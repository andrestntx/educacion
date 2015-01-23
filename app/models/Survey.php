<?php 
/**
* 
*/

class Survey extends Eloquent
{
	protected $table = 'survey';
	protected $primaryKey = 'id';
	protected $fillable = array('created_by', 'name', 'description', 'type_id');
	public $timestamps = true;
	public $increments = true;
	public $errors;

    public function scopeWhereNotExam($query)
    {
        return $query->where('type_id', '<>', 1);
    }

    public function getNumberQuestionsAttribute()
    {
        return $this->questions->count();
    }

    public function getAreasListsAttribute()
    {
        return $this->areas->lists('id');
    }

    public function getRolesListsAttribute()
    {
        return $this->roles->lists('id');
    }

    public function questions()
    {
        return $this->hasMany('Question', 'survey_id');
    }

    public function creator()
    {
        return $this->belongsTo('User', 'created_by');
    }

    public function type()
    {
        return $this->belongsTo('SurveyType', 'type_id');
    }

    public function areas()
    {
        return $this->belongsToMany('Area', 'surveys_has_areas', 'survey_id', 'area_id');
    }

    public function roles()
    {
        return $this->belongsToMany('UserRole', 'surveys_has_roles', 'survey_id', 'role_id');
    }

    public function randomQuestions()
    {
        if($this->questions->count() >= 10)
        {
            return $this->questions->random(10);
        }

        return $this->questions;
    }

    public function scopeUserCanAcces($query, $user_id)
    {
        return $query->joinCanAccess()
            ->where('users_has_access_surveys.user_id', $user_id);
    }

    public function scopeJoinCanAccess($query)
    {
        return $query->join('users_has_access_surveys', 'users_has_access_surveys.survey_id', '=', 'survey.id');
    }

    public function isValid($data)
    {
        $rules = array(
            'name'  => 'required|max:100',
            'created_by' => 'required',
            'type_id' => 'required'
        );

        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }

    public function validAndSave($data)
    {
        if ($this->isValid($data))
        {
            $this->fill($data);
            $this->save();

            if(array_key_exists('areas', $data))
            {
                $this->syncAreas($data['areas']);
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

    public function syncAreas($areas = array())
    {
        $this->areas()->sync($areas);
    }
}


?>