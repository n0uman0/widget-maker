<?php 

namespace WidgetMaker\Promotions;
interface IPromotion{
    
    public function apply( array $products );
    
}