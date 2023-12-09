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


$id=$_POST['exp'];
$data=array();
$result=$conn->query("select * from members where membercode='".$id."'");
if($result->num_rows > 0){
    if($r1=$result->fetch_assoc()){
        $tempmemid=$r1['memid'];
        $res1=$conn->query("select * from withdrawreq where memid=".$tempmemid);
        if($res1->num_rows > 0){
            while($rec=$res1->fetch_assoc()){
                $data[]=$rec;
            }
        }
    }
}

header("Content-Type: application/json");
echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
?>
