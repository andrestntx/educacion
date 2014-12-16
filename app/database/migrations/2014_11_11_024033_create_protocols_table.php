<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtocolsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('protocol', function($table)
		{
		    $table->increments('id');
		    $table->string('name', 100);
		    $table->string('description', 250)->nullable();
		    $table->string('url_pdf', 250)->nullable();
		    $table->timestamps();

		    $table->integer('user_id')->unsigned();
		    $table->foreign('user_id')
		      ->references('id')->on('user')
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
		Schema::drop('protocol');
	}

}
