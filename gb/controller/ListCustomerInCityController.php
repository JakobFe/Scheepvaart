<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/CustomerMapper.php");
// $allCustomer = $mapper->findAll();

class ListCustomerInCityController extends PageController {
    function process() {
        if (isset($_POST["list_customer"])) {
            if (isset($_POST["city"])){
            	$city = $_POST["city"]; 
            	$mapper = new \gb\mapper\CustomerMapper();
            	$customers = $mapper->getCustomersInCity($city);
            	return $customers;
            }
            
        }
        else {
        	return array();
        }


    }
}
?>