<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t07_area', function($table)
		{
		    $table->increments('t07_id');
		    $table->string('t07_name', 45);
		    $table->text('t07_description')->nullable();	    

		    $table->integer('t07_company_id')->unsigned();	    
		    $table->foreign('t07_company_id')
		      ->references('t01_id')->on('t01_company')
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
		Schema::drop('t07_area');
	}

}
