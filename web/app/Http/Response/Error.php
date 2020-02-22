<?php
namespace App\Http\Response;
use Illuminate\Http\Response;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class Error
{
	/**
	 * @param string $message
	 */
	public function __construct(string $message)
	{
		parent::__construct([
			'code' => 1,
			'message'=>$message,
		],200,[]);
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Illuminate\Http\Response::morphToJson()
	 */
	protected function morphToJson($content)
	{
		if ($content instanceof Jsonable) {
			return $content->toJson();
		} elseif ($content instanceof Arrayable) {
			return json_encode($content->toArray(),JSON_UNESCAPED_UNICODE);
		}
		
		return json_encode($content);
	}
}

