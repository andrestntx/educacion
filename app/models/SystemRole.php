<?php 

class SystemRole extends Eloquent
{
	protected $table = 'sys01_system_role';
	protected $primaryKey = 'sys01_id';
	public $timestamps = true;

	public function users()
	{
	    return $this->hasMany('User', 't02_system_role_id');
	}
}