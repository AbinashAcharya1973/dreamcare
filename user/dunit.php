<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
$_POST = json_decode(file_get_contents('php://input'), true);
$cid=$_POST['cid'];
	$qstatus=$conn->query("delete from UnitMaster where UnitID=".$cid);
	if($qstatus){
		echo "Deleted Successfully";
	}else{
		echo "Error in Deleting";
	}

?>
