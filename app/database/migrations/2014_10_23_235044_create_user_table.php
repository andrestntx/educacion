<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t02_user', function($table)
		{
		    $table->increments('t02_id');
		    $table->string('t02_name', 255)->nullable();
		    $table->string('t02_url_photo', 255)->nullable();
		    $table->string('t02_tel', 45)->nullable();
		    $table->string('username', 45);
		    $table->unique('username');
		    $table->string('email', 100);
		    $table->unique('email');
		    $table->string('password', 255);
		    $table->timestamps();
		    $table->rememberToken();

		    $table->integer('t02_preferred_company_id')->unsigned();
		    $table->foreign('t02_preferred_company_id')
		      ->references('t01_id')->on('t01_company')
		      ->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('t02_user');
	}

}
