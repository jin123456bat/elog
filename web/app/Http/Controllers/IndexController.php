<?php
namespace App\Http\Controllers;
use App\Helper\Geetest;
use App\Http\Response\Success;
use Illuminate\Http\Request;
use App\Models\AdminModel;
use App\Exceptions\LoginFailedException;

class IndexController extends Controller
{
	function index()
	{
		return view('index.index');
	}
	
	function login(Request $request)
	{
		if ($request->method() == Request::METHOD_POST)
		{
			$this->validate($request, [
				'username'=>'required',
				'password'=>'required',
				'geetest_challenge'=>'required',
				'geetest_validate'=>'required',
				'geetest_seccode'=>'required'
			]);
			
			$config = config('geetest');
			$gt_sdk = new Geetest($config['captcha_id'],$config['private_key']);
			$data = array(
				'user_id' => 'hotel',
				'client_type' => 'web',
				'ip_address' => $_SERVER['REMOTE_ADDR']
			);
			if(!$gt_sdk->success_validate($request->input('geetest_challenge'),$request->input('geetest_validate'),$request->input('geetest_seccode'),$data)){
				throw new LoginFailedException('验证码验证失败,重新点击验证');
			}
			
			if(AdminModel::authenticateWithName($request->input('username'), $request->input('password')))
			{
				return new Success();
			}
			throw new LoginFailedException('登录失败');
		}
		else
		{
			return view('index.login');
		}
	}
	
	/**
	 * 生成登陆用验证码
	 */
	function code()
	{
		$config = config('geetest');
		$gt_sdk = new Geetest($config['captcha_id'],$config['private_key']);
		$data = array(
			'user_id' => 'hotel',
			'client_type' => 'web',
			'ip_address' => $_SERVER['REMOTE_ADDR']
		);
		$status = $gt_sdk->pre_process($data, 1);
		return new Success($gt_sdk->get_response());
	}
}
