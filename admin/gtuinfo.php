<?php
//header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
//header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
//header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
$_POST = json_decode(file_get_contents('php://input'), true);
$temploginid=$_POST['expt'];
$sql = "SELECT * FROM users where UserID=".$temploginid;
$result = $conn->query($sql);
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
