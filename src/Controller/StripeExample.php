<?php

namespace App\Controller;

use App\Sukhdev\StripeBundle\Service\Exceptions\GetCustomerException;
use App\Sukhdev\StripeBundle\Service\Exceptions\SymfonyStripeException;
use App\Sukhdev\StripeBundle\Service\StripeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StripeExample extends AbstractController
{
    public function getAllCustomers(StripeService $stripeService, Request $request): Response
    {
        try {
            $email = $request->attributes->getAlnum('email') ?: null;
            return $this->render('customers.html.twig',[
                'customers' => $stripeService->getListOfClients($email)
            ]);
        } catch (GetCustomerException $e) {
            exit($e->getMessage());
        } catch (SymfonyStripeException $e) {
            exit($e->getMessage());
        }
    }

    public function getAllPlans(StripeService  $stripeService): Response
    {
        try {
            return $this->render('plans.html.twig',[
                'plans' => $stripeService->getPlansList(),
                'type' => 'All'
            ]);
        } catch (GetCustomerException $e) {
            exit($e->getMessage());
        } catch (SymfonyStripeException $e) {
            exit($e->getMessage());
        }
    }

    public function getAllActivePlans(StripeService  $stripeService): Response
    {
        try {
            return $this->render('plans.html.twig',[
                'plans' => $stripeService->getActivePlansList(),
                'type' => 'Active'
            ]);
        } catch (GetCustomerException $e) {
            exit($e->getMessage());
        } catch (SymfonyStripeException $e) {
            exit($e->getMessage());
        }
    }

    public function getAllRecurringPlans(StripeService  $stripeService): Response
    {
        try {
            return $this->render('plans.html.twig',[
                'plans' => $stripeService->getRecurringPlansList(),
                'type' => 'Recurring'
            ]);
        } catch (GetCustomerException $e) {
            exit($e->getMessage());
        } catch (SymfonyStripeException $e) {
            exit($e->getMessage());
        }
    }

    public function getAllActiveRecurringPlans(StripeService  $stripeService): Response
    {
        try {
            return $this->render('plans.html.twig',[
                'plans' => $stripeService->getActiveRecurringPlansList(),
                'type' => 'Active Recurring'
            ]);
        } catch (GetCustomerException $e) {
            exit($e->getMessage());
        } catch (SymfonyStripeException $e) {
            exit($e->getMessage());
        }
    }
}