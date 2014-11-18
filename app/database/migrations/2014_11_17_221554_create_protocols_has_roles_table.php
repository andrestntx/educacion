<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtocolsHasRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t13_protocols_has_roles', function($table)
		{
		    $table->integer('t13_protocol_id')->unsigned();
		    $table->foreign('t13_protocol_id')
		      ->references('t06_id')->on('t06_protocol')
		      ->onUpdate('cascade');
	
			$table->integer('t13_role_id')->unsigned();	    
		    $table->foreign('t13_role_id')
		      ->references('t03_id')->on('t03_user_role')
		      ->onUpdate('cascade');

		    $table->primary(array('t13_protocol_id', 't13_role_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('t13_protocols_has_roles');
	}

}
