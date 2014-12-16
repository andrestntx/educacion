<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtocolsHasAreasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('protocols_has_areas', function($table)
		{
		    $table->integer('protocol_id')->unsigned();
		    $table->foreign('protocol_id')
		      ->references('id')->on('protocol')
		      ->onUpdate('cascade');
	
			$table->integer('area_id')->unsigned();	    
		    $table->foreign('area_id')
		      ->references('id')->on('area')
		      ->onUpdate('cascade');

		    $table->primary(array('protocol_id', 'area_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('protocols_has_areas');
	}

}
