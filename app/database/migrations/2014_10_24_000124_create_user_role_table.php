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
		Schema::create('user_role', function($table)
		{
		    $table->increments('id');
		    $table->string('name', 45);
		    $table->text('description')->nullable();	    

		    $table->integer('company_id')->unsigned();	    
		    $table->foreign('company_id')
		      ->references('id')->on('company')
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
		Schema::drop('user_role');
	}

}
