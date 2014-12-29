<?php 
/**
* 
*/

class PatientSurvey extends Eloquent
{
	protected $table = 'patient_survey';
	protected $primaryKey = 'id';
	protected $fillable = array('patient_id', 'resolved_survey_id');
	public $timestamps = false;
	public $increments = true;
	public $errors;

    public function patient()
    {
        return $this->belongsTo('Patient', 'patient_id');
    }

    public function resolvedSurvey()
    {
        return $this->belongsTo('ResolvedSurvey', 'resolved_survey_id');
    }
}


?>