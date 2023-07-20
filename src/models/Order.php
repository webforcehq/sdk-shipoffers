<?php

namespace Thiio\ShipOffers\Models;

use Thiio\ShipOffers\Models\Base;

class Order extends Base
{
    public function __construct(array $data = null)
    {
        $this->data['id'] = isset($data['id']) ? $data['id'] : null;
        $this->data['status'] = isset($data['status']) ? $data['status'] : null;
        $this->data['order_number'] = isset($data['order_number']) ? $data['order_number'] : null;
        $this->data['requested_shipping_service'] = isset($data['requested_shipping_service']) ? $data['requested_shipping_service'] : null;
        $this->data['ship_name'] = isset($data['ship_name']) ? $data['ship_name'] : null;
        $this->data['address1'] = isset($data['address1']) ? $data['address1'] : null;
        $this->data['address2'] = isset($data['address2']) ? $data['address2'] : null;
        $this->data['city'] = isset($data['city']) ? $data['city'] : null;
        $this->data['state'] = isset($data['state']) ? $data['state'] : null;
        $this->data['postal_code'] = isset($data['postal_code']) ? $data['postal_code'] : null;
        $this->data['country'] = isset($data['country']) ? $data['country'] : null;
        $this->data['phone'] = isset($data['phone']) ? $data['phone'] : null;
        $this->data['email'] = isset($data['email']) ? $data['email'] : null;
        $this->data['order_date'] = isset($data['order_date']) ? $data['order_date'] : null;
        $this->data['items'] = isset($data['items']) ? $data['items'] : null;
    }

    /**
     * Get the value of orderNumber
     */ 
    public function getOrderNumber()
    {
        return $this->data['order_number'];
    }

    /**
     * Set the value of orderNumber
     *
     * @return  self
     */ 
    public function setOrderNumber(int $orderNumber)
    {
        $this->data['order_number'] = $orderNumber;

        return $this;
    }

    /**
     * Get the value of requestedShippingService
     */ 
    public function getRequestedShippingService()
    {
        return $this->data['requested_shipping_service'];
    }

    /**
     * Set the value of requestedShippingService
     *
     * @return  self
     */ 
    public function setRequestedShippingService($requestedShippingService)
    {
        $this->data['requested_shipping_service'] = $requestedShippingService;

        return $this;
    }

    /**
     * Get the value of shipName
     */ 
    public function getShipName()
    {
        return $this->data['ship_name'];
    }

    /**
     * Set the value of shipName
     *
     * @return  self
     */ 
    public function setShipName(string $shipName)
    {
        $this->data['ship_name'] = $shipName;

        return $this;
    }

    /**
     * Get the value of address1
     */ 
    public function getAddress1()
    {
        return $this->data['address1'];
    }

    /**
     * Set the value of address1
     *
     * @return  self
     */ 
    public function setAddress1(string $address1)
    {
        $this->data['address1'] = $address1;

        return $this;
    }

    /**
     * Get the value of address2
     */ 
    public function getAddress2()
    {
        return $this->data['address2'];
    }

    /**
     * Set the value of address2
     *
     * @return  self
     */ 
    public function setAddress2(string $address2)
    {
        $this->data['address2'] = $address2;

        return $this;
    }

    /**
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->data['city'];
    }

    /**
     * Set the value of city
     *
     * @return  self
     */ 
    public function setCity(string $city)
    {
        $this->data['city'] = $city;

        return $this;
    }

    /**
     * Get the value of state
     */ 
    public function getState()
    {
        return $this->data['state'];
    }

    /**
     * Set the value of state
     *
     * @return  self
     */ 
    public function setState(string $state)
    {
        $this->data['state'] = $state;

        return $this;
    }

    /**
     * Get the value of postalCode
     */ 
    public function getPostalCode()
    {
        return $this->data['postal_code'];
    }

    /**
     * Set the value of postalCode
     *
     * @return  self
     */ 
    public function setPostalCode(string $postalCode)
    {
        $this->data['postal_code'] = $postalCode;

        return $this;
    }

    /**
     * Get the value of country
     */ 
    public function getCountry()
    {
        return $this->data['country'];
    }

    /**
     * Set the value of country
     *
     * @return  self
     */ 
    public function setCountry(string $country)
    {
        $this->data['country'] = $country;

        return $this;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->data['phone'];
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */ 
    public function setPhone(string $phone)
    {
        $this->data['phone'] = $phone;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->data['email'];
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->data['email'] = $email;

        return $this;
    }

    /**
     * Get the value of orderDate
     */ 
    public function getOrderDate()
    {
        return $this->data['order_date'];
    }

    /**
     * Set the value of orderDate
     *
     * @return  self
     */ 
    public function setOrderDate(string $orderDate)
    {
        $this->data['order_date'] = $orderDate;

        return $this;
    }

    /**
     * Get the value of items
     */ 
    public function getItems()
    {
        return $this->data['items'];
    }

    /**
     * Set the value of items
     *
     * @return  self
     */ 
    public function setItems(array $items)
    {
        $this->data['items'] = $items;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->data['id'];
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(string $id)
    {
        $this->data['id'] = $id;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->data['status'];
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus(string $status)
    {
        $this->data['status'] = $status;

        return $this;
    }
}