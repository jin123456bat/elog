<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\CommonLogModel;

class CommonLogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    	foreach ($this->data['log'] as $log)
    	{
    		$context = (!empty($log['context']) && is_array($log['context']))?json_encode($log['context'],JSON_UNESCAPED_UNICODE):'[]';
    		$logModel = new CommonLogModel();
    		$logModel->fill([
    			'project' => $this->data['project'],
    			'level' => $log['level'],
    			'message' => $log['message'],
    			'context' => $context
    		]);
    		$logModel->save();
    	}
    }
}
