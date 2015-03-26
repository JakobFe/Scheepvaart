<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "Update ship";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");

    require_once( "gb/controller/UpdateShipController.php" );
    $updateShipController = new gb\controller\UpdateShipController();
    $updateShipController->process();
?> 

<form action="" method="post" >

<table>
    <tr>
        <td>Ship id </td><td><input type="input" name="ship_id" value="<?php echo $_REQUEST["ship_id"]; ?>" /></td>
    </tr>
    <tr>
        <td>Ship name </td><td><input type="input" name="ship_name" value="<?php echo $_REQUEST["name"]; ?>" /></td>
    </tr>
    <tr>
        <td>Type</td><td><input type="input" name="ship_type" value="<?php echo $_REQUEST["type"]; ?>" /></td>
    </tr>
    <tr>
        <td></td><td><input type="submit" value="Update" name="update_ship" /></td>
    </tr>
</table>
</form>    
<?php
	require("template/bottom.tpl.php");
?>