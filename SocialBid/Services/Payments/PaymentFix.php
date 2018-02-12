<?php

namespace SocialBid\Services\Payments;
use PayPal\Api\Payment;
use PayPal\Rest\ApiContext;
use PayPal\Transport\PPRestCall;
class PaymentFix extends Payment {
	    /**
     * Execute
     *
     * @param \Paypal\Api\PaymentExecution $paymentExecution
     * @param \PayPal\Rest\ApiContext|null $apiContext
     *
     * @return Payment
     * @throws \InvalidArgumentException
     */
    public function execute($paymentExecution, $apiContext = null, $restCall = NULL)
    {
        if ($this->getId() == null) {
            throw new \InvalidArgumentException("Id cannot be null");
        }

        if (($paymentExecution == null)) {
            throw new \InvalidArgumentException("paymentExecution cannot be null or empty");
        }

        $payLoad = $paymentExecution->toJSON();

        if ($apiContext == null) {
            $apiContext = new ApiContext(self::$credential);
        }

        $call = new PPRestCall($apiContext);
        $json = $call->execute(array('PayPal\Rest\RestHandler'), "/v1/payments/payment/{$this->getId()}/execute", "POST", $payLoad);
        //hack
        return json_decode($json);
    }
}