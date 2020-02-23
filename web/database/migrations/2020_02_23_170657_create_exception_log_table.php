<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExceptionLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exception_log', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned()->comment('ID');
			$table->string('project', 128)->comment('异常项目');
			$table->char('md5', 32)->index('md5')->comment('错误消息主键');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('消息创建时间');
			$table->string('code', 32)->nullable()->comment('错误码');
			$table->string('file', 256)->comment('异常发生的文件');
			$table->integer('line')->comment('异常所在的行');
			$table->text('message', 65535)->nullable()->comment('异常消息内容');
			$table->string('exception_class', 256)->nullable()->comment('异常类名');
			$table->string('url', 256)->nullable()->comment('异常明细信息地址');
			$table->text('header', 65535)->nullable()->comment('header');
			$table->text('cookie', 65535)->nullable()->comment('cookie');
			$table->text('session', 65535)->nullable()->comment('session');
			$table->string('request_url', 512)->nullable()->comment('请求地址');
			$table->string('method', 32)->nullable()->comment('请求方式');
			$table->text('params', 65535)->nullable()->comment('请求参数');
			$table->text('server', 65535)->nullable()->comment('server');
			$table->char('ip', 15)->nullable()->comment('请求IP');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('exception_log');
	}

}
