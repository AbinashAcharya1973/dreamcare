<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename)or die("Could not connect to mysql".mysqli_error($con));
$json = file_get_contents('php://input');
	$req=json_decode($json);
	$add=$req->branchaddress;
	$bname=$req->branchname;
	$contactno=$req->contactno;
$result=$conn->query("select * from Branch where Branch='".$bname."'");
if($result->num_rows>0){
	echo "Already Exists".'-'.$add.'-'.$_REQUEST['branchname'];
}else{
	$qstatus=$conn->query("insert into Branch (Branch,Address,BranchContactNO,BranchLogin) values('".$bname."','".$add."','".$contactno."','".$contactno."')");
	if($qstatus){
		echo "Branch Added";
	}else{
		echo "Error";
	}
}
?>
