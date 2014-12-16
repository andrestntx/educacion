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
		Schema::create('protocols_has_roles', function($table)
		{
		    $table->integer('protocol_id')->unsigned();
		    $table->foreign('protocol_id')
		      ->references('id')->on('protocol')
		      ->onUpdate('cascade');
	
			$table->integer('role_id')->unsigned();	    
		    $table->foreign('role_id')
		      ->references('id')->on('user_role')
		      ->onUpdate('cascade');

		    $table->primary(array('protocol_id', 'role_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('protocols_has_roles');
	}

}
