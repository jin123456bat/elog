<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\AdminModel;
use App\Http\Response\Json;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Helper\Encrypt;
use App\Http\Response\Success;

class AdminController extends Controller
{
	function index(Request $request)
	{
		if ($request->method() == Request::METHOD_POST)
		{
			$result = $this->database($request, AdminModel::query(),[
				'gravatar' => '(select url from file where id=admin.gravatar limit 1) as gravatar'
			]);
			
			return new Json($result);
		}
		else if ($request->method() == Request::METHOD_GET)
		{
			return view('admin.index');
		}
	}
	
	function create()
	{
		if ($this->request->method() == Request::METHOD_POST)
		{
			$admin = new AdminModel();
			$admin->username = $this->request->input('username');
			$admin->realname = $this->request->input('realname');
			$admin->email = $this->request->input('email');
			$admin->mobile = $this->request->input('mobile');
			$admin->password = $this->request->input('password');
			$admin->islock = $this->request->input('islock');
			$admin->issupper = $this->request->input('issupper');
			$admin->wechat = $this->request->input('wechat_info');
			$admin->save();
			return new Success();
		}
		else if ($this->request->method() == Request::METHOD_GET)
		{
			$qrcode_id = Encrypt::guid();
			
			$qrcode = 'data:image/png;base64,'.base64_encode(QrCode::format('png')->generate('https://www.baidu.com'));
			
			return view('admin.create',[
				'qrcode' => $qrcode,
				'qrcode_id' => $qrcode_id,
			]);
		}
	}
}