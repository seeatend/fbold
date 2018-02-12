<?php

namespace SocialBid\Helpers;

use Followback\SocialAccount;

class ServicesHelper {
    public function __construct()
    {
        $this->servicesList = \Config::get('bidServices');
    }

    public function getList()
    {
        return $this->servicesList;
    }

    public function toSelectOptions($service)
    {
        $results = [];
        $list = $this->servicesList[$service];
        foreach ($list as $service => $settings) {
            $results[$service] = $settings['description'];
        }
        return $results;
    }

    public function getDescription($service, $type)
    {
        return isset($this->servicesList[$service][$type]['description']) ?
            $this->servicesList[$service][$type]['description'] : null;
    }

    public function isUploadable($service, $serviceType)
    {
        if (isset($this->servicesList[$service][$serviceType]['uploadable']) &&
            $this->servicesList[$service][$serviceType]['uploadable'] === true
        ) {
            return true;
        }
        return false;
    }

    public function getListWithConnectFilter()
    {

        $services = $this->servicesList;
        $userServices = Sentry::getUser()->socialAccounts()->lists('type');

        //$userServices = Sentry::getUser()->socialAccounts()->lists('type');

        $userServices = DB::table('users_social_accounts')
            ->where('user_id', Sentry::getUser()->id)
            ->where('is_connected', 1)
            ->lists('type');

        foreach ($services as $key => $service) {
            if (!in_array($key, $userServices)) {
                unset($services[$key]);
            }
        }
        return $services;
    }

    public function getPricesByServiceAndUsername($service, $username)
    {
        $user = (new SocialAccount)->byUsername($username)
            ->byType($service)
            ->with('user')
            ->first();
        if ($user) {
            $settings = $user->user->getSettings();
            $prices = isset($settings->services_prices[$service]) ?
                $settings->services_prices[$service] : null;
            if ($prices !== null) {
                return $prices;
            }
        }
        $dummyPrices = $this->dummyServicesPrices();
        return $dummyPrices[$service];
    }

    public function dummyServicesPrices()
    {
        $results = [];
        foreach ($this->servicesList as $key => $service) {
            foreach ($service as $key2 => $option) {
                $results[$key][$key2] = ['type' => null, 'price' => null];
            }
        }
        return $results;
    }

    public function forBidCreate($service, $username)
    {
        $values = $this->getPricesByServiceAndUsername($service, $username);
        foreach ($values as $key => $value) {
            if (isset($this->servicesList[$service][$key])) {
                $values[$key]['description'] = $this->servicesList[$service][$key]['description'];
            }
        }
        return $values;
    }

    /**
     * counts fixed price settings for user prices settings
     * @param  array $userPrices array from user_settings
     * @return integer
     */
    public function countFixedPrices($userPrices)
    {
        $count = 0;
        foreach ($userPrices as $service) {
            if (isset($service['type']) and $service['type'] === 'fixed') {
                $count++;
            }
        }
        return $count;
    }
}