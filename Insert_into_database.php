<?php 
require_once("Include/DB.php");
if(isset($_POST["Submit"])){
  if(!empty($_POST["EName"])&&($_POST["SSN"])){
  	$EName = $_POST["EName"];
  	$SSN = $_POST["SSN"];
  	$Dept = $_POST["Dept"];
  	$Salary = $_POST["Salary"];
  	$HomeAddress = $_POST["HomeAddress"];
  	$ConnectingDB;  //You can put global if you are using older version of php
  	$sql = "INSERT INTO emp_record(ename,ssn,dept,salary,homeaddress)
  	        VALUES (:enamE,:ssN,:depT,:salarY,:homeaddresS)";//This prevents sql injection when using PDO unlike others that uses mysqli_real_escape_string which will later use  VALUES ('$EName','$SSN','$Dept','$Salary','$HomeAddress')"; You can put any dummy name you like e.g Enameodira but make sure it matches with the bind value options
  	        $stmt = $ConnectingDB->prepare($sql); //-> means we are using the variable $ConnectingDB as object and calling the function or method prepare
  	        $stmt->bindValue(':enamE',$EName);
  	        $stmt->bindValue(':ssN',$SSN);
  	        $stmt->bindValue(':depT',$Dept);
  	        $stmt->bindValue(':salarY',$Salary);
  	        $stmt->bindValue(':homeaddresS',$HomeAddress);
  	        $Execute = $stmt->execute();
  	        if ($Execute) {
  	        	echo '<script>window.open("View_From_Database.php?id=Record Inserted Successfully","_self")</script>';
              // You can also you this header("location:view_From_Database.php");
  	        }	        
  }else{
  	echo '<span class="FieldInfoHeading">Please Add atleast Name and Social Security Number</span>';
  }
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Insert Data into Database</title>
	<link rel="stylesheet" href="include/style.css">
</head>
<body>
<div>
	<form class="" action="Insert_into_database.php" method="post">
		<fieldset>
			<legend style="text-align: center;color: blue;">Employee data</legend>
			<span class="FieldInfo">Employee Name</span><br>
			<input type="text" name="EName" value=""><br>
			<span class="FieldInfo">Social Security number</span><br>
			<input type="text" name="SSN" value=""><br>
			<span class="FieldInfo">Department</span><br>
			<input type="text" name="Dept" value=""><br>
			<span class="FieldInfo">Salary</span><br>
			<input type="text" name="Salary" value=""><br>
			<span class="FieldInfo">Home Address:</span><br>
			<textarea name="HomeAddress" cols="80" rows="8"></textarea><br>
			<input type="submit" name="Submit" value="Submit your record" placeholder="Text here">
		</fieldset>
	</form>
</div>
	
</body>
</html>