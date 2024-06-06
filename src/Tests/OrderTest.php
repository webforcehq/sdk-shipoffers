<?php

namespace WebforceHQ\ShipOffers\Test;

use PHPUnit\Framework\TestCase;
use WebforceHQ\ShipOffers\Handlers\OrderHandler;
use WebforceHQ\ShipOffers\Models\Order;

final class OrderTest extends TestCase
{
    private const USERNAME = '';
    private const PASSWORD = '';
    private const STORE_ID = '';

    private $orderHandler;

    /**
     * PHPunit setUp method
     *
     * @return void
     */
    //vendor/bin/phpunit src/tests/OrderTest.php
    protected function setUp(): void
    {
        $this->orderHandler = new OrderHandler(self::USERNAME, self::PASSWORD, self::STORE_ID);
    }

    /**
     * @test
     */
    public function itShouldBuildOrderHandler() : void
    {
        $this->assertInstanceOf(OrderHandler::class, $this->orderHandler);
    }

    /**
     * @test
     */
    public function itShouldThrowAnErrorIfOrderIdIsNotSet() : void
    {
        $response = $this->orderHandler->fetchOrder();
        $this->assertEquals('Missing required parameter Order Id', $response->error);
    }

    /**
     * @test
     */
    public function itShouldFetchAnOrder() : void
    {
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
        $responseCreateOrder = $this->orderHandler->createOrder($order);
        $this->assertEquals($orderNumber, $responseCreateOrder->order->getOrderNumber());

        $responseFetchOrder = $this->orderHandler->fetchOrder($responseCreateOrder->order->getId());
        $this->assertEquals($responseCreateOrder->order->getId(), $responseFetchOrder->order->getId());
    }

    /**
     * @test
     */
    public function itShouldFetchOrders() : void
    {
        $response = $this->orderHandler->fetchOrders();
        $this->assertContainsOnlyInstancesOf(Order::class, $response->orders);
    }

    /**
     * @test
     */
    public function itShouldCreateAnOrder() : void
    {
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
    }

    /**
     * @test
     */
    public function itShouldUpdateAnOrder() : void
    {
        $orderNumber = date("YmdHis") . rand(0, 100);
        $createPayload = [
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

        
        $orderCreate = new Order($createPayload);
        $responseCreateOrder = $this->orderHandler->createOrder($orderCreate);
        $this->assertEquals($orderNumber, $responseCreateOrder->order->getOrderNumber());
        
        $updatePayload = [
            "id" => $responseCreateOrder->order->getId(),
            "ship_name" => "TEST William Adama UPDATED"
        ];

        $orderUpdate = new Order($updatePayload);
        $responseUpdateOrder = $this->orderHandler->updateOrder($orderUpdate);
        $this->assertEquals($responseCreateOrder->order->getId(), $responseUpdateOrder->order->getId());
    }

    /**
     * @test
     */
    public function itShouldDeleteAnOrder() : void
    {
        $orderNumber = date("YmdHis") . rand(0, 100);
        $createPayload = [
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

        
        $orderCreate         = new Order($createPayload);
        $responseCreateOrder = $this->orderHandler->createOrder($orderCreate);
        $this->assertEquals($orderNumber, $responseCreateOrder->order->getOrderNumber());

        $responseDeleteOrder = $this->orderHandler->deleteOrder($responseCreateOrder->order->getId(),$responseCreateOrder->order->getOrderNumber());
        $this->assertEquals($responseDeleteOrder->code, 200);
        $this->assertEquals($responseDeleteOrder->success, true);
    }

    /**
     * @test
     */
    public function itShouldThrowErrorWhenOrderNumberIsTaken() : void
    {
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
        $responseCreateOrder1 = $this->orderHandler->createOrder($order);
        $this->assertEquals($orderNumber, $responseCreateOrder1->order->getOrderNumber());

        $responseCreateOrder2 = $this->orderHandler->createOrder($order);
        $this->assertStringContainsString('Order number has already been taken', $responseCreateOrder2->error);
    }
}
