<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/CustomerMapper.php");
require_once("gb/connection/ConnectionManager.php");
require_once("gb/mapper/ShipmentMapper.php");
require_once("gb/mapper/OrderMapper.php");

class OrderShipmentController extends PageController {
    private $customer;
    public $inserted;

    /**
     * This method is the main method which is invoked each time the order_shipment.php page is loaded.
     */
    function process() {
        
        if (!$this->isSsnNull()) {
            $this->customer = $this->lookupCustomer($_POST["ssn"]);
        }

        /**
         * Only when the user clicked the submit button and the shipment id doesn't exists yet, the order can be placed.
         */
        if ($this->isOrderShipmentEnabled() and !($this->shipmentExists($_POST["shipment_id"]))){
            $this->placeShipmentOrder();
        }
    }
    
    function isSsnNull() {
        return !(isset ($_POST['ssn']));
    }
    
    function isOrderShipmentDisabled() {
        return is_null($this->customer);
    }
    
    function isOrderShipmentEnabled() {
        return (isset($_POST["order_shipment"]));
    }
            
    function lookupCustomer ($ssn) {
        //$this->customer = null;
        $mapper = new \gb\mapper\CustomerMapper();//
        return $mapper->find($ssn);
    }
    
    function getCustomerSsn() {
        if (!is_null($this->customer)) {
            return $this->customer->getSsn();
        } else {
            return '';
        }
    }
    
    function getCustomerFirstName() {
        if (!is_null($this->customer)) {
            return $this->customer->getFirstName();
        } else {
            return '';
        }
    }
    
    function getCustomerLastName() {
        if (!is_null($this->customer)) {
            return $this->customer->getLastName();
        } else {
            return '';
        }
    }
    
    function getCustomerCity() {
        if (!is_null($this->customer)) {
            return $this->customer->getCity();
        } else {
            return '';
        }
    }
    
    function getCustomerStreet() {
        if (!is_null($this->customer)) {
            return $this->customer->getStreet();
        } else {
            return '';
        }
    }
    
    function getCustomerNumber() {
        if (!is_null($this->customer)) {
            return $this->customer->getNumber();
        } else {
            return '';
        }
    }
    
    function getCustomerBus() {
        if (!is_null($this->customer)) {
            return $this->customer->getBus();
        } else {
            return '';
        }
    }
    
    function getCustomerPostalCode () {
        if (!is_null($this->customer)) {
            return $this->customer->getPostalCode();
        } else {
            return '';
        }
    }

    /**
     * A method similar to lookupCustomer to check whether a shipment id is already in use or not.
     * @param $shipment_id  The shipment id to check.
     * @return bool         The result of type boolean says whether the result of finding the shipment id is empty or not.
     */
    function shipmentExists($shipment_id){
        $mapper = new \gb\mapper\ShipmentMapper();
        $result = $mapper->find($shipment_id);
        return ($result != "");
    }

    /**
     * A method to get all values filled in and submitted by the user plus the ssn, first name and last name of the customer
     * which are needed to set up the proper order object (see Order.php).
     * @return array        Returns an array with all the values needed to make a object type Order.
     */
    function getOrderValues(){
        $array["shipment_id"] = $_POST["shipment_id"];
        $array["ssn"] = $this->getCustomerSsn();
        $array["ship_broker_name"] = $_POST["ship_broker_name"];
        $array["price"] = $_POST["price"];
        $array["order_date"] = $_POST["date"];
        $array["first_name"] = $this->getCustomerFirstName();
        $array["last_name"] = $this->getCustomerLastName();
        return $array;
    }

    /**
     * A method similar to getOrderValues to store all values filled in by the user in an array.
     * @return array        Returns an array with all the values needed to make a object type Shipment.
     */
    function getShipmentValues(){
        $array["shipment_id"] = $_POST["shipment_id"];
        $array["volume"] = $_POST["volume"];
        $array["weight"] = $_POST["weight"];
        return $array;
    }

    /**
     * A method to place a shipment and an order based on the values filled in by the user.
     */
    function placeShipmentOrder() {
        /**
         * First a mapper is initialized for order and shipment to be able to use the methods of these mappers
         * to create an object of type Order and Shipment and to insert these objects in the database.
         */
        $orderMapper = new \gb\mapper\OrderMapper();
        $shipmentMapper = new \gb\mapper\ShipmentMapper();
        /**
         * $newOrder and $newShipment are the two objects where the information filled in by the user will be stored.
         * This will be accomplished by the function doCreateObject who will create an object with the given values and will return it.
         */
        $newOrder = $orderMapper->doCreateObject($this->getOrderValues());
        $newShipment = $shipmentMapper->doCreateObject($this->getShipmentValues());
        /**
         * $newOrder and $newShipment will be inserted in the database using the method doInsert. This method will execute an insert
         * statement in order to insert the data stored in the objects in the db.
         */
        $orderMapper->doInsert($newOrder);
        $shipmentMapper->doInsert($newShipment);
        $this->inserted = true;
        echo "the order has been placed.";
    }
}

?>