<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menu', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 32)->comment('中文名');
			$table->string('icon', 32)->nullable()->comment('icon');
			$table->integer('logo')->nullable()->comment('logo');
			$table->integer('sup_menu_id')->nullable()->comment('上级菜单ID');
			$table->string('link', 128)->default('')->comment('连接');
			$table->integer('sort')->default(999999);
			$table->boolean('shown')->default(1)->comment('是否显示');
			$table->boolean('level')->default(1)->comment('菜单等级');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('menu');
	}

}
