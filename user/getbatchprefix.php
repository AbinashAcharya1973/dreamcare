<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename)or die("Could not connect to mysql".mysqli_error($con));

$res =$conn->query("SELECT BatchPrefix FROM prefixcodes");
if($res->num_rows>0){
    if($rs=$res->fetch_assoc()){
        echo $rs['BatchPrefix'];
    }
}
?>