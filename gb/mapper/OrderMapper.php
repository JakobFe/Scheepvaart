<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Order.php" );


class OrderMapper extends Mapper {

    function __construct() {
        parent::__construct();
        // SEQUEL queries to select the needed information 
        $this->selectStmt = "SELECT * FROM shipment where shipment_id = ?";
        $this->selectAllStmt = "SELECT shipment_id, O.ssn, ship_broker_name,price,order_date,first_name,last_name FROM orders O, customer C WHERE O.ssn = C.ssn ";    
        
    } 
    
    // after the query has been queried, put the obtained information in an array as an Order, 
    // to easily use it afterwards. 
    function getCollection( array $raw ) {
        
        $customerCollection = array();
        foreach($raw as $row) {
            array_push($customerCollection, $this->doCreateObject($row));
        }
        
        return $customerCollection;
    }

    // create a new Order and give it all the needed attributes. 
    protected function doCreateObject( array $array ) {
        
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

    protected function doInsert( \gb\domain\DomainObject $object ) {
        $values = array( $object->getName() );
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
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
