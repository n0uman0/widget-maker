<?php

namespace WidgetMaker\Actions;

use WidgetMaker\Entities\BasketEntity;
use WidgetMaker\Promotions\PromotionsFactory;

class BasketAction{

    protected array $products;    
    protected string $promotion;
    protected BasketEntity $basket;
    protected float $total = 0.00;

    public function __construct( array $products, string $promotion = '' ){
        $this->products = $products;
        $this->promotion = $promotion;
    }

    public function process() : BasketEntity {

        $this->basket = new BasketEntity( time(), []);

        foreach( $this->products as $product ){
            
            $this->basket->addProduct( $product );
            $this->total += $product->getPrice();

        }

        if( !empty( $this->promotion ) ){
            
            try{

                $promotion_factory = new PromotionsFactory();
                $promotion_discount = $promotion_factory->get( $this->promotion )->apply( $this->products );
                $this->total -= $promotion_discount;
                $this->basket->setPromotion( $this->promotion );

            }catch( \Exception $e ){
                error_log( $e->getMessage() );
            }

        }

        $delivery_charges = $this->getDeliveryCharges( $this->total );

        $this->total += $delivery_charges;
        $this->basket->setDeliveryCharges( $delivery_charges );
        $this->basket->setTotal( $this->total );

        return $this->basket;

    }

    protected function getDeliveryCharges( float $total ) : float {
        
        $delivery_charges = [
            50 => 4.95,
            90 => 2.95,
        ];

        foreach ($delivery_charges as $limit => $charge) {
            if ($total < $limit) {
                return $charge;
            }
        }

        return 0.00;
    }

}