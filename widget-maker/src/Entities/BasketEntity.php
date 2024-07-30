<?php

namespace WidgetMaker\Entities;

class BasketEntity extends AbstractEntity{

    protected array $products = [];
    protected float $total = 0.0;
    protected float $delivery_charges = 0.0;
    protected string $promotion = '';
    protected string $currency = '$';

    public function setTotal( float $total){
        $this->total = $total;
    }

    public function getTotal() : float{
        return $this->total;
    }

    public function getProducts() : array {
        return $this->products;
    }

    public function getProductIds() : array {
        return array_map( function( $product ){
            return $product->getId();
        }, $this->products );
    }

    public function addProduct( ProductEntity $product ){
        $this->products[] = $product;
    }

    public function setPromotion( string $promotion ){
        $this->promotion = $promotion;
    }

    public function getPromotion() : string {
        return $this->promotion;
    }

    public function getDeliveryCharges() : float {
        return $this->delivery_charges;
    }

    public function setDeliveryCharges( float $delivery_charges ){
        $this->delivery_charges = $delivery_charges;
    }

    public function setCurrency( string $currency ){
        $this->currency = $currency;
    }

    public function getCurrency() : string {
        return $this->currency;
    }

}