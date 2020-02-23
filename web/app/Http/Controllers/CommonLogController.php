<?php
namespace App\Http\Controllers;
use App\Http\Response\Success;
use Illuminate\Http\Request;
use App\Http\Requests\CommonLogTriggerRequest;
use App\Jobs\CommonLogJob;
use App\Models\CommonLogModel;
use App\Http\Response\Json;

class CommonLogController extends Controller
{
	/**
	 * 日志上报
	 */
	function trigger(CommonLogTriggerRequest $request)
	{
		$data = $request->all([
			'project',
			'log'
		]);
		
		dispatch(new CommonLogJob($data));
		
		return new Success('上传成功');
	}
	
	/**
	 * 普通日志列表
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	function index(Request $request)
	{
		if ($request->method() == Request::METHOD_POST)
		{
			return new Json($this->database($request, CommonLogModel::query(),[],function($query)use($request){
				$keywords = trim($request->input('keywords'));
				if (!empty($keywords))
				{
					$query->where(function($query)use($keywords){
						$query->orWhere('project','like','%'.$keywords.'%')
						->orWhere('level','like','%'.$keywords.'%')
						->orWhere('message','like','%'.$keywords.'%');
					});
				}
				return $query;
			}));
		}
		else if ($request->method() == Request::METHOD_GET)
		{
			return view('log.common');
		}
	}
}