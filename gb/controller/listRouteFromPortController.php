<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/PortMapper.php");
// $allCustomer = $mapper->findAll();

class ListRouteFromPortController extends PageController {
    function process() {
        if (isset($_POST["port_selector"])) {
            if (isset($_POST["port"])){
            	$port = $_POST["port"]; 
                $country = $_POST["country"];
            	$mapper = new \gb\mapper\PortMapper();
            	$start_ports = $mapper->getRoute_From_Port($port,$country);
                $end_ports= $mapper->getRoute_To_Port($port,$country);
            	return array($start_ports, $end_ports);
            }
            
        }
        else {
        	return array(array(),array());
        }


    }
}
?>