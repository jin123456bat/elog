<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SqlLogModel extends Model
{
	protected $table = 'sql_log';
	
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
		
		'exectime',
		'sql_string',
	];
}
