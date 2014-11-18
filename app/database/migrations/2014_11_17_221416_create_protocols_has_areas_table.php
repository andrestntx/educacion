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
		Schema::create('t12_protocols_has_areas', function($table)
		{
		    $table->integer('t12_protocol_id')->unsigned();
		    $table->foreign('t12_protocol_id')
		      ->references('t06_id')->on('t06_protocol')
		      ->onUpdate('cascade');
	
			$table->integer('t12_area_id')->unsigned();	    
		    $table->foreign('t12_area_id')
		      ->references('t07_id')->on('t07_area')
		      ->onUpdate('cascade');

		    $table->primary(array('t12_protocol_id', 't12_area_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('t12_protocols_has_areas');
	}

}
