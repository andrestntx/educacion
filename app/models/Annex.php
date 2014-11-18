<?php 

class Annex extends ModelEloquent
{
	protected $table = 't11_annex';
	protected $primaryKey = 't11_id';
	protected $fillable = array('t11_name', 't11_description', 't11_user_id');
	protected $globalModel = 2;
	public $timestamps = true;
	public $increments = true;
	public $errors;
	protected $attributeNames = array('t11_url_pdf' => 'Pdf', 't11_id' => 'Id', 't11_description' => 'Descripción', 
        't11_name' => 'Nombre', 't11_user_id' => 'Autor', 'created_at' => 'Creación', 'updated_at' => 'Actualización',
    );
	protected $mainAttributes = array('t11_id', 't11_name', 't11_user_id');
    protected $relationsArray = array('t11_user_id' => 'user');

    public function getUserValueAttribute()
    {
        return $this->user->t02_name;
    }

    public function user()
    {
        return $this->belongsTo('User', 't11_user_id');
    }

	public function isValid($data)
    {
        $rules = array(
            't11_name'     => 'required|max:100|unique:t11_annex',
            't11_user_id' => 'required'
        );

        if ($this->exists)
        {
			$rules['t11_name'] .= ',t11_name,'.$this->t11_id.',t11_id';
        }
        else 
        {
            $rules['t11_url_pdf'] .= '|required';
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
            if(array_key_exists('t11_url_pdf', $data))
            {
            	$this->uploadPdf('t11_url_pdf');
            }
            
            return true;
        }
        
        return false;
    }

    public function uploadAnexo($file)
    {
        $url_pdf = Config::get('constant.path_anexos').'/'.$this->t11_id.'.pdf';
        Input::file($file)->move(Config::get('constant.path_anexos'), $this->t11_id.'.pdf');
        $this->t11_url_pdf = $url_pdf;
        $this->save();
    }
}