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

$myObj = new stdClass();
$myObj->memcount = 0;
$myObj->direct=0;
$myObj->temmem=0;

$result=$conn->query("select count(memid) as memcount from members");
if($result->num_rows>0){
    if($rec=$result->fetch_assoc()){
        $myObj->memcount=$rec['memcount'];        
    }
}
$result=$conn->query("select count(memid) as memcount from members where sponsorid=1");
if($result->num_rows>0){
    if($rec=$result->fetch_assoc()){
        $myObj->direct=$rec['memcount'];        
    }
}
$result=$conn->query("select count(memid) as memcount from members where sponsorid!=1");
if($result->num_rows>0){
    if($rec=$result->fetch_assoc()){
        $myObj->temmem=$rec['memcount'];        
    }
}
header("Content-Type: application/json");
echo json_encode($myObj, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
?>
