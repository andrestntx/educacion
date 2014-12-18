<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemRoleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('system_role', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
		});

		Schema::table('users', function($table)
		{
		    $table->integer('system_role_id')->unsigned();
		    $table->foreign('system_role_id')
		      ->references('id')->on('system_role')
		      ->onUpdate('cascade')
		      ;
		});

			
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table)
		{
			$table->dropForeign('users_system_role_id_foreign');
		});
		
		Schema::drop('system_role');
	}

}
