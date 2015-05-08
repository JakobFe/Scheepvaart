<?php
	
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "city information";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");


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


      
</table>
    
</form>    
<?php
	require("template/bottom.tpl.php");
?>