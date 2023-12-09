<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
$_POST = json_decode(file_get_contents('php://input'), true);
	$lid=$_POST['ldgid'];
$ClosingCr=0;
$ClosingDr=0;
$ObalanceCr=0;
$ObalanceDr=0;
$balancetype='';
$obalance=0;
$TotalCr=0;
$TotalDr=0;
$sql1=$conn->query("select * from LedgerMaster where AccID=".$lid);
if($sql1->num_rows>0){
    if($row=$sql1->fetch_assoc()){
        $obalance=$row['OBalance'];
        $balancetype=$row['BalanceType'];
    }
}

$sql = "SELECT sum(Dr) as total_dr,Sum(Cr) as total_cr FROM ledgertran where AccId=".$lid." and TDate<'".$_REQUEST['frmDate']."'";
$result = $conn->query($sql);
if($result->num_rows>0){
    if($row=$result->fetch_assoc()){
        $TotalDr=$row['total_dr'];
        $TotalCr=$row['total_cr'];
    }
}
if($balancetype==='Cr') {
    $ObalanceCr=$obalance;
    
}else{$ObalanceCr=0;}
if($balancetype==='Dr') {
    $ObalanceDr=$obalance;
    
}else{$ObalanceDr=0;}
if(($TotalCr+$ObalanceCr)>($TotalDr+$ObalanceDr)){
   $ClosingCr=($ObalanceCr+$TotalCr)-($TotalDr+$ObalanceDr);
}
if(($TotalDr+$ObalanceDr)>($TotalCr+$ObalanceCr)){
    $ClosingDr=($ObalanceDr+$TotalDr)-($TotalCr+$ObalanceCr);
}
    mysql_close($conn);
	//header("Access-Control-Allow-Origin: *");
    $myObj = new stdClass();
    $myObj->OBalanceDr=$ObalanceDr;
    $myObj->OBalanceCr=$ObalanceCr;
    $myObj->ClosingDr=$ClosingDr;
    $myObj->ClosingCr=$ClosingCr;
    $myObj->BalanceType=$balancetype;
    //$myObj->TotalDr=$TotalDr;
    //$myObj->TotalCr=$TotalCr;
	echo json_encode($myObj);

?>