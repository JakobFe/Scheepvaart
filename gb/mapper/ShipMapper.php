<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Ship.php" );


class ShipMapper extends Mapper {

    function __construct() {
        parent::__construct();
        $this->selectStmt = "SELECT * FROM CUSTOMER where ssn = ?";
        $this->selectAllStmt = "SELECT * FROM SHIP ";
        $this->selectIDStmt = "SELECT ship_id FROM SHIP"; 
        $this->updateShipStmt = "UPDATE SHIP SET ship_id = ? , ship_name = ?, type = ? where ship_id = ? ";
        
    } 
    
    function getCollection( array $raw ) {
        
        $shipCollection = array();
        foreach($raw as $row) {
            array_push($shipCollection, $this->doCreateObject($row));
        }
        
        return $shipCollection;
    }

    // a function to get the ID's of each ship in a usable way
    function getCollectionID( array $raw){
        $IDCollection = array();
        foreach ($raw as $row ) {
            array_push($IDCollection, $row['ship_id']);
        }

        return $IDCollection; 
    }

    // a function to create a new Ship object
    protected function doCreateObject( array $array ) {
        $obj = new \gb\domain\Ship( $array['ship_id'] );
        
        $obj->setShipId($array['ship_id']);
        $obj->setShipName($array['ship_name']);
        $obj->setType($array['type']);
        
        return $obj;
    }

    protected function doInsert( \gb\domain\DomainObject $object ) {
        
    }
    
    function update( \gb\domain\DomainObject $object ) {
        
    }
    
    // a function to update a ship to its new ID, name and type
    function updateShip($previousID, $newID, $newShipName, $newType){
        self::$con->executeUpdateStatement($this->updateShipStmt(),array($newID,$newShipName,$newType, $previousID)); 
    }


    function selectStmt() {
        return $this->selectStmt;
    }
    
    function selectAllStmt() {
        return $this->selectAllStmt;
    }


    function updateShipStmt(){
        return $this->updateShipStmt;
    }

    
    
    
}


?>
