<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'user';
	protected $primaryKey = 'id';
	protected $fillable = array(
        'username', 'password', 'email', 'name', 'tel','preferred_company_id', 'system_role_id', 
        'password'
    );
	public $timestamps = true;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


    /* Exams */

    public function hasExmasProtocol($protocol_id)
    {
        if($this->numberExamsProtocol($protocol_id) > 0)
        {
            return true;
        }

        return false;
    }

    public function examsProtocol($protocol_id)
    {
        return $this->exams()->whereProtocolId($protocol_id);
    }

    public function numberExamsProtocol($protocol_id)
    {
        return $this->examsProtocol($protocol_id)->count();
    }

    public function lastExamProtocol($protocol_id)
    {
        $exam = $this->examsProtocol($protocol_id)->get()->sortByDesc('updated_at')->first();

        if(!is_null($exam))
        {
            return $exam;
        }

        return null;
    }

    public function lastExamProtocol_update($protocol_id)
    {
        if($this->hasExmasProtocol($protocol_id))
        {
            return $this->lastExamProtocol($protocol_id)->updated_at;
        }

        return 'Sin examenes';
    }

    public function lastExamProtocol_score($protocol_id)
    {
        if($this->hasExmasProtocol($protocol_id))
        {
            return $this->lastExamProtocol($protocol_id)->score;
        } 

        return 'NA';
    }

    public function bestExamProtocol($protocol_id)
    {
        $exam = $this->examsProtocol($protocol_id)->get()->sortByDesc(function($exam)
        {
            return $exam->score;
        })->first();

        if(!is_null($exam))
        {
            return $exam;
        }

        return null;
    }

    public function bestExamProtocol_score($protocol_id)
    {
        if($this->hasExmasProtocol($protocol_id))
        {
            return $this->bestExamProtocol($protocol_id)->score;
        }

        return 'NA';
    }

    /* End Exams */

    public function editTypeUser()
    {
        if($this->isSuperAdmin())
        { 
            return 'Administrador';
        }
        else
        {
            return 'Usuario'; 
        } 
    }

    public function isSuperAdmin()
    {
        if($this->system_role_id == 1)
        {
            return true;
        }
        return false;
    }

    public function isAdmin()
    {
        if($this->system_role_id == 2)
        {
            return true;
        }
        return false;
    }

    public function isRegistred()
    {
        if($this->system_role_id == 3)
        {
            return true;
        }
        return false;
    }

    /*** Scopes ***/

    public function scopeAdmin($query)
    {
        return $query->where('system_role_id', '=', 2);
    }

    public function scopeRegistred($query)
    {
        return $query->where('system_role_id', '=', 3);
    }

    /*** End Scopes ***/

    /*** Relations ***/

    public function protocolsForStudy()
    {
        return $this->preferredCompany->protocols()->orderBy('id')->get();
    }

    public function exams()
    {
        return $this->hasMany('Exam', 'user_id');
    }

    public function protocols()
    {
        return $this->hasMany('Protocol', 'user_id');
    }

	public function preferredCompany()
    {
        return $this->belongsTo('Company', 'preferred_company_id');
    }

    public function systemRole()
    {
        return $this->belongsTo('SystemRole', 'system_role_id');
    }

    public function roles()
    {
        return $this->belongsToMany('UserRole', 'users_has_roles', 'user_id', 'role_id');
    }

    public function areas()
    {
        return $this->belongsToMany('Area', 'users_has_areas', 'user_id', 'area_id');
    }

    public function companies()
    {
        return $this->belongsToMany('Company', 'users_has_companies', 'user_id', 'company_id');
    }
    /*** End Relations ***/

    /*** Mutators **/ 
    public function getCompaniesIdAttribute()
    {
        return $this->companies->lists('id');
    }

    public function getNameRoleAttribute()
    {
    	if ($this->system_role_id == 1 || $this->system_role_id == 2) {
    		return $this->systemRole->name;
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

    public function getImageAttribute()
    {
        if (File::exists($this->url_photo))
        {
            return $this->url_photo.'?'.time();
        }
        else
        {
            return Config::get('constant.url_user_photo').'?'.time();
        }
    }

    /*** End Mutators **/ 

    public function isValidImage($imagen)
    {
        if(!is_null($imagen) && !$imagen->isValid())
        {
            $this->errors = array('La imagen debe ser menor que '.ini_get('upload_max_filesize'));
            return false;
        }

        return true;
    }

    public function isValid($data)
    {
        $rules = array(
            'username'     => 'required|max:100|unique:user',
            'email'     => 'required|max:100|unique:user',
            'password' =>  'confirmed',
            'url_photo' => 'mimes:jpeg,png,bmp|max:1500'
        );

        if ($this->exists)
        {
			$rules['username'] .= ',username,'.$this->id.',id';
			$rules['email'] .= ',email,'.$this->id.',id';
        }
        else 
        {
            $rules['password'] .= '|required';
            $rules['preferred_company_id'] = 'required';
            $rules['system_role_id'] = 'required';
        }
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }

    public function validAndSave($data, $image)
    {
        if ($this->isValidImage($image) && $this->isValid($data))
        {
            $this->fill($data);
            $this->save();
            $this->uploadImage($image);

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
            $data_companies[$company_id] = array('active' => true);
        }
        $this->companies()->sync($data_companies);
    }

    public function uploadImage($image)
    {
        if(File::isFile($image))
        {
            $url = Config::get('constant.path_users_photos').'/'.$this->id.'.'.$image->getClientOriginalExtension();
            Image::make($image)->widen(300)->save($url);
            $this->url_photo = $url;
            $this->save();
        }
    }
}
