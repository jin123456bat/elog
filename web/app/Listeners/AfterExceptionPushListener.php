<?php

namespace App\Listeners;

use App\Events\AfterExceptionTrigger;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;
use App\Models\ExceptionModel;

class AfterExceptionPushListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AfterExceptionTrigger  $event
     * @return void
     */
    public function handle(AfterExceptionTrigger $event)
    {
    	//异常信息先记录到缓存里面
    	$exception_list = Cache::get(ExceptionModel::CACHE_LIST_KEY);
    	if (empty($exception_list))
    	{
    		$exception_list = [
    			$event->_exception_log->md5 => 1,
    		];
    	}
    	else
    	{
    		if (isset($exception_list[$event->_exception_log->md5]))
    		{
    			$exception_list[$event->_exception_log->md5] += 1;
    		}
    		else
    		{
    			$exception_list[$event->_exception_log->md5] = 1;
    		}
    	}
    	Cache::forever(ExceptionModel::CACHE_LIST_KEY,$exception_list);
    	
    	//发送异常邮件
        $pusher = new \App\Pusher\Email();
        $pusher->run($event->_exception_log);
    }
}
