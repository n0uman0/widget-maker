<?php

namespace WidgetMaker\Promotions;;

class BuyOneGetSecondHalfPrice implements IPromotion{
    
    public function apply( array $products ) : float {
        
        $discount = 0.00;

        $products = array_filter($products, function( $product ){
            return $product->getCode() === 'R01' ;
        });

        if( sizeof( $products ) > 1 ){
            $discount = reset($products)->getPrice() / 2;
        }

        return $discount;
        
    }

}