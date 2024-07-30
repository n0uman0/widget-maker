<?php 

namespace WidgetMaker\Controllers;

use WidgetMaker\Actions\BasketAction;
use WidgetMaker\Entities\BasketEntity;
use WidgetMaker\Repositories\ProductRepository;

class Basket extends Controller{ 

    private ProductRepository $product_repository;
    private BasketEntity $basket_entity;
    
    public function __construct( ProductRepository $product_repository ) { 
        $this->product_repository = $product_repository;
    }

    public function process() { 

        $request = json_decode(file_get_contents('php://input'), true);
        
        try{

            if( empty($request['product_codes']) ){
                throw new \Exception('Invalid Input', 401);
            }

            $products = $this->product_repository->findByCodes( $request['product_codes'] );
            
            if( empty($products) ){
                throw new \Exception('No products found', 404);
            }

            $offer = !empty($request['offer']) ? $request['offer'] : '';

            $basket_action = new BasketAction( $products, $offer );
            $this->basket_entity = $basket_action->process();

            $response = [
                'products' => $this->basket_entity->getProductIds(),
                'total' => (float) number_format($this->basket_entity->getTotal(), 2),
                'promotion' => $this->basket_entity->getPromotion(),
                'delivery_charges' => $this->basket_entity->getDeliveryCharges(),
                'currency' => $this->basket_entity->getCurrency(),
            ];

            return $this->jsonResponse( 200, true, $response, 'success');

        }catch( \Exception $e ){

            return $this->jsonResponse($e->getCode() || 401, false, [], $e->getMessage());
       
        }

    }
   

}