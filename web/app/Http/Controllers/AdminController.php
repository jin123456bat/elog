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
			],function($query)use($request){
				$keywords = trim($request->input('keywords'));
				if(! empty($keywords))
				{
					$query->where(function($query)use($keywords){
						$query->orWhere('username','like','%'.$keywords.'%')
						->orWhere('realname','like','%'.$keywords.'%')
						->orWhere('email','like','%'.$keywords.'%')
						->orWhere('mobile','like','%'.$keywords.'%');
					});
				}
				return $query;
			});
			
			return new Json($result);
		}
		else if ($request->method() == Request::METHOD_GET)
		{
			return view('admin.index');
		}
	}
	
	function delete()
	{
		$this->validate($this->request, [
			'id' => 'required',
		]);
		
		$admin = AdminModel::find($this->request->input('id'));
		$admin->delete();
		
		return new Success();
	}
	
	function update($id)
	{
		$admin = AdminModel::findOrFail($id);
		if ($this->request->method() == Request::METHOD_POST)
		{
			$this->validate($this->request,[
				'realname' => 'required',
				'email' => 'required',
				'mobile' => 'required',
				'password' => 'required',
			]);
			
			$admin->realname = $this->request->input('realname');
			$admin->email = $this->request->input('email');
			$admin->mobile = $this->request->input('mobile');
			$admin->password = $this->request->input('password');
			$admin->islock = $this->request->input('islock');
			$admin->issupper = $this->request->input('issupper');
			// 			$admin->wechat = $this->request->input('wechat_info');
			$admin->save();
			return new Success();
		}
		else if ($this->request->method() == Request::METHOD_GET)
		{
			$qrcode_id = Encrypt::guid();
			$qrcode = 'data:image/png;base64,'.base64_encode(QrCode::format('png')->generate('https://www.baidu.com'));
			
			
			
			return view('admin.update',[
				'qrcode' => $qrcode,
				'qrcode_id' => $qrcode_id,
				'admin' => $admin
			]);
		}
	}
	
	function create()
	{
		if ($this->request->method() == Request::METHOD_POST)
		{
			$this->validate($this->request,[
				'username' => 'required|unique:admin',
				'realname' => 'required',
				'email' => 'required',
				'mobile' => 'required',
				'password' => 'required',
			]);
			
			$admin = new AdminModel();
			$admin->username = $this->request->input('username');
			$admin->realname = $this->request->input('realname');
			$admin->email = $this->request->input('email');
			$admin->mobile = $this->request->input('mobile');
			$admin->password = $this->request->input('password');
			$admin->islock = $this->request->input('islock');
			$admin->issupper = $this->request->input('issupper');
// 			$admin->wechat = $this->request->input('wechat_info');
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