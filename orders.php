<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of orders";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");

	// this finds all the orders placed. 
	require_once("gb/mapper/OrderMapper.php");
	$mapper = new gb\mapper\OrderMapper();//
    $allOrders = $mapper->findAll();
?>
<table>
    <tr>
        <td>Shipment id</td>
        <td>Customer name</td>
        <td>Ship broker name</td>
        <td>Price</td>
        <td>Order date</td>
    </tr>
    <?php
    // all the found orders and its Shipment ID, Ship broker name, price,
    // order date and the name of the person who ordered it are placed in a list. 
    foreach($allOrders as $order) {
 ?>
       <tr>
		<td><?php echo $order->getShipmentID(); ?></td>
		<td><?php echo $order->getNameBelongingToSsn(); ?></td>
		<td><?php echo $order->getShipBrokerName(); ?></td>
		<td><?php echo $order->getPrice(); ?></td>
		<td><?php echo $order->getOrderDate(); ?></td>
	</tr>     
<?php        
}
?>
</table>  
<?php
	require("template/bottom.tpl.php");
?>