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
    foreach($allShipBrokers as $Shipbroker) {
		/*
		De eerste 2 lijnen komen eerst, om de route_id te bepalen, maar php leest de functie niet.
		
		require_once( "gb/mapper/ShipBrokerMapper.php" );
		$route = getShipbrokerRoute($Shipbroker->getName()); 
		
		De lijst lijn moet onder de andere echo, maar aangezien route nog niet tegoei bepaald 
		wordt staat deze even hier gecommertarieërd. 
		<td><?php echo $Shipbroker->getRoute(); ?></td>	
		*/
 ?>
       <tr>
		<td><?php echo $Shipbroker->getName(); ?></td>
		</tr>  
	
<?php        
}
?>
</table>
<?php
	require("template/bottom.tpl.php");
?>