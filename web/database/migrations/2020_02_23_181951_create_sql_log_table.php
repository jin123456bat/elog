<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSqlLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sql_log', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('project', 128);
			$table->dateTime('created_at');
			$table->text('sql_string', 65535);
			$table->decimal('exectime', 10, 6);
			$table->string('url', 256)->default('');
			$table->string('method', 32)->default('');
			$table->text('params')->nullable();
			$table->text('header')->nullable();
			$table->text('cookie')->nullable();
			$table->text('session')->nullable();
			$table->text('server')->nullable();
			$table->string('ip', 32)->default('');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sql_log');
	}

}
