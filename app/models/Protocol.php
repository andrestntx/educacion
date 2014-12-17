<?php 

class Protocol extends Eloquent
{
	protected $table = 'protocol';
	protected $primaryKey = 'id';
	protected $fillable = array('name', 'description', 'user_id');
	protected $globalModel = 2;
	public $timestamps = true;
	public $increments = true;
	public $errors;
	protected $attributeNames = array('url_pdf' => 'Pdf', 'id' => 'Id', 'description' => 'Descripción', 
        'name' => 'Nombre', 'user_id' => 'Autor', 'created_at' => 'Creación', 'updated_at' => 'Actualización',
    );
	protected $mainAttributes = array('id', 'name', 'user_id');
    protected $relationsArray = array('user_id' => 'user');

    public function getUserValueAttribute()
    {
        return $this->user->name;
    }

    /***** Relations *****/

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

    public function questions()
    {
        return $this->hasMany('Question', 'protocol_id');
    }

    public function exams()
    {
        return $this->hasMany('Exam', 'protocol_id');
    }

    /***** End Relations *****/

    public function randomQuestions()
    {
        if($this->questions()->count() >= 10)
        {
            return $this->questions->random(10);
        }

        return $this->questions;
        
    }

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
            $pdf->move($url);
        	$this->url_pdf = $url;
        	$this->save();
        }
    }
}
