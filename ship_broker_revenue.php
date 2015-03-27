<?php
	$title = "Ship broker revenues";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");

    require_once( "gb/mapper/ShipBrokerMapper.php" );
    $mapper = new gb\mapper\ShipBrokerMapper();//
	$allShipBrokers = $mapper->findAll();

 ?>
<table>
    <tr>
        <td>Ship broker name</td>
        <td>From port</td>
        <td>To port</td>
        <td>Revenue</td>
        <td>Date (mm/yyyy)</td>
    </tr>
	
	
<?php
	require_once( "gb/mapper/ShipBrokerMapper.php" );
	$mapper = new gb\mapper\ShipBrokerMapper();//
	$routes = $mapper->getShipbrokerRevenue(); 
    for($i = 0; $i < count($routes); ++$i) {
		$route_id = $routes[$i]['Route_id'];
		
		require_once( "gb/mapper/ShipBrokerMapper.php" );
		$mapper = new gb\mapper\ShipBrokerMapper();//
		$Ports = $mapper->getPorts($route_id);
		
 ?>
       <tr>
		<td><?php echo $routes[$i]['Ship_broker_name']; ?></td>
		<td><?php echo $Ports[0]['from_port_code'] ?></td>
		<td><?php echo $Ports[0]['to_port_code'] ?></td>
		<td><?php echo $routes[$i]['SUM(price)'] ?></td>
		<td><?php echo $routes[$i]['departure_date'] ?></td>
		</tr>  
	
<?php        
}
?>
</table>
<?php
	require("template/bottom.tpl.php");
?>