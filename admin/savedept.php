<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
$_POST = json_decode(file_get_contents('php://input'), true);
	$dept=$_POST['dept'];
$result=$conn->query("select * from departments where department='".$dept."'");
if($result->num_rows>0){
	echo "Unit Name Already Exists";
}else{
	
	$qstatus=$conn->query("insert into departments (department) values('".$dept."')");
	if($qstatus){
		echo "Unit Added Successfully";
	}else{
		echo "Error";
        
	}
}



?>