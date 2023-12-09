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
global $data;
$data = array();
$_POST = json_decode(file_get_contents('php://input'), true);
$page = $_POST['page'];
$itemsPerPage = 10;
$offset = ($page - 1) * $itemsPerPage;

$sql = "SELECT * FROM members LIMIT $itemsPerPage OFFSET $offset";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($rec = $result->fetch_assoc()) {
        $newmem=array('memid' => $rec['memid'],
        'mname' => $rec['mname'],
        'membercode' => $rec['membercode'],
        'mobileno' => $rec['mobileno'],'referral' => $rec['totalreferral'],
        'joingindate'=>$rec['joingindate']);
        array_push($data, $newmem);        
    }
    //mysql_close($conn);
    //header("Access-Control-Allow-Origin: *");	
} else {
    array_push($data, "NOT", $sql);
}
echo json_encode($data);

?>