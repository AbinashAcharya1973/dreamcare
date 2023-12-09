<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
$unitname=$_POST['unitname'];
	$groupname=$_POST['groupname'];
	$cvalue=$_POST['cvalue'];
	$parentid=$_POST['punit'];
$result=$conn->query("select * from UnitMaster where UnitName='".$unitname."'");
if($result->num_rows>0){
	echo "Unit Name Already Exists";
}else{
	$result=$conn->query("select max(UnitID) as max_unit from UnitMaster where GroupName='".$groupname."'");
	if($result->num_rows>0){
		if($row=$result->fetch_assoc()){
			$tempmaxid=$row['max_unit']+1;
		}
	}else{
		$tempmaxid=1;
	}
	$qstatus=$conn->query("insert into UnitMaster (MasterID,ConversionV,UnitName,GroupName) values(".$parentid.",".$cvalue.",'".$unitname."','".$groupname."')");
	if($qstatus){
		echo "Unit Added Successfully";
	}else{
		echo "Error";
        
	}
}



?>
