<?php
namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Whoops\Handler\PrettyPageHandler;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use App\Jobs\ExceptionJob;

class Handler extends ExceptionHandler
{

	/**
	 * A list of the exception types that are not reported.
	 * @var array
	 */
	protected $dontReport = [		//
	];

	/**
	 * A list of the inputs that are never flashed for validation exceptions.
	 * @var array
	 */
	protected $dontFlash = [
		'password',
		'password_confirmation'
	];

	/**
	 * Report or log an exception.
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 * @param \Exception $exception
	 * @return void
	 */
	public function report(Exception $exception)
	{
// 		try{
// 			$handler = new PrettyPageHandler();
// 			$files = new Filesystem();
// 			$handler->handleUnconditionally(true);
// 			foreach (config('app.debug_blacklist', []) as $key => $secrets)
// 			{
// 				foreach ($secrets as $secret)
// 				{
// 					$handler->blacklist($key, $secret);
// 				}
// 			}
			
// 			if (config('app.editor', false))
// 			{
// 				$handler->setEditor(config('app.editor'));
// 			}
// 			$handler->setApplicationPaths(array_flip(\Illuminate\Support\Arr::except(array_flip($files->directories(base_path())), [
// 				base_path('vendor')
// 			])));
			
// 			$html = tap(new \Whoops\Run(), function ($whoops) use ($handler) {
// 				$whoops->pushHandler($handler);
// 				$whoops->writeToOutput(false);
// 				$whoops->allowQuit(false);
// 			})->handleException($exception);
			
// 			$data = [
// 				'created_at' => date('Y-m-d H:i:s'),
// 				'html' => $html,
// 				'project' => config('app.name'),
// 				'code' => $exception->getCode(),
// 				'file' => $exception->getFile(),
// 				'line' => $exception->getLine(),
// 				'message' => $exception->getMessage(), // 异常消息
// 				'exception_class' => get_class($exception), // 异常类
// 				'header' => json_encode(\Illuminate\Support\Facades\Request::header(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
// 				'cookie' => json_encode(\Illuminate\Support\Facades\Request::cookie(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
// 				'session' => json_encode(\Illuminate\Support\Facades\Request::session()->all(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
// 				'server' => json_encode(\Illuminate\Support\Facades\Request::server(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
// 				'request_url' => \Request::url(),
// 				'method' => \Illuminate\Support\Facades\Request::method(),
// 				'params' => json_encode(\Illuminate\Support\Facades\Request::input(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
// 				'ip' => \Request::ip()
// 			];
// 			$data['created_at'] = date('Y-m-d H:i:s');
// 			dispatch(new ExceptionJob($data));
// 		}
// 		catch (\Exception $e)
// 		{
// 		}
		parent::report($exception);
	}

	/**
	 * Render an exception into an HTTP response.
	 * @param \Illuminate\Http\Request $request
	 * @param \Exception $exception
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $exception)
	{
		return parent::render($request, $exception);
	}

	// protected function unauthenticated($request, AuthenticationException $exception)
	// {
	// if($request->expectsJson()){
	// $response=response()->json([
	// 'status'=>3,
	// 'msg' => $exception->getMessage(),
	// 'errors'=>[],
	// ], 200);
	// }else{
	// $response=redirect()->guest(route('login'));
	// }
	// return $response;
	// }
	protected function invalid($request, ValidationException $exception)
	{
		return response()->json([
			'code' => $exception->status,
			'message' => $exception->getMessage(),
			'data' => $exception->errors()
		], 200);
	}

	protected function invalidJson($request, ValidationException $exception)
	{
		return response()->json([
			'code' => $exception->status,
			'message' => $exception->getMessage(),
			'data' => $exception->errors()
		], 200);
	}
}
