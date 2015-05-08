<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Port.php" );


class PortMapper extends Mapper {

    function __construct() {
        parent::__construct();
        $this->selectAllStmt = "SELECT * FROM PORT";
    }
    
    function getCollection( array $raw ) {
        
        $shipCollection = array();
        foreach($raw as $row) {
            array_push($shipCollection, $this->doCreateObject($row));
        }
        
        return $shipCollection;
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

    function selectAllStmt() {
        return $this->selectAllStmt;
    }

    function updateShipStmt(){
        return $this->updateShipStmt;
    }
	
	function getRoute_From_Port($Start_port, $start_port_country){
		$con = $this->getConnectionManager();
		$selectStmt = "SELECT route_id from ROUTE where from_port_code = 
		(SELECT port_code FROM PORT where port_name = $Start_port and country_id = $start_port_country)";
		$results = $con->executeSelectStatement($selectStmt, array());        
		return $results;
	}
	
		function getRoute_to_Port($End_port, $end_port_country){
		$con = $this->getConnectionManager();
		$selectStmt = "SELECT route_id from ROUTE where to_port_code = 
		(SELECT port_code FROM PORT where port_name = $End_port and country_id = $end_port_country)";
		$results = $con->executeSelectStatement($selectStmt, array());        
		return $results;
	}
}
?>
