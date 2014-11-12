<?php 

class Protocol extends ModelEloquent
{
	protected $table = 't06_protocol';
	protected $primaryKey = 't06_id';
	protected $fillable = array('t06_name', 't06_description', 't06_user_id');
	protected $globalModel = 2;
	public $timestamps = true;
	public $increments = true;
	public $errors;
	protected $attributeNames = array('t06_url_pdf' => 'Pdf', 't06_id' => 'Id', 't06_description' => 'Descripción', 
        't06_name' => 'Nombre', 't06_user_id' => 'Autor', 'created_at' => 'Creación', 'updated_at' => 'Actualización',
    );
	protected $mainAttributes = array('t06_id', 't06_name', 't06_user_id');
    protected $relationsArray = array('t06_user_id' => 'user');

    public function getUserValueAttribute()
    {
        return $this->user->t02_name;
    }

    public function user()
    {
        return $this->belongsTo('User', 't06_user_id');
    }

	public function isValid($data)
    {
        $rules = array(
            't06_name'     => 'required|max:100|unique:t06_protocol',
            't06_user_id' => 'required',
            't06_url_pdf' => 'mimes:pdf'
        );

        if ($this->exists)
        {
			$rules['t06_name'] .= ',t06_name,'.$this->t06_id.',t06_id';
        }
        else 
        {
            $rules['t06_url_pdf'] .= '|required';
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
            if(array_key_exists('t06_url_pdf', $data))
            {
            	$this->uploadPdf('t06_url_pdf');
            }
            
            return true;
        }
        
        return false;
    }

    public function uploadPdf($file)
    {
    	$url_pdf = Config::get('constant.path_protocols_pdf').'/'.$this->t06_id.'.pdf';
        Input::file($file)->move(Config::get('constant.path_protocols_pdf'), $this->t06_id.'.pdf');
    	$this->t06_url_pdf = $url_pdf;
    	$this->save();
    }
}
