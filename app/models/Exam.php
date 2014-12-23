<?php 
/**
* 
*/

class Exam extends Eloquent
{
	protected $table = 'exam';
	protected $primaryKey = 'id';
	protected $fillable = array('protocol_id', 'user_id');
	public $timestamps = true;
	public $increments = true;
	public $errors;

	public function answers()
    {
        return $this->belongsToMany('Answer', 'exams_has_answers', 'exam_id', 'answer_id');
    }

    public function numberAnswers()
    {
    	return $this->answers()->count();
    }

    public function getScoreAttribute()
    {
    	$numberAnswers = $this->numberAnswers();
    	if($numberAnswers > 0)
    	{
            $score = $this->answers()->corrects()->count() / $numberAnswers * 100;
            return number_format($score,1);
    	}

    	return 0;
    }

}


?>