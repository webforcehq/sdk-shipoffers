<?php

namespace WebforceHQ\ShipOffers\Exceptions;

use Exception;

final class InvalidArgumentException extends Exception
{
    public function __construct($message = null)
    {
        parent::__construct($message);
    }

}
