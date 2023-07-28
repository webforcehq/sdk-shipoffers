<?php

namespace Thiio\ShipOffers\Exceptions;

use Exception;

final class ApiException extends Exception
{
    public function __construct($message = null)
    {
        parent::__construct($message);
    }

}
