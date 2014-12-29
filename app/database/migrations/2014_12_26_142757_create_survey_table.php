<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('survey', function($table)
		{
		    $table->increments('id');
		    $table->string('name');
		    $table->text('description')->nullable();

		    $table->integer('created_by')->unsigned();	    
		    $table->foreign('created_by')
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
		Schema::drop('survey');
	}

}
