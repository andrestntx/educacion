<?php 

class Patient extends Eloquent
{
	protected $table = 'patient';
	protected $primaryKey = 'id';
	protected $fillable = array('country_id', 'name', 'date_of_birth', 'company_id');
	public $timestamps = true;
	public $increments = true;
	public $errors;


    public function company()
    {
        return $this->belongsTo('Company', 'company_id');
    }
}
