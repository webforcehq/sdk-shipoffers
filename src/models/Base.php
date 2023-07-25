<?php

namespace Thiio\ShipOffers\Models;

use JsonSerializable;

class Base implements JsonSerializable
{
    protected $setters;
    protected $attributeMap;

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
    
    public function toArray()
    {
        return array_filter(json_decode(json_encode($this), true));
    }

    /**
     * Return a serialized array of the current Model
     *
     * @return mixed[]
     */ 
    public function serialize()
    {
        $valuesWhitLocalNames = $this->toArray();
        $valuesWithOriginalNames = [];
        foreach ( $valuesWhitLocalNames as $key => $val ) {
            if ( !array_key_exists($key, $this->attributeMap) ) continue;
            $valuesWithOriginalNames[$this->attributeMap[$key]] = $val;
        }

        return $valuesWithOriginalNames;
    }

    public function setAttributes(array $data)
    {
        foreach ( $data as $key => $val ) {
            if ( !$val ) continue;
            if ( !array_key_exists($key, $this->setters) ) continue;
            $this->{$this->setters[$key]}($val);
        }
    }
}