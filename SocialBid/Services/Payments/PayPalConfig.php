<?php
namespace SocialBid\Services\Payments;
class PayPalConfig
{
	// For a full list of configuration parameters refer in wiki page(https://github.com/paypal/sdk-core-php/wiki/Configuring-the-SDK)
	public static function getConfig($key=null)
	{
		$config = array(
				// values: 'sandbox' for testing
				//		   'live' for production
				//"mode" => \DbConfig::get('payments.paypal.mode','live')
				"mode" => \DbConfig::get('payments.paypal.mode')
		);
		return array_get($config, $key);
	}

	// Creates a configuration array containing credentials and other required configuration parameters.
	public static function getAcctAndConfig()
	{
		return array_merge(\DbConfig::get('payments.paypal'), self::getConfig());;
	}
}
