<?php

namespace SocialBid\Services\Forms\Profile;
use SocialBid\Services\Forms\BaseForm;
use Illuminate\Support\MessageBag;
use config;
class ServicesPricesForm extends BaseForm {
	public function isValid($input)
	{
		//set services
		$services = $input;
		$servicesList = \ServicesHelper::getList();
		$errors = new MessageBag;


		//iterate over them and if any of them will return an error then we will return false
		foreach($services as $service=>$options){
			foreach($options as $type=>$settings){
				//check if exists on the list of services list
				if(!isset($servicesList[$service][$type])){
					$errors->add("services[{$service}][{$type}]", "This is not a valid service type. Try again.");
				}
				if(!empty($settings['price']) and !isset($settings['type'])){
					$errors->add("services[{$service}][{$type}][price]", "You must choose the type of bid you want the value to be applied to.");
				}
				if(isset($settings['type']) and empty($settings['price'])){
					//$errors->add("services[{$service}][{$type}][price]", "You selected the type of bid, but you have to fill price too.");
					$errors->add("services[{$service}][{$type}][price]", "Price must be at least $".Config::get('otherconstants')['MIN_BID_PRICE']);
				}
				//check if isset and not null and is numeric
				if(isset($settings['type']) and isset($settings['price']) and !is_numeric($settings['price'])){
					$errors->add("services[{$service}][{$type}][price]", "This value is not a number. Try again.");
				}

				if(!empty($settings['price']) and $settings['price'] < Config::get('otherconstants')['MIN_BID_PRICE']){
					$errors->add("services[{$service}][{$type}][price]", "Price must be at least $".Config::get('otherconstants')['MIN_BID_PRICE']);
				}
			}
		}
		$this->setErrors($errors);
		return $errors->isEmpty() ? true : false;
	}
}