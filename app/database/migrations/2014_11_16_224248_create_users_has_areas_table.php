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
		Schema::create('t08_users_has_areas', function($table)
		{
	    
		    $table->integer('t08_user_id')->unsigned();
		    $table->foreign('t08_user_id')
		      ->references('t02_id')->on('t02_user')
		      ->onUpdate('cascade');
	
			$table->integer('t08_area_id')->unsigned();	    
		    $table->foreign('t08_area_id')
		      ->references('t07_id')->on('t07_area')
		      ->onUpdate('cascade');

		    $table->primary(array('t08_user_id', 't08_area_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('t08_users_has_areas');	
	}

}
