<?php

namespace thiio\shipoffers\handlers;

use thiio\shipoffers\Client;
use thiio\shipoffers\exceptions\InvalidArgumentException;
use thiio\shipoffers\models\Order as ModelsOrder;

class Order extends Client
{
    public function __construct(string $username = null, string $password = null, string $storeId = null)
    {   
        parent::__construct($username, $password, $storeId);
    }

    protected function createOrder(ModelsOrder $order)
    {
        if ( $order ) throw new InvalidArgumentException('Missing required parameter Order');

        $resourcePath = 'orders/new.json';
        $response = $this->makeRequest(
            $resourcePath,
            'POST'
        );
    }

    protected function fetchOrder(string $orderId)
    {
        if ( $orderId ) throw new InvalidArgumentException('Missing required parameter Order Id');

        $resourcePath = "orders/{$orderId}.json";
        $response = $this->makeRequest(
            $resourcePath,
            'GET'
        );

        var_dump($response);
    }

    protected function fetchOrders(array $query)
    {
        if ( $query ) throw new InvalidArgumentException('Missing required parameter Query');

        $resourcePath = 'orders/new.json';
        $response = $this->makeRequest(
            $resourcePath,
            'GET'
        );
    }
}
