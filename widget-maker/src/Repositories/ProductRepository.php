<?php 

namespace WidgetMaker\Repositories;
use WidgetMaker\Entities\AbstractEntity;
use WidgetMaker\Entities\ProductEntity;

class ProductRepository extends AbstractRepository { 

    const TABLE_NAME = 'products';

    public function mapDataToEntity( array $data ) : AbstractEntity | null { 
       
        if( empty($data) || empty($data['code']) ){
            return null;
        }

        return new ProductEntity( $data['code'] , $data );

    }

    public function findByCode( $code ) : AbstractEntity | null { 

        $result = array_filter(
            $this->getData(),
            function( $entity ) use ( $code ) {
                return $entity['code'] == $code;
            }
        );

        if( empty($result) ){
            return null;
        }

        return $this->mapDataToEntity( reset($result) );

    }
    
    public function findByCodes( array $codes ) : array {

        $entities = [];
        
        // this can be better like i fetch all the records in single query but for now this is fine
        foreach( $codes as $code ){

            $enitity = $this->findByCode( $code );
            
            if( empty($enitity) ){
                continue;
            }
            
            $entities[] = $enitity;
        }

        return $entities;

    }

}