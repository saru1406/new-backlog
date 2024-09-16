<?php

namespace App\Exceptions;

use Exception;

class AlreadyExistsException extends Exception
{
    public function __construct(string $key)
    {
        $message = "既に'{$key}は存在しています'";

        parent::__construct($message);
    }
}
