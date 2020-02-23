<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExceptionPushEmailWorkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exception_push_email_work', function(Blueprint $table)
		{
			$table->increments('id')->comment('方案ID');
			$table->text('project', 65535)->comment('项目名称，空代表所有项目，多个逗号分隔');
			$table->text('except_exception_class', 65535)->comment('哪些异常，不推送，多个逗号分隔');
			$table->text('email', 65535)->comment('接受者的邮箱，多个逗号分隔');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('exception_push_email_work');
	}

}
