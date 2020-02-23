<?php
namespace App\Services;
use App\Models\FileModel;
use App\Models\ConfigModel;
use OSS\OssClient;
use OSS\Core\OssException;
use App\Exceptions\UploadFileException;

class ExceptionStorageService
{
	/**
	 * 异常文件存放的位置
	 * @var unknown
	 */
	private $type;
	
	/**
	 * @param string $type  alioss
	 */
	function __construct($type)
	{
		$this->type = $type;
	}
	
	/**
	 * 存放异常文件
	 * @param string $local_file
	 * @return FileModel
	 */
	function store($local_file)
	{
		return call_user_func([$this,'store_'.$this->type],$local_file);
	}
		
	/**
	 * 异常文件存放在alioss
	 * @param string $local_file
	 * @return FileModel
	 */
	private function store_alioss(string $local_file)
	{
		//将文件上传到alioss
		$alioss = ConfigModel::get('alioss.*');
		try {
			$ext = pathinfo($local_file,PATHINFO_EXTENSION);
			$basename = pathinfo($local_file,PATHINFO_BASENAME);
			$content = 'exception_file/'.$basename;
			$ossClient = new OssClient($alioss['accessKeyId'], $alioss['accessKeySecret'], $alioss['endpoint']);
			$ossClient->uploadFile($alioss['bucket'], $content, $local_file);
		} catch (OssException $e) {
			throw new UploadFileException('文件上传到oss失败:'.$local_file);
		}
		//数据库中添加一条记录
		$file = new FileModel();
		$file->url = $alioss['host'].'/'.$content;
		$file->size = filesize($local_file);
		$file->ext = $ext;
		$file->md5 = md5_file($local_file);
		$file->save();
		return $file;
	}
}