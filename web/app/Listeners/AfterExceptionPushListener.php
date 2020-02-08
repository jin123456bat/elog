<?php

namespace App\Listeners;

use App\Events\AfterExceptionTrigger;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        $pusher = new \App\Pusher\Email();
        $pusher->run($event->_exception_log);
    }
}
