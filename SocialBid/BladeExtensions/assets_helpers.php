<?php

if(!function_exists('asset_javascript')){
	function asset_javascript($path)
	{
		echo \HTML::script('assets/js/'.$path);
	}
}

if(!function_exists('asset_stylesheet')){
	function asset_stylesheet($path)
	{
		echo \HTML::style('assets/css/'.$path);
	}
}
if(!function_exists('asset_image')){
	function asset_image($path)
	{
		echo asset('assets/images/'.$path);
	}
}