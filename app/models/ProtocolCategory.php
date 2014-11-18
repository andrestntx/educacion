<?php 
	/**
	* 
	*/
	class ProtocolCategory extends ModelEloquent
	{
		protected $table = 't09_protocol_category';
		protected $primaryKey = 't09_id';
		protected $fillable = array('t09_name', 't09_description', 't09_company_id');
		protected  $globalModel = 4;
		public $timestamps = true;
		public $increments = true;
		public $errors;
		protected $attributeNames = array('t09_id' => 'Id', 't09_name' => 'Nombre', 't09_description' => 'Descripción', 
			'created_at' => 'Creación', 't09_company_id' => 'Institución',
	        'updated_at' => 'Actualización');
		protected $mainAttributes = array('t09_id', 't09_name', 't09_description', 'created_at');


		public function isValid($data)
	    {
	        $rules = array(
	            't09_name'     => 'required|max:100',
	            't09_company_id' => 'required'
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