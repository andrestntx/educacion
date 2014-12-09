<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t14_question', function($table)
		{
		    $table->increments('t14_id');
		    $table->string('t14_text', 200);

		    $table->integer('t14_protocol_id')->unsigned();	    
		    $table->foreign('t14_protocol_id')
		      ->references('t06_id')->on('t06_protocol')
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
		Schema::drop('t14_question');
	}

}
