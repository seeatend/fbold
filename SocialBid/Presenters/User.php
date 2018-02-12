<?php

namespace SocialBid\Presenters;
class User extends Presenter{
	protected $entity;
	public function servicesPricesForSettings()
	{
		if($this->entity->services_prices !==null){
			return $this->entity->services_prices;
		}
		return null;
	}
	public function name()
	{
		if(!empty($this->entity->first_name) and !empty($this->entity->last_name)){
			return $this->entity->first_name.' '.$this->entity->last_name;
		}
		return $this->entity->email;
	}
}