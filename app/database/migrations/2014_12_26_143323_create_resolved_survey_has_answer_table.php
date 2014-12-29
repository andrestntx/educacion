<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResolvedSurveyHasAnswerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resolved_survey_has_answer', function($table)
		{
	    
		    $table->integer('resolved_survey_id')->unsigned();
		    $table->foreign('resolved_survey_id')
		      ->references('id')->on('resolved_survey')
		      ->onUpdate('cascade');
	
			$table->integer('answer_id')->unsigned();	    
		    $table->foreign('answer_id')
		      ->references('id')->on('answer')
		      ->onUpdate('cascade');

		    $table->primary(array('resolved_survey_id', 'answer_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('resolved_survey_has_answer');
	}

}
