<?php 

class QuestionType extends Eloquent
{
	protected $table = 'question_type';
	protected $primaryKey = 'id';
	protected $fillable = array('name', 'description');
	public $timestamps = false;
	public $increments = true;
	public $errors;
}

?>