<?php

namespace App\Exceptions;

use Exception;

class InvalidDateException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
