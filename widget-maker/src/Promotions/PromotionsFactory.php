<?php

namespace WidgetMaker\Promotions;

class PromotionsFactory{
    
    public function get( string $slug ) : IPromotion  {

		$class = $this->createProviderClassName( $slug );

		if( !$this->isValidClass( $class ) ){
			throw new \Exception('No promotion class found with the name ' . $slug);
		}

		return new $class();

	}

	private function createProviderClassName( string $slug )
    {
        return __NAMESPACE__ . '\\' . 
            str_replace(' ', '', ucwords(str_replace(['_', '-'], ' ', $slug))
			);
    }

	private function isValidClass( $class ){
		return class_exists( $class );
	}
    
}