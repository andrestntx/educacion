<?php 

class Module extends Eloquent
{
	protected $table = 'sys02_module';
	protected $primaryKey = 'sys02_id';
	protected $fillable = array('sys02_name');
	public $timestamps = true;
	public $increments = true;
	public $errors;

    public function model()
    {
        return $this->belongsTo('GlobalModel', 'sys02_table_id');
    }

	public function isValid($data)
    {
        $rules = array(
            'sys02_name'     => 'required|max:100|unique:sys02_module'
        );

        if ($this->exists)
        {
			$rules['sys02_name'] .= ',sys02_name,'.$this->sys02_id.',sys02_id';
        }
        
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

   /* public static function ordered()
    {
        $modules = self::orderBy('sys02_top_module_id')->orderBy('sys02_order')->get();
        $orderedModules = array();
        $top_module_id = 1;

        foreach ($modules as $module) 
        {
            if($module->sys02_order == 0)
            {
                $orderedModules[$module->id]['module'] = $module;
            }
            else
            {
                $orderedModules[$module->sys02_top_module_id]['sons'][$module->id]['module'] = $module;
            } 
        }
        return $orderedModules;
    }
    */
}
