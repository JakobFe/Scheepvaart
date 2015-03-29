<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Shipment.php" );
require_once( "gb/connection/ConnectionManager.php" );


class ShipmentMapper extends Mapper {

    function __construct() {
        parent::__construct();
        // SEQUEL queries to select the needed information 
        $this->selectStmt = "SELECT * FROM shipment where shipment_id = ?";
        $this->selectAllStmt = "SELECT * FROM shipment ";
        $this->insertStmt = "INSERT INTO shipment VALUES (?,?,?)";
    }

    // after the query has been queried, put the obtained information in an array as a Shipment, 
    // to easily use it afterwards. 
    function getCollection( array $raw ) {

        $customerCollection = array();
        foreach($raw as $row) {
            array_push($customerCollection, $this->doCreateObject($row));
        }

        return $customerCollection;
    }

    // create a new Shipment and give it all the needed attributes.
    function doCreateObject( array $array ) {
        $obj = null;
        if (count($array) > 0) {
            $obj = new \gb\domain\Shipment( $array['shipment_id'] );

            $obj->setShipmentID($array['shipment_id']);
            $obj->setVolume($array['volume']);
            $obj->setWeight($array['weight']);
        }

        return $obj;
    }

    function doInsert( \gb\domain\DomainObject $object )
    {
        $values = array( $object->getShipmentID(), $object->getVolume(), $object->getWeight() );
        $con = new \gb\connection\ConnectionManager();
        $con->executeUpdateStatement($this->insertStmt,$values);
    }

    function update( \gb\domain\DomainObject $object ) {
        //$values = array( $object->getName(), $object->getId(), $object->getId() );
        //$this->updateStmt->execute( $values );
    }

    function selectStmt() {
        return $this->selectStmt;
    }

    function selectAllStmt() {
        return $this->selectAllStmt;
    }

   
}


?>