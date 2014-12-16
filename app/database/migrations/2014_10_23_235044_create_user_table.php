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
		Schema::create('user', function($table)
		{
		    $table->increments('id');
		    $table->string('name', 255)->nullable();
		    $table->string('url_photo', 255)->nullable();
		    $table->string('tel', 45)->nullable();
		    $table->string('username', 45);
		    $table->unique('username');
		    $table->string('email', 100);
		    $table->unique('email');
		    $table->string('password', 255);
		    $table->timestamps();
		    $table->rememberToken();

		    $table->integer('preferred_company_id')->unsigned();
		    $table->foreign('preferred_company_id')
		      ->references('id')->on('company')
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
		Schema::drop('user');
	}

}
