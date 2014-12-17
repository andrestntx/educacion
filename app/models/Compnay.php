<?php 

class Company extends Eloquent
{
	protected $table = 'company';
	protected $primaryKey = 'id';
	protected $fillable = array('name');
	protected $globalModel = 2;
	public $timestamps = true;
	public $increments = true;
	public $errors;
	protected $attributeNames = array('id' => 'Id', 'name' => 'Nombre', 'tel' => 'Telefono', 
        'email' => 'Correco electrónico', 'created_at' => 'Creación', 
        'updated_at' => 'Actualización', 'url_logo' => 'Logo');
	protected $mainAttributes = array('id', 'name', 'created_at');


	/***** Relations *****/
	public function usersPreferCompany()
	{
	    return $this->hasMany('User', 'preferred_company_id');
	}

	public function protocolCategories()
	{
	    return $this->hasMany('ProtocolCategory', 'company_id');
	}

	public function protocols()
    {
        return $this->hasManyThrough('Protocol', 'User', 'preferred_company_id', 'user_id');
    }

	public function roles()
	{
	    return $this->hasMany('UserRole', 'company_id');
	}

	public function areas()
	{
	    return $this->hasMany('Area', 'company_id');
	}

	public function users()
	{
		return $this->belongsToMany('User', 'users_has_companies', 'company_id', 'user_id');
	}
	/***** End Relations *****/

	public function getLogoAttribute()
	{
		if (File::exists($this->url_logo))
		{
			return $this->url_logo.'?'.time();
		}
		else
		{
			return Config::get('constant.url_company_logo_demo').'?'.time();
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

	public function isValidLogo($logo)
    {
        if(!is_null($logo) && !$logo->isValid())
        {
            $this->errors = array('El logo debe ser menor que '.ini_get('upload_max_filesize'));
            return false;
        }

        return true;
    }

	public function isValid($data)
    {
        $rules = array(
            'name'     => 'required|max:100|unique:company',
            'url_logo' => 'mimes:jpeg,png,bmp|max:1500'
        );

        if ($this->exists)
        {
			$rules['name'] .= ',name,'.$this->id.',id';
        }
        else 
        {
            $rules['url_logo'] .= '|required';
        }
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }

    public function validAndSave($data, $logo)
    {
        if ($this->isValidLogo($logo) && $this->isValid($data))
        {
            $this->fill($data);
            $this->save();
            $this->uploadLogo($logo);
            
            return true;
        }
        
        return false;
    }

    public function uploadLogo($file)
    {
    	if(File::isFile($file))
    	{
	    	$url_logo = Config::get('constant.path_companies_logos').'/'.$this->id.'.'.$file->getClientOriginalExtension();
	    	Image::make($file)->widen(225)->save($url_logo);
	    	$this->url_logo = $url_logo;
	    	$this->save();
    	}
    }

    public function createDefaultData()
    {
    	Area::create(array('name' =>  'Todas las áreas', 'company_id' => $this->id));
    	ProtocolCategory::create(array('name' =>  'Todas los Protocolos', 'company_id' => $this->id));
    	UserRole::create(array('name' =>  'Perfil general', 'company_id' => $this->id));

    	return true;
    }
}
