<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));

//$jdetails=json_decode($req);
$_POST = json_decode(file_get_contents('php://input'), true);
$req=$_POST['pdata'];
$uid=$_POST['uid'];
$countRecords=count($req);
$RC=0;

//echo "insert into UserPermission (ModuleID,UserID,PEdit,PSave,PPrint,PDelete) values(".$jdetails[$RC]->ModuleID.",".$uid.",".$jdetails[$RC]->Edit.",".$jdetails[$RC]->Save.",".$jdetails[$RC]->Print.",".$jdetails[$RC]->Delete.")";
while($RC<$countRecords){
	$result=$conn->query("select * from UserPermission where ModuleID=".$req[$RC]['ModuleID']." and UserID=".$uid);
	if($result->num_rows>0){
	$conn->query("update UserPermission set PEdit=".(int)$reg[$RC]['Edit'].",PSave=".(int)$req[$RC]['Save'].",PPrint=".(int)$req[$RC]['Print'].",PDelete=".(int)$req[$RC]['Delete']." where ModuleID=".$req[$RC]['ModuleID']." and UserID=".$uid);	
	}else{
		$conn->query("insert into UserPermission (ModuleID,UserID,PEdit,PSave,PPrint,PDelete) values(".$req[$RC]['ModuleID'].",".$uid.",".(int)$req[$RC]['Edit'].",".(int)$req[$RC]['Save'].",".(int)$req[$RC]['Print'].",".(int)$req[$RC]['Delete'].")");
	}
	$RC++;
}
echo "OK";

?>
