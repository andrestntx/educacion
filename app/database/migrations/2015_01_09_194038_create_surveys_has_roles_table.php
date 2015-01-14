<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysHasRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('surveys_has_roles', function($table)
		{
		    $table->integer('survey_id')->unsigned();
		    $table->foreign('survey_id')
		      ->references('id')->on('survey')
		      ->onUpdate('cascade');
	
			$table->integer('role_id')->unsigned();	    
		    $table->foreign('role_id')
		      ->references('id')->on('user_role')
		      ->onUpdate('cascade');

		    $table->primary(array('survey_id', 'role_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('surveys_has_roles');
	}

}
