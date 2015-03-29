<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Order.php" );


class OrderMapper extends Mapper {

    function __construct() {
        parent::__construct();
        $this->selectStmt = "SELECT * FROM shipment where shipment_id = ?";
        //$this->selectStmt = "SELECT * FROM CUSTOMER where ssn = ?";
        $this->selectAllStmt = "SELECT * FROM orders ";        
    } 
    
    function getCollection( array $raw ) {
        
        $customerCollection = array();
        foreach($raw as $row) {
            array_push($customerCollection, $this->doCreateObject($row));
        }
        
        return $customerCollection;
    }

    protected function doCreateObject( array $array ) {
        
        $obj = null;        
        if (count($array) > 0) {
            $obj = new \gb\domain\Order( $array['shipment_id'] );

            $obj->setShipmentID($array['shipment_id']);
            $obj->setSsn($array['ssn']);
            $obj->setShipBrokerName($array['ship_broker_name']);
            $obj->setPrice($array['price']);
            $obj->setOrderDate($array['order_date']);
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
    
    // function getCustomersInCity ($city) {
        
    //     $con = $this->getConnectionManager();
    //     $selectStmt = "SELECT * FROM CUSTOMER where city = ?";
    //     $cities = $con->executeSelectStatement($selectStmt, array($city));        
    //     return $this->getCollection($cities);
    // }
}


?>
