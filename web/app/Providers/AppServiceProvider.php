<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\MenuModel;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use App\Models\AdminModel;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * 获取一级菜单的URL
	 * 考虑权限
	 */
	private function getMenuUrl($menu)
	{
		//获取二级菜单列表
		$pages_2 = MenuModel::where([
			'level' => 2,
			'sup_menu_id'=>$menu['id']
		])
		->orderBy('sort','asc')
		->orderBy('id','asc')
		->get()->toArray();
		foreach ($pages_2 as $menu2)
		{
			//获取三级菜单列表
			$pages_3 = MenuModel::where([
				'level' => 3,
				'sup_menu_id'=>$menu2['id']
			])
			->orderBy('sort','asc')
			->orderBy('id','asc')
			->get()->toArray();
			foreach ($pages_3 as $menu3)
			{
				if (!empty($menu3['link']))
				{
					return url($menu3['link']);
				}
			}
		}
		return NULL;
	}
	
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    	// 菜单对列
    	$menu_queue = [];
    	
    	// 获取一级菜单列表
    	$menu = MenuModel::where(array(
    		'shown' => 1,
    		'level' => 1
    	))
    	->orderBy('sort', 'asc')
    	->get()->toArray();
    	
    	// 获取选中的菜单
    	$current = MenuModel::where(array(
    		'link' => implode('/', array_slice(explode('/', Request::path()), 0,2))
    	))->first();
    	
    	// 获取选中的3级菜单
    	if ($current['level'] == 4)
    	{
    		$current_menu3 = MenuModel::where(array(
    			'id' => $current['sup_menu_id'],
    			'level' => 3,
    			'shown' => 1
    		))->first();
    		$menu_queue[] = $current['name'];
    	}
    	else
    	{
    		$current_menu3 = $current;
    	}
    	
    	//获取选中的2级菜单
    	$current_sup = MenuModel::where(array(
    		'id' => $current_menu3['sup_menu_id'],
    		'level' => 2,
    		'shown' => 1
    	))->first();
    	
    	// 获取二级菜单列表
    	$menu1 = MenuModel::where(array(
    		'sup_menu_id' => $current_sup['sup_menu_id'],
    		'shown' => 1,
    		'level' => 2
    	))
    	->orderBy('sort', 'asc')
    	->get()->toArray();
    	
    	// 获取三级菜单列表
    	$menu2 = MenuModel::where(array(
    		'sup_menu_id' => $current_menu3['sup_menu_id'],
    		'shown' => 1,
    		'level' => 3
    	))
    	->orderBy('sort', 'asc')
    	->get()->toArray();
    	
    	// 将三级菜单设置为选中状态
    	foreach ($menu2 as &$m)
    	{
    		if (! empty($m['link']))
    		{
    			$m['link'] = url($m['link']);
    		}
    		if ($m['id'] == $current_menu3['id'])
    		{
    			$menu_queue[] = $m['name'];
    			$m['active'] = true;
    		}
    		else
    		{
    			$m['active'] = false;
    		}
    	}
    	reset($menu2);
    	
    	foreach ($menu1 as &$m)
    	{
    		$temp_menu = MenuModel::where([
    			'level' => 3,
    			'sup_menu_id' => $m['id'],
    			'shown' => 1
    		])
    		->where('link','<>','')
    		->orderBy('sort', 'asc')
    		->orderBy('id','asc')
    		->get()->toArray();
    		
    		if (isset($temp_menu[0]['link']) && ! empty($temp_menu[0]['link']))
    		{
    			// 二级菜单的连接取对应三级菜单的第一个菜单的连接
    			$m['link'] = url($temp_menu[0]['link']);
    		}
    		
    		if ($m['id'] == $current_sup['id'])
    		{
    			$menu_queue[] = $m['name'];
    			$m['active'] = true;
    		}
    		else
    		{
    			$m['active'] = false;
    		}
    	}
    	reset($menu1);
    	
    	foreach ($menu as &$m)
    	{
    		$m['link'] = $this->getMenuUrl($m);
    		
    		if ($m['id'] === $current_sup['sup_menu_id'])
    		{
    			$menu_queue[] = $m['name'];
    			$m['active'] = true;
    		}
    		else
    		{
    			$m['active'] = false;
    		}
    	}
    	
    	View::share('menu',$menu);
    	View::share('menu1',$menu1);
    	View::share('menu2',$menu2);
    	View::share('menu_queue',implode(' - ', array_reverse($menu_queue)));
    	
    	View::share('user',AdminModel::getLoginedAdmin());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
