<?php

namespace SocialBid\Presenters;

class UserSetting extends Presenter {
    protected $entity;

    public function servicesPricesForSettings()
    {
        if ($this->entity->services_prices !== null) {
            return $this->entity->services_prices;
        }
        return null;
    }
}