<?php

namespace WidgetMaker\Repositories;
use WidgetMaker\Entities\AbstractEntity;

abstract class AbstractRepository {

    const TABLE_NAME = '';
	protected $table_name;

    public function findById( $id = 0 ) : AbstractEntity | null {

		if ( ! $id ) {
			return null;
		}

        $result = array_filter(
            $this->getData(),
            function( $entity ) use ( $id ) {
                return $entity['id'] == $id;
            }
        );

		$entity = $this->mapDataToEntity( reset($result) );

		return $entity;
	}

    public function findAll( $args = [] ) : array {

        return $this->mapBulkDataToEntities( $this->getData() );

    }

    public function mapBulkDataToEntities( array $data ) : array {

       return array_map( function( $entity ) {
            return $this->mapDataToEntity( $entity );
        }, $data );

    }

	abstract public function mapDataToEntity( array $data ) : AbstractEntity | null;

    public function getData() : array {
        
        $file_path = "./data/" . static::TABLE_NAME . ".json";
        $data = file_get_contents($file_path);
        
        if( empty($data) ){
            return [];
        }

        return json_decode($data, true);

    }

}