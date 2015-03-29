<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
 

class UpdateShipController extends PageController {
	
        
    function process() {	
    	require_once("gb/mapper/ShipMapper.php" );
		$mapper = new \gb\mapper\ShipMapper();
		$allShips = $mapper->findAllShipID();

        if (isset($_POST["update_ship"])) {
        	$previousID = htmlspecialchars($_GET["ship_id"]);
        	$shipID = $_POST["ship_id"];
        	$shipName = $_POST["ship_name"];
        	$shipType = $_POST["ship_type"]; 
	        if (! is_numeric($shipID)){
				echo "please enter a number as the id.";
			}
			else if (in_array($shipID, $allShips) &&  $shipID != $previousID){
				echo "this id has already been taken.";
			}
			else {
				require_once("gb/mapper/ShipMapper.php");
				$ships = new \gb\mapper\ShipMapper();
				$ships->updateShip($previousID,$shipID,$shipName,$shipType);
				echo "<br> The ship information has been updated";
				
			}
        }
            
    		
            

        }
    }


?>