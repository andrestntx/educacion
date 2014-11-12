<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys02_module', function($table)
		{
		    $table->increments('sys02_id');
		    $table->string('route', 100)->nullable();
		    $table->string('controller', 100)->nullable();
		    $table->string('sys02_name', 100);
		    $table->string('sys02_description', 250)->nullable();
		    $table->timestamps();

		    $table->integer('sys02_top_module_id')->unsigned()->nullable();
		    $table->foreign('sys02_top_module_id')
		      ->references('sys02_id')->on('sys02_module')
		      ->onUpdate('cascade')
		      ->onDelete('cascade');

		    $table->integer('sys02_order');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sys02_module');
	}

}
