<?php
include 'dbconfig.php';
$conn = new mysqli($hostname, $username, $pwd, $databasename) or die("Could not connect to mysql" . mysqli_error($con));
$_POST = json_decode(file_get_contents('php://input'), true);
$amt = $_POST['amt'];
$memcode = $_POST['id'];
$trdate = $_POST['tdate'];
$remarks = $_POST['remarks'];
//$trdate = $_SERVER['REMOTE_ADDR'];
$myObj = new stdClass();
$myObj->amt=$amt;
$myObj->memcode=$memcode;
$myObj->trdate=$trdate;
$myObj->remarks=$remarks;
$result1=$conn->query("select * from members where membercode='".$memcode."'");
if($result1->num_rows>0){
	if($rows=$result1->fetch_assoc()){
		$memid=$rows['memid'];
	}
	$sql="insert into invledger (tdate,particulars,income,remarks,memid) values('".$trdate."','Received@Purchase',".$amt.",'".$remarks."',".$memid.")";
	if($conn->query($sql)===true) {
		$message="OK";
		$conn->query("update members set mactive='Y' where memid=".$memid);
	}else{
		$message="Error: ".$conn->error;
	}	
}else{
	$message="Invalid MemberCode";
}
//$myJson=json_encode($myObj,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
//header("Content-Type: application/json");
//echo json_encode($myObj, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
echo $message;
