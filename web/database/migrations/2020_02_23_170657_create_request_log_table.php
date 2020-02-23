<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('request_log', function(Blueprint $table)
		{
			$table->increments('id');
			$table->dateTime('created_at');
			$table->string('project', 32);
			$table->string('url', 256);
			$table->string('method', 32);
			$table->text('params')->nullable();
			$table->text('header')->nullable();
			$table->text('cookie')->nullable();
			$table->text('session')->nullable();
			$table->text('server')->nullable();
			$table->string('ip', 32)->nullable()->default('');
			$table->text('response')->nullable();
			$table->decimal('exectime', 10, 6)->nullable()->default(0.000000);
			$table->integer('memory')->nullable()->default(0);
			$table->string('xhprof', 256)->nullable()->default('');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('request_log');
	}

}
