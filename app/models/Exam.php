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

	    public function getScoreAttribute()
	    {
	    	return $this->answers()->whereCorrect(true)->count() / $this->answers()->count() * 100;
	    }
	}
 ?>