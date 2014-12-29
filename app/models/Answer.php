<?php 

class Answer extends Eloquent
{
	protected $table = 'answer';
	protected $primaryKey = 'id';
	protected $fillable = array('text', 'value', 'observation', 'question_id', 'correct');
	public $timestamps = true;
	public $increments = true;
	public $errors;


    public function question()
    {
        return $this->belongsTo('Question', 'question_id');
    }

    public function scopeCorrects($query)
    {
        return $query->whereCorrect(true);
    }

    public function scopeIncorrects($query)
    {
        return $query->where('correct', '<>', true);
    }
}
