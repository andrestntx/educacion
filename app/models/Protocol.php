<?php 

class Protocol extends Eloquent
{
	protected $table = 'protocol';
	protected $primaryKey = 'id';
	protected $fillable = array('name', 'description', 'user_id');
	public $timestamps = true;
	public $increments = true;
	public $errors;
    

    public function getUserValueAttribute()
    {
        return $this->user->name;
    }

    public function getCategoriesListsAttribute()
    {
        return $this->categories->lists('id');
    }

    public function getAreasListsAttribute()
    {
        return $this->areas->lists('id');
    }

    public function getRolesListsAttribute()
    {
        return $this->roles->lists('id');
    }


    /* Exams */

    public function lastExam()
    {
        $examScore = $this->examScores->sortByDesc('updated_at')->first();

        if(!is_null($examScore))
        {
            return $examScore;
        }

        return null;
    }

    public function isPdfCorrect()
    {
        if(File::isFile($this->url_pdf))
        {
            return true;
        }

        return false;
    }

    public function getPdfAttribute()
    {
        if(File::isFile($this->url_pdf))
        {
            return $this->url_pdf;
        }

        return '#';
    }

    public function getLastExamUpdateAttribute()
    {
        if($examScore = $this->lastExam())
        {
            return $examScore->updated_at;
        } 

        return 'SIN EXAMEN';
    }

    public function getLastExamScoreAttribute()
    {
        if($examScore = $this->lastExam())
        {
            return $examScore->score;
        } 

        return 'NA';
    }

    public function bestExam()
    {
        $examScore = $this->examScores->sortByDesc('score')->first();

        if(!is_null($examScore))
        {
            return $examScore;
        }

        return null;
    }

    public function getBestExamScoreAttribute()
    {
        if($exam = $this->bestExam())
        {
            return $exam->score;
        }

        return 'NA';
    }

    public function getbestExamStatusAttribute()
    {
        if($exam = $this->bestExam())
        {
            if($exam->score > 80){
                return 'APROBADO';
            }
            else
            {
                return 'SIN APROBAR';
            }
        }

        return 'NO PRESENTADO';
    }

    public function getNumberAnnexAttribute()
    {
        return $this->annex->count();
    }

    public function getNumberQuestionsAttribute()
    {
        return $this->survey->number_questions;
    }

    /* End Exams */

    /***** Relations *****/

    public function survey()
    {
        return $this->belongsTo('Survey', 'survey_id');
    }

    public function examScores()
    {
        return $this->hasMany('ExamScores', 'survey_id');
    }

    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    public function areas()
    {
        return $this->belongsToMany('Area', 'protocols_has_areas', 'protocol_id', 'area_id');
    }

    public function categories()
    {
        return $this->belongsToMany('ProtocolCategory', 'protocols_has_categories', 'protocol_id', 'category_id');
    }

    public function roles()
    {
        return $this->belongsToMany('UserRole', 'protocols_has_roles', 'protocol_id', 'role_id');
    }

    public function annex()
    {
        return $this->hasMany('Annex', 'protocol_id');
    }

    /***** End Relations *****/

    public function getAnnexFileAttribute()
    {
        $annex = $this->annex->filter(function($annex)
        {
            return $annex->isFile();
        });

        return $annex;
    }

    public function getAnnexLinkAttribute()
    {
        $links = $this->annex->filter(function($annex)
        {
            return $annex->isLink();
        });

        return $links;
    }

    /***** Scopes *****/

    public function scopeUserCanStudy($query, $user_id)
    {
        return $query->joinCanStudyProtocols()
            ->where('users_can_study_protocols.user_id', $user_id);
    }

    public function scopeJoinCanStudyProtocols($query)
    {
        return $query->join('users_can_study_protocols', 'protocol_id', '=', 'protocol.id');
    }

    /****** End Scopes ******/

	public function isValid($data)
    {
        $rules = array(
            'name'     => 'required|max:100|unique:protocol',
            'user_id' => 'required',
            'url_pdf' => 'mimes:pdf|max:35000'
        );

        if ($this->exists)
        {
			$rules['name'] .= ',name,'.$this->id.',id';
        }
        else 
        {
            $rules['url_pdf'] .= '|required';
        }
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }

    public function isValidPDF($pdf)
    {
        if(!is_null($pdf) && !$pdf->isValid())
        {
            $this->errors = array('El campo PDF debe ser menor que '.ini_get('upload_max_filesize'));
            return false;
        }

        return true;
    }

    public function validAndSave($data, $pdf)
    {
        if ($this->isValidPDF($pdf) && $this->isValid($data))
        {
            $this->fill($data);
            if(!$this->exists)
            {
                $survey = Survey::create(array('name' => 'Examen de Protocolo ' + $data['name'], 'created_by' => Auth::user()->id, 'type_id' => 2));
                $this->survey_id = $survey->id;
            }
            $this->save();
            $this->uploadPdf($pdf);

            if(array_key_exists('areas', $data))
            {
                $this->syncAreas($data['areas']);
            }

            if(array_key_exists('categories', $data))
            {
                $this->syncCategories($data['categories']);
            }

            if(array_key_exists('roles', $data))
            {
                $this->syncRoles($data['roles']);
            }
            
            return true;
        }
        
        return false;
    }

    public function syncRoles($roles = array())
    {
        $this->roles()->sync($roles);
    }

    public function syncCategories($categories = array())
    {
        $this->categories()->sync($categories);
    }

    public function syncAreas($areas = array())
    {
        $this->areas()->sync($areas);
    }

    public function uploadPdf($pdf)
    {
        if (File::isFile($pdf))
        {
        	$url = Config::get('constant.path_protocols_pdf').'/'.$this->id.'.'.$pdf->getClientOriginalExtension();
            
            $pdf->move(Config::get('constant.path_protocols_pdf'), $this->id.'.'.$pdf->getClientOriginalExtension());
        	$this->url_pdf = $url;
        	$this->save();
        }
    }
}
