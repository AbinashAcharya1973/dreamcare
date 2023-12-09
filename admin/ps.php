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
	$sku=$_POST['sku'];
	$rno=$_POST['rackno'];
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
$result=$conn->query("select * from ItemMaster where ItemName='".$temp_pname."'");
if($result->num_rows>0){
	echo "The Product Name Is Already Exists";
}else{
	$result=$conn->query("insert into ItemMaster (ItemName,MRP,TaxP,OpeningStock,CategoryID,SubcategoryID,SalePrice,Unit,PrintingCharge,HSN,Category,Subcategory,BrandID,SKU,RackNo,Weight,TColor,Description,Warranty) values('".$temp_pname."',".$temp_mrp.",".$temp_tax.",".$temp_oqty.",".$temp_cid.",".$temp_sid.",".$sprice.",'".$unit."',".$pprice.",'".$temp_hsn."','".$category."','".$subcategory."',".$brandid.",'".$sku."','".$rno."',".$weight.",'".$pcolor."','".$des."',".$warranty.")");
	if($result){		
		$lastid=$conn->insert_id;

		$conn->query("INSERT INTO stock (Category, Subcategory, Itemname,brand,barcode,size,MRP,PRate,Qty,ProductID,Tax,Lose,UnitType,SaleRate,HSN,Taxslab,SKU,RackNo,Weight,TColor) values('".$category."','".$subcategory."','".$temp_pname."','".$brandname."','','size',".$temp_mrp.",".$pprice.",".$temp_oqty.",".$lastid.",".$temp_tax.",0,'".$unit."',".$sprice.",'".$hsn."','N','".$sku."','".$rno."',".$weight.",'".$pcolor."')");

	$filename = $_FILES['file']['name'];
		// Valid file extensions
		$valid_extensions = array("jpg","jpeg","png","pdf");
		// File extension
		$extension = pathinfo($filename, PATHINFO_EXTENSION);
		// Check extension
		if(in_array(strtolower($extension),$valid_extensions) ) {
			$newfile=$lastid.".".$extension;
			if(move_uploaded_file($_FILES['file']['tmp_name'], "product_img/".$newfile)){
				$conn->query("update ItemMaster set PrImage='product_img/".$newfile."' where ProductID=".$lastid);
			}
		}
	}
	else{
	}
}

//echo $_FILES['file']['tmp_name'];
?>
