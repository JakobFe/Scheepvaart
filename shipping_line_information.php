<?php
	
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "Customers in city";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");

    // php page that makes sure the right information is put on this page 
    // once the client has chosen a specific city, this page returns a list 
    // with the customers in that specific city. 
    require_once( "gb/controller/ListCustomerInCityController.php" );
    $filterController = new gb\controller\ListCustomerInCityController();
    $customers = $filterController->process();

    // find all the cities where customers live
    require_once( "gb/mapper/CustomerMapper.php");
    $mapper = new gb\mapper\CustomerMapper();
    $allCities = $mapper->findAllCities();
?>
<form method="post">

<table style="width: 100%">
    <tr>
        <td style="width: 10%"></td>
        
        <td style="width: 10%">City</td>
        <td style="width: 40%">
            <select name="city" style="width: 100%">
                <?php
                    // each city is put in a dropdown list
                    foreach($allCities as $city) {
                ?>
                <option value="<?php echo $city?>"><?php echo $city?></option>
                <?php        
                }
                ?>
            </select>
        </td>
        <td style="width: 10%"><input type="submit" value="get all cities" name="list_customer"></td>
        <td style="width: 30%"></td>
    </tr>
</table>    
	<table>
            <tr>
                <td>Ssn</td>
                <td>First name</td>
                <td>Last name</td>
                <td>Address</td>
                <td>City</td>
            </tr>


 <?php
    // for each customer living in the chosen city, his Ssn, first name, last name, address and city
    // are displayed in a list 
    foreach($customers as $customer) {
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
    
</form>    
<?php
	require("template/bottom.tpl.php");
?>