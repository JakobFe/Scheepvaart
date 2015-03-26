<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of customers";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");

    require_once( "gb/mapper/CustomerMapper.php" );
    $mapper = new gb\mapper\CustomerMapper();//
    $allCustomer = $mapper->findAll();
?>
	<table>
            <tr>
                <td>Ssn</td>
                <td>First name</td>
                <td>Last name</td>
                <td>Address</td>
                <td>City</td>
            </tr>
<?php
    foreach($allCustomer as $customer) {
 ?>
       <tr>
		<td><?php echo $customer->getSsn(); ?></td>
		<td><?php echo $customer->getFirstName(); ?></td>
		<td><?php echo $customer->getLastName(); ?></td>
                <td><?php echo $customer->getAddress(); ?></td>
                <td><?php echo $customer->getCity(); ?></td>
	</tr>     
<?php        
}
?>
</table>
<?php
	require("template/bottom.tpl.php");
?>