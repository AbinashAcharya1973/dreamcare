<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
session_start();

$_POST = json_decode(file_get_contents('php://input'), true);
$cid=$_POST['cid'];

	$result2=$conn->query("select * from ItemMaster where BrandID=".$cid);
	if($result2->num_rows>0){
		echo "Records Exists In ItemMaster";
	}else{
		$qstatus=$conn->query("delete from Brands where BrandID=".$cid);
		if($qstatus){
			echo "Deleted Successfully";
		}else{
			echo "Error in Deleting";
		}
	}

?>
