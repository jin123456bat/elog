<?php
namespace App\Http\Controllers;
use App\Http\Response\Success;
use Illuminate\Http\Request;
use App\Http\Requests\SqlLogTriggerRequest;
use App\Jobs\SqlLogJob;
use App\Models\SqlLogModel;
use App\Http\Response\Json;

class SqlLogController extends Controller
{
	/**
	 * 日志上报
	 */
	function trigger(SqlLogTriggerRequest $request)
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
			
			'exectime',
			'sql_string',
		]);
		
		dispatch(new SqlLogJob($data));
		
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
			return new Json($this->database($request, SqlLogModel::query(),[],function($query)use($request){
				$keywords = trim($request->input('keywords'));
				if (!empty($keywords))
				{
					$query->where(function($query)use($keywords){
						$query->orWhere('url','like','%'.$keywords.'%')
						->query->orWhere('sql_string','like','%'.$keywords.'%');
					});
				}
				return $query;
			}));
		}
		else if ($request->method() == Request::METHOD_GET)
		{
			return view('log.sql');
		}
	}
}