<?php
namespace App\Pusher;
use Illuminate\Support\Facades\Mail;
use App\Models\ExceptionModel;
use App\Models\ExceptionPushEmailWorkModel;
use App\Exceptions\EmailSendFailedException;

class Email
{
	function run(ExceptionModel $exception_log)
	{
		$push_work_list = ExceptionPushEmailWorkModel::get();
		foreach ($push_work_list as $work)
		{
			if ((empty($work['project']) || in_array($exception_log['project'], explode(',', $work['project']))) && !in_array($exception_log['exception_class'], explode(',', $work['except_exception_class'])))
			{
				try{
					Mail::send(new \App\Mail\ExceptionReport($exception_log,$work['email']));
				}
				catch (\Exception $e)
				{
					throw new EmailSendFailedException('邮件发送失败:'.$e->getMessage());
				}
			}
		}
	}
}