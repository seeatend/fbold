<?php

namespace SocialBid\Helpers;

class ArrayHelper {

	/**
	 * maps values to keys so result is an array with keys the same as values
	 * @param  array  $array
	 * @return array
	 */
	public function valuesAsKeys(array $array)
	{
		$results = [];
		foreach($array as $key=>$value){
			$results[$value] = $value;
		}
		return $results;
	}

	public function valuesToUpperFirst(array $array)
	{
		return array_map(function($value){
			return ucfirst($value);
		}, $array);
	}

	public function recursiveReplace($search, $replace, $subject)
	{
		if ( ! is_array($subject)) {
			// Regular replace
			return str_replace($search, $replace, $subject);
		}

		$newArr = array();
		foreach ($subject as $k => $v) {
			// Replace keys as well?
			$add_key = $k;

			// Recurse
			$newArr[$add_key] = $this->recursiveReplace($search, $replace, $v);
		}

		return $newArr;
	}
}
