<?php 

class Question extends ModelEloquent
{
	protected $table = 't14_question';
	protected $primaryKey = 't14_id';
	protected $fillable = array('t14_text', 't14_protocol_id');
	protected $globalModel = 2;
	public $timestamps = true;
	public $increments = true;
	public $errors;
	protected $attributeNames = array('t14_text' => 'Pregunta', 'created_at' => 'Creación', 'updated_at' => 'Actualización');
	protected $mainAttributes = array('t14_text');
    protected $relationsArray = array('t14_protocol_id' => 'protocol');

    public function getUserValueAttribute()
    {
        return $this->protocol->t06_name;
    }

    public function protocol()
    {
        return $this->belongsTo('Protocol', 't14_protocol_id');
    }

    public function answers()
    {
        return $this->hasMany('Answer', 't15_question_id');
    }

	public function isValid($data)
    {
        $rules = array(
            't14_text'     => 'required|max:150',
            't14_protocol_id' => 'required'
        );
        
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

    public function saveAnswers($data)
    {
        foreach ($data as $value) 
        {
            if(array_key_exists('t15_correct', $value))
            {
                $answer = new Answer($value);
            }
            else
            {
                $answer = new Answer(array('t15_text' => $value['t15_text'], 't15_correct' => false));
            }
            
            $this->answers()->save($answer);
        }
        return true;
    }

    public function updateAnswers($data)
    {
        foreach ($data as $id => $value) 
        {
            if(array_key_exists('t15_correct', $value))
            {
                $answer = Answer::where('t15_id', $id)->update($value);
            }
            else
            {
                $answer = Answer::where('t15_id', $id)->update(array('t15_text' => $value['t15_text'], 't15_correct' => false));
            }
        }
        return true;
    }
}
