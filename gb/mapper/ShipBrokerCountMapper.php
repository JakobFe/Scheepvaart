<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/ShipBrokerCount.php" );


class ShipBrokerCountMapper extends Mapper {

    function __construct() {
        parent::__construct();
        $this->selectStmt =
            "SELECT ship_broker_name, COUNT(ship_broker_name)
                FROM(SELECT ship_broker_name
                 FROM ORDERS NATURAL JOIN (SELECT shipment_id
                  FROM SHIPS where route_id = ?)
                  as ship_brokers)
                   as counting
                    group by ship_broker_name";
    }
    
    function getCollection( array $raw ) {
        
        $shipBrokerCountCollection = array();
        foreach($raw as $row) {
            array_push($shipBrokerCountCollection, $this->doCreateObject($row));
        }
        
        return $shipBrokerCountCollection;
    }

    protected function doCreateObject( array $array ) {
        $obj = new \gb\domain\ShipBrokerCount( $array['ship_broker_name'] );
        
        $obj->setName($array['ship_broker_name']);
        $obj->setPopularity($array['COUNT(ship_broker_name)']);

        return $obj;
    }

    function selectStmt() {
        return $this->selectStmt;
    }
    
	function getPopularity($route_id){
	
	$con = $this->getConnectionManager();
	$results = $con->executeSelectStatement($this->selectStmt(), array($route_id));
	return $this->getCollection($results);
	}

    function update(\gb\domain\DomainObject $object)
    {
        // TODO: Implement update() method.
    }

    protected function doInsert(\gb\domain\DomainObject $object)
    {
        // TODO: Implement doInsert() method.
    }
}

?>
