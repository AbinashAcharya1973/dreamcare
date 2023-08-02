<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
$temp_mrp=$_POST['mrp'];
	$temp_cid=$_POST['Cid'];
	$temp_sid=$_POST['Sid'];
	$temp_pname=$_POST['pname'];
	$temp_hsn=$_POST['hsn'];
	$temp_tax=$_POST['tax'];
	$temp_oqty=$_POST['oqty'];
	$sprice=$_POST['salerate'];
	$unit=$_POST['unit'];
	$brandid=$_POST['Brandid'];
	$pprice=$_POST['printingcharge'];
	$productid=$_POST['prcid'];
	$sku=$_POST['sku'];
	$rackno=$_POST['rackno'];
	$printingc=$_POST['printingcharge'];
	$weight=$_POST['weight'];
	$pcolor=$_POST['TColor'];
	$des=$_POST['Description'];
	$warranty=$_POST['Warranty'];
$cresult=$conn->query("select * from Category where CategoryID=".$temp_cid);
if($cresult->num_rows>0){
	if($rs=$cresult->fetch_assoc()){
		$category=$rs['Category'];			
	}
}
$sresult=$conn->query("select * from Subcategory where SubcategoryID=".$temp_sid);
if($sresult->num_rows>0){
	if($rs=$sresult->fetch_assoc()){
		$subcategory=$rs['Subcategory'];			
	}
}
$cresult=$conn->query("select * from Brands where BrandID=".$brandid);
if($cresult->num_rows>0){
	if($rs=$cresult->fetch_assoc()){
		$brandname=$rs['BrandName'];			
	}
}
//
$result=$conn->query("update ItemMaster set ItemName='".$temp_pname."',MRP=".$temp_mrp.",TaxP=".$temp_tax.",OpeningStock=".$temp_oqty.",CategoryID=".$temp_cid.",
SubcategoryID=".$temp_sid.",SalePrice=".$sprice.",Unit='".$unit."',PrintingCharge=".$pprice.",HSN='".$temp_hsn."',Category='".$category."',
Subcategory='".$subcategory."',BrandID=".$brandid.",SKU='".$sku."',RackNo='".$rackno."',Weight=".$weight.",PrintingCharge=".$pprice.",TColor='".$pcolor."',Description='".$des."',Warranty=".$warranty." where ProductID=".$productid);

$result=$conn->query("update stock set Itemname='".$temp_pname."',MRP=".$temp_mrp.",Tax=".$temp_tax.",SaleRate=".$sprice.",UnitType='".$unit."',HSN='".$temp_hsn."',Category='".$category."',
Subcategory='".$subcategory."',SKU='".$sku."',RackNo='".$rackno."',Weight=".$weight.",TColor='".$pcolor."' where ProductID=".$productid);

$filename = $_FILES['file']['name'];
	// Valid file extensions
	$valid_extensions = array("jpg","jpeg","png","pdf");
	// File extension
	$extension = pathinfo($filename, PATHINFO_EXTENSION);
	// Check extension
	if(in_array(strtolower($extension),$valid_extensions) ) {
		$newfile=$productid.".".$extension;
		if(move_uploaded_file($_FILES['file']['tmp_name'], "../product_img/".$newfile)){
			$conn->query("update ItemMaster set PrImage='product_img/".$newfile."' where ProductID=".$productid);
		}
	}

echo "update ItemMaster set ItemName='".$temp_pname."',MRP=".$temp_mrp.",TaxP=".$temp_tax.",OpeningStock=".$temp_oqty.",CategoryID=".$temp_cid.",
SubcategoryID=".$temp_sid.",SalePrice=".$sprice.",Unit='".$unit."',PrintingCharge=".$pprice.",HSN='".$temp_hsn."',Category='".$category."',
Subcategory='".$subcategory."',BrandID=".$brandid.",PrintingCharge=,SKU='".$sku."',RackNo='".$rackno."',Weight=".$weight.",PrintingCharge=".$printingc.",Description='".$des."',Warranty=".$warranty." where ProductID=".$productid;

//echo "update ItemMaster set PrImage='product_img/".$newfile."' where ProductID=".$productid;


//echo $_FILES['file']['tmp_name'];
?>
