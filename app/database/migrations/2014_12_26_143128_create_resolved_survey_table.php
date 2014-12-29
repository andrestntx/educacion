<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResolvedSurveyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resolved_survey', function($table)
		{
		    $table->increments('id');

		    $table->integer('survey_id')->unsigned();	    
		    $table->foreign('survey_id')
		      ->references('id')->on('survey')
		      ->onUpdate('cascade');

		    $table->integer('user_id')->unsigned();	    
		    $table->foreign('user_id')
		      ->references('id')->on('users')
		      ->onUpdate('cascade');

		    $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('resolved_survey');
	}

}
