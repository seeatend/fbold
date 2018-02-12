<?php
namespace SocialBid\Presenters;

use SocialBid\Presenters\Exceptions\PresenterException;

trait PresentableTrait {
    protected $presenterInstance;

    public function present()
    {
        if (!$this->presenter or !class_exists($this->presenter)) {
            throw new PresenterException(
                'Please set the protected $presenter property to your presenter path.'
            );
        }
        if (!isset(static::$presenterInstance)) {
            $this->presenterInstance = new $this->presenter($this);
        }

        return $this->presenterInstance;
    }
}