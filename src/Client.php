<?php

namespace WebforceHQ\ShipOffers;

use Exception;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\ClientException;
use WebforceHQ\ShipOffers\Exceptions\ApiException;
use WebforceHQ\ShipOffers\Exceptions\InvalidArgumentException;

class Client
{
    private $host = 'https://api.shipoffers.com/api/stores';

    protected const DELETE_ORDER_API_HOST = "https://soapi.shipoffers.com/stores";
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

    public function makeRequest(string $resourcePath, string $method = 'GET', array $bodyParams = [], array $queryParams = [], string $host = null)
    {
        try {
            $apiHost = $host ?: $this->host;
            $url     = "{$apiHost}/{$this->storeId}/{$resourcePath}";
            $requestClient = new GuzzleHttpClient();
            
            $requestConfig = [
                'auth'    => [$this->username, $this->password],
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
                //'debug' => true
            ];

            if ( $bodyParams ) {
                $requestConfig['json'] = $bodyParams;
            }

            if ( $queryParams ) {
                $requestConfig['query'] = $queryParams;
            }

            $response        = $requestClient->request($method, $url, $requestConfig);
            $defaultResponse = ["code" => $response->getStatusCode()];
            $parsedResponse  = json_decode($response->getBody(), true);
            if( ! is_null($parsedResponse) ){
                $defaultResponse = array_merge($defaultResponse, $parsedResponse);
            }
            return $defaultResponse;
        } catch (ClientException $e) {
            throw new ApiException($e);
        } catch (Exception $e) {
            throw new ApiException($e->getMessage());
        }
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

    private function handleErrorResponse(ClientException $error)
    {
        if ( !$error->hasResponse() ) return $error->getMessage();

        $responseBodyErrors = $this->handleBodyResponseErrors($error);
        $statusCode = $error->getResponse()->getStatusCode();
        $errorMessage = "{$statusCode} Unknown error occurred{$responseBodyErrors}";
        
        if ( $statusCode === 404 ) {
            $errorMessage = "{$statusCode} Resource not found{$responseBodyErrors}";
        }
        
        if ( $statusCode === 400 ) {
            $errorMessage = "{$statusCode} Bad request{$responseBodyErrors}";
        }

        return $errorMessage;
    }

    private function handleBodyResponseErrors(ClientException $error)
    {
        $errors = '';

        if ( !$error->getResponse()->getBody() ) return '';
        $responseBody = json_decode((string)$error->getResponse()->getBody());
        if ( !$responseBody->errors ) return '';

        foreach ( $responseBody->errors as $responseBodyError ) {
            $errors = $errors === '' ? ": {$responseBodyError}" : "{$errors}, {$responseBodyError}";
        }

        return $errors;
    }
}
