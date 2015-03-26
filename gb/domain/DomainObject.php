<?php
namespace gb\domain;

abstract class DomainObject {
    private $id = -1;

    function __construct( $id=null ) {
        if ( !is_null( $id ) ) {
            $this->id = $id;
        }
    }

    function getId( ) {
        return $this->id;
    }
 
    function collection() {
        return self::getCollection( get_class( $this ) );
    }

    function finder() {
        return self::getFinder( get_class( $this ) );
    }

    static function getFinder( $type=null ) {
        if ( is_null( $type ) ) {
            return HelperFactory::getFinder( get_called_class() ); 
        }
        return HelperFactory::getFinder( $type ); 
    }
 
    static function getCollection( $type=null ) {
        if ( is_null( $type ) ) {
            return HelperFactory::getCollection( get_called_class() ); 
        } 
        return HelperFactory::getCollection( $type ); 
    }
   
    static function findAll() {
        $finder = self::getFinder(); 
        return $finder->findAll();
    }

    static function find( $id ) {
        $finder = self::getFinder(); 
        return $finder->find( $id );
    }

    function setId( $id ) {
        $this->id = $id;
    }

    function __clone() {
        $this->id = -1;
    }
}
?>
