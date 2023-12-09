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

function fetchMembers($conn, $parentID = 0) {
    $sql = "SELECT memid, mname,membercode FROM members WHERE sponsorid = $parentID";
    $result = $conn->query($sql);
    $members = array();

    while ($row = $result->fetch_assoc()) {
        $row['children'] = fetchMembers($conn, $row['memid']);
        $members[] = $row;
    }

    return $members;
}

$tree = fetchMembers($conn);

$conn->close();

header("Content-Type: application/json");
echo json_encode($tree);
?>
