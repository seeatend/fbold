<?php

namespace SocialBid\Helpers;
use Response;
class ResponseHelper {
	public static function registerMacros(){
		/**
		 * JSON OK response macro
		 * @var [type]
		 */
		Response::macro('jsonOk', function($data=null, $httpCode=200){
			$response = array('status'=>'OK');
			if($data!==null){
				$response['data'] = $data;
			}
			return Response::json($response, $httpCode);
		});

		Response::macro('jsonError', function($errors=null,$error_code=null, $httpCode=200){
			$errors = $errors instanceof \Illuminate\Support\MessageBag ? $errors->toArray() : $errors;
			$response = array('status'=>'error','errors'=>(array) $errors);
			if($error_code!==null){
				$reponse['error_code'] = $error_code;
			}
			return Response::json($response,$httpCode);
		});
	}
}
