<?php

namespace App\Sukhdev\StripeBundle\Entity;

class StripePlan
{
    private string $id;
    private string $currency;
    private string $productName;
    private string $productDescription;
    private string $type;
    private bool $active;
    private float $unitAmount;

    /**
     * @param string $id
     * @param string $currency
     * @param string $productName
     * @param string $productDescription
     * @param string $type
     * @param bool $active
     * @param float $unitAmount
     */
    public function __construct(string $id, string $currency, string $productName,
                                string $productDescription, string $type, bool $active, ?float $unitAmount)
    {
        $this->id = $id;
        $this->currency = $currency;
        $this->productName = $productName;
        $this->productDescription = $productDescription;
        $this->type = $type;
        $this->active = $active;
        $this->unitAmount = $unitAmount?: 0.0;
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
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     */
    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    /**
     * @return string
     */
    public function getProductDescription(): string
    {
        return $this->productDescription;
    }

    /**
     * @param string $productDescription
     */
    public function setProductDescription(string $productDescription): void
    {
        $this->productDescription = $productDescription;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return float
     */
    public function getUnitAmount(): float
    {
        return $this->unitAmount;
    }

    /**
     * @param float $unitAmount
     */
    public function setUnitAmount(float $unitAmount): void
    {
        $this->unitAmount = $unitAmount;
    }
}