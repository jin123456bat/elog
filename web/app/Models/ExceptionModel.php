<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExceptionModel extends Model
{
	const CACHE_LIST_KEY = 'exception_id_list';
	
    /**
     * 与模型关联的数据表
     * 
     * @var string
     */
    protected $table = 'exception_log';
    
    /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;
    
    /**
     * 不可被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = [
    	'project',
    	'md5',
    	'times',
    	'success',
    	'code',
    	'file',
    	'line',
    	'message',
    	'exception_class',
    	'url',
    	'need_report',
    	'header',
    	'cookie',
    	'session',
    	'request_url',
    	'method',
    	'params',
    	'server',
    	'ip',
    	'created_at',
    ];
}
