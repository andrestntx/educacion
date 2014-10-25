<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersHasRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t04_users_has_roles', function($table)
		{
		    $table->integer('t04_user_id')->unsigned();
		    $table->foreign('t04_user_id')
		      ->references('t02_id')->on('t02_user')
		      ->onDelete('cascade');
	
			$table->integer('t04_role_id')->unsigned();	    
		    $table->foreign('t04_role_id')
		      ->references('t03_id')->on('t03_user_role')
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
		Schema::drop('t04_users_has_roles');
	}

}
