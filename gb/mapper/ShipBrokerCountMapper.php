<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/ShipBrokerCount.php" );


class ShipBrokerCountMapper extends Mapper {

    function __construct() {
        parent::__construct();
        /**
         * The query to select the number of times a shipbroker has shipped
         * on the route with the given route_id grouped by the shipbroker's name.
         */
        $this->selectStmt =
            "SELECT ship_broker_name, COUNT(ship_broker_name)
                FROM(SELECT ship_broker_name
                 FROM ORDERS NATURAL JOIN (SELECT shipment_id
                  FROM SHIPS where route_id = ?)
                  as ship_brokers)
                   as counting
                    group by ship_broker_name";
    }

    /**
     * A method to create a collection of objects from the result of a query.
     * @param array $raw
     *          The result of a query to process.
     * @return array
     *          Returns an array of objects of type ShipBrokerCount.
     */
    function getCollection( array $raw ) {
        
        $shipBrokerCountCollection = array();
        foreach($raw as $row) {
            array_push($shipBrokerCountCollection, $this->doCreateObject($row));
        }
        
        return $shipBrokerCountCollection;
    }

    /**
     * A method to create an object out of an array row of the result of a query.
     * @param array $array
     *          The array row of the result of a query.
     * @return \gb\domain\ShipBrokerCount
     *          Returns an object of type ShipBrokerCount.
     */
    protected function doCreateObject( array $array ) {
        $obj = new \gb\domain\ShipBrokerCount( $array['ship_broker_name'] );
        
        $obj->setName($array['ship_broker_name']);
        $obj->setPopularity($array['COUNT(ship_broker_name)']);

        return $obj;
    }

    /**
     * A method to get the query initialised in the constructor.
     * @return string
     *          Returns the query to select the required info.
     */
    function selectStmt() {
        return $this->selectStmt;
    }

    /**
     * The main method to get the info out of the database. The connection is made,
     * the query is executed and the collection of objects is made.
     * @param $route_id
     *          The given route-id.
     * @return array
     *          Returns an array of objects of type ShipBrokerCount.
     */
	function getPopularity($route_id){
	
	$con = $this->getConnectionManager();
	$results = $con->executeSelectStatement($this->selectStmt(), array($route_id));
	return $this->getCollection($results);
	}

    /**
     * A method to update the database. NOT USED!!!
     */
    function update(\gb\domain\DomainObject $object)
    {
        // TODO: Implement update() method.
    }

    /**
     * A method to insert in the database. NOT USED!!!
     */
    protected function doInsert(\gb\domain\DomainObject $object)
    {
        // TODO: Implement doInsert() method.
    }
}

?>
