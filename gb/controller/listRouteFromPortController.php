<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
// a mapper to get the correct information concerning a port 
require_once("gb/mapper/PortMapper.php");


class ListRouteFromPortController extends PageController {
    function process() {
        // if the port has been selected, a list is created
        if (isset($_POST["port_selector"])) {
            if (isset($_POST["port"])){
                // get the port the customer has selected
            	$port = $_POST["port"]; 
                // get the country the customer has selected
                $country = $_POST["country"];
                // create a new mapper
            	$mapper = new \gb\mapper\PortMapper();
                // get all the routes that have this port as start route
            	$start_ports = $mapper->getRoute_From_Port($port,$country);
                // get all the routes that have this port as end route 
                $end_ports= $mapper->getRoute_To_Port($port,$country);
            	return array($start_ports, $end_ports);
            }
            
        }
        else {
            // if the port has not been selected, two empty arrays are returned 
        	return array(array(),array());
        }


    }
}
?>