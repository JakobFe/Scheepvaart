<?php
namespace gb\domain;

require_once( "gb/domain/DomainObject.php" );

class Ship extends DomainObject {    
      
    private $ship_id;
    private $ship_name;
    private $type;    

    function __construct( $id=null ) {
        //$this->name = $name;
        parent::__construct( $id );
    }
        
    function setShipId ( $ship_id ) {
        $this->ship_id = $ship_id;        
    }
    
    function getShipId () {
        return $this->ship_id;
    }
    
    function setShipName ($ship_name) {
        $this->ship_name = $ship_name;
    }
    
    function getShipName() {
        return $this->ship_name;
    }
    
    function setType ($type) {
        $this->type = $type;
    }
    
    function getType () {
        return $this->type;
    }
}

?>
