<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtocolsHasCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t10_protocols_has_categories', function($table)
		{
		    $table->integer('t10_protocol_id')->unsigned();
		    $table->foreign('t10_protocol_id')
		      ->references('t06_id')->on('t06_protocol')
		      ->onUpdate('cascade');
	
			$table->integer('t10_category_id')->unsigned();	    
		    $table->foreign('t10_category_id')
		      ->references('t09_id')->on('t09_protocol_category')
		      ->onUpdate('cascade');

		    $table->primary(array('t10_protocol_id', 't10_category_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('t10_protocols_has_categories');
	}

}
