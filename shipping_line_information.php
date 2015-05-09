<?php
	
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "city information";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");

    // find all the routes that depart or end at the given port
    require_once("gb/controller/ListRouteFromPortController.php");
    $filerController = new gb\controller\listRouteFromPortController();
    list($start_routes, $end_routes) = $filerController->process();

    // find all the cities where customers live
    require_once( "gb/mapper/PortMapper.php");
    $mapper = new gb\mapper\PortMapper();
    $allCountries = $mapper->findAllCountries();
?>
<form method="post">

<table style="width: 100%">
    <tr>
        <td style="width: 10%"></td>
        
        <td style="width: 10%">Country</td>
        <td style="width: 40%">
            <select name="country" style="width: 100%">
                <?php
                    // each city is put in a dropdown list
                    foreach($allCountries as $country) {
                ?>
                <option <?php
                        if(isset($_POST["country"])){
                            if($_POST["country"] == $country){
                                echo "selected";
                            }
                        }
                        ?>

                    value="<?php echo $country?>"><?php echo $country?></option>
                <?php
                }
                ?>
            </select>
        </td>
        <!-- a button to choose the selected country and get all the ports in that country -->
        <td style="width: 10%"><input type="submit" value="get all ports" name="list_customer"></td>
        <td style="width: 30%"></td>
    </tr>
     <tr>
        <td style="width: 10%"></td>
        
        <td style="width: 10%">City</td>
        <td style="width: 40%">
            <select name="port" style="width: 100%">
                <?php
                // if a country has been choses by the customer, all the
                // ports in that country get added to another dropdown list 
                     if (isset($_POST["list_customer"])){
                        // get the selected country
                        $country = $_POST["country"];
                        // get all the ports in the selected country 
                        $allPorts = $mapper->findallPortsInCountry($country); }
                        foreach($allPorts as $city) {
                        ?>
                        <!-- put the port in the dropdown list  -->
                            <option value="<?php echo $city?>"><?php echo $city?></option>
                        <?php        
                        }
                        ?>
            </select>
        </td>
        <!-- button to select a por t -->
        <td style="width: 10%"><input type="submit" value="select this port" name="port_selector"></td>
        <td style="width: 30%"></td>
    </tr>
</table>    
	<table>
    <tr> Routes starting at this port: </tr>
            <tr>
                <td>From port</td>
                <td>To port</td>
                <td>Route-id </td>
            </tr>
            <?php
    // for each route that has this port as start port , the start and end port and 
    // the route id are displayed in a list 
    foreach($start_routes as $route) {
 ?>
       <tr>
        
        <td><a href="shipping_line_detail.php?route_id=<?php echo $route["route_id"] ?>">View</a></td>
        <td><?php echo $_POST["port"] ?></td>
        <td><?php echo $route["port_name"] ?></td>
        <td><?php echo $route["route_id"] ?></td>

    </tr>     
<?php

}
?>

<table>
    <tr> Routes ending at this port: </tr>
            <tr>
                <td>From port</td>
                <td>To port</td>
                <td>Route-id </td>
            </tr>
            <?php
      // for each route that has this port as end port , the start and end port and 
    // the route id are displayed in a list 
    foreach($end_routes as $route) {
 ?>
       <tr>
       <td><?php echo $route["port_name"] ?></td>
        <td><?php echo $_POST["port"] ?></td>
        <td><?php echo $route["route_id"] ?></td>
        <td><a href="shipping_line_detail.php?route_id=<?php echo $route["route_id"] ?>">View</a></td>

       </tr>
<?php        
}
?>


      
</table>
    
</form>    
<?php
	require("template/bottom.tpl.php");
?>