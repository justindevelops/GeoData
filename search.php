<!DOCTYPE html>
<html>
<head>
<title>Sheldon Soil Data</title>
<link rel="stylesheet" type="text/css"
href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<label>Search</label>
<form action="" method="POST">
<!-- Dropdown Menu to select search criteria -->
<select name="mineral">
<option value="SiO2">Select Mineral</option><!--SiO2 left in blank field for full data print-->
<option value="Pedon">Pedon</option>
<option value="SiO2">SiO2</option>
<option value="TiO2">TiO2</option>
<option value="Fe2O3">Fe2O3</option>
<option value="Al2O3">Al2O3</option>
<option value="MnO">MnO</option>
<option value="CaO">CaO</option>
<option value="MgO">MgO</option>
<option value="K2O">K2O</option>
<option value="Na2O">Na2O</option>
<option value="P2O5">P2O5</option>
</select>

<input type="text" placeholder="Type numeric value here" name="search">&nbsp;
<input type="submit" value="Search" name="Search">&nbsp;
<p>Search by mineral content or specific soil sample. Select the mineral or 'Pedon' for soil sample, and enter a numeric value you're looking for.</p>
<p>Leave field empty to show entire dataset.</p>
</form>
<!-- MySQLi database connection info-->
<?php
$localhost = "sql105.epizy.com";
$username = "CENSORED";
$password = "CENSORED";
$dbname = "epiz_24801292_test";
$con = new mysqli($localhost, $username, $password, $dbname); /*creating new connection*/

/*Error checking on connection status*/
if( $con->connect_error){
    die('Error: ' . $con->connect_error);
}

if(isset($_POST['mineral'])){
    $mineral = $_POST['mineral'];
}

/*Test if "Pedon" has been selected from dropdown menu, only return result of that one row*/
if( isset($_POST['search']) ){
    if($mineral == "Pedon") {
        $numValue = mysqli_real_escape_string($con, htmlspecialchars($_POST['search']));
        $sql = "SELECT * FROM `epiz_24801292_soil_db`.`TABLE 1` WHERE $mineral = '$numValue'";
    } else {
        $numValue = mysqli_real_escape_string($con, htmlspecialchars($_POST['search']));
        $sql = "SELECT * FROM `epiz_24801292_soil_db`.`TABLE 1` WHERE $mineral REGEXP '^$numValue'";
    }
    
}

$result = $con->query($sql);

?>

<h2>Soil Data</h2>
<table class="table table-striped table-responsive">
<tr>
<th>Pedon</th>
<th>SiO2</th>
<th>TiO2</th>
<th>Fe2O3</th>
<th>Al2O3</th>
<th>MnO</th>
<th>CaO</th>
<th>MgO</th>
<th>K2O</th>
<th>Na2O</th>
<th>P2O5</th>
<th>MAP</th>
<th>MAT</th>
<th>USDA</th>
<th>Cat#</th>
</tr>
<?php
while($row = $result->fetch_assoc()){
    ?>
    <tr>
    <td><?php echo $row['Pedon']; ?></td>
    <td><?php echo $row['SiO2']; ?></td>
    <td><?php echo $row['TiO2']; ?></td>
    <td><?php echo $row['Fe2O3']; ?></td>
    <td><?php echo $row['Al2O3']; ?></td>
    <td><?php echo $row['MnO']; ?></td>
    <td><?php echo $row['CaO']; ?></td>
    <td><?php echo $row['MgO']; ?></td>
    <td><?php echo $row['K2O']; ?></td>
    <td><?php echo $row['Na2O']; ?></td>
    <td><?php echo $row['P2O5']; ?></td>
    <td><?php echo $row['MAP']; ?></td>
    <td><?php echo $row['MAT']; ?></td>
    <td><?php echo $row['USDA']; ?></td>
    <td><?php echo $row['Cat#']; ?></td>
    </tr>
    <?php
}
mysqli_free_result($result);
mysqli_close($con);
?>
</table>
</div>
</body>
</html>
