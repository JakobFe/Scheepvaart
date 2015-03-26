<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of shipments";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");

	require_once("gb/mapper/ShipmentMapper.php");
	$mapper = new gb\mapper\ShipmentMapper();//
    $allShipments = $mapper->findAll();
?>

<table>
    <tr>
        <td>Shipment id</td>
        <td>Volume</td>
        <td>Weight</td>        
    </tr>
    <?php
    foreach($allShipments as $shipment) {
 ?>
       <tr>
		<td><?php echo $shipment->getShipmentID(); ?></td>
		<td><?php echo $shipment->getVolume(); ?></td>
		<td><?php echo $shipment->getWeight(); ?></td>
	</tr>     
<?php        
}
?>

</table>            

<?php
	require("template/bottom.tpl.php");
?>