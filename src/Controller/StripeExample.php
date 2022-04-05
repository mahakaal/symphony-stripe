<?php

namespace App\Controller;

use App\Sukhdev\StripeBundle\Service\Exceptions\GetCustomerException;
use App\Sukhdev\StripeBundle\Service\Exceptions\SymfonyStripeException;
use App\Sukhdev\StripeBundle\Service\StripeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StripeExample extends AbstractController
{
    public function getAllCustomers(StripeService $stripeService): \Symfony\Component\HttpFoundation\JsonResponse
    {
        try {
            return $this->json(array_map(function($e) {
                return ['id' => $e->getId(), 'company' => $e->getCompany(), 'email' => $e->getEmail()];
            },$stripeService->getListOfClients(null)));
        } catch (GetCustomerException $e) {
            exit($e->getMessage());
        } catch (SymfonyStripeException $e) {
            exit($e->getMessage());
        }
    }
}