<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnexTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t11_annex', function($table)
		{
		    $table->increments('t11_id');
		    $table->string('t11_name', 45);
		    $table->text('t11_description')->nullable();
		    $table->text('t11_url')->nullable();	    

		    $table->integer('t11_protocol_id')->unsigned();	    
		    $table->foreign('t11_protocol_id')
		      ->references('t06_id')->on('t06_protocol')
		      ->onUpdate('cascade');

		    $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('t11_annex');
	}

}
