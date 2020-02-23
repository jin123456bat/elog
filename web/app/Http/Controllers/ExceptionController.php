<?php
namespace App\Http\Controllers;
use App\Http\Response\Success;
use Illuminate\Http\Request;
use App\Http\Requests\ExceptionTriggerRequest;
use App\Jobs\ExceptionJob;
use App\Models\ExceptionModel;
use App\Http\Response\Json;

class ExceptionController extends Controller
{
	/**
	 * 异常上报
	 */
	function trigger(ExceptionTriggerRequest $request)
	{
		$data = [
			'project' => $project,//异常出现的项目名称
			'line' => $line,//异常出现的文件行
			'file' => $file,//异常文件
		] = $request->input();
		
		
		$data = array_merge($data,$request->keys([
			'html',
			'code',
			'message',
			'exception_class',
			'header',
			'cookie',
			'session',
			'server',
			'request_url',
			'method',
			'params',
			'ip',
		]));
		
		$data['created_at'] = date('Y-m-d H:i:s');
		
		dispatch(new ExceptionJob($data));
		
		return new Success('上传成功');
	}
	
	function index(Request $request)
	{
		if ($request->method() == Request::METHOD_POST)
		{
			return new Json($this->database($request, ExceptionModel::query(),[],function($query)use($request){
				$keywords = trim($request->input('keywords'));
				if(!empty($keywords))
				{
					$query->where(function($query)use($keywords){
						$query->orWhere('project','like','%'.$keywords.'%')
						->orWhere('file','like','%'.$keywords.'%')
						->orWhere('message','like','%'.$keywords.'%')
						->orWhere('request_url','like','%'.$keywords.'%');
					});
				}
				return $query;
			}));
		}
		else if ($request->method() == Request::METHOD_GET)
		{
			return view('exception.index');
		}
	}
}