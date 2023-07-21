<?php

namespace Thiio\ShipOffers\Handlers;

use Exception;
use Thiio\ShipOffers\Client;
use Thiio\ShipOffers\Exceptions\InvalidArgumentException;
use Thiio\ShipOffers\models\OrderItem;
use Thiio\ShipOffers\Models\Order;
use Thiio\ShipOffers\Traits\BaseResponseTrait;

class OrderItemHandler extends Client
{
    use BaseResponseTrait;

    public function __construct(string $username = null, string $password = null, string $storeId = null)
    {   
        parent::__construct($username, $password, $storeId);
    }

    public function createOrderItem(OrderItem $orderItem, string $orderId = null) : Object
    {
        try {
            $defaultResponse = $this->getDefaultResponse();
            if ( !$orderItem ) throw new InvalidArgumentException('Missing required parameter orderItem');
            if ( !$orderId ) throw new InvalidArgumentException('Missing required parameter orderId');
    
            $resourcePath = "orders/{$orderId}/items/add.json";
            $response = $this->makeRequest(
                $resourcePath,
                'POST',
                [
                    'order_item' => $orderItem->serialize()
                ]
            );

            $orderItemCreated = [];
            if ( count($response['items']) ) {
                $orderItemCreated = array_shift($response['items']);
            }
            
            $defaultResponse->msg = 'Order Item created';  
            $defaultResponse->success = true;
            $defaultResponse->{'orderItem'} = new OrderItem($orderItemCreated);
        } catch (Exception $e) {
            $defaultResponse->msg = 'Error trying to create Order Item';
            $defaultResponse->error = $e->getMessage();
        } finally {
            return $defaultResponse;
        }
    }

    public function fetchOrderItem(string $orderItemId = null, string $orderId = null) : Object
    {
        try {
            $defaultResponse = $this->getDefaultResponse();
            if ( !$orderId ) throw new InvalidArgumentException('Missing required parameter orderId');
            if ( !$orderItemId ) throw new InvalidArgumentException('Missing required parameter orderItemId');
    
            $resourcePath = "orders/{$orderId}/items/{$orderItemId}.json";
            $response = $this->makeRequest(
                $resourcePath,
                'GET'
            );

            $defaultResponse->msg = 'Order Item found';  
            $defaultResponse->success = true;
            $defaultResponse->{'orderItem'} = new OrderItem($response['order_item']);
        } catch (Exception $e) {
            $defaultResponse->msg = 'Error trying to fetch Order Item';
            $defaultResponse->error = $e->getMessage();
        } finally {
            return $defaultResponse;
        }
    }

    public function updateOrderItem(OrderItem $orderItem, string $orderId = null) : Object
    {
        try {
            $defaultResponse = $this->getDefaultResponse();
            if ( !$orderId ) throw new InvalidArgumentException('Missing required parameter orderId');
            if ( !$orderItem->getId() ) throw new InvalidArgumentException('orderItem does not have an Id set');

            $resourcePath = "orders/{$orderId}/items/{$orderItem->getId()}.json";
            $response = $this->makeRequest(
                $resourcePath,
                'PUT',
                [
                    'order_item' => $orderItem->serialize()
                ]
            );
            
            $defaultResponse->msg = 'Order Item updated';  
            $defaultResponse->success = true;
            $defaultResponse->{'orderItem'} = new OrderItem($response['order_item']);
        } catch (Exception $e) {
            $defaultResponse->msg = 'Error trying to update Order Item';
            $defaultResponse->error = $e->getMessage();
        } finally {
            return $defaultResponse;
        }
    }

    public function deleteOrderItem(string $orderItemId = null, string $orderId = null) : Object
    {
        try {
            $defaultResponse = $this->getDefaultResponse();
            if ( !$orderId ) throw new InvalidArgumentException('Missing required parameter orderId');
            if ( !$orderItemId ) throw new InvalidArgumentException('Missing required parameter orderItemId');
    
            $resourcePath = "orders/{$orderId}/items/{$orderItemId}.json";
            $response = $this->makeRequest(
                $resourcePath,
                'DELETE'
            );

            $defaultResponse->msg = 'Order Item deleted';  
            $defaultResponse->success = true;
            $defaultResponse->{'orderItem'} = new OrderItem($response);
        } catch (Exception $e) {
            $defaultResponse->msg = 'Error trying to delete Order Item';
            $defaultResponse->error = $e->getMessage();
        } finally {
            return $defaultResponse;
        }
    }
    
    public function fetchOrderItems(string $orderId = null) : Object
    {
        try {
            $defaultResponse = $this->getDefaultResponse();
            if ( !$orderId ) throw new InvalidArgumentException('Missing required parameter orderId');
    
            $resourcePath = "orders/{$orderId}/items.json";
            $response = $this->makeRequest(
                $resourcePath,
                'GET'
            );

            $orderItems = [];
            foreach ( $response['items'] as $item ) {
                $orderItems[] = new OrderItem($item);
            }

            $defaultResponse->msg = 'Order Items found';  
            $defaultResponse->success = true;
            $defaultResponse->{'orderItems'} = $orderItems;
        } catch (Exception $e) {
            $defaultResponse->msg = 'Error trying to fetch Order Items';
            $defaultResponse->error = $e->getMessage();
        } finally {
            return $defaultResponse;
        }
    }
}
