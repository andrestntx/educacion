<?php 
/**
* 
*/

class ExamScores extends Eloquent
{
	protected $table = 'exam_scores';
	protected $primaryKey = 'id';

	public function getFormatedScoreAttribute()
    {
        return number_format($this->score, 0);
    }
}


?>