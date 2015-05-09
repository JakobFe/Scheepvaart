<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Port.php" );


class PortMapper extends Mapper {

    function __construct() {
        parent::__construct();

        $this->selectStmt = "SELECT * FROM CUSTOMER where ssn = ?";
        // select al the ship id's from a ship
        $this->selectIDStmt = "SELECT ship_id FROM SHIP"; 
        // update a ship 
        $this->updateShipStmt = "UPDATE SHIP SET ship_id = ? , ship_name = ?, type = ? where ship_id = ? ";
        // select all the ports in a given country
        $this->selectPortStmt = "SELECT port_name FROM Port  WHERE country_id = ?";      
        // select all the information about all ports
        $this->selectAllStmt = "SELECT * FROM PORT";
        // select all country id's from all ports 
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
    
    // a function to find all the ports in the given country 
    // a collection containing all the ports in a given country is returned 
    function findAllPortsInCountry($country){
        $ports = self::$con->executeSelectStatement($this->selectPortStmt(),array($country)); 
        return $this->getCollectionPort($ports); 

    }

    // a function to find all countries
    // a collection containing all the countries is returned
    function findAllCountries(){
        $ports = self::$con->executeSelectStatement($this->selectCountryStmt(),array());
        return $this->getCollectionCountry($ports); 
    }


    // a function to create a collection containing all the country id's from the given array
    function getCollectionCountry( array $raw) {
        $customerCollection = array();
        foreach($raw as $row) {
            array_push($customerCollection,  $row['country_id']);
        }
        
        return $customerCollection;
    }
    // a function to create a collection containing all the port names from the given array
    function getCollectionPort( array $raw) {
        $customerCollection = array();
        foreach($raw as $row) {
            array_push($customerCollection,  $row['port_name']);
        }
        
        return $customerCollection;
    }
	
    // a function to get all the routes starting in the given port
	function getRoute_From_Port($Start_port, $start_port_country){
		$con = $this->getConnectionManager();      
        // the query to select the route id and name of the end port
        // for all routes starting in the given port
		$selectStmt = "SELECT route_id, port_name FROM PORT INNER JOIN (
		SELECT route_id, to_port_code from ROUTE
		where from_port_code = (SELECT port_code FROM PORT 
		where port_name = ? and country_id = ?))
        as routes
		ON routes.to_port_code = port.port_code ";
		$results = $con->executeSelectStatement($selectStmt, array($Start_port, $start_port_country));        
		return $results;
	}
	   // a function to get all the routes ending at the given port 
		function getRoute_to_Port($End_port, $end_port_country){
		$con = $this->getConnectionManager();
        // the query to select the route id and name of the start port 
        // for all routes ending in the given port
		$selectStmt = "SELECT route_id, port_name FROM PORT INNER JOIN (
		SELECT route_id, from_port_code from ROUTE
		where to_port_code = (SELECT port_code FROM PORT 
		where port_name = ? and country_id = ?))
        as routes 
		ON routes.from_port_code = port.port_code";
		$results = $con->executeSelectStatement($selectStmt, array($End_port, $end_port_country));        
		return $results;
	}
}
?>
