<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "Create a new customer";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");

    require_once( "gb/controller/CreateCustomerController.php" );
    $customerController = new gb\controller\CreateCustomerController();
    $customerController->process();
?>    
<form method="post">
<table style="width: 100%">

<tr>
    <td colspan="6">
    <table style="width: 100%">
        <tr>
            <td>Customer ssn</td>
            <td><input type="text" value="" name="ssn"></td>
            <td>First name</td>
            <td><input type="text" name="first_name"  value=""></td>
            <td>Last name</td>
            <td><input type ="text" name = "last_name"   value=""></td>
            
        </tr>
        <tr>
            <td>Street</td>
            <td><input type="text" name="street"   value=""></td>
            <td>Number</td>
            <td><input type ="text" name = "number"   value=""></td>
            <td>Bus</td>
            <td><input type ="text" name = "bus"   value=""></td>
            
        </tr>
        <tr>            
            <td>Mobile phone</td>
            <td><input type ="text" name = "mobiphone"   ></td>
            <td>City</td>
            <td><input type ="text" name = "city"   value=""></td>
            <td>Postal code</td>
            <td><input type ="text" name = "postal_code"   value=""></td>
        </tr>
    </table>
    </td>
</tr>    

<tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td><input type ="submit" name="create_customer" value="Create customer" ></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
</tr>
</table>
</form>    
<?php
	require("template/bottom.tpl.php");
?>