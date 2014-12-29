<?php 

class SurveyType extends Eloquent
{
	protected $table = 'survey_type';
	protected $primaryKey = 'id';
	protected $fillable = array('name', 'description');
	public $timestamps = false;
	public $increments = true;
	public $errors;
}

?>