<?php 
require_once("Include/DB.php");
$SearchQueryParameter = $_GET["id"]; //Anytthing after question mark (i.e ?) is search query parameter 
if(isset($_POST["Submit"])){
  
  	$EName = $_POST["EName"];
  	$SSN = $_POST["SSN"];
  	$Dept = $_POST["Dept"];
  	$Salary = $_POST["Salary"];
  	$HomeAddress = $_POST["HomeAddress"];
  	$ConnectingDB;  //You can put global if you are using older version of php
  	$sql = "UPDATE emp_record SET ename='$EName', ssn='$SSN', dept='$Dept', salary='$Salary', homeaddress='$HomeAddress' WHERE id='$SearchQueryParameter'";
  	        $stmt = $ConnectingDB->query($sql); //-> means we are using the variable $ConnectingDB as object and calling the method query
  	        if ($stmt) {
  	        	echo '<script>window.open("View_From_Database.php?id=Record updated Successfully","_self")</script>';
  	        }	//this javascript script redirects us to View_From_Database.php after updating our records with _self        
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Update Data into Database</title>
	<link rel="stylesheet" href="include/style.css">
</head>
<body>
<?php 
$ConnectingDB;
$sql = "SELECT * FROM emp_record WHERE id='$SearchQueryParameter'";
$stmt = $ConnectingDB->query($sql);
while ($DataRows = $stmt->fetch()) {
  $Id =  $DataRows["id"]; // fetching data from the exact table name (i.e id) from our table and assigning it to the column name on our client side 
  $EName =  $DataRows["ename"]; 
  $SSN =  $DataRows["ssn"];
  $Department =  $DataRows["dept"];
  $Salary =  $DataRows["salary"];
  $HomeAddress = $DataRows["homeaddress"];
}
 ?>
<div>
	<form class="" action="Update.php?id=<?php echo $SearchQueryParameter; ?>" method="post">
		<fieldset>
			<legend style="text-align: center;" >Employee data</legend>
			<span class="FieldInfo">Employee Name</span><br>
			<input type="text" name="EName" value=" <?php echo $EName; ?> "><br>
			<span class="FieldInfo">Social Security number</span><br>
			<input type="text" name="SSN" value="<?php echo $SSN; ?> "><br>
			<span class="FieldInfo">Department</span><br>
			<input type="text" name="Dept" value="<?php echo $Department; ?> "><br>
			<span class="FieldInfo">Salary</span><br>
			<input type="text" name="Salary" value="<?php echo $Salary; ?> "><br>
			<span class="FieldInfo">Home Address:</span><br>
			<textarea name="HomeAddress" cols="80" rows="8"> <?php echo $HomeAddress; ?> </textarea><br>
			<input type="submit" name="Submit" value="Submit your record">
		</fieldset>
	</form>
</div>
	
</body>
</html>