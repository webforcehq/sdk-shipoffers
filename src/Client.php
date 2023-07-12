<?php

namespace Thiio\ShipOffers;

use Thiio\Shipoffers\Exceptions\ShipOffersException;

class Client
{

    private $username;
    private $password;

    public function __construct($username = null, $password = null){
        
        $this->setUsername($username)
        ->setPassword($password)
        ->validateCredentials();
        
    }

    private function validateCredentials(){
        
        if( ! $this->username || ! $this->password ) throw new ShipOffersException("Username and Password are required");
        
        return $this;
    }


    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}
