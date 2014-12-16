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
		Schema::create('users_has_companies', function($table)
		{
			$table->boolean('active');
		    
		    $table->integer('user_id')->unsigned();
		    $table->foreign('user_id')
		      ->references('id')->on('user')
		      ->onUpdate('cascade')
		      ->onDelete('cascade');
	
			$table->integer('company_id')->unsigned();	    
		    $table->foreign('company_id')
		      ->references('id')->on('company')
		      ->onUpdate('cascade');

		    $table->primary(array('user_id', 'company_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users_has_companies');	
	}

}
