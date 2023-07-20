<?php

namespace Thiio\ShipOffers\exceptions;

use Exception;

final class InvalidArgumentException extends Exception
{
    public function __construct($message = null)
    {
        parent::__construct($message);
    }

}
