<?php 
/**
* 
*/

class ResolvedSurvey extends Eloquent
{
	protected $table = 'resolved_survey';
	protected $primaryKey = 'id';
	protected $fillable = array('name', 'description', 'survey_id', 'user_id');
	public $timestamps = true;
	public $increments = true;
	public $errors;


    public function survey()
    {
        return $this->belongsTo('Survey', 'survey_id');
    }

    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    public function answers()
    {
        return $this->belongsToMany('Answer', 'resolved_survey_has_answer', 'resolved_survey_id', 'answer_id');
    }

    public function validAndSave($survey_id, $user_id, $multipleAnswers = null, $simpleAnswers = null)
    {
        $this->survey_id = $survey_id;
        $this->user_id = $user_id;
        $this->save();

        if(!is_null($simpleAnswers))
        {
            foreach ($simpleAnswers as $question_id => $text) 
            {
                $newAnswers[$question_id] = new Answer(array('question_id' => $question_id, 'text' => $text));
            }  
            $this->answers()->saveMany($newAnswers);
        }
        
        if(!is_null($multipleAnswers))
        {
            $this->answers()->attach($multipleAnswers);    
        }
    }

}


?>