<?php

namespace Thiio\ShipOffers\Exceptions;

use Exception;

final class InvalidPropertyValueException extends Exception
{
    public function __construct($message = null)
    {
        parent::__construct($message);
    }

}
