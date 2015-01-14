<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysHasAreasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('surveys_has_areas', function($table)
		{
		    $table->integer('survey_id')->unsigned();
		    $table->foreign('survey_id')
		      ->references('id')->on('survey')
		      ->onUpdate('cascade');
	
			$table->integer('area_id')->unsigned();	    
		    $table->foreign('area_id')
		      ->references('id')->on('area')
		      ->onUpdate('cascade');

		    $table->primary(array('survey_id', 'area_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('surveys_has_areas');
	}
}
