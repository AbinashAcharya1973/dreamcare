<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename)or die("Could not connect to mysql".mysqli_error($con));

$party=$_REQUEST['party'];
$address1=$_REQUEST['address1'];
$address2=$_REQUEST['address2'];
$pincode=$_REQUEST['pincode'];
$emailid=$_REQUEST['emailid'];
$phoneno=$_REQUEST['phoneno'];
$gstn=$_REQUEST['gstn'];
$obalance=$_REQUEST['obalance'];
$obalancetype=$_REQUEST['obalancetype'];
$scode=$_REQUEST['scode'];

$rec1=$conn->query("select * from groups where GroupName='Sundry Creditor'");
if($rec1->num_rows>0){
	if($res=$rec1->fetch_assoc()){
		$temp_tran_type = $res["GroupNature"];
		$groupid=$res["GroupID"];
	}
}
$conn->query("insert into LedgerMaster (AccName,GroupID,Dr,Cr,TransactionType,OBalance,BalanceType,Groupname,GSTIN,statecode,Phone,Address1,Address2) values('".$party."',".$groupid.",'-','+','".$temp_tran_type."',".$obalance.",'".$obalancetype."','Sundry Creditor','".$gstn."',".$scode.",'".$phoneno."','".$address1."','".$address2."')");
//echo "insert into LedgerMaster (AccName,GroupID,Dr,Cr,TransactionType,OBalance,BalanceType,Groupname,GSTIN,statecode,Phone) values('".$party."',".$groupid.",'-','+','".$temp_tran_type."',".$obalance.",'".$obalancetype."','Sundry Creditor','".$gstn."',".$scode.",'".$phoneno."')";
$lastid=$conn->insert_id;
$conn->query("insert into partycr (AccId,Party,Address,Address2,Phone,GSTN,StateCode,PINCode,MobileNO,Email) values(".$lastid.",'".$party."','".$address1."','".$address2."','".$phoneno."','".$gstn."',".$scode.",'".$pincode."','".$phoneno."','".$emailid."')");
//$conn->query("insert into users (FirstName,StoreName,MobileNO,EmailID,Address1,Address2,PINCode,GSTNo,UserType,AccID) values('".$party."','".$party."','".$phoneno."','".$emailid."','".$address1."','".$address2."','".$pincode."','".$gstn."','s',".$lastid.")");


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
