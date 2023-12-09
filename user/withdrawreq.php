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
$temploginid = $_POST['expt'];
$reqamount=$_POST['amt'];
$otp=$_POST['otp'];
$joingindate = date("Y-m-d H:i:s");
$sql = "SELECT * FROM members where membercode='" . $temploginid . "'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    if ($rec = $result->fetch_assoc()) {
        $memid = $rec['memid'];
    }
}
$result=$conn->query("select * from otps where memcode='".$temploginid."' and otp='".$otp."'");
if($result->num_rows>0){
    $sql = "insert into withdrawreq (reqdate,memid,amount) values('".$joingindate."',".$memid.",".$reqamount.")";
    $conn->query($sql);
    $conn->query("delete from otps where memcode='".$temploginid."'");
    $msg="Request Submited";
}else{
    $msg="Invalid OTP";
}
echo $msg;
