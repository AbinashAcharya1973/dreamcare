<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename)or die("Could not connect to mysql".mysqli_error($con));

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

$rec1=$conn->query("select * from groups where GroupName='Sundry Debtor'");
if($rec1->num_rows>0){
	if($res=$rec1->fetch_assoc()){
		$temp_tran_type = $res["GroupNature"];
		$groupid=$res["GroupID"];
	}
}
$conn->query("insert into LedgerMaster (AccName,GroupID,Dr,Cr,TransactionType,OBalance,BalanceType,Groupname,GSTIN,statecode,Address1,Address2) values('".$party."',".$groupid.",'-','+','".$temp_tran_type."',".$obalance.",'".$obalancetype."','Sundry Debtor','".$gstn."',".$scode.",'".$address1."','".$address2."')");

$lastid=$conn->insert_id;
$conn->query("insert into partydr (AccId,Party,Address,Address2,Phone,GSTN,StateCode,Email,Pin,Mobile,OpBalance,OpType) values(".$lastid.",'".$party."','".$address1."','".$address2."','".$phoneno."','".$gstn."',".$scode.",'".$emailid."','".$pincode."','".$phoneno."',".$obalance.",'".$obalancetype."')");
//$conn->query("insert into users (FirstName,StoreName,MobileNO,EmailID,Address1,Address2,PINCode,GSTNo,UserType,AccID,Address1,Address2) values('".$party."','".$party."','".$phoneno."','".$emailid."','".$address1."','".$address2."','".$pincode."','".$gstn."','r',".$lastid.",'".$address1."','".$address2."')");
//$r="insert into partydr (AccId,Party,Address,Address2,Phone,GSTN,StateCode,Email,Pin,Mobile) values(".$lastid.",'".$party."','".$address1."','".$address2."','".$phoneno."','".$gstn."',".$scode.",'".$emailid."','".$pincode."','".$phoneno."')";
//echo "Ok";

//error_log(print_r($r,true));
//echo "insert into partydr (AccId,Party,Address,Address2,Phone,GSTN,StateCode,Email,Pin,Mobile) values(".$lastid.",'".$party."','".$address1."','".$address2."','".$phoneno."','".$gstn."',".$scode.",'".$emailid."','".$pincode."','".$phoneno."')";

/*if($result){
	$lastid=$conn->insert_id;	
	$conn->query("INSERT INTO stock (Category, Subcategory, Itemname,brand,barcode,size,MRP,PRate,Qty,ProductID,Tax,Lose,UnitType,SaleRate,HSN,Taxslab) values('".$category."','".$subcategory."','".$temp_pname."','".$brandname."','','size',".$temp_mrp.",".$pprice.",".$temp_oqty.",".$lastid.",".$temp_tax.",0,'".$unit."',".$sprice.",'".$hsn."','N')");

$filename = $_FILES['file']['name'];
	// Valid file extensions
	$valid_extensions = array("jpg","jpeg","png","pdf");
	// File extension
	$extension = pathinfo($filename, PATHINFO_EXTENSION);
	// Check extension
	if(in_array(strtolower($extension),$valid_extensions) ) {
		$newfile=$lastid.".".$extension;
		if(move_uploaded_file($_FILES['file']['tmp_name'], "../product_img/".$newfile)){
			$conn->query("update ItemMaster set PrImage='product_img/".$newfile."' where ProductID=".$lastid);
		}
	}
}
else{	
}*/	
//echo $_FILES['file']['tmp_name'];
echo $lastid;
?>