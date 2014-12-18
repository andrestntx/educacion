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
		Schema::create('users_has_roles', function($table)
		{
		    $table->integer('user_id')->unsigned();
		    $table->foreign('user_id')
		      ->references('id')->on('users')
		      ->onUpdate('cascade');
	
			$table->integer('role_id')->unsigned();	    
		    $table->foreign('role_id')
		      ->references('id')->on('user_role')
		      ->onUpdate('cascade');

		    $table->primary(array('user_id', 'role_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users_has_roles');
	}

}
