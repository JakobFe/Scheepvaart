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
                echo $port; 
                echo $country; 
            	$mapper = new \gb\mapper\PortMapper();
            	$ports = $mapper->getRoute_From_Port($port,$country);
            	return $ports;
            }
            
        }
        else {
        	return array();
        }


    }
}
?>