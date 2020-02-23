<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ExceptionModel;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use App\Models\ExceptionPushDDWorkModel;

class ExceptionPush extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exception:push';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '异常消息推送任务';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	$exception_md5_list = Cache::get(ExceptionModel::CACHE_LIST_KEY);
    	if (empty($exception_id_list))
    	{
    		return ;
    	}
    	
    	$exception_md5 = array_slice($exception_md5_list, 0,10);
    	
    	$error_notify_logs = ExceptionModel::whereIn('md5',array_keys($exception_md5))->get();
    	$client = new Client();
    	$exception_push_dd_work = ExceptionPushDDWorkModel::get();
    	foreach ($exception_push_dd_work as $work)
    	{
	    	foreach ($error_notify_logs as $log)
	    	{
	    		if ( (empty($work['project']) || in_array($log['project'], explode(',', $work['project']))) && !in_array($log['exception_class'], explode(',', $work['except_exception_class'])) )
	    		{
	    			foreach (explode(',', $work['token']) as $token)
	    			{
	    				$response = $client->request('POST','https://oapi.dingtalk.com/robot/send?access_token='.$token,[
			    			'json'=>[
			    				'msgtype'=>'link',
			    				'link' =>[
			    					'title'=>$log['project'].'系统异常上报 - (上报'.$exception_md5[$log['md5']].'次)',
			    					'text'=> $log['message']??'',
			    					'messageUrl'=>$log['url']??''
			    				]
			    			]
			    		])->getBody()->getContents();
	    			}
	    		}
	    	}
    	}
    	
    	Cache::forever(ExceptionModel::CACHE_LIST_KEY,array_slice($exception_id_list, 10));
    }
}
