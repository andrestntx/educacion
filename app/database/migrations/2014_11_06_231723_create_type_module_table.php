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
		Schema::create('type_module', function($table)
		{
		    $table->increments('id');
		    $table->string('name', 100);
		    $table->string('description', 250)->nullable();
		    $table->timestamps();
		});

		Schema::table('module', function($table)
		{
			$table->integer('type_module_id')->unsigned();
		    $table->foreign('type_module_id')
		      ->references('id')->on('type_module')
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
			$table->dropForeign('module_type_module_id_foreign');
		});

		Schema::drop('type_module');
	}

}
