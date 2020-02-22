<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\AdminModel;
use App\Http\Response\Json;

class AdminController extends Controller
{
	function index(Request $request)
	{
		if ($request->method() == Request::METHOD_POST)
		{
			$result = $this->database($request, AdminModel::query(),[
				'gravatar' => '(select url from oss_file where id=admin.gravatar limit 1) as gravatar'
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
			
		}
		else if ($this->request->method() == Request::METHOD_GET)
		{
			return view('admin.create');
		}
	}
}