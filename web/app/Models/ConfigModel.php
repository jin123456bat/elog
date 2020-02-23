<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ConfigModel extends Model
{
	protected $table = 'config';
	
	protected $primaryKey = 'c_key';
	
	public $incrementing = false;
	
	protected $keyType = 'string';
	
	public $timestamps = false;
	
	protected $fillable = ['c_value'];
	
	public static function get($key)
	{
		$count = 0;
		$config_list = self::where('c_key','like',str_replace('*','%', $key,$count))->get();
		if ($count)
		{
			$config = [];
			foreach ($config_list as $value)
			{
				list($a,$b) = explode('.', $value['c_key'],2);
				$config[$b] = $value['c_value'];
			}
			return $config;
		}
		else
		{
			return $config_list[0]['c_value'];
		}
	}
	
	public static function set(array $data)
	{
		foreach ($data as $key => $value)
		{
			$config = self::find($key);
			$config->update([
				'c_value' => $value
			]);
		}
	}
}