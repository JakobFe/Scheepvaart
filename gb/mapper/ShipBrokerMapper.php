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
	
	function getPorts($route_id){
	
	$con = $this->getConnectionManager();
	$selectStmt = "SELECT from_port_code, to_port_code FROM ROUTE where route_id = $route_id";
	$results = $con->executeSelectStatement($selectStmt, array());        
	return $results;
	}
		
	function getShipbrokerRevenue() {
     
    $con = $this->getConnectionManager();
    $selectStmt = "SELECT Ship_broker_name, Route_id, departure_date, SUM(price) 
	FROM ORDERS NATURAL JOIN SHIPS where departure_date >= cast((now() - interval 1 month) as date)
	GROUP BY Route_id, Ship_broker_name";
	$results = $con->executeSelectStatement($selectStmt, array());        
	return $results;
        
    }
}

?>
