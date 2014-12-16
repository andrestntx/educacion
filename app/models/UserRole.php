<?php 
	/**
	* 
	*/
	class UserRole extends Eloquent
	{
		protected $table = 'user_role';
		protected $primaryKey = 'id';
		protected $fillable = array('name', 'description', 'company_id');
		protected  $globalModel = 4;
		public $timestamps = true;
		public $increments = true;
		public $errors;
		protected $attributeNames = array('id' => 'Id', 'name' => 'Nombre', 'description' => 'Descripción', 
			'created_at' => 'Creación', 'company_id' => 'Institución',
	        'updated_at' => 'Actualización');
		protected $mainAttributes = array('id', 'name', 'description', 'created_at');


		public function isValid($data)
	    {
	        $rules = array(
	            'name'     => 'required|max:100',
	            'company_id' => 'required'
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