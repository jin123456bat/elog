<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Exceptions\LoginFailedException;

class AdminModel extends Model
{
	use SoftDeletes;
	
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'admin';
	
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = ['password','salt'];
	
	/**
	 * 使用用户名和密码验证登录
	 * @param string $username
	 * @param string $password
	 * @throws LoginFailedException
	 * @return boolean
	 */
	static public function authenticateWithName(string $username,string $password)
	{
		$admin = self::where([
			'username' => $username
		])->first();
		if (empty($admin))
		{
			throw new LoginFailedException('用户名错误');
		}
		
		if(password_verify($password.$admin['salt'], $admin['password']))
		{
			session('LOGINED_ADMIN_ID',$admin['id']);
			return true;
		}
		throw new LoginFailedException('密码错误');
	}
	
	/**
	 * 获取当前登录的管理员
	 * 未登录返回null
	 * @return null|\App\Models\AdminModel
	 */
	static public function getLoginedAdmin()
	{
		$logined_admin_id = session('LOGINED_ADMIN_ID');
// 		var_dump($logined_admin_id);
// 		exit();
		if (!empty($logined_admin_id))
		{
			$admin = self::find($logined_admin_id);
			if (!empty($admin))
			{
				return $admin;
			}
			return null;
		}
		return null;
	}
}

