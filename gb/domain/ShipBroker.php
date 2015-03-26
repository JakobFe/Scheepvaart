<?php
namespace gb\domain;

require_once( "gb/domain/DomainObject.php" );

class ShipBroker extends DomainObject {    
      
    private $name;
    private $street;
    private $number;
    private $bus;
    private $postal_code;
    private $city;

    function __construct( $id=null ) {
        //$this->name = $name;
        parent::__construct( $id );
    }
        
    function setName ( $name ) {
        $this->name = $name;        
    }
    
    function getName () {
        return $this->name;
    }
    
    
    function setStreet ($street) {
        $this->street = $street;
    }
    
    function getStreet () {
        return $this->street;
    }
    
    function setNumber ($number) {
        $this->number = $number;
    }
    function getNumber() {
        return $this->number;
    }
    
    function setBus ($bus) {
        $this->bus = $bus;
    }
    
    function getBus () {
        return $this->bus;
    }
    
    function setPostalCode ($postal_code) {
        $this->postal_code = $postal_code;
    }
    
    function getPostalCode () {
        return $this->postal_code;
    }
    
    function setCity ($city) {
        $this->city = $city;
    }
    
    function getCity () {
        return $this->city;
    }

}

?>
