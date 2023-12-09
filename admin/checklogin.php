<?php

include 'dbconfig.php';
include 'app.php';
$conn = new mysqli($hostname, $username, $pwd, $databasename) or die("Could not connect to mysql" . mysqli_error($con));

$uid = $_POST['userid'];
$pwd1 = $_POST['password'];
$rip = $_SERVER['REMOTE_ADDR'];
$myObj = new stdClass();

$res = $conn->query("select * from staffs where username='" . $uid . "' and pwd='" . $pwd1 . "'");

if ($res->num_rows > 0) {
	if ($rec = $res->fetch_assoc()) {
		$myObj->UT = "";
		$myObj->Status = 1;		
		$myObj->origin = 1;
		$myObj->BID = 1;
		$myObj->BName = 'admin';
		$_SESSION["uid"] = $uid;
		$_SESSION["Password"] = $pwd1;
		$myObj->UT = 'admin';
		$myObj->msg = "true";
		$myObj->ptx = "index.php";
		$myObj->origin = 0;
	}
} else {
	$myObj->UT = "";
	$myObj->msg = "User ID or Password was Incorrect" . $sql;
	$conn->query("insert into userlogbk (LoginID,IPAdd) values('" . $uid . "','" . $rip . "')");
}
//$myJson=json_encode($myObj,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
header("Content-Type: application/json");
echo json_encode($myObj, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
//echo $myJson
