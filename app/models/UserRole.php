<?php 
	/**
	* 
	*/
	class UserRole extends Eloquent
	{
		protected $table = 't03_user_role';
		protected $primaryKey = 't03_id';
		protected $fillable = array(
	        
	    );
		public $timestamps = true;
		protected static $globalModel = 4;
	}
 ?>