<?php 

class CompanyType extends Eloquent
{
	protected $table = 'company_type';
	protected $primaryKey = 'id';
	protected $fillable = array('name', 'description');
	public $timestamps = false;
	public $increments = true;
	public $errors;
}

?>