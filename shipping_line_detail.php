<?php
	$title = "Popularity of route";
	require("template/top.tpl.php");
	require_once("gb/mapper/ShipBrokerCountMapper.php");
    $route_id = $_REQUEST["route_id"];
	$mapper = new gb\mapper\ShipBrokerCountMapper();
    $allShipBrokers = $mapper->getPopularity($route_id);
?>

<table>
    <tr>
        <td>Shipbroker name</td>
        <td>Popularity</td>
    </tr>
    <?php
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