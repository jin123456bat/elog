<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrontabLogModel extends Model
{
	protected $table = 'crontab_log';
	
	const UPDATED_AT = null;
	
	protected $fillable = [
		'project',
		'starttime',
		'endtime',
		'exectime',
		'command'
	];
}
