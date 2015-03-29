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
        $this->updateIDStmt = "UPDATE SHIP SET ship_id = ? where ship_id = ? ";
        $this->updateNameStmt = "UPDATE SHIP SET ship_name = ? where ship_id=?";
        $this->updateTypeStmt = "UPDATE SHIP SET type = ? WHERE ship_id = ?";
        
    } 
    
    function getCollection( array $raw ) {
        
        $customerCollection = array();
        foreach($raw as $row) {
            array_push($customerCollection, $this->doCreateObject($row));
        }
        
        return $customerCollection;
    }

    function getCollectionID( array $raw){
        $IDCollection = array();
        foreach ($raw as $row ) {
            array_push($IDCollection, $row['ship_id']);
        }

        return $IDCollection; 
    }

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
    function updateShip($previousID, $newID, $newShipName, $newType){
        $this->updateID($previousID,$newID);
        $this->updateName($newShipName,$previousID);
        $this->updateType($newType,$previousID);
    }

    function updateID($previousID, $newID){
        self::$con->executeUpdateStatement($this->updateIDStmt(),array($newID, $previousID)); 
    }

    function updateName($newShipName, $previousID){
        self::$con->executeUpdateStatement($this->updateNameStmt(),array($newShipName, $previousID)); 
    }

    function updateType($newType, $previousID){
        self::$con->executeUpdateStatement($this->updateTypeStmt(),array($newType, $previousID)); 
    }

    function selectStmt() {
        return $this->selectStmt;
    }
    
    function selectAllStmt() {
        return $this->selectAllStmt;
    }

    function selectIDStmt(){
        return $this->selectIDStmt; 
    }

    function updateIDStmt(){
        return $this->updateIDStmt;
    }

    function updateNameStmt(){
        return $this->updateNameStmt;
    }

    function updateTypeStmt(){
        return $this->updateTypeStmt;
    }
    
    
}


?>
