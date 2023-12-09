<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename)or die("Could not connect to mysql".mysqli_error($con));
$AccId=$_POST['tempacid'];
	$party=$_POST['party'];
	$address1=$_POST['address1'];
	$address2=$_POST['address2'];
	$pincode=$_POST['pincode'];
	$phoneno=$_POST['phoneno'];
	$emailid=$_POST['emailid'];
	$gstn=$_POST['gstn'];
	$obalance=$_POST['obalance'];
	$obalancetype=$_POST['obalancetype'];
	$scode=$_POST['scode'];
echo "UPDATE LedgerMaster SET AccName='".$party."', Address1='".$address1."', Address2='".$address2."', Phone='".$phoneno."', GSTIN='".$gstn."', StateCode='".$scode."', OBalance='".$obalance."', BalanceType='".$obalancetype."' WHERE AccId=".$AccId;
$conn->query("UPDATE partycr SET Party='".$party."', Address='".$address1."', Address2='".$address2."', PINCode='".$pincode."', MobileNO='".$phoneno."', GSTN='".$gstn."', Email='".$emailid."' WHERE AccId=".$AccId); 
$conn->query("UPDATE LedgerMaster SET AccName='".$party."', Address1='".$address1."', Address2='".$address2."', Phone='".$phoneno."', GSTIN='".$gstn."', StateCode='".$scode."', OBalance='".$obalance."', BalanceType='".$obalancetype."' WHERE AccId=".$AccId);
//$conn->query("UPDATE partydr SET Party='".$StoreName."',Address='".$Address1."',Address2='".$Address2."',GSTN='".$GSTNo."',Password='".$Password."' where AccId=".$_REQUEST['AccID']);
/*$filename = $_FILES['file']['name'];
	// Valid file extensions
	$valid_extensions = array("jpg","jpeg","png","pdf");
	// File extension
	$extension = pathinfo($filename, PATHINFO_EXTENSION);
	// Check extension
	if(in_array(strtolower($extension),$valid_extensions) ) {
		$newfile=$UserID.".".$extension;
		if(move_uploaded_file($_FILES['file']['tmp_name'], "../profileimg/".$newfile)){
			$conn->query("update users set ProImg='profileimg/".$newfile."' WHERE UserID=".$UserID);
		}
	}
	else{	
	}
echo $_FILES['file']['tmp_name'];*/
?>
