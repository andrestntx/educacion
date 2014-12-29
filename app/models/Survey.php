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

    public function getNumberQuestionsAttribute()
    {
        return $this->questions->count();
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

    public function randomQuestions()
    {
        if($this->questions->count() >= 10)
        {
            return $this->questions->random(10);
        }

        return $this->questions;
    }

    public function isTypeCheck()
    {
        if($this->type_id == 2)
        {
            return true;
        }

        return false;
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
            
            return true;
        }
        
        return false;
    }
}


?>