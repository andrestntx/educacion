<?php 

class Question extends Eloquent
{
	protected $table = 'question';
	protected $primaryKey = 'id';
	protected $fillable = array('text', 'survey_id', 'type_id');
	public $timestamps = true;
	public $increments = true;



    /* Relations */
     
    public function survey()
    {
        return $this->belongsTo('Survey', 'survey_id');
    }

    public function type()
    {
        return $this->belongsTo('QuestionType', 'type_id');
    }

    public function answers()
    {
        return $this->hasMany('Answer', 'question_id');
    }

    /* End Relations */

    public function isMultiple()
    {
        if($this->type_id == 1)
        {
            return true;
        }

        return false;
    }

    public function isSimple()
    {
        if($this->type_id == 2)
        {
            return true;
        }

        return false;
    }

    public function isText()
    {
        if($this->type_id == 3)
        {
            return true;
        }

        return false;
    }

	public function isValid($data)
    {
        $rules = array(
            'text'     => 'required',
            'survey_id' => 'required'
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
            $isUpdate = $this->exists;

            $this->fill($data);
            $this->save();

            if($this->isMultiple())
            {
                $this->saveAnswers($data['answers'], $isUpdate);
            }

            return true;
        }
        
        return false;
    }

    public function saveAnswers($data, $isUpdate = false)
    {
        foreach ($data as $id => $value) 
        {
            if(array_key_exists('correct', $value))
            {
                $value['correct'] = 1;
            }
            else
            {
                $value['correct'] = 0;
            }
            
            if($isUpdate)
            {
                Answer::where('id', $id)->update($value);
            }
            else
            {
                $answer = new Answer($value);
                $this->answers()->save($answer);
            }
        }

        return true;
    }
}
