<?php

namespace App\Sukhdev\StripeBundle\Service;

use App\Sukhdev\StripeBundle\Entity\StripeCustomer;
use App\Sukhdev\StripeBundle\Entity\StripePlan;

interface IStripeService
{
    public function createClient(string $company, string $email);

    public function getCustomer(string $id): StripeCustomer;

    public function updateClient(string $company, string $customerId): void;

    /** @return StripeCustomer[] */
    public function getListOfClients(?string $email): array;

    /** @return StripePlan[] */
    public function getPlansList(): array;

    /** @return StripePlan[] */
    public function getActivePlansList(): array;

    /** @return StripePlan[] */
    public function getRecurringPlansList(): array;

    /** @return StripePlan[] */
    public function getActiveRecurringPlansList(): array;
}