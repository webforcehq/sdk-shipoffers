<?php

namespace Thiio\ShipOffers\Handlers;

use Exception;
use Thiio\ShipOffers\Client;
use Thiio\ShipOffers\Exceptions\InvalidArgumentException;
use Thiio\ShipOffers\Models\Order as OrderModel;
use Thiio\ShipOffers\Traits\BaseResponseTrait;

class Order extends Client
{
    use BaseResponseTrait;

    public const ALLOWED_QUERY_PROPERTIES = [
        'updated_at_start',	
        'updated_at_end',	
        'order_number',	
        'page',	
        'per_page'
    ];

    public function __construct(string $username = null, string $password = null, string $storeId = null)
    {   
        parent::__construct($username, $password, $storeId);
    }

    public function createOrder(OrderModel $order) : Object
    {
        try {
            $defaultResponse = $this->getDefaultResponse();
            if ( !$order ) throw new InvalidArgumentException('Missing required parameter Order');
    
            $resourcePath = 'orders/new.json';
            $response = $this->makeRequest(
                $resourcePath,
                'POST',
                [
                    'order' => $order->serialize()
                ]
            );
            
            $defaultResponse->msg = 'Order created';  
            $defaultResponse->success = true;
            $defaultResponse->{'order'} = new OrderModel($response['order']);
        } catch (Exception $e) {
            $defaultResponse->msg = 'Error trying to create Order';
            $defaultResponse->error = $e->getMessage();
        } finally {
            return $defaultResponse;
        }
    }

    public function fetchOrder(string $orderId = null) : Object
    {
        try {
            $defaultResponse = $this->getDefaultResponse();
            if ( !$orderId ) throw new InvalidArgumentException('Missing required parameter Order Id');
    
            $resourcePath = "orders/{$orderId}.json";
            $response = $this->makeRequest(
                $resourcePath,
                'GET'
            );

            $defaultResponse->msg = 'Order found';  
            $defaultResponse->success = true;
            $defaultResponse->{'order'} = new OrderModel($response['order']);
        } catch (Exception $e) {
            $defaultResponse->msg = 'Error trying to fetch Order';
            $defaultResponse->error = $e->getMessage();
        } finally {
            return $defaultResponse;
        }
    }

    public function updateOrder(OrderModel $order) : Object
    {
        try {
            $defaultResponse = $this->getDefaultResponse();
            if ( !$order ) throw new InvalidArgumentException('Missing required parameter Order');
            if ( !$order->getId() ) throw new InvalidArgumentException('Order does not have an Id set');

            $resourcePath = "orders/{$order->getId()}/update.json";
            $response = $this->makeRequest(
                $resourcePath,
                'PUT',
                [
                    'order' => $order->serialize()
                ]
            );
            
            $defaultResponse->msg = 'Order updated';  
            $defaultResponse->success = true;
            $defaultResponse->{'order'} = new OrderModel($response['order']);
        } catch (Exception $e) {
            $defaultResponse->msg = 'Error trying to update Order';
            $defaultResponse->error = $e->getMessage();
        } finally {
            return $defaultResponse;
        }
    }

    public function deleteOrder(string $orderId = null) : Object
    {
        try {
            $defaultResponse = $this->getDefaultResponse();
            if ( !$orderId ) throw new InvalidArgumentException('Missing required parameter Order Id');

            $resourcePath = "orders/{$orderId}.json";
            $response = $this->makeRequest(
                $resourcePath,
                'DELETE'
            );
            
            $defaultResponse->msg = 'Order deleted';  
            $defaultResponse->success = true;
            $defaultResponse->{'order'} = new OrderModel($response['order']);
        } catch (Exception $e) {
            $defaultResponse->msg = 'Error trying to delete Order';
            $defaultResponse->error = $e->getMessage();
        } finally {
            return $defaultResponse;
        }
    }

    public function fetchOrders(array $query = []) : Object
    {
        try {
            $defaultResponse = $this->getDefaultResponse();

            $resourcePath = 'orders.json';
            $response = $this->makeRequest(
                $resourcePath,
                'GET',
                [],
                $this->filterQueryParams($query)
            );

            $orders = [];
            foreach ( $response['orders'] as $order ) {
                $orders[] = new OrderModel($order);
            }

            $defaultResponse->msg = 'Order found';  
            $defaultResponse->success = true;
            $defaultResponse->{'orders'} = $orders;
        } catch (Exception $e) {
            $defaultResponse->msg = 'Error trying to fetch Orders';
            $defaultResponse->error = $e->getMessage();
        } finally {
            return $defaultResponse;
        }
    }

    private function filterQueryParams(array $query) : array 
    {
        $filteredQueryParams = [];
        foreach ( $query as $key => $val ) {
            if ( !in_array($key, self::ALLOWED_QUERY_PROPERTIES) ) continue;
            $filteredQueryParams[$key] = $val;
        }

        return $filteredQueryParams;
    }
}
