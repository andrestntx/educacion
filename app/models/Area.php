<?php 
	/**
	* 
	*/
	class Area extends ModelEloquent
	{
		protected $table = 't07_area';
		protected $primaryKey = 't07_id';
		protected $fillable = array('t07_name', 't07_description', 't07_company_id');
		protected  $globalModel = 4;
		public $timestamps = true;
		public $increments = true;
		public $errors;
		protected $attributeNames = array('t07_id' => 'Id', 't07_name' => 'Nombre', 't07_description' => 'Descripción', 
			'created_at' => 'Creación', 't07_company_id' => 'Institución',
	        'updated_at' => 'Actualización');
		protected $mainAttributes = array('t07_id', 't07_name', 't07_description', 'created_at');


		public function isValid($data)
	    {
	        $rules = array(
	            't07_name'     => 'required|max:100',
	            't07_company_id' => 'required'
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