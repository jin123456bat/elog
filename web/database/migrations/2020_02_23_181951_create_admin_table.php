<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin', function(Blueprint $table)
		{
			$table->increments('id')->comment('管理员ID');
			$table->integer('gravatar')->unsigned()->nullable()->comment('头像ID');
			$table->string('username', 32)->index('username')->comment('管理员登陆名,唯一');
			$table->string('realname', 12)->comment('真实姓名');
			$table->string('email', 32)->comment('邮箱');
			$table->string('password', 128)->comment('登陆密码');
			$table->char('salt', 32)->comment('密码盐值');
			$table->char('mobile', 11)->comment('手机号码');
			$table->timestamps();
			$table->softDeletes()->index('deletetime')->comment('删除时间，不为NULL则已删除');
			$table->boolean('islock')->default(0)->comment('是否锁定，1已经锁定，0未锁定');
			$table->boolean('login_error_num')->default(0)->comment('连续登陆密码错误次数');
			$table->boolean('issupper')->default(0)->comment('是否是超级管理员');
			$table->char('wechat_openid', 28)->nullable()->unique('company_id_2')->comment('绑定微信的openid');
			$table->string('wechat_nickname', 32)->nullable()->comment('绑定微信的nickname');
			$table->dateTime('wechat_time')->nullable()->comment('绑定微信的时间');
			$table->integer('wechat_gravatar_file_id')->unsigned()->nullable()->comment('绑定微信的头像');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admin');
	}

}
