<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Order.php" );
require_once( "gb/connection/ConnectionManager.php" );


class OrderMapper extends Mapper {

    function __construct() {
        parent::__construct();
        $this->selectStmt = "SELECT * FROM shipment where shipment_id = ?";
        //$this->selectStmt = "SELECT * FROM CUSTOMER where ssn = ?";
        $this->selectAllStmt = "SELECT shipment_id, O.ssn, ship_broker_name,price,order_date,first_name,last_name FROM orders O, customer C WHERE O.ssn = C.ssn ";
        $this->insertStmt = "INSERT INTO orders VALUES (?,?,?,?,?)";
        
    } 
    
    function getCollection( array $raw ) {
        
        $customerCollection = array();
        foreach($raw as $row) {
            array_push($customerCollection, $this->doCreateObject($row));
        }
        
        return $customerCollection;
    }

    function doCreateObject( array $array ) {
        
        $obj = null;        
        if (count($array) > 0) {
            $obj = new \gb\domain\Order( $array['shipment_id'] );

            $obj->setShipmentID($array['shipment_id']);
            $obj->setSsn($array['ssn']);
            $obj->setShipBrokerName($array['ship_broker_name']);
            $obj->setPrice($array['price']);
            $obj->setOrderDate($array['order_date']);
            $obj->setNameBelongingToSsn($array['first_name'].' '.$array['last_name']);
        } 
        
        return $obj;
    }

    function doInsert( \gb\domain\DomainObject $object ) {
        $values = array( $object->getShipmentID(), $object->getSsn(), $object->getShipBrokerName(), $object->getPrice(),
            $object->getOrderDate());
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
