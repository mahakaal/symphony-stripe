<?php

namespace App\Sukhdev\StripeBundle\Entity;

class StripeCustomer {
    private string $id;
    private string $company;
    private string $email;

    /**
     * @param string $id
     * @param string $company
     * @param string $email
     */
    public function __construct(string $id, string $company, string $email)
    {
        $this->id = $id;
        $this->company = $company;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCompany(): string
    {
        return $this->company;
    }

    /**
     * @param string $company
     */
    public function setCompany(string $company): void
    {
        $this->company = $company;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


}