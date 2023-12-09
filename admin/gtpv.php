<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
$result=$conn->query("select PaymentHead.SlNo,PaymentHead.AccName as ReceivedBy,PaymentDetails.AccName as ReceivedFrom,PaymentHead.Amount,PaymentHead.PDate from PaymentHead inner join PaymentDetails on PaymentHead.SlNo=PaymentDetails.SlNo");
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
