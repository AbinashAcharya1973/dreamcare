<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
$_POST = json_decode(file_get_contents('php://input'), true);
$temp_cramount=$_POST['cramount'];
$temp_selectedcracc=$_POST['selectedcracc'];
$temp_selecteddracc=$_POST['selecteddracc'];
$temp_vdate=$_POST['vdate'];
$temp_remarks=$_POST['remarks'];
$temp_editv=$_POST['edit'];
//cracc
//echo $temp_editv;
//echo $temp_vdate;
$result1=$conn->query("select * from LedgerMaster where AccID=".$temp_selectedcracc);
if($result1->num_rows>0){
    if($row=$result1->fetch_assoc()){
        $temp_craccname=$row['AccName'];
        $temp_craccgroupid=$row['GroupID'];
    }
}
$result1=$conn->query("select * from LedgerMaster where AccID=".$temp_selecteddracc);
if($result1->num_rows>0){
    if($row=$result1->fetch_assoc()){
        $temp_draccname=$row['AccName'];
        $temp_draccgroupid=$row['GroupID'];
    }
}
if($temp_editv){
    echo $temp_editv;
    $temp_vno=$_POST['vno'];
    $conn->query("update PaymentHead  set PDate='".$temp_vdate."',AccId=".$temp_selecteddracc.",AccName='".$temp_draccname."',Amount=".$temp_cramount.",Narration='".$temp_remarks."' where SlNo=".$temp_vno);
    $conn->query("update PaymentDetails set PDate='".$temp_vdate."',AccId=".$temp_selectedcracc.",AccName='".$temp_craccname."',Amount=".$temp_cramount." where SlNo=".$temp_vno);    
    $conn->query("delete from ledgertran Where VoucherType='Payment' and VoucherSlno=".$temp_vno);
    $conn->query("insert into ledgertran (TDate,Particulars,Dr,Cr,Balance,AccId,Remarks,VoucherType,VoucherSlno,GroupId,TranAccId) values('".$temp_vdate."','To ".$temp_draccname."',".$temp_cramount.",0,0,".$temp_selectedcracc.",'".$temp_remarks."','Payment',".$temp_vno.",".$temp_craccgroupid.",".$temp_selecteddracc.")");
    $conn->query("insert into ledgertran (TDate,Particulars,Dr,Cr,Balance,AccId,Remarks,VoucherType,VoucherSlno,GroupId,TranAccId) values('".$temp_vdate."','By ".$temp_craccname."',0,".$temp_cramount.",0,".$temp_selecteddracc.",'".$temp_remarks."','Payment',".$temp_vno.",".$temp_draccgroupid.",".$temp_selectedcracc.")");
}else{
    $conn->query("insert into PaymentHead (PDate,AccId,AccName,Amount,ParentTrn,ChildTran,Narration) values('".$temp_vdate."',".$temp_selecteddracc.",'".$temp_draccname."',".$temp_cramount.",'CREDIT','DEBIT','".$temp_remarks."')");    
    $last_vno=$conn->insert_id;
    $conn->query("insert into PaymentDetails (SlNo,PDate,AccId,AccName,Amount,TranType) values(".$last_vno.",'".$temp_vdate."',".$temp_selectedcracc.",'".$temp_craccname."',".$temp_cramount.",'DEBIT')");
    $conn->query("insert into ledgertran (TDate,Particulars,Dr,Cr,Balance,AccId,Remarks,VoucherType,VoucherSlno,GroupId,TranAccId) values('".$temp_vdate."','To ".$temp_draccname."',".$temp_cramount.",0,0,".$temp_selectedcracc.",'".$temp_remarks."','Payment',".$last_vno.",".$temp_craccgroupid.",".$temp_selecteddracc.")");
    $conn->query("insert into ledgertran (TDate,Particulars,Dr,Cr,Balance,AccId,Remarks,VoucherType,VoucherSlno,GroupId,TranAccId) values('".$temp_vdate."','By ".$temp_craccname."',0,".$temp_cramount.",0,".$temp_selecteddracc.",'".$temp_remarks."','Payment',".$last_vno.",".$temp_draccgroupid.",".$temp_selectedcracc.")");
    echo $last_vno;
}

//echo $_FILES['file']['tmp_name'];

?>
