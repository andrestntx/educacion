<?php 

class Annex extends Eloquent
{
	protected $table = 'annex';
	protected $primaryKey = 'id';
	protected $fillable = array('name', 'description', 'protocol_id');
	protected $globalModel = 2;
	public $timestamps = true;
	public $increments = true;
	public $errors;
	protected $attributeNames = array('url' => 'Archivo', 'id' => 'Id', 'description' => 'Descripción', 
        'name' => 'Nombre', 'created_at' => 'Creación', 'updated_at' => 'Actualización',
    );
	protected $mainAttributes = array('name');
    protected $relationsArray = array('user_id' => 'user');

    public function getUserValueAttribute()
    {
        return $this->user->name;
    }

    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    public function isValidFile($file)
    {
        if(!is_null($file) && !$file->isValid())
        {
            $this->errors = array('El Archivo debe ser menor que '.ini_get('upload_max_filesize'));
            return false;
        }

        return true;
    }

	public function isValid($data, $file)
    {
        $rules = array(
            'name'     => 'required|max:100|unique:annex',
            'protocol_id' => 'required'
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
        if ($this->isValidFile($file) && $this->isValid($data))
        {
            $this->fill($data);
            $this->save();
            if(array_key_exists('url', $data))
            {
            	$this->uploadAnnex('url');
            }
            
            return true;
        }
        
        return false;
    }

    public function uploadAnnex($file)
    {
        if(Input::file($file))
        {
            $path = Config::get('constant.path_annex');
            $name = $this->id.'.'.Input::file($file)->getClientOriginalExtension();
            $url = $path.'/'.$name;
            Input::file($file)->move($path, $name);
            $this->url = $url;
            $this->save();
        }
    }
}
