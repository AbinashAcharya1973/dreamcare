<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
$_POST = json_decode(file_get_contents('php://input'), true);
$rtype=$_POST['btext'];
$result=$conn->query("select * from Brands where BrandName='".$rtype."'");
if($result->num_rows>0){
	echo "Brand Name Already Exists";
}else{
	$qstatus=$conn->query("insert into Brands (BrandName) values('".$rtype."')");
	if($qstatus){
		echo "Brand Name Added Successfully";
	}else{
		echo "Error";
	}
	
}
?>
