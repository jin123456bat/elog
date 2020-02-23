<?php
namespace App\Http\Response;
use Illuminate\Http\Response;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class Success extends Response
{
	/**
	 * @param array $data
	 */
	public function __construct($data = [])
	{
		parent::__construct([
			'code' => 1,
			'message'=>'OK',
			'data' => $data
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
			return json_encode($content->toArray(),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		}
		
		return json_encode($content,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}
}