<?php 

class Answer extends Eloquent
{
	protected $table = 'answer';
	protected $primaryKey = 'id';
	protected $fillable = array('text', 'question_id', 'correct');
	protected $globalModel = 2;
	public $timestamps = true;
	public $increments = true;
	public $errors;
	protected $attributeNames = array('text' => 'Respuesta', 'created_at' => 'Creación', 'updated_at' => 'Actualización');
	protected $mainAttributes = array('text');
    protected $relationsArray = array('question_id' => 'question');

    public function getUserValueAttribute()
    {
        return $this->question->text;
    }

    public function question()
    {
        return $this->belongsTo('Question', 'question_id');
    }
}
