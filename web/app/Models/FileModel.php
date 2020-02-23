<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Services\ExceptionStorageService;

class FileModel extends Model
{
	protected $table = 'file';
	
	const UPDATED_AT = null;
	
	/**
	 * @param string $local_file
	 * @return self
	 */
	public static function upload(string $local_file)
	{
		$exception_storage_service = new ExceptionStorageService(ConfigModel::get('exception_file_storage'));
		return $exception_storage_service->store($local_file);
	}
}