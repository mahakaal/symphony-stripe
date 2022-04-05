<?php

namespace App\Sukhdev\StripeBundle\Entity;

use Stripe\Customer;
use Stripe\StripeClient;

class StripeCustomerTranslator
{
    public static function fromObject(Customer $customer, StripeClient $client): StripeCustomer
    {
        return new StripeCustomer(
            $customer->id,
            $customer->name ?: '',
            $customer->email ?: ''
        );
    }

}