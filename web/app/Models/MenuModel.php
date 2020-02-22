<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
	protected $table = 'menu';
	
	/**
	 * 该模型是否被自动维护时间戳
	 *
	 * @var bool
	 */
	public $timestamps = false;
}

