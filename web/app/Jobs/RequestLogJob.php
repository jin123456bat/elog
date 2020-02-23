<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\RequestLogModel;
use App\Services\ExceptionStorageService;
use App\Models\ConfigModel;
use App\Helper\Encrypt;
use App\Models\FileModel;

class RequestLogJob implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	private $data;

	/**
	 * Create a new job instance.
	 * @return void
	 */
	public function __construct($data)
	{
		$this->data = $data;
	}

	/**
	 * Execute the job.
	 * @return void
	 */
	public function handle()
	{
		if(!empty($this->data['xhprof']))
		{
			//创建临时文件
			if (!is_dir(storage_path('xhprof')))
			{
				$oldmask = umask(0);
				mkdir(storage_path('xhprof'),0777,true);
				umask($oldmask);
			}
			
			//计算消息内容
			$file = storage_path('xhprof').'/'.Encrypt::unique_id('xhprof').'.html';
			file_put_contents($file, $this->_data['xhprof']);
			$file_model = FileModel::upload($file);
			unlink($file);
			$this->_data['xhprof'] = $file_model->url;
		}
		
		$logModel = new RequestLogModel();
		$logModel->fill($this->data);
		$logModel->save();
	}
}
