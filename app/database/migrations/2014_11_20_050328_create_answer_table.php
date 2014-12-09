<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t15_answer', function($table)
		{
		    $table->increments('t15_id');
		    $table->string('t15_text', 200);
		    $table->boolean('t15_correct');

		    $table->integer('t15_question_id')->unsigned();	    
		    $table->foreign('t15_question_id')
		      ->references('t14_id')->on('t14_question')
		      ->onUpdate('cascade')
		      ->onDelete('cascade');

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
		Schema::drop('t15_answer');
	}

}
