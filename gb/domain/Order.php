<?php
namespace gb\domain;

require_once( "gb/domain/DomainObject.php" );

class Order extends DomainObject {    
      
    // the different attributes of an Order 
    private $ShipmentID;
    private $ship_broker_name;
    private $price;
    private $order_date;

    // attributes of the person who ordered the order
    private $ssn;
    private $nameBelongingToSsn;


    function __construct( $id=null ) {
        parent::__construct( $id );
    }
    
    
    // below, basic getters and setters of the attributes defined above are implemented. 

    function setShipmentID($ShipmentID ) {
        $this->ShipmentID = $ShipmentID;
    }
    
    function getShipmentID() {
        return $this->ShipmentID;
    }
    
    function setSsn($ssn) {
        $this->ssn = $ssn;
    }
    
    function getSsn() {
        return $this->ssn;
    }
    
    
    
    function setShipBrokerName ($ship_broker_name) {
        $this->ship_broker_name = $ship_broker_name;
    }
    function getShipBrokerName() {
        return $this->ship_broker_name;
    }

    function setPrice($price) {
        $this->price = $price;
    }
    
    function getPrice() {
        return $this->price;
    }
    
    
    
    function setOrderDate ($order_date) {
        $this->order_date = $order_date;
    }
    function getOrderDate() {
        return $this->order_date;
    }

    function setNameBelongingToSsn($nameBelongingToSsn){
        $this->nameBelongingToSsn = $nameBelongingToSsn; 
    }

    function getNameBelongingToSsn(){
        return $this->nameBelongingToSsn; 
    }
    
    

}

?>
