<?php

namespace SocialBid\Presenters;

abstract class Presenter{
	/**
	 * Model entity
	 * @var [type]
	 */
	protected $entity;


	public function __construct($entity)
	{
		$this->entity = $entity;
	}

	public function __get($property)
	{
		$property = studly_case($property);
		if(method_exists($this, $property)){
			return $this->{$property}();
		}
		return $this->entity->{$property};
	}
}