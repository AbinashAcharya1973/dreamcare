<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,'ordermanagement')or die("Could not connect to mysql".mysqli_error($con));
$result=$conn->query("select max(SlNo) as maxno from PaymentHead");
if($result->num_rows>0){
    if($rec=$result->fetch_assoc()){
        echo $rec['maxno'];
    }
}else{
    echo "0";
}
?>
