<?php

namespace WebforceHQ\ShipOffers\Traits;

trait BaseResponseTrait
{
    private function getDefaultResponse()
    {
        return (object) [
            'msg'     => '',
            'error'   => '',
            'success' => false,
            'code'    => null,
        ];
    }
}