<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\ExceptionModel;
use App\Events\AfterExceptionTrigger;
use App\Models\FileModel;

class ExceptionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    private $_data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->_data = $data;
    }
    
    static function generateUniqueId($data)
    {
    	return md5($data['project'] . $data['file'] . $data['line'] . ($data['message']??''));
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
        	//计算消息的md5
        	$this->_data['md5'] = self::generateUniqueId($this->_data);
        	
        	//创建临时文件
        	if (!is_dir(storage_path('error')))
        	{
        		$oldmask = umask(0);
        		mkdir(storage_path('error'),0777,true);
        		umask($oldmask);
        	}
        	
        	//计算消息内容
        	$file = storage_path('error').'/'.$this->_data['md5'].'.html';
        	file_put_contents($file, $this->_data['html']);
        	$file_model = FileModel::upload($file);
        	unlink($file);
        	$this->_data['url'] = $file_model->url;
        	
        	//记录到数据库
        	$exception_log = new ExceptionModel($this->_data);
        	$exception_log->save();
        	
        	event(new AfterExceptionTrigger($exception_log));
        }
        catch (\Exception $e)
        {
        }
    }
}
