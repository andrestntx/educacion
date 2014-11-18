<?php 
	/**
	* 
	*/
	class UserRole extends ModelEloquent
	{
		protected $table = 't03_user_role';
		protected $primaryKey = 't03_id';
		protected $fillable = array('t03_name', 't03_description', 't03_company_id');
		protected  $globalModel = 4;
		public $timestamps = true;
		public $increments = true;
		public $errors;
		protected $attributeNames = array('t03_id' => 'Id', 't03_name' => 'Nombre', 't03_description' => 'Descripción', 
			'created_at' => 'Creación', 't03_company_id' => 'Institución',
	        'updated_at' => 'Actualización');
		protected $mainAttributes = array('t03_id', 't03_name', 't03_description', 'created_at');


		public function isValid($data)
	    {
	        $rules = array(
	            't03_name'     => 'required|max:100',
	            't03_company_id' => 'required'
	        );

	        $validator = Validator::make($data, $rules);
	        
	        if ($validator->passes())
	        {
	            return true;
	        }
	        
	        $this->errors = $validator->errors();
	        
	        return false;
	    }

	    public function validAndSave($data)
	    {
	        if ($this->isValid($data))
	        {
	            $this->fill($data);
	            $this->save();
	            
	            return true;
	        }
	        
	        return false;
	    }
	}
 ?>