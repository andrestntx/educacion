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
		Schema::create('table', function($table)
		{
		    $table->increments('id');
		    $table->string('singular_name', 100);
		    $table->string('plural_name', 100)->nullable();
		    $table->string('icon', 100)->nullable();
		    $table->string('form', 100)->nullable();
		    $table->timestamps();
		});

		Schema::table('module', function($table)
		{
			$table->integer('table_id')->unsigned()->nullable();
		    $table->foreign('table_id')
		      ->references('id')->on('table')
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
		Schema::table('module', function($table)
		{
			$table->dropForeign('module_table_id_foreign');
		});

		Schema::drop('table');
	}

}
