<?php 

class Answer extends ModelEloquent
{
	protected $table = 't15_answer';
	protected $primaryKey = 't15_id';
	protected $fillable = array('t15_text', 't15_question_id', 't15_correct');
	protected $globalModel = 2;
	public $timestamps = true;
	public $increments = true;
	public $errors;
	protected $attributeNames = array('t15_text' => 'Respuesta', 'created_at' => 'Creación', 'updated_at' => 'Actualización');
	protected $mainAttributes = array('t15_text');
    protected $relationsArray = array('t15_question_id' => 'question');

    public function getUserValueAttribute()
    {
        return $this->question->t14_text;
    }

    public function question()
    {
        return $this->belongsTo('Question', 't15_question_id');
    }
}
