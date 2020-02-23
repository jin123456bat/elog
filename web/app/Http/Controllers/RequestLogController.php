<?php
namespace App\Http\Controllers;
use App\Http\Response\Success;
use Illuminate\Http\Request;
use App\Http\Requests\RequestLogTriggerRequest;
use App\Jobs\RequestLogJob;
use App\Models\RequestLogModel;
use App\Http\Response\Json;

class RequestLogController extends Controller
{
	/**
	 * 日志上报
	 */
	function trigger(RequestLogTriggerRequest $request)
	{
		$data = $request->all([
			'project',
			'url',
			'method',
			'params',
			'header',
			'cookie',
			'session',
			'server',
			'ip',
			'response',
			'exectime',
			'memory',
			'xhprof',
		]);
		
		dispatch(new RequestLogJob($data));
		
		return new Success('上传成功');
	}
	
	/**
	 * 请求日志列表
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	function index(Request $request)
	{
		if ($request->method() == Request::METHOD_POST)
		{
			return new Json($this->database($request, RequestLogModel::query(),[],function($query)use($request){
				$keywords = trim($request->input('keywords'));
				if (!empty($keywords))
				{
					$query->where(function($query)use($keywords){
						$query->orWhere('url','like','%'.$keywords.'%');
					});
				}
				return $query;
			}));
		}
		else if ($request->method() == Request::METHOD_GET)
		{
			return view('log.request');
		}
	}
}