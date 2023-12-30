<?php

namespace App\Paypal;

use Paypal\Api\Amount;
use Paypal\Api\Details;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Exception\PayPalConnectionException;

class Paypal
{

    protected $apicontext;

    public function __construct()
    {
        $this->apicontext = new \PayPal\Rest\Apicontext(
            new \PayPal\Auth\OAuthTokenCredential(
                config(key: 'services.paypal.id'),
                config(key: 'services.paypal.secret'),
            )
        );


    }

    protected function details(): Details
    {
        $details = new Details();

        $details->setTax(tax: 1.3);

        return $details;
    }
}