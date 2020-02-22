<?php
namespace App\Helper;
class Assets
{
	static private function getWebPath($value){
		return '/'.$value.'/';
	}
	
	static public function css($value)
	{
		return self::getWebPath('css').$value; 
	}
	
	static public function image($value)
	{
		return self::getWebPath('images').$value; 
	}
	
	static public function js($value)
	{
		return self::getWebPath('js').$value;
	}
}