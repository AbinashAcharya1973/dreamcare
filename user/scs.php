<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
$_POST = json_decode(file_get_contents('php://input'), true);
$rtype=$_POST['stext'];
$subcategory=$_POST['sc'];
$result=$conn->query("select * from Category where CategoryID=".$rtype);
if($result->num_rows>0){
	if($rec=$result->fetch_assoc()){
		$temp_category=$rec['Category'];
		$result=$conn->query("select * from Subcategory where Subcategory='".$subcategory."'");
		if($result->num_rows>0){
			echo "Already Exists";
		}else{
			$conn->query("insert into Subcategory (CategoryID,Category,Subcategory) values(".$rtype.",'".$temp_category."','".$subcategory."')");
			echo "Subcategory Added Successfully";
		}
	}
}

echo $subcategory;

?>
