<?php

namespace thiio\shipoffers\exceptions;

use Exception;

class InvalidArgumentException extends Exception
{
    public function __construct($message = null)
    {
        parent::__construct($message);
    }

}
