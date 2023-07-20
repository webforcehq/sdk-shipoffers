<?php

namespace Thiio\ShipOffers\models;

class Item
{
    protected $id;
    protected $sku;
    protected $skuId;
    protected $quantity;
    
    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $data = [];

    public function __construct()
    {
        $this->data['id'] = isset($data['id']) ? $data['id'] : null;
        $this->data['sku'] = isset($data['sku']) ? $data['sku'] : null;
        $this->data['sku_id'] = isset($data['sku_id']) ? $data['sku_id'] : null;
        $this->data['quantity'] = isset($data['quantity']) ? $data['quantity'] : null;
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
     * Get the value of sku
     */ 
    public function getSku()
    {
        return $this->data['sku'];
    }

    /**
     * Set the value of sku
     *
     * @return  self
     */ 
    public function setSku(string $sku)
    {
        $this->data['sku'] = $sku;

        return $this;
    }

    /**
     * Get the value of skuId
     */ 
    public function getSkuId()
    {
        return $this->data['sku_id'];
    }

    /**
     * Set the value of skuId
     *
     * @return  self
     */ 
    public function setSkuId(int $skuId)
    {
        $this->data['sku_id'] = $skuId;

        return $this;
    }

    /**
     * Get the value of quantity
     */ 
    public function getQuantity()
    {
        return $this->data['quantity'];
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */ 
    public function setQuantity(int $quantity)
    {
        $this->data['quantity'] = $quantity;

        return $this;
    }
}