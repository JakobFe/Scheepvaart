<?php
namespace gb\domain;

require_once( "gb/domain/DomainObject.php" );

class Shipment extends DomainObject {    
      
    // attributes of a shipment
    private $ShipmentID;
    private $Volume;
    private $Weight;


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
    
    function setVolume($Volume) {
        $this->Volume = $Volume;
    }
    
    function getVolume() {
        return $this->Volume;
    }
    
    
    
    function setWeight ($Weight) {
        $this->Weight = $Weight;
    }
    function getWeight() {
        return $this->Weight;
    }
    
    

}

?>
