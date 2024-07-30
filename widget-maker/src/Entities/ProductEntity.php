<?php

namespace WidgetMaker\Entities;

class ProductEntity extends AbstractEntity{

    protected string $code;
    protected string $name;
    protected float $price;
    
    public function setCode( $code ){
        $this->code = $code;
    }

    public function getCode() : string {
        return $this->code;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getName() : string {
        return $this->name;
    }

    public function setPrice($price){
        $this->price = $price;
    }

    public function getPrice() : float{
        return $this->price;
    }


}