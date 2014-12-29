<?php 
	/**
	* 
	*/
	class Area extends Eloquent
	{
		protected $table = 'area';
		protected $primaryKey = 'id';
		protected $fillable = array('name', 'description', 'company_id');
		public $timestamps = true;
		public $increments = true;
		public $errors;


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