<?php 

class SystemRole extends Eloquent
{
	protected $table = 'system_role';
	protected $primaryKey = 'id';
	public $timestamps = true;

	public function users()
	{
	    return $this->hasMany('User', 'system_role_id');
	}
}