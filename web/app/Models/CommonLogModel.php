<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonLogModel extends Model
{
	protected $table = 'log';
	
	const UPDATED_AT = null;
	
	protected $fillable = [
		'project',
		'message',
		'level',
		'message',
		'context',
	];
}
