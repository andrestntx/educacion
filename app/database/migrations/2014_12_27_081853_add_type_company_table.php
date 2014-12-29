<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeCompanyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('company', function(Blueprint $table)
		{
			
			$table->integer('type_id')->unsigned();	    
		    $table->foreign('type_id')
		      ->references('id')->on('company_type')
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
		Schema::table('company', function(Blueprint $table)
		{
			$table->dropForeign('company_type_id_foreign');
		});
	}

}
