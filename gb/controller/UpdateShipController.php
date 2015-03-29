<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
 

class UpdateShipController extends PageController {
	
        
    function process() {	
    	require_once("gb/mapper/ShipMapper.php" );
		$mapper = new \gb\mapper\ShipMapper();
		// all the ship ID's are found 
		$allShips = $mapper->findAllShipID(); 

        if (isset($_POST["update_ship"])) {
        	// previous ID contains the previous ID of the ship. This ID 
        	// is needed to access the ship in the database. 
        	$previousID = htmlspecialchars($_GET["ship_id"]);
        	// get the information the user filled in in the form
        	$shipID = $_POST["ship_id"];
        	$shipName = $_POST["ship_name"];
        	$shipType = $_POST["ship_type"]; 
        	// the ship id is not a valid id number
	        if (! is_numeric($shipID)){
				echo "please enter a number as the id.";
			}
			// the ship id is already takens
			else if (in_array($shipID, $allShips) &&  $shipID != $previousID){
				echo "this id has already been taken.";
			}
			else {
				require_once("gb/mapper/ShipMapper.php");
				$ships = new \gb\mapper\ShipMapper();
				// update the ship information to the new id, name and type
				$ships->updateShip($previousID,$shipID,$shipName,$shipType);
				echo "<br> The ship information has been updated";
				
			}
        }
            
    		
            

        }
    }


?>