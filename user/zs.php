<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename)or die("Could not connect to mysql".mysqli_error($con));
$json = file_get_contents('php://input');
	$req=json_decode($json);
	$bid=$req->branchid;
	$zname=$req->zone;

$result=$conn->query("select * from Zone where Zone='".$bname."'");
if($result->num_rows>0){
	echo "Already Exists";
}else{
	$qstatus=$conn->query("insert into Zone (BranchID,Zone) values(".$bid.",'".$zname."')");
	if($qstatus){
		echo "Zone Added";
	}else{
		echo "Error";
	}
}
?>
