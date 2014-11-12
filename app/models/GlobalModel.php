<?php 

class GlobalModel extends Eloquent
{
	protected $table = 'sys03_table';
	protected $primaryKey = 'sys03_id';
	protected $fillable = array('plural_name', 'singular_name');
    protected static $globalModel = 1;
	public $timestamps = true;
	public $increments = true;
	public $errors;

    public static function getGlobalModel()
    {
        return self::findOrFail(self::$globalModel);
    }

    public function getIconAttribute()
    {
        if(!is_null($this->attributes['icon']))
        {
            return $this->attributes['icon'];
        }
        return 'fa-edit';
    }

	public function isValid($data)
    {
        $rules = array(
            'singular_name'     => 'required|max:100|unique:sys03_table',
            'plural_name'     => 'required|max:100|unique:sys03_table'
        );

        if ($this->exists)
        {
            $rules['singular_name'] .= ',singular_name,'.$this->sys03_id.',sys03_id';
            $rules['plural_name'] .= ',plural_name,'.$this->sys03_id.',sys03_id';
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
}
