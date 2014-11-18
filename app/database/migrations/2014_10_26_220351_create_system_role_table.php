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
		Schema::create('sys01_system_role', function($table)
		{
			$table->increments('sys01_id');
			$table->string('sys01_name');
			$table->timestamps();
		});

		Schema::table('t02_user', function($table)
		{
		    $table->integer('t02_system_role_id')->unsigned();
		    $table->foreign('t02_system_role_id')
		      ->references('sys01_id')->on('sys01_system_role')
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
		Schema::table('t02_user', function($table)
		{
			$table->dropForeign('t02_user_t02_system_role_id_foreign');
		});
		
		Schema::drop('sys01_system_role');
	}

}
