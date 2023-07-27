<?php

namespace Thiio\ShipOffers\Test;

use PHPUnit\Framework\TestCase;
use Thiio\ShipOffers\Handlers\OrderHandler;
use Thiio\ShipOffers\Handlers\OrderItemHandler;
use Thiio\ShipOffers\Models\Order;
use Thiio\ShipOffers\Models\OrderItem;

final class OrderItemTest extends TestCase
{
    private const USERNAME = '';
    private const PASSWORD = '';
    private const STORE_ID = '';

    private $order;
    private $orderHandler;
    private $orderItemHandler;

    /**
     * PHPunit setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->orderHandler = new OrderHandler(self::USERNAME, self::PASSWORD, self::STORE_ID);
        $this->orderItemHandler = new OrderItemHandler(self::USERNAME, self::PASSWORD, self::STORE_ID);

        $orderNumber = date("YmdHis") . rand(0, 100);
        $payload = [
            "order_number" => $orderNumber,
            "requested_shipping_service" => "UPS First Class",
            "ship_name" => "TEST William Adama",
            "address1" => "3534 Cole Prairie",
            "address2" => "Suite 703",
            "city" => "East Justine",
            "state" => "North Carolina",
            "postal_code" => "56957-3212",
            "country" => "US",
            "phone" => "1-514-133-0708",
            "email" => null
        ];

        $order = new Order($payload);
        $response = $this->orderHandler->createOrder($order);
        $this->assertEquals($orderNumber, $response->order->getOrderNumber());

        $this->order = $response->order;
    }

    /**
     * @test
     */
    public function itShouldBuildOrderItemHandler() : void
    {
        $this->assertInstanceOf(OrderItemHandler::class, $this->orderItemHandler);
    }

    /**
     * @test
     */
    public function itShouldCreateAnOrderItem() : void
    {
        $payload = [
            "sku" => "SKU123",
            "quantity" => 5
        ];

        $item = new OrderItem($payload);
        $responseCreateOrderItem = $this->orderItemHandler->createOrderItem($item, $this->order->getId());
        $this->assertNotNull($responseCreateOrderItem->orderItem->getId());
    }

    /**
     * @test
     */
    public function itShouldFetchAnOrderItem() : void
    {
        $payload = [
            "sku" => "SKU1234",
            "quantity" => 5
        ];

        $item = new OrderItem($payload);
        $responseCreateOrderItem = $this->orderItemHandler->createOrderItem($item, $this->order->getId());
        $this->assertNotNull($responseCreateOrderItem->orderItem->getId());

        $responseUpdateOrderItem = $this->orderItemHandler->fetchOrderItem($responseCreateOrderItem->orderItem->getId(), $this->order->getId());
        $this->assertNotNull($responseUpdateOrderItem->orderItem->getId());
    }

    /**
     * @test
     */
    public function itShouldUpdateAnOrderItem() : void
    {
        $payload = [
            "sku" => "SKU1234",
            "quantity" => 5
        ];

        echo "\nitShouldUpdateAnOrderItem\n";
        echo $this->order->getId() . "\n";

        $orderItem = new OrderItem($payload);
        $responseCreateOrderItem = $this->orderItemHandler->createOrderItem($orderItem, $this->order->getId());
        $this->assertNotNull($responseCreateOrderItem->orderItem->getId());

        $responseCreateOrderItem->orderItem->setQuantity(10);
        
        $responseUpdateOrderItem = $this->orderItemHandler->updateOrderItem($responseCreateOrderItem->orderItem, $this->order->getId());
        $this->assertNotNull($responseUpdateOrderItem->orderItem->getId());
        $this->assertEquals($responseCreateOrderItem->orderItem->getQuantity(), $responseUpdateOrderItem->orderItem->getQuantity());
    }

    /**
     * @test
     */
    public function itShouldDeleteAnOrderItem() : void
    {
        $payload = [
            "sku" => "SKU1234",
            "quantity" => 5
        ];

        echo "\nitShouldDeleteAnOrderItem\n";
        echo $this->order->getId() . "\n";

        $orderItem = new OrderItem($payload);
        $responseCreateOrderItem = $this->orderItemHandler->createOrderItem($orderItem, $this->order->getId());
        $this->assertNotNull($responseCreateOrderItem->orderItem->getId());

        $responseDeleteOrderItem = $this->orderItemHandler->deleteOrderItem($responseCreateOrderItem->orderItem->getId(), $this->order->getId());
        $this->assertNotNull($responseDeleteOrderItem->orderItem->getId());
    }

    /**
     * @test
     */
    public function itShouldFetchOrderItems() : void
    {
        $response = $this->orderItemHandler->fetchOrderItems($this->order->getId());
        $this->assertContainsOnlyInstancesOf(OrderItem::class, $response->orderItems);
    }
}