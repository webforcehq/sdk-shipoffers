<?php

namespace WebforceHQ\ShipOffers\Models;

use JsonSerializable;

class Base implements JsonSerializable
{
    protected $setters;
    protected $attributeMap;
    protected $protectedProperties = [
        'attributeMap',
        'setters',
        'protectedProperties'
    ];

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
    
    public function toArray()
    {
        return array_filter(json_decode(json_encode($this), true), fn($val) => !is_null($val));
    }

    /**
     * Return a serialized array of the current Model
     *
     * @return mixed[]
     */ 
    public function serialize()
    {
        $valuesWithOriginalNames = [];
        $valuesWhitLocalNames = $this->toArray();

        $this->unsetProtectedProperties($valuesWhitLocalNames);
        foreach ( $valuesWhitLocalNames as $key => $val ) {
            if ( !array_key_exists($key, $this->attributeMap) ) continue;
            $valuesWithOriginalNames[$this->attributeMap[$key]] = $val;
        }

        return $valuesWithOriginalNames;
    }

    private function unsetProtectedProperties(&$array) {
        foreach ( $array as $key => &$value ) {
            if ( $array[$key] === 0 || $array[$key] === '' ) continue;
            if ( is_null($value) || in_array($key, $this->protectedProperties) ) {
                unset($array[$key]);
            }

            if ( is_array($value) ) {
                $this->unsetProtectedProperties($value);
            }
        }
    }

    public function setAttributes(array $data)
    {
        foreach ( $data as $key => $val ) {
            if ( is_null($val) ){
                continue;
            } 
            if ( !array_key_exists($key, $this->setters) ) continue;
            $this->{$this->setters[$key]}($val);
        }
    }
}