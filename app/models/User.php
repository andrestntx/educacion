<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends ModelEloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 't02_user';
	protected $primaryKey = 't02_id';
	protected $fillable = array(
        'username', 'password', 'email', 't02_name', 't02_tel','t02_preferred_company_id', 't02_system_role_id', 
        'password'
    );
    protected $attributeNames = array('t02_id' => 'Id', 't02_name' => 'Nombre', 't02_tel' => 'Telefono', 
        'username' => 'Nombre de Usuario', 'email' => 'Correco electrónico', 'created_at' => 'Creación', 
        'updated_at' => 'Actualización', 't02_preferred_company_id' => 'Institución Preferida', 
        't02_system_role_id' => 'Tipo de Usuario', 't02_url_photo' => 'Foto de Perfil');
    protected $mainAttributes = array('t02_id', 't02_name', 'email');
	public $timestamps = true;
	protected $globalModel = 3;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


    public function getT02UrlPhotoValidatedAttribute()
    {
        if (File::exists($this->t02_url_photo))
        {
            return $this->t02_url_photo;
        }
        else
        {
            return Config::get('constant.url_user_photo');
        }
    }

    /*** Relations ***/

    public function protocols()
    {
        return $this->hasMany('Protocol', 't06_user_id');
    }

	public function preferredCompany()
    {
        return $this->belongsTo('Company', 't02_preferred_company_id');
    }

    public function systemRole()
    {
        return $this->belongsTo('SystemRole', 't02_system_role_id');
    }

    public function roles()
    {
        return $this->belongsToMany('UserRole', 't04_users_has_roles', 't04_user_id', 't04_role_id');
    }

    public function areas()
    {
        return $this->belongsToMany('Area', 't08_users_has_areas', 't08_user_id', 't08_area_id');
    }

    public function companies()
    {
        return $this->belongsToMany('Company', 't05_users_has_companies', 't05_user_id', 't05_company_id');
    }
    /*** End Relations ***/

    public function getCompaniesIdAttribute()
    {
        return $this->companies->lists('t01_id');
    }

    public function getT02NameRoleAttribute()
    {
    	if ($this->t02_system_role_id == 1 || $this->t02_system_role_id == 2) {
    		return $this->systemRole->sys01_name;
    	}
    	else
    	{
    		return 'Usuario Registrado';
    	}
    }

    public function setPasswordAttribute($value)
    {
        if(!empty($value)){
            $this->attributes['password'] = Hash::make(trim($value));
        }
    }

    public function isValid($data)
    {
        $rules = array(
            'username'     => 'required|max:100|unique:t02_user',
            'email'     => 'required|max:100|unique:t02_user',
            'password' =>  'confirmed',
            't02_preferred_company_id' => 'required',
            't02_system_role_id' => 'required'
        );

        if ($this->exists)
        {
			$rules['username'] .= ',username,'.$this->t02_id.',t02_id';
			$rules['email'] .= ',email,'.$this->t02_id.',t02_id';
        }
        else 
        {
            $rules['password'] .= '|required';
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

            if(array_key_exists('t02_url_photo', $data))
            {
                $this->uploadLogo($data['t02_url_photo']);
            }

            if(array_key_exists('roles', $data))
            {
                $this->syncRoles($data['roles']);
            }

            if(array_key_exists('areas', $data))
            {
                $this->syncAreas($data['areas']);
            }

            return true;
        }
        
        return false;
    }

    public function syncRoles($roles = array())
    {
        $this->roles()->sync($roles);
    }

    public function syncAreas($areas = array())
    {
        $this->areas()->sync($areas);
    }

    public function syncCompanies($companies = array())
    {
        $data_companies = array();
        foreach ($companies as $company_id) 
        {
            $data_companies[$company_id] = array('t05_active' => true);
        }
        $this->companies()->sync($data_companies);
    }

    public function uploadLogo($file)
    {
        if(is_file($file))
        {
            $url = Config::get('constant.path_users_photos').'/'.$this->id.'.png';
            Image::make($file)->widen(225)->save($url);
            $this->t02_url_photo = $url;
            $this->save();
        }
    }
}
