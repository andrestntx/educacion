<?php 

class Protocol extends ModelEloquent
{
	protected $table = 't06_protocol';
	protected $primaryKey = 't06_id';
	protected $fillable = array('t06_name');
	protected $globalModel = 2;
	public $timestamps = true;
	public $increments = true;
	public $errors;
	protected $attributeNames = array('t06_id' => 'Id', 't06_name' => 'Nombre');
	protected $mainAttributes = array('t06_id', 't06_name');


	public function isValid($data)
    {
        $rules = array(
            't06_name'     => 'required|max:100|unique:t06_company',
            't06_url_logo' => 'mimes:png|max:500'
        );

        if ($this->exists)
        {
			$rules['t06_name'] .= ',t06_name,'.$this->t06_id.',t06_id';
        }
        else // Si no existe...
        {
            // La clave es obligatoria:
            $rules['t06_url_logo'] .= '|required';
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
            if(array_key_exists('t06_url_logo', $data))
            {
            	$this->uploadLogo($data['t06_url_logo']);
            }
            
            return true;
        }
        
        return false;
    }

    public function uploadLogo($file)
    {
    	if(is_file($file))
    	{
	    	$url_logo = Config::get('constant.path_companies_logos').'/'.$this->t06_id.'.png';
	    	Image::make($file)->widen(225)->save($url_logo);
	    	$this->t06_url_logo = $url_logo;
	    	$this->save();
    	}
    }
}
