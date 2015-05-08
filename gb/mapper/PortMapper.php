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
}
?>
