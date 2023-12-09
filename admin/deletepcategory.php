<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
session_start();
$_POST = json_decode(file_get_contents('php://input'), true);
$cid=$_POST['cid'];
$result1=$conn->query("select * from Subcategory where CategoryID=".$cid);
if($result1->num_rows>0){
	$result2=$conn->query("select * from ItemMaster where CategoryID=".$cid);
	if($result2->num_rows>0){
		echo "Records Exists In SubCategory and ItemMaster";
	}else{
		echo "Records Exists In SubCategory";
	}
}else{
	$qstatus=$conn->query("delete from Category where CategoryID=".$cid);
	if($qstatus){
		echo "Deleted Successfully";
	}else{
		echo "Error in Deleting";
	}
}
?>
