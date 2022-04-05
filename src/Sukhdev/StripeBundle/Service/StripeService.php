<?php

namespace App\Sukhdev\StripeBundle\Service;

use Psr\Log\LoggerInterface;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;
use App\Sukhdev\StripeBundle\Entity\StripeCustomer;
use App\Sukhdev\StripeBundle\Entity\StripeCustomerTranslator;
use App\Sukhdev\StripeBundle\Entity\StripePlanTranslator;
use App\Sukhdev\StripeBundle\Service\Exceptions\CreateCustomerException;
use App\Sukhdev\StripeBundle\Service\Exceptions\GetCustomerException;
use App\Sukhdev\StripeBundle\Service\Exceptions\SymfonyStripeException;
use App\Sukhdev\StripeBundle\Service\Exceptions\UpdateCustomerException;
use Symfony\Component\DependencyInjection\ContainerInterface;

class StripeService implements IStripeService
{
    private LoggerInterface $logger;
    private StripeClient $stripeClient;
    private $container;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger, ContainerInterface $container)
    {
        $this->logger = $logger;
        $this->container = $container;
        $this->stripeClient = new StripeClient($this->container->getParameter("api_key"));
    }

    /**
     * @throws CreateCustomerException
     * @throws SymfonyStripeException
     */
    public function createClient(string $company, string $email): StripeCustomer
    {
        try {
            $result = $this->stripeClient->customers->create([
                "email" => $email,
                "name" => $company
            ]);

            return StripeCustomerTranslator::fromJson($result);
        } catch (ApiErrorException $e) {
            $this->logger->error("Create Customer failed because: " . $e->getMessage());
            throw new CreateCustomerException("Create Customer failed because: " . $e->getMessage());
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new SymfonyStripeException("An error occured: ". $e->getMessage());
        }
    }

    /**
     * @throws UpdateCustomerException
     * @throws SymfonyStripeException
     */
    public function updateClient(string $company, string $customerId): void
    {
        try {
            $this->stripeClient->customers->update($customerId, ["name" => $company]);
        } catch (ApiErrorException $e) {
            $this->logger->error("Create Customer failed because: " . $e->getMessage());
            throw new UpdateCustomerException("Update Customer failed because: " . $e->getMessage());
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new SymfonyStripeException("An error occured: ". $e->getMessage());
        }
    }

    /**
     * @throws GetCustomerException
     * @throws SymfonyStripeException
     */
    public function getListOfClients(?string $email): array
    {
        try {
            if (empty($email)) {
                $result = $this->stripeClient->customers->all();
            } else {
                $result = $this->stripeClient->customers->all(['email' => $email]);
            }

            return $this->map($result, StripeCustomerTranslator::class);
        } catch (ApiErrorException $e) {
            $this->logger->error("Get list of failed because: " . $e->getMessage());
            throw new GetCustomerException("Get Customer failed because: " . $e->getMessage());
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new SymfonyStripeException("An error occured: ". $e->getMessage());
        }
    }

    /**
     * @throws GetCustomerException
     * @throws SymfonyStripeException
     */
    public function getPlansList(): array
    {
        try {
            $result = $this->stripeClient->plans->all();

            return $this->map($result, StripePlanTranslator::class);
        } catch (ApiErrorException $e) {
            $this->logger->error("Get plans failed because: " . $e->getMessage());
            throw new GetCustomerException("Get plans failed because: " . $e->getMessage());
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new SymfonyStripeException("An error occured: ". $e->getMessage());
        }
    }

    /**
     * @throws GetCustomerException
     * @throws SymfonyStripeException
     */
    public function getActivePlansList(): array
    {
        try {
            $result = $this->stripeClient->plans->all(["active" => true]);

            return $this->map($result, StripePlanTranslator::class);
        } catch (ApiErrorException $e) {
            $this->logger->error("Get active plans failed because: " . $e->getMessage());
            throw new GetCustomerException("Get active plans failed because: " . $e->getMessage());
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new SymfonyStripeException("An error occured: ". $e->getMessage());
        }
    }

    /**
     * @throws GetCustomerException
     * @throws SymfonyStripeException
     */
    public function getRecurringPlansList(): array
    {
        try {
            return array_filter($this->getPlansList(), function($e){
                return $e->getType() === "licensed";
            });
        } catch (ApiErrorException $e) {
            $this->logger->error("Get recurring failed because: " . $e->getMessage());
            throw new GetCustomerException("Get recurring  plans failed because: " . $e->getMessage());
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new SymfonyStripeException("An error occured: ". $e->getMessage());
        }
    }

    /**
     * @throws GetCustomerException
     * @throws SymfonyStripeException
     */
    public function getActiveRecurringPlansList(): array
    {
        try {
            return array_filter($this->getActivePlansList(), function($e){
                return $e->getType() === "licensed";
            });
        } catch (ApiErrorException $e) {
            $this->logger->error("Get active recurring plans failed because: " . $e->getMessage());
            throw new GetCustomerException("Get active recurring plans failed because: " . $e->getMessage());
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new SymfonyStripeException("An error occured: ". $e->getMessage());
        }
    }

    private function map($collection, $translator): array
    {
        $result = [];

        foreach($collection as $item) {
            $result[] = $translator::fromObject($item, $this->stripeClient);
        }

        return $result;
    }
}