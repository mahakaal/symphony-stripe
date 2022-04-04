<?php

namespace App\Sukhdev\StripeBundle\Service\Exceptions;

class GetCustomerException extends \Exception {
    public function __construct($message, $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function toString()
    {
        return __CLASS__ . ": [{$this->code}|get]: {$this->message}".PHP_EOL;
    }
}