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
$pid=$_POST['pid'];
$memid=$_POST['memid'];
$sql = "SELECT * FROM rewarddetails inner join members on rewarddetails.memid=members.memid where rewarddetails.pid=".$pid." and rewarddetails.memid=".$memid;
$result = $conn->query($sql);
$data = array();
if ($result->num_rows > 0) {
    while ($rec = $result->fetch_assoc()) {
        $data[] = $rec;
    }
    //mysql_close($conn);
    //header("Access-Control-Allow-Origin: *");	
} else {
    array_push($data, "NOT", $sql);
}
echo json_encode($data);
