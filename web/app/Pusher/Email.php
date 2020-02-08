<?php
namespace App\Pusher;
use Illuminate\Support\Facades\Mail;
use App\ExceptionModel;

class Email
{
	function run(ExceptionModel $exception_log)
	{
		Mail::send(new \App\Mail\ExceptionReport($exception_log));
	}
}