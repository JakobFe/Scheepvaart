<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/ShipBroker.php" );


class ShipBrokerMapper extends Mapper {

    function __construct() {
        parent::__construct();
        $this->selectStmt = "SELECT * FROM CUSTOMER where ssn = ?";
        $this->selectAllStmt = "SELECT * FROM SHIP_BROKER ";       
    } 
    
    function getCollection( array $raw ) {
        
        $customerCollection = array();
        foreach($raw as $row) {
            array_push($customerCollection, $this->doCreateObject($row));
        }
        
        return $customerCollection;
    }

    protected function doCreateObject( array $array ) {
        $obj = new \gb\domain\ShipBroker( $array['name'] );
        
        $obj->setName($array['name']);
        $obj->setNumber($array['number']);
        $obj->setStreet($array['street']);
        $obj->setBus($array['bus']);
        $obj->setPostalCode($array['postal_code']);
        $obj->setCity($array['city']);
        
        return $obj;
    }

    protected function doInsert( \gb\domain\DomainObject $object ) {

    }
    
    function update( \gb\domain\DomainObject $object ) {
       
    }

    function selectStmt() {
        return $this->selectStmt;
    }
    
    function selectAllStmt() {
        return $this->selectAllStmt;
    }
    
    function getShipBrokerRevenues() {
        
        $con = $this->getConnectionManager();
        $selectStmt = "SELECT name FROM SHIP_BROKER";
        $results = $con->executeSelectStatement($selectStmt, array());        
        return $results;
	}
		
	function getShipbrokerRoute($ShipBrokerName) {
        /* 
		De SELECT statement selecteerd eerst uit order the shipment_id, en gebruikt deze daarna
		om de route_id uit TRIP te halen. 
		*/
		
		require_once( "gb/mapper/OrderMapper.php");
        $con = $this->getConnectionManager();
        $selectStmt = "(SELECT route_id, departure_date, arrival_date FROM TRIP where ((ship_id = 
		(SELECT shipment_id FROM ORDER where ship_broker_name = ShipBrokerName))
		AND (arrival_date >= date('F', strtotime($date)) - 1)))";
        $results = $con->executeSelectStatement($selectStmt, array());        
        return $results;
        
    }
}

?>
