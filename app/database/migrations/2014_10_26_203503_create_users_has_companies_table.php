<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersHasCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t05_users_has_companies', function($table)
		{
			$table->boolean('t05_active');
		    
		    $table->integer('t05_user_id')->unsigned();
		    $table->foreign('t05_user_id')
		      ->references('t02_id')->on('t02_user')
		      ->onUpdate('cascade');
	
			$table->integer('t05_company_id')->unsigned();	    
		    $table->foreign('t05_company_id')
		      ->references('t01_id')->on('t01_company')
		      ->onUpdate('cascade');

		    $table->primary(array('t05_user_id', 't05_company_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('t05_users_has_companies');	
	}

}
