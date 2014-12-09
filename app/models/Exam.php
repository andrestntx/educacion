<?php 
	/**
	* 
	*/
	class Exam extends Eloquent
	{
		protected $table = 't16_exam';
		protected $primaryKey = 't16_id';
		protected $fillable = array('t16_protocol_id', 't16_user_id');
		public $timestamps = true;
		public $increments = true;
		public $errors;

	}
 ?>