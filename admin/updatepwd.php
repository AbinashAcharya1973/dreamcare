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
$ppwd = $_POST['cpwd'];
$npwd = $_POST['npwd'];
$memid = $_POST['memid'];
$result=$conn->query("select * from members where membercode='".$memid."' and pwd='".$ppwd."'");
if($result->num_rows>0){
    $sql = "update members set pwd='".$npwd."' where membercode='" . $memid."'";
    $conn->query($sql);
    $message="Password changed";
}else{
    $message="Password not Matched";
}
echo $message;
