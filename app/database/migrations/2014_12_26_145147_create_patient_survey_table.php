<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientSurveyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patient_survey', function($table)
		{
		    $table->increments('id');

		    $table->integer('patient_id')->unsigned();
		    $table->foreign('patient_id')
		      ->references('id')->on('patient')
		      ->onUpdate('cascade');

		    $table->integer('resolved_survey_id')->unsigned();
		    $table->foreign('resolved_survey_id')
		      ->references('id')->on('resolved_survey')
		      ->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('patient_survey');
	}

}
