<?php
//header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
//header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
//header('Accept: application/json;charset=UTF-8');

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');

include 'dbconfig.php';
$conn = new mysqli($hostname, $username, $pwd, $databasename) or die("Could not connect to mysql" . mysqli_error($con));
//session_start();
$_POST = json_decode(file_get_contents('php://input'), true);
$data = $_POST['pfdata'];
//$sql = "update members set mname='".$data[0]['mname']."',address='".$data[0]['address']."',city_village='".$data[0]['city_village']."',pin='".$data[0]['pin']."',statecode=".$data[0]['statecode'].",aadhar='".$data[0]['aadhar']."',bankac='".$data[0]['bankac']."',ifsc='".$data[0]['ifsc']."',mobileno='".$data[0]['mobileno'] ."' where memid=" . $data[0]['memid'];
$sql = "update members set mname='".$data[0]['mname']."',address='".$data[0]['address']."',city_village='".$data[0]['city_village']."',pin='".$data[0]['pin']."',aadhar='".$data[0]['aadhar']."',bankac='".$data[0]['bankac']."',ifsc='".$data[0]['ifsc']."',mobileno='".$data[0]['mobileno'] ."' where memid=" . $data[0]['memid'];
$conn->query($sql);
$data = array();
/*if ($result->num_rows > 0) {
    //mysql_close($conn);
    //header("Access-Control-Allow-Origin: *");	
} else {
    array_push($data, "NOT", $sql);
}*/
//echo json_encode($data);
echo $sql;
?>
