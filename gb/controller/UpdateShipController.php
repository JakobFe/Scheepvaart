<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/ShipMapper.php" );

class UpdateShipController extends PageController {
        
    function process() {
        if (isset($_POST["update_ship"])) {
            print "update code here";            
        }
    }
}

?>