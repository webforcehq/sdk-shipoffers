<?php

namespace Thiio\Shipoffers\Exceptions;

use Exception;

class ShipOffersException extends Exception
{

    public function __construct($message = null)
    {
        parent::__construct($message);
    }

}
