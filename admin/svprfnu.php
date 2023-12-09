<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
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
	$BID=$_POST['BranchID'];
	$BName=$_POST['BName'];
	$ZID=$_POST['ZoneID'];
	$ZName=$_POST['ZName'];
	$STCode=$_POST['IStateCode'];
	$STName=$_POST['IStateN'];
$result=$conn->query("select * from users where MobileNO='".$MobileNo."'");
if($result->num_rows>0){
	echo "NO";
}else{
	if($UType=='s'){
			$conn->query("insert into users (FirstName,LastName,StoreName,MobileNO,WhatsappNO,EmailID,Address1,Address2,PINCode,GSTNo,UserType,Password,BranchID,BranchName,ZoneID,Zone,IState,IStateC) values('".$FirstName."','".$LastName."','".$StoreName."','".$MobileNo."','".$WhatsappNo."','".$EmailID."','".$Address1."','".$Address2."','".$PINCode."','".$GSTNo."','".$UserType."','".$Password."',".$BID.",'".$BName."',".$ZID.",'".$ZName."','".$STName."',".$STCode.")");
			$lastid=$conn->insert_id;
			$r="insert into users (FirstName,LastName,StoreName,MobileNO,WhatsappNO,EmailID,Address1,Address2,PINCode,GSTNo,UserType,Password) values('".$FirstName."','".$LastName."','".$StoreName."','".$MobileNo."','".$WhatsappNo."','".$EmailID."','".$Address1."','".$Address2."','".$PINCode."','".$GSTNo."','".$UserType."','".$Password."')";
			error_log(print_r($r,true));
	}
	if($UType=='k'){
			$conn->query("insert into users (FirstName,LastName,StoreName,MobileNO,WhatsappNO,EmailID,Address1,Address2,PINCode,GSTNo,UserType,Password) values('".$FirstName."','".$LastName."','".$StoreName."','".$MobileNo."','".$WhatsappNo."','".$EmailID."','".$Address1."','".$Address2."','".$PINCode."','".$GSTNo."','".$UserType."','".$Password."')"); 
			$lastid=$conn->insert_id;
			
	}
}

$filename = $_FILES['file']['name'];
	// Valid file extensions
	$valid_extensions = array("jpg","jpeg","png","pdf");
	// File extension
	$extension = pathinfo($filename, PATHINFO_EXTENSION);
	// Check extension
	if(in_array(strtolower($extension),$valid_extensions) ) {
		$newfile=$lastid.".".$extension;
		if(move_uploaded_file($_FILES['file']['tmp_name'], "../profileimg/".$newfile)){
			$conn->query("update users set Proimg='profileimg/".$newfile."' where UserID=".$lastid);
		}
	}
echo($lastid);	

?>
