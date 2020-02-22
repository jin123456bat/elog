<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $request;
    
    function __construct(Request $request)
    {
    	$this->request = $request;
    }
    
    function database(Request $request,$query,array $column = [])
    {
    	$start = $request->input('start');
    	$length = $request->input('length');
    	$page = intval($start / $length) + 1;
    	
    	// 固定筛选项
    	$ajaxData = $request->input('ajaxData');
    	if(is_array($ajaxData))
    	{
    		$query->where($ajaxData);
    	}
    	
    	// 排序
    	$order = $request->input('order');
    	foreach ($order as $key => $value)
    	{
    		$query->orderBy($key,$value);
    	}
    	
    	// 查询字段
    	$columns = $request->input('columns');
    	$columns = array_column($columns, 'data');
    	
    	
    	foreach (array_unique(array_filter($columns)) as $item)
    	{
    		if (isset($column[$item]))
    		{
    			$query->addSelect(\DB::raw($column[$item]));
    		}
    		else
    		{
    			$query->addSelect($item);
    		}
    	}
    	
    	// 过滤
    	$keywords = $request->input('keywords');
    	if(! empty($keywords))
    	{
    		$query->where(function($query)use($keywords){
    			$query->whereOr('username','like','%'.$keywords.'%')
    			->whereOr('realname','like','%'.$keywords.'%')
    			->whereOr('email','like','%'.$keywords.'%')
    			->whereOr('mobile','like','%'.$keywords.'%');
    		});
    	}
    	
    	// 			// 计算数据
    	$data = $query->paginate($length);
    	
    	return [
    		'draw' => $request->input('draw'),
    		'total' => $data->total(),
    		'data' => $data->items()
    	];
    }
}
