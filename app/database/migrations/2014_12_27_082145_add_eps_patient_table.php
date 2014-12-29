<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEpsPatientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('patient', function(Blueprint $table)
		{
			$table->integer('company_id')->unsigned();
		    $table->foreign('company_id')
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
		Schema::table('patient', function(Blueprint $table)
		{
			$table->dropForeign('patient_company_id_foreign');
		});
	}

}
