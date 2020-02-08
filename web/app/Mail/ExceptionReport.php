<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Yiche\Config\Models\SapiConfig;
use App\Models\ExceptionModel;

class ExceptionReport extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    
    private $_data;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ExceptionModel $exception_log)
    {
    	$this->_data = $exception_log;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = SapiConfig::getConfigValue('ERROR_NOTIFY_MAIL');
        if (!empty($email))
        {
        	return $this->to($email)->markdown('emails.exception_report')->with([
            	'data' => $this->_data,
            ]);
        }
        return $this;
    }
}
