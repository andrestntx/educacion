<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeSurveyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('survey', function(Blueprint $table)
		{
			$table->integer('type_id')->unsigned();	    
		    $table->foreign('type_id')
		      ->references('id')->on('survey_type')
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
		Schema::table('survey', function(Blueprint $table)
		{
			$table->dropForeign('survey_type_id_foreign');
		});
	}

}
