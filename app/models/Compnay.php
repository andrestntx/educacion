<?php 

class Company extends ModelEloquent
{
	protected $table = 't01_company';
	protected $primaryKey = 't01_id';
	protected $fillable = array('t01_name');
	protected $globalModel = 2;
	public $timestamps = true;
	public $increments = true;
	public $errors;
	protected $attributeNames = array('t01_id' => 'Id', 't01_name' => 'Nombre', 't01_tel' => 'Telefono', 
        't01_email' => 'Correco electrónico', 'created_at' => 'Creación', 
        'updated_at' => 'Actualización', 't01_url_logo' => 'Logo');
	protected $mainAttributes = array('t01_id', 't01_name', 'created_at');


	/***** Relations *****/
	public function usersPreferCompany()
	{
	    return $this->hasMany('User', 't02_preferred_company_id');
	}

	public function users()
	{
	    return $this->belongsToMany('User', 't05_users_has_companies', 't05_user_id', 't05_company_id');
	}
	/***** End Relations *****/

	public function getT01UrlLogoValidatedAttribute()
	{
		if (File::exists($this->t01_url_logo))
		{
			return $this->t01_url_logo;
		}
		else
		{
			return Config::get('constant.url_company_logo_demo');
		}
	}

	public static function findOrActual($id = null)
	{
		if(is_null($id))
		{
			return Session::get('actual_company');
		}
		else
		{
			return Company::find($id);
		}
	}

	public function isValid($data)
    {
        $rules = array(
            't01_name'     => 'required|max:100|unique:t01_company',
            't01_url_logo' => 'mimes:png|max:500'
        );

        if ($this->exists)
        {
			$rules['t01_name'] .= ',t01_name,'.$this->t01_id.',t01_id';
        }
        else // Si no existe...
        {
            // La clave es obligatoria:
            $rules['t01_url_logo'] .= '|required';
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
            if(array_key_exists('t01_url_logo', $data))
            {
            	$this->uploadLogo($data['t01_url_logo']);
            }
            
            return true;
        }
        
        return false;
    }

    public function uploadLogo($file)
    {
    	if(is_file($file))
    	{
	    	$url_logo = Config::get('constant.path_companies_logos').'/'.$this->t01_id.'.png';
	    	Image::make($file)->widen(225)->save($url_logo);
	    	$this->t01_url_logo = $url_logo;
	    	$this->save();
    	}
    }
}
