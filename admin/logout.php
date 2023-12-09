<?php
header("Location: login");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename)or die("Could not connect to mysql".mysqli_error($con));
session_start();
$_POST = json_decode(file_get_contents('php://input'), true);
$temploginid=$_POST['sdf'];
$sql = "delete FROM userlog where LoginID='".$temploginid."'";
$result = $conn->query($sql);
session_unset();
session_destroy();
echo "1".$sql;

?>