<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlobalModelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	
	public function up()
	{
		Schema::create('sys03_table', function($table)
		{
		    $table->increments('sys03_id');
		    $table->string('singular_name', 100);
		    $table->string('plural_name', 100)->nullable();
		    $table->string('icon', 100)->nullable();
		    $table->string('form', 100)->nullable();
		    $table->timestamps();
		});

		Schema::table('sys02_module', function($table)
		{
			$table->integer('sys02_table_id')->unsigned()->nullable();
		    $table->foreign('sys02_table_id')
		      ->references('sys03_id')->on('sys03_table')
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
			$table->dropForeign('sys02_module_sys02_table_id_foreign');
		});

		Schema::drop('sys03_table');
	}

}
