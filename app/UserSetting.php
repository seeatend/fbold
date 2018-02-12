<?php
namespace Followback;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model {
    use \SocialBid\Presenters\PresentableTrait;
    protected $presenter = 'SocialBid\Presenters\UserSetting';

    protected $fillable = [];
    protected $table = 'user_settings';

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function setServicesPricesAttribute($value)
    {
        $value = $this->processPriceSettings($value);
        $this->attributes['services_prices'] = json_encode($value);
    }

    public function getServicesPricesAttribute()
    {
        return json_decode($this->attributes['services_prices'], true);
    }

    protected function processPriceSettings($values, $decimals = 2)
    {
        foreach ($values as $service => $value) {
            foreach ($value as $serviceType => $prices) {
                $values[$service][$serviceType]['type'] = !empty($prices['type']) ?
                    $prices['type'] : null;
                $values[$service][$serviceType]['price'] = !empty($prices['price']) ?
                    str_replace(',', '', $prices['price']) : null;
            }
        }
        return $values;
    }

    public function getPricesForService($service)
    {
        $prices = $this->services_prices;
        if (isset($prices[$service])) {
            return $prices[$service];
        }
        return null;
    }

    /**
     * returns minimum price for provided service type and bid type
     * @param  string $serviceType service type
     * @param  string $bidType bid type
     * @return float              value
     */
    public function getMinimumPrice($service, $serviceType)
    {
        $servicesPrices = $this->services_prices;
        if (isset($servicesPrices[$service][$serviceType]['type'])) {
            return (float) $servicesPrices[$service][$serviceType]['price'];
        }
        return 0;
    }

    public function getMinimumPriceList($service, $serviceType)
    {
        $servicesPrices = $this->services_prices;
        if (isset($servicesPrices[$service][$serviceType]['type'])) {
            return $servicesPrices[$service][$serviceType];
        }
        return array('type' => 'bid', 'price' => '0');
    }
}