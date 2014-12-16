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
		Schema::create('module', function($table)
		{
		    $table->increments('id');
		    $table->string('route', 100)->nullable();
		    $table->string('controller', 100)->nullable();
		    $table->string('name', 100);
		    $table->string('description', 250)->nullable();
		    $table->timestamps();

		    $table->integer('top_module_id')->unsigned()->nullable();
		    $table->foreign('top_module_id')
		      ->references('id')->on('module')
		      ->onUpdate('cascade')
		      ;

		    $table->integer('order');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('module');
	}

}
