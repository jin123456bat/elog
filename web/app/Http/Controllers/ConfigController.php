<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ConfigModel;
use function GuzzleHttp\Psr7\str;

class ConfigController extends Controller
{
	function index()
	{
		if ($this->request->method() == Request::METHOD_POST)
		{
			$data = $this->request->all([
				'name',
				'exception_file_storage',
				'alioss%host',
				'alioss%endpoint',
				'alioss%bucket',
				'alioss%accessKeySecret',
				'alioss%accessKeyId',
			]);
			
			$result = [];
			foreach ($data as $key => $value)
			{
				$result[str_replace('%', '.', $key)] = $value;
			}
			
			ConfigModel::set($result);
			
			return response()->redirectTo('config/index');
		}
		else if ($this->request->method() == Request::METHOD_GET)
		{
			return view('config.index');
		}
	}
}