<?php

namespace App\Sukhdev\StripeBundle\Entity;

use Stripe\Plan;
use Stripe\StripeClient;

class StripePlanTranslator
{
    /**
     * @throws \Stripe\Exception\ApiErrorException
     */
    public static function fromObject(Plan $plan, StripeClient $client): StripePlan
    {
        $product = $client->products->retrieve($plan->product);
        return new StripePlan(
            $plan->id,
            $plan->currency,
            $plan->product,
            $product->description,
            $plan->usage_type,
            $plan->active,
            $plan->amount
        );
    }

}