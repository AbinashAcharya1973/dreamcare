<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
$result=$conn->query("select ReceiptHead.ReceiptNo,ReceiptHead.AccName as ReceivedBy,ReceiptDetails.AccName as ReceivedFrom,ReceiptHead.Amount,ReceiptHead.ReceiptDate from ReceiptHead inner join ReceiptDetails on ReceiptHead.ReceiptNo=ReceiptDetails.ReceiptNo");
//echo $_FILES['file']['tmp_name'];
if($result->num_rows > 0) {
	$data=array();
	foreach ($result as $row){
		$data[]=$row;
	}
    	//mysql_close($conn);
	//header("Access-Control-Allow-Origin: *");
	echo json_encode($data);
}
?>