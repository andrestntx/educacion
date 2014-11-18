<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeModuleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys04_type_module', function($table)
		{
		    $table->increments('sys04_id');
		    $table->string('sys04_name', 100);
		    $table->string('sys04_description', 250)->nullable();
		    $table->timestamps();
		});

		Schema::table('sys02_module', function($table)
		{
			$table->integer('sys02_type_module_id')->unsigned();
		    $table->foreign('sys02_type_module_id')
		      ->references('sys04_id')->on('sys04_type_module')
		      ->onUpdate('cascade')
		      ;
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sys02_module', function($table)
		{
			$table->dropForeign('sys02_module_sys02_type_module_id_foreign');
		});

		Schema::drop('sys04_type_module');
	}

}
