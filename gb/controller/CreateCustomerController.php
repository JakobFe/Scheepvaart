<?php
namespace gb\controller;

use gb\connection\ConnectionManager;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/CustomerMapper.php" );
require_once("gb/connection/ConnectionManager.php" );

class CreateCustomerController extends PageController {
    function process() {
        if (isset($_POST["create_customer"])) {     
			$con = new ConnectionManager();
			//Makes the update statement for a new customer
			$updateStmt = "INSERT INTO CUSTOMER(ssn, first_name, last_name, street, 
			number, bus, postal_code, city, mobi_phone) VALUES (?,?,?,?,?,?,?,?,?)" ;
			//Get an array with the values given by the user
			$Values = array($_POST['ssn'], $_POST['first_name'], $_POST['last_name'], $_POST['street'],
			$_POST['number'], $_POST['bus'], $_POST['postal_code'], $_POST['city'], $_POST['mobiphone']);
			//Add the new user the the database
			$con->executeUpdateStatement($updateStmt, $Values);  
        }
    }
}


?>