<?php

namespace WebforceHQ\ShipOffers\Models;

use WebforceHQ\ShipOffers\Models\Base;

class Shipment extends Base
{
    public $id;
    public $orderNumber;
    public $trackingNumber;
    public $shipName;
    public $address1;
    public $address2;
    public $city;
    public $state;
    public $postalCode;
    public $country;
    public $status;
    public $carrierCode;
    public $serviceCode;
    public $shipDate;
    public $orders;

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     *
     * @var string[]
     */
    protected $attributeMap = [
        'id' => 'id',
        'orderNumber' => 'order_number',
        'trackingNumber' => 'tracking_number',
        'shipName' => 'ship_name',
        'address1' => 'address1',
        'address2' => 'address2',
        'city' => 'city',
        'state' => 'state',
        'postalCode' => 'postal_code',
        'country' => 'country',
        'status' => 'status',
        'carrierCode' => 'carrier_code',
        'serviceCode' => 'service_code',
        'shipDate' => 'ship_date',
        'orders' => 'orders'
    ];

    /**
     * Array of attributes to setter functions
     *
     * @var string[]
     */
    protected $setters = [
        'id' => 'setId',
        'order_number' => 'setOrderNumber',
        'tracking_number' => 'setTrackingNumber',
        'ship_name' => 'setShipName',
        'address1' => 'setAddress1',
        'address2' => 'setAddress2',
        'city' => 'setCity',
        'state' => 'setState',
        'postal_code' => 'setPostalCode',
        'country' => 'setCountry',
        'status' => 'setStatus',
        'carrier_code' => 'setCarrierCode',
        'service_code' => 'setServiceCode',
        'ship_date' => 'setShipDate',
        'orders' => 'setOrders'
    ];

    public function __construct(array $data = [])
    {
        $this->setAttributes($data);
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of orderNumber
     */ 
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * Set the value of orderNumber
     *
     * @return  self
     */ 
    public function setOrderNumber(string $orderNumber)
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * Get the value of trackingNumber
     */ 
    public function getTrackingNumber()
    {
        return $this->trackingNumber;
    }

    /**
     * Set the value of trackingNumber
     *
     * @return  self
     */ 
    public function setTrackingNumber(string $trackingNumber)
    {
        $this->trackingNumber = $trackingNumber;

        return $this;
    }

    /**
     * Get the value of shipName
     */ 
    public function getShipName()
    {
        return $this->shipName;
    }

    /**
     * Set the value of shipName
     *
     * @return  self
     */ 
    public function setShipName(string $shipName)
    {
        $this->shipName = $shipName;

        return $this;
    }

    /**
     * Get the value of address1
     */ 
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set the value of address1
     *
     * @return  self
     */ 
    public function setAddress1(string $address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * Get the value of address2
     */ 
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set the value of address2
     *
     * @return  self
     */ 
    public function setAddress2(string $address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */ 
    public function setCity(string $city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of state
     */ 
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @return  self
     */ 
    public function setState(string $state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get the value of postalCode
     */ 
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set the value of postalCode
     *
     * @return  self
     */ 
    public function setPostalCode(string $postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get the value of country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */ 
    public function setCountry(string $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus(string $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of carrierCode
     */ 
    public function getCarrierCode()
    {
        return $this->carrierCode;
    }

    /**
     * Set the value of carrierCode
     *
     * @return  self
     */ 
    public function setCarrierCode(string $carrierCode)
    {
        $this->carrierCode = $carrierCode;

        return $this;
    }

    /**
     * Get the value of serviceCode
     */ 
    public function getServiceCode()
    {
        return $this->serviceCode;
    }

    /**
     * Set the value of serviceCode
     *
     * @return  self
     */ 
    public function setServiceCode(string $serviceCode)
    {
        $this->serviceCode = $serviceCode;

        return $this;
    }

    /**
     * Get the value of shipDate
     */ 
    public function getShipDate()
    {
        return $this->shipDate;
    }

    /**
     * Set the value of shipDate
     *
     * @return  self
     */ 
    public function setShipDate(string $shipDate)
    {
        $this->shipDate = $shipDate;

        return $this;
    }

    /**
     * Get the value of orders
     */ 
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * Set the value of orders
     *
     * @return  self
     */ 
    public function setOrders(array $orders = [])
    {
        $this->orders = $orders;

        return $this;
    }
}