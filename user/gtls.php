<?php
//header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
//header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
//header('Accept: application/json;charset=UTF-8');

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Accept: application/json;charset=UTF-8');
	
	include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename)or die("Could not connect to mysql".mysqli_error($con));
	//session_start();
$_POST = json_decode(file_get_contents('php://input'), true);
$temploginid=$_POST['expt'];
$rip=$_SERVER['REMOTE_ADDR'];
$sql = "SELECT * FROM userlog where LoginID='".$temploginid."' and IPAdd='".$rip."'";
$result = $conn->query($sql);
$data=array();
if ($result->num_rows > 0) {		
	$result1=$conn->query("select * from members where membercode='".$temploginid."'");
	if($result1->num_rows>0){
		if($rec=$result1->fetch_assoc()){
			$tempid=$rec['memid'];
			$tempname=$rec['mname'];
			$templname='';
			$tempstorename='';
			//$proimg=$rec['Proimg'];
			$proimg='';
			$status="YES";
			array_push($data,$status,$tempname,$tempid,$templname,$tempstorename,$proimg);
		}
	}
    	//mysql_close($conn);
	//header("Access-Control-Allow-Origin: *");	
}else{
	array_push($data,"NOT",$temploginid);
}
echo json_encode($data);
?>
