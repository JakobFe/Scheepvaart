<?php
	$title = "Popularity of route";
	require("template/top.tpl.php");
	require_once("gb/mapper/ShipBrokerCountMapper.php");
    // The route-id from which we have to get the info and show it
    // is retrieved from the url and saved in a local variable.
    $route_id = $_REQUEST["route_id"];
    // A mapper with the query to select the info is initialised.
	$mapper = new gb\mapper\ShipBrokerCountMapper();
    // The query is executed with the given route-id
    // and the array of objects is stored in allShipBrokers.
    $allShipBrokers = $mapper->getPopularity($route_id);
?>

<table>
    <tr>
        <td>Shipbroker name</td>
        <td>Popularity</td>
    </tr>
    <?php
    // For each object of type ShipBrokerCount in allShipBrokers we retrieve
    // the name and the popularity.
    foreach($allShipBrokers as $shipBroker) {
    ?>
        <tr>
            <td><?php echo $shipBroker->getName(); ?></td>
            <td><?php echo $shipBroker->getPopularity(); ?></td>
        </tr>
    <?php
    }
    ?>
</table>
<?php
	require("template/bottom.tpl.php");
?>