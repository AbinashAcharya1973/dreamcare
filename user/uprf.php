<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
//echo $uid;
$FirstName=$_POST['FirstName'];
	$LastName=$_POST['LastName'];
	$StoreName=$_POST['StoreName'];
	$MobileNo=$_POST['MobileNo'];
	$UserType=$_POST['UserType'];
	$WhatsappNo=$_POST['WhatsappNo'];
	$EmailID=$_POST['EmailID'];
	$Address1=$_POST['Address1'];
	$Address2=$_POST['Address2'];
	$PINCode=$_POST['PINCode'];
	$GSTNo=$_POST['GSTNo'];
	$Password=$_POST['Password'];
	$UType=$_POST['UserType'];
	$uid=$_POST['uid'];
	$BID=$_POST['BranchID'];
	$BName=$_POST['BName'];
	$ZID=$_POST['ZoneID'];
	$ZName=$_POST['ZName'];
	$STCode=$_POST['IStateCode'];
	$STName=$_POST['IStateN'];
$ustatus=$conn->query("update users set FirstName='".$FirstName."',LastName='".$LastName."',StoreName='".$StoreName."',MobileNO='".$MobileNo."',WhatsappNO='".$WhatsappNo."',EmailID='".$EmailID."',Address1='".$Address1."',Address2='".$Address2."',PINCode='".$PINCode."',GSTNo='".$GSTNo."',UserType='".$UserType."',Password='".$Password."',BranchID=".$BID.",BranchName='".$BName."',ZoneID=".$ZID.",Zone='".$ZName."',IState='".$STName."',IStateC=".$STCode." where UserID=".$uid);
if($ustatus){
    echo "OK";
}else{
    echo "error";
}

?>
