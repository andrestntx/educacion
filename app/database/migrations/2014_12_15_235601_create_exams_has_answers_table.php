<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsHasAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exams_has_answers', function($table)
		{
	    
		    $table->integer('exam_id')->unsigned();
		    $table->foreign('exam_id')
		      ->references('id')->on('exam')
		      ->onUpdate('cascade');
	
			$table->integer('answer_id')->unsigned();	    
		    $table->foreign('answer_id')
		      ->references('id')->on('answer')
		      ->onUpdate('cascade');

		    $table->primary(array('exam_id', 'answer_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('exams_has_answers');
	}

}
