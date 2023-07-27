<?php

namespace Thiio\ShipOffers\Models;

use Thiio\ShipOffers\Models\Base;

class OrderItem extends Base
{
    public $id;
    public $sku;
    public $skuId;
    public $quantity;
    
    /**
     * Array of attributes where the key is the local name, and the value is the original name
     *
     * @var string[]
     */
    protected $attributeMap = [
        'id' => 'id',
        'sku' => 'sku',
        'skuId' => 'sku_id',
        'quantity' => 'quantity'
    ];

    /**
     * Array of attributes to setter functions
     *
     * @var string[]
     */
    protected $setters = [
        'id' => 'setId',
        'sku' => 'setSku',
        'skuId' => 'setSkuId',
        'quantity' => 'setQuantity'
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
     * Get the value of sku
     */ 
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set the value of sku
     *
     * @return  self
     */ 
    public function setSku(string $sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Get the value of skuId
     */ 
    public function getSkuId()
    {
        return $this->skuId;
    }

    /**
     * Set the value of skuId
     *
     * @return  self
     */ 
    public function setSkuId(string $skuId)
    {
        $this->skuId = $skuId;

        return $this;
    }

    /**
     * Get the value of quantity
     */ 
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */ 
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }
}