<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGracePeriodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('grace_periods', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('days')->default(0);
			$table->integer('hours')->default(0);
			$table->integer('minutes')->default(0);
			$table->integer('miliseconds')->nullable();
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
		Schema::drop('grace_periods');
	}

}
