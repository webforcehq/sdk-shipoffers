<?php

namespace thiio\shipoffers;

use GuzzleHttp\Client as GuzzleHttpClient;
use thiio\shipoffers\exceptions\InvalidArgumentException;

class Client
{
    private $host = 'https://api.shipoffers.com/api/stores/';
    private $storeId;
    private $username;
    private $password;

    public function __construct($username, $password, $storeId)
    {    
        $this->setStoreId($storeId)
        ->setPassword($password)
        ->setUsername($username);
    }

    /**
     * Get the value of storeId
     */ 
    public function getStoreId()
    {
        return $this->storeId;
    }

    /**
     * Set the value of storeId
     *
     * @return  self
     */ 
    public function setStoreId($storeId)
    {
        if ( !$storeId  ) throw new InvalidArgumentException("Store Id is a required parameter");
        $this->storeId = $storeId;

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        if ( !$username  ) throw new InvalidArgumentException("Username is a required parameter");
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        if ( !$password  ) throw new InvalidArgumentException("Password is a required parameter");
        $this->password = $password;

        return $this;
    }

    public function makeRequest(string $resourcePath, string $method = 'GET', array $bodyParams = [], array $queryParams = [])
    {
        $url = "{$this->host}/{$this->storeId}/{$resourcePath}";
        $requestClient = new GuzzleHttpClient();
        
        $requestConfig = [
            'auth' => [$this->username, $this->password],
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ];

        if ( $bodyParams ) {
            $requestConfig['json'] = $bodyParams;
        }

        if ( $queryParams ) {
            $requestConfig['query'] = $queryParams;
        }

        $response = $requestClient->request($method, $url, $requestConfig);
        return $response;
    }


    private function buildQueryParams(array $queryParams)
    {
        $params = '';
        if ( !count($queryParams) ) return $params;

        foreach ( $queryParams as $key => $val ) {
            $params = $params === '' ? "?{$key}={$val}" : "{$params}&{$key}={$val}";
        }

        return $params;
    }
}
