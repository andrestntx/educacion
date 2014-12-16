<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersHasAreasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_has_areas', function($table)
		{
	    
		    $table->integer('user_id')->unsigned();
		    $table->foreign('user_id')
		      ->references('id')->on('user')
		      ->onUpdate('cascade');
	
			$table->integer('area_id')->unsigned();	    
		    $table->foreign('area_id')
		      ->references('id')->on('area')
		      ->onUpdate('cascade');

		    $table->primary(array('user_id', 'area_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users_has_areas');	
	}

}
