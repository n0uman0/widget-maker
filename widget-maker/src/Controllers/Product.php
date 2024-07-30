<?php 

namespace WidgetMaker\Controllers;
use WidgetMaker\Repositories\ProductRepository;

class Product extends Controller{ 

    private $productRepository;
    public function __construct( ProductRepository $productRepository ) { 
        $this->productRepository = $productRepository;
    }

    public function getAll(){ 

        try{

            $data = $this->productRepository->findAll();

            if( empty($data) ){
                throw new \Exception('No products found', 404);
            }

            $data = array_map( function( $product ) {
                return $product->toArray();
            }, $data );

            return $this->jsonResponse(200, true, $data, 'Products found');

        }
        catch( \Exception $e ){

            return $this->jsonResponse($e->getCode() || 401, false, [], $e->getMessage());
       
        }
    }

    public function get( array $data ) { 

        $id = $data['id'];
       //$products = file_get_contents('./data/products.json');
       print_r( $this->productRepository->findByCode( $id ) );
       die("SA");

    }

    public function show() { 

        echo 'Products show';

    }

}