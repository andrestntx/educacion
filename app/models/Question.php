<?php 

class Question extends Eloquent
{
	protected $table = 'question';
	protected $primaryKey = 'id';
	protected $fillable = array('text', 'protocol_id');
	public $timestamps = true;
	public $increments = true;
    protected $relationsArray = array('protocol_id' => 'protocol');

    public function getUserValueAttribute()
    {
        return $this->protocol->name;
    }

    public function protocol()
    {
        return $this->belongsTo('Protocol', 'protocol_id');
    }

    public function answers()
    {
        return $this->hasMany('Answer', 'question_id');
    }

	public function isValid($data)
    {
        $rules = array(
            'text'     => 'required|max:150',
            'protocol_id' => 'required'
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
            if(array_key_exists('correct', $value))
            {
                $answer = new Answer($value);
            }
            else
            {
                $answer = new Answer(array('text' => $value['text'], 'correct' => false));
            }
            
            $this->answers()->save($answer);
        }
        return true;
    }

    public function updateAnswers($data)
    {
        foreach ($data as $id => $value) 
        {
            if(array_key_exists('correct', $value))
            {
                $answer = Answer::where('id', $id)->update($value);
            }
            else
            {
                $answer = Answer::where('id', $id)->update(array('text' => $value['text'], 'correct' => false));
            }
        }
        return true;
    }
}
