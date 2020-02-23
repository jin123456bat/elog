<?php
namespace App\Http\Controllers;
use App\Http\Response\Success;
use Illuminate\Http\Request;
use App\Http\Requests\CrontabLogTriggerRequest;
use App\Jobs\CrontabLogJob;
use App\Models\CrontabLogModel;
use App\Http\Response\Json;

class CrontabLogController extends Controller
{
	/**
	 * 日志上报
	 */
	function trigger(CrontabLogTriggerRequest $request)
	{
		$data = $request->all([
			'project',
			'starttime',
			'endtime',
			'exectime',
			'command'
		]);
		
		dispatch(new CrontabLogJob($data));
		
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
			return new Json($this->database($request, CrontabLogModel::query(),[],function($query)use($request){
				$keywords = trim($request->input('keywords'));
				if (!empty($keywords))
				{
					$query->where(function($query)use($keywords){
						$query->orWhere('command','like','%'.$keywords.'%');
					});
				}
				return $query;
			}));
		}
		else if ($request->method() == Request::METHOD_GET)
		{
			return view('log.crontab');
		}
	}
}