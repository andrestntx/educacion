<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtocolCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t09_protocol_category', function($table)
		{
		    $table->increments('t09_id');
		    $table->string('t09_name', 45);
		    $table->text('t09_description')->nullable();	    

		    $table->integer('t09_company_id')->unsigned();	    
		    $table->foreign('t09_company_id')
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
		Schema::drop('t09_protocol_category');
	}

}
