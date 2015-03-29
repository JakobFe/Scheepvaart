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
            <td><input type="text" value="" name="shipment_id"></td>
            <td>Volume</td>
            <td><input type="text" value="" name="volume" ></td>
            <td>Weight</td>
            <td><input type ="text" value = "" name="weight"></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input type ="text" value = "" name="price"></td>
            <td>Date</td>
            <td><input type="date" value="" name="date"></td>
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
                <select style="width: 50%" name="ship_broker_name">
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
<div id="error">
<?php
/**
 * This if statement will show an error message if
 *      the ssn is not null which is equivalent to the ssn is filled in by the user before clicking on the look up button
 *  and
 *      the order/shipment is disabled which is equivalent to the given ssn doesn't exist yet.
 * The user will be asked to navigate to the create new customer page, because there is no customer with the given ssn.
 */
if(!$orderController->isSsnNull() and $orderController->isOrderShipmentDisabled())
    echo "Please go to the 'create new customer' page to create a new customer";
?>
</div>
<div id="error">
<?php
/**
 * If the user pressed the submit button (first if) and the shipment id does already exist (second if) and the shipment id
 * has not recently been inserted (third if), there will be an error message showed to suggest the user to choose another shipment id
 * because the id is already in use.
 */
if($orderController->isOrderShipmentEnabled())
    if ($orderController->shipmentExists($_POST["shipment_id"]))
        if (!$orderController->inserted)
            echo "The given shipment id already exists, please choose another one.";
?>
</div>
</form>
<?php
	require("template/bottom.tpl.php");
?>