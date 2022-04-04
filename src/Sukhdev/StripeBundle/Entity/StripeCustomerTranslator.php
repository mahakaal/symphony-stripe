<?php

namespace App\Sukhdev\StripeBundle\Entity;

use Stripe\Customer;

class StripeCustomerTranslator
{
    public static function fromJson(Customer $customer): StripeCustomer
    {
        return new StripeCustomer(
            $customer->id,
            $customer->name,
            $customer->email
        );
    }

}