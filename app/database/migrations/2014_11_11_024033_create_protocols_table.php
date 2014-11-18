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
		Schema::create('t06_protocol', function($table)
		{
		    $table->increments('t06_id');
		    $table->string('t06_name', 100);
		    $table->string('t06_description', 250)->nullable();
		    $table->string('t06_url_pdf', 250)->nullable();
		    $table->timestamps();

		    $table->integer('t06_user_id')->unsigned();
		    $table->foreign('t06_user_id')
		      ->references('t02_id')->on('t02_user')
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
		Schema::drop('t06_protocol');
	}

}
