<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeQuestionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('question', function(Blueprint $table)
		{
			$table->integer('type_id')->unsigned();	    
		    $table->foreign('type_id')
		      ->references('id')->on('question_type')
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
		Schema::table('question', function(Blueprint $table)
		{
			$table->dropForeign('question_type_id_foreign');
		});
	}

}
