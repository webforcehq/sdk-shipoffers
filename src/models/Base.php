<?php

namespace Thiio\ShipOffers\Models;

class Base
{
    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $data = [];

    public function __construct() { }
    
    /**
     * Return a serialized array of the current Model
     *
     * @return mixed[]
     */ 
    public function serialize()
    {
        $dataFiltered = [];
        foreach ( $this->data as $key => $val ) {
            if ( !$val ) continue;
            $dataFiltered[$key] = $val;
        }

        return $dataFiltered;
    }
}