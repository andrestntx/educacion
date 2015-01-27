<?php 

class SurveyType extends Eloquent
{
	protected $table = 'survey_type';
	protected $primaryKey = 'id';
	protected $fillable = array('name', 'description');
	public $timestamps = false;
	public $increments = true;
	public $errors;


	public function scopeWhereNotExam($query)
	{
		return $query->where('id', '<>', 1);
	}

	public function isNotExam()
	{
		if($this->id == 1)
		{
			return false;
		}

		return true;
	}

	public function isCheck()
	{
		if($this->id == 2)
		{
			return true;
		}

		return false;
	}

	public function isMath()
	{
		if($this->id == 3)
		{
			return true;
		}

		return false;
	}

	public function isObservations()
	{
		if($this->id == 4)
		{
			return true;
		}

		return false;
	}

	public function isGenerator()
	{
		if($this->id == 5)
		{
			return true;
		}

		return false;
	}
}

?>