<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
$_POST = json_decode(file_get_contents('php://input'), true);
	$temp_vno=$_POST['vid'];
$sql = "SELECT PaymentHead.AccId as DrAcc,DATE(PaymentHead.PDate) as RDate,PaymentHead.Amount as Amount,PaymentDetails.AccId as CrAcc,LedgerMaster.GroupID as GroupID,PaymentHead.Narration as Remark FROM PaymentHead inner join PaymentDetails on PaymentHead.SlNo=PaymentDetails.SlNo inner join LedgerMaster on PaymentDetails.AccId=LedgerMaster.AccID where PaymentHead.SlNo=".$temp_vno;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$data=array();
	foreach ($result as $row){
		$data[]=$row;
	}
    	//mysql_close($conn);
	//header("Access-Control-Allow-Origin: *");
	echo json_encode($data);
}
?>
