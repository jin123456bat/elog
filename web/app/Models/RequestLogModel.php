<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestLogModel extends Model
{
	protected $table = 'request_log';
	
	const UPDATED_AT = null;
	
	protected $fillable = [
		'project',
		'url',
		'method',
		'params',
		'header',
		'cookie',
		'session',
		'server',
		'ip',
		'response',
		'exectime',
		'memory',
		'xhprof',
	];
}
