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
$id=$_POST['exp'];
$result=$conn->query("select * from members where membercode='".$id."'");
if($result->num_rows>0){
    if($rec=$result->fetch_assoc()){
        $memid=$rec['memid'];
    }
}
$myObj->memcount=fetchMembers($conn, $memid);

$result=$conn->query("select count(memid) as memcount from members where sponsorid=".$memid);
if($result->num_rows>0){
    if($rec=$result->fetch_assoc()){
        $myObj->direct=$rec['memcount'];        
    }
}
$result5=$conn->query("select max(payoutid) as maxpid from payoutdetails");
if($result5->num_rows>0){
    if($rec=$result5->fetch_assoc()){
        $maxid=$rec['maxpid'];
    }
}
$result=$conn->query("select * from payoutdetails where memid=".$memid." and payoutid=".$maxid);
if($result->num_rows>0){
    if($rec=$result->fetch_assoc()){
        $myObj->totalin=$rec['totalincome'];
        $myObj->levelin=$rec['levelincome'];
        $myObj->mbonus=$rec['MBonus'];
    }
}
$myObj->temmem=0;
/*$result=$conn->query("select count(memid) as memcount from members where sponsorid!=1");
if($result->num_rows>0){
    if($rec=$result->fetch_assoc()){
        $myObj->temmem=$rec['memcount'];        
    }
}*/
function fetchMembers($conn, $parentID = 0)
{
    $sql = "SELECT memid, mname,membercode FROM members WHERE sponsorid = $parentID";
    $result = $conn->query($sql);
    $members=0;
    $sublevel=false;
    if ($result->num_rows > 0) {
        $members++;
        while ($row = $result->fetch_assoc()) {                        
            $c = fetchMembers($conn, $row['memid']);
            $members+=$c;
            //$members[] = $row;
            /*if($c==1){
                if($sublevel){

                }else{
                    $sublevel=true;
                }
            }*/
            
        }
        /*if($sublevel){
            $members++;
        }*/
    }

    return $members;
}
header("Content-Type: application/json");
echo json_encode($myObj, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
?>
