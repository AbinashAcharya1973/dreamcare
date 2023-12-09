<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
$_POST = json_decode(file_get_contents('php://input'), true);
	$temp_vno=$_POST['vid'];
$sql = "SELECT ReceiptHead.AccId as DrAcc,DATE(ReceiptHead.ReceiptDate) as RDate,ReceiptHead.Amount as Amount,ReceiptDetails.AccId as CrAcc,LedgerMaster.GroupID as GroupID,ReceiptHead.Narration as Remark FROM ReceiptHead inner join ReceiptDetails on ReceiptHead.ReceiptNo=ReceiptDetails.ReceiptNo inner join LedgerMaster on ReceiptDetails.AccId=LedgerMaster.AccID where ReceiptHead.ReceiptNo=".$temp_vno;
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
