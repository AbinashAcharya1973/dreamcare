<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
$_POST = json_decode(file_get_contents('php://input'), true);
$md=$_POST['m'];
$act=$_POST['ta'];
$uid=$_POST['id'];
if($uid==1){
	echo "true";
}else{
$result1=$conn->query("select * from AppModules where ModuleName='".$md."'");
if($result1->num_rows>0){
	if($row=$result1->fetch_assoc()){
		$mid=$row['ModuleID'];
	}
	$result=$conn->query("select * from UserPermission where ModuleID=".$mid." and UserID=".$uid." and P".$act."=1");
	if($result->num_rows>0){
		echo "true";
	}else{
		echo "false";
	}
}else{
	echo "false";
}
}

?>
