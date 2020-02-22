<?php
namespace App\Http\Controllers;
use App\Http\Response\Success;
use Illuminate\Http\Request;
use App\Http\Requests\LogTriggerRequest;

class LogController extends Controller
{
	/**
	 * 日志上报
	 */
	function trigger(LogTriggerRequest $request)
	{
		return new Success('上传成功');
	}
	
	function index(Request $request)
	{
		return view('log.index');
	}
}