<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSurveyProtocolTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('protocol', function(Blueprint $table)
		{
			$table->integer('survey_id')->unsigned();	    
		    $table->foreign('survey_id')
		      ->references('id')->on('survey')
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
		Schema::table('protocol', function(Blueprint $table)
		{
			$table->dropForeign('protocol_survey_id_foreign');
		});
	}

}
