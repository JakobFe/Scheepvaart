<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/CustomerMapper.php" );

class CreateCustomerController extends PageController {
    function process() {
        if (isset($_POST["create_customer"])) {
            print "create customer code here";
        }
    }
}

?>