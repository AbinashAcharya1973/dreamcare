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
$tempamt = $_POST['amt'];
$slno = $_POST['id'];
$tdate = date("Y-m-d H:i:s");
$result=$conn->query("select * from withdrawreq where slno=".$slno);
if($result->num_rows>0){
    if($rec=$result->fetch_assoc()){
        $memid=$rec['memid'];
        $reqdate=$rec['reqdate' ];
    }
}

$conn->query("insert into ledger (tdate,particulars,withdrawal,memid,remarks) values('".$tdate."','By Transfer',".$tempamt.",".$memid.",'Request Date:".$reqdate."')");
$conn->query("update withdrawreq set status='Approved' where slno=".$slno);
echo "Transferred";
