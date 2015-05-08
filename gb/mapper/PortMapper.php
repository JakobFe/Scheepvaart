<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Port.php" );


class PortMapper extends Mapper {

    function __construct() {
        parent::__construct();

        $this->selectStmt = "SELECT * FROM CUSTOMER where ssn = ?";
        $this->selectAllStmt = "SELECT * FROM SHIP ";
        $this->selectIDStmt = "SELECT ship_id FROM SHIP"; 
        $this->updateShipStmt = "UPDATE SHIP SET ship_id = ? , ship_name = ?, type = ? where ship_id = ? ";
        $this->selectPortStmt = "SELECT port_name FROM Port  WHERE country_id = ?";      
        $this->selectAllStmt = "SELECT * FROM PORT";
        $this->selectCountryStmt = "SELECT country_id FROM Port GROUP BY country_id";
    }
    
    function getCollection( array $raw ) {
        
        $portCollection = array();
        foreach($raw as $row) {
            array_push($portCollection, $this->doCreateObject($row));
        }
        
        return $portCollection;
    }

    // a function to create a new Ship object
    protected function doCreateObject( array $array ) {
        $obj = new \gb\domain\Port( $array['port_code'] );
        
        $obj->setPortCode($array['port_code']);
        $obj->setPortName($array['port_name']);
        $obj->setTax($array['tax']);
        $obj->setLongitude($array['longitude']);
        $obj->setLatitude($array['latilude']);
        $obj->setTimeZone($array['time_zone']);
        $obj->setDstZone($array['dst_zone']);
        $obj->setCountryId($array['country_id']);


        return $obj;
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

    function selectPortStmt() {
        return $this->selectPortStmt; 
    }

    function selectCountryStmt(){
        return $this->selectCountryStmt;
    }


    protected function doInsert( \gb\domain\DomainObject $object ) {
        // laten staan want dit is een abstracte functie in mapper
    }
    
    function update( \gb\domain\DomainObject $object ) {
        /// laten staan want dit is een abstracte functie in mapper
    }
    
    function findAllPortsInCountry($country){
        $ports = self::$con->executeSelectStatement($this->selectPortStmt(),array($country));
        //return serialize($customers); 
        return $this->getCollectionPort($ports); 

    }

    function findAllCountries(){
        $ports = self::$con->executeSelectStatement($this->selectCountryStmt(),array());
        return $this->getCollectionCountry($ports); 
    }



    function getCollectionCountry( array $raw) {
        $customerCollection = array();
        foreach($raw as $row) {
            array_push($customerCollection,  $row['country_id']);
        }
        
        return $customerCollection;
    }
    function getCollectionPort( array $raw) {
        $customerCollection = array();
        foreach($raw as $row) {
            array_push($customerCollection,  $row['port_name']);
        }
        
        return $customerCollection;
    }
	
	function getRoute_From_Port($Start_port, $start_port_country){
		$con = $this->getConnectionManager();      
		$selectStmt = "SELECT route_id, port_name FROM PORT INNER JOIN (
		SELECT route_id, to_port_code from ROUTE
		where from_port_code = (SELECT port_code FROM PORT 
		where port_name = ? and country_id = ?))
        as routes
		ON routes.'to_port_code' = port.'port_code' ";
		$results = $con->executeSelectStatement($selectStmt, array($Start_port, $start_port_country));        
		return $results;
	}
	
		function getRoute_to_Port($End_port, $end_port_country){
		$con = $this->getConnectionManager();
		$selectStmt = "SELECT route_id, port_name FROM PORT INNER JOIN (
		SELECT route_id, from_port_code from ROUTE
		where to_port_code = (SELECT port_code FROM PORT 
		where port_name = ? and country_id = ?))as routes 
		ON ROUTES.to_port_code = PORT.port_code";
		$results = $con->executeSelectStatement($selectStmt, array($End_port, $end_port_country));        
		return $results;
	}
}
?>
