<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRoleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t03_user_role', function($table)
		{
		    $table->increments('t03_id');
		    $table->string('t03_name', 45);
		    $table->text('t03_description')->nullable();	    

		    $table->integer('t03_company_id')->unsigned();	    
		    $table->foreign('t03_company_id')
		      ->references('t01_id')->on('t01_company')
		      ->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('t03_user_role');
	}

}
