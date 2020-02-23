<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCrontabLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crontab_log', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string('project', 128);
			$table->string('command', 256);
			$table->dateTime('starttime')->nullable();
			$table->dateTime('endtime')->nullable();
			$table->decimal('exectime', 10, 6)->default(0.000000);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('crontab_log');
	}

}
