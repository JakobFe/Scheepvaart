<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "Order shipments";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");

    require_once( "gb/controller/OrderShipmentController.php" );
    require_once( "gb/mapper/ShipBrokerMapper.php" );
    
    $orderController = new gb\controller\OrderShipmentController();
    $orderController->process();
    
    $mapper = new gb\mapper\ShipBrokerMapper();
    $allShipBroker = $mapper->findAll();    
?>    
<form method="post">
<table style="width: 100%">
<tr>
        <td colspan="6">Customer information</td>
</tr>
<tr>
    <td colspan="6">
    <table style="width: 100%">
        <tr>
            <td>Customer ssn</td>
            <td><input type="text" value="<?php echo $orderController->getCustomerSsn(); ?>" name="ssn"></td>
            <td><input type ="submit" value = "Look up"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>First name</td>
            <td><input type="text" name="first_name" readonly="true" value="<?php echo $orderController->getCustomerFirstName(); ?>"></td>
            <td>Last name</td>
            <td><input type ="text" name = "last_name" readonly="true" value="<?php echo $orderController->getCustomerLastName(); ?>"></td>
            <td>City</td>
            <td><input type ="text" name = "city" readonly="true" value="<?php echo $orderController->getCustomerCity(); ?>"></td>
        </tr>
        <tr>
            <td>Street</td>
            <td><input type="text" name="street" readonly="true" value="<?php echo $orderController->getCustomerStreet(); ?>"></td>
            <td>Number</td>
            <td><input type ="text" name = "number" readonly="true" value="<?php echo $orderController->getCustomerNumber(); ?>"></td>
            <td>Mobile phone</td>
            <td><input type ="text" name = "mobiphone" readonly="true" ></td>
        </tr>
    </table>
    </td>
</tr>    
<tr>
    <td colspan="6">Shipment information</td>
</tr>
<tr>
    <td colspan="6">
    <table style="width: 100%">
        <tr>
            <td>Shipment id</td>
            <td><input type="text" value=""></td>
            <td>Volume</td>
            <td><input type="text" value=""></td>
            <td>Weight</td>
            <td><input type ="text" value = ""></td>            
        </tr>
        <tr>
            <td>Price</td>
            <td><input type ="text" value = ""></td>
            <td>Date</td>
            <td><input type="text" value=""></td>
            <td></td>
            <td></td>
            <td></td>            
        </tr>
    </table>
    </td>    
</tr>
<tr>
    <td colspan="6">Ship broker information</td>
</tr>
<tr>
    <td colspan="6">
    <table style="width: 100%">
        <tr>
            <td style="width: 15%">Broker name</td>
            <td colspan="5" style="width: 85%">
                <select style="width: 50%">
                    <?php
                    foreach($allShipBroker as $broker) {
                        echo "<option value=\"", $broker->getName(), "\">", $broker->getName(), "</option>" ;
                    }
                    
                    ?>      
                </select>
            </td>
            
        </tr>        
    </table>
    </td>    
</tr>
<tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td><input type ="submit" name="order_shipment" value="Order shipment" <?php if($orderController->isOrderShipmentDisabled()) echo 'disabled'; ?>></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
</tr>
</table>
</form>    
<?php
	require("template/bottom.tpl.php");
?>