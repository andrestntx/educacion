<?php 

class Module extends Eloquent
{
	protected $table = 'module';
	protected $primaryKey = 'id';
	protected $fillable = array('name');
	public $timestamps = true;
	public $increments = true;
	public $errors;

    public function model()
    {
        return $this->belongsTo('GlobalModel', 'table_id');
    }

	public function isValid($data)
    {
        $rules = array(
            'name'     => 'required|max:100|unique:module'
        );

        if ($this->exists)
        {
			$rules['name'] .= ',name,'.$this->id.',id';
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
        $modules = self::orderBy('top_module_id')->orderBy('order')->get();
        $orderedModules = array();
        $top_module_id = 1;

        foreach ($modules as $module) 
        {
            if($module->order == 0)
            {
                $orderedModules[$module->id]['module'] = $module;
            }
            else
            {
                $orderedModules[$module->top_module_id]['sons'][$module->id]['module'] = $module;
            } 
        }
        return $orderedModules;
    }
    */
}
