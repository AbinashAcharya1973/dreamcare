<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
$_POST = json_decode(file_get_contents('php://input'), true);
$rtype=$_POST['stext'];
$result=$conn->query("select * from Category where Category='".$rtype."'");
if($result->num_rows>0){
	echo "Already Exists";
}else{
$conn->query("insert into Category (Category) values('".$rtype."')");
	echo "Category Added Successfully";
}

?>
