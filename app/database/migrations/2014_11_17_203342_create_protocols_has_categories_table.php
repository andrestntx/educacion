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
		Schema::create('protocols_has_categories', function($table)
		{
		    $table->integer('protocol_id')->unsigned();
		    $table->foreign('protocol_id')
		      ->references('id')->on('protocol')
		      ->onUpdate('cascade');
	
			$table->integer('category_id')->unsigned();	    
		    $table->foreign('category_id')
		      ->references('id')->on('protocol_category')
		      ->onUpdate('cascade');

		    $table->primary(array('protocol_id', 'category_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('protocols_has_categories');
	}

}
