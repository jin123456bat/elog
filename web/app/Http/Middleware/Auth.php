<?php
namespace App\Http\Middleware;

use App\Models\AdminModel;

class Auth
{
	/**
	 * 处理传入的请求
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, \Closure $next)
	{
		if (empty(AdminModel::getLoginedAdmin()))
		{
			//return response()->redirectTo('index/login');
		}
		return $next($request);
	}
}

