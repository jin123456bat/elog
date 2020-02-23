<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\ExceptionModel;

class ExceptionReport extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    
    private $_data;
    
    private $_email;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ExceptionModel $exception_log,string $email)
    {
    	$this->_data = $exception_log;
    	$this->_email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (!empty($this->_email))
        {
        	return $this->to(explode(',', $this->_email))->markdown('emails.exception')->with([
            	'data' => $this->_data,
            ]);
        }
        return $this;
    }
}
