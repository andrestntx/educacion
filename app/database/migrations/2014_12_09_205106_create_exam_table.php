<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t16_exam', function($table)
		{
		    $table->increments('t16_id');

		    $table->integer('t16_protocol_id')->unsigned();	    
		    $table->foreign('t16_protocol_id')
		      ->references('t06_id')->on('t06_protocol')
		      ->onUpdate('cascade');

		    $table->integer('t16_user_id')->unsigned();	    
		    $table->foreign('t16_user_id')
		      ->references('t02_id')->on('t02_user')
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
		Schema::drop('t16_exam');
	}

}
