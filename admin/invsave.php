<?php
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename)or die("Could not connect to mysql".mysqli_error($con));
$_POST = json_decode(file_get_contents('php://input'), true);	
	$invhead=$_POST['invhead'];
	$invdetails=$_POST['invdetails'];
$BID=0;
$BN='HO';
$sqlphead="insert into invoicehead (InvDate,Party,AccID,TotalQty,TotalGross,TaxAmount,Freight,FreightTaxP,FreightTax,GrandTotal,totaldiscount,branchid,branchname) values";
$sqlphead=$sqlphead."('".$invhead['invdate']."','".$invhead['partyname']."',".$invhead['partyid'].",".$invhead['totalqty'].",".$invhead['totalgross'].",".$invhead['totalgstamt'].",".$invhead['freight'].",".$invhead['freightgst'].",".$invhead['freightamt'].",".$invhead['grandtotal'].",".$invhead['totaldiscount'].",".$BID.",'".$BN."')";

$conn->query($sqlphead);
$lastid=$conn->insert_id;
$RC=0;
$countRecords=count($invdetails);
$mrp=0;
while($RC<$countRecords){
    $sqlpdetails="insert into invoicedetails (InvNo,ProductID,BatchNO,ProductName,Units,Qty,SaleRate,Gross,disp,disamt,cd,TotalDis,TaxP,TaxAmount,MRP,Net) values";
    $sqlpdetails=$sqlpdetails."(".$lastid.",".$invdetails[$RC]["ProductID"].",'".$invdetails[$RC]["batchno"]."','".$invdetails[$RC]["ProductName"]."','Unit',".$invdetails[$RC]["qty"].",".$invdetails[$RC]["rate"].",".$invdetails[$RC]["gross"].",".$invdetails[$RC]["disp"].",".$invdetails[$RC]["dis"].",".$invdetails[$RC]["cd"].",".$invdetails[$RC]["tdis"].",".$invdetails[$RC]["gst"].",".$invdetails[$RC]["gstamt"].",".$invdetails[$RC]["MRP"].",".$invdetails[$RC]["netamt"].")";        
    //echo $sqlpdetails;
    $conn->query($sqlpdetails);
    //Stock Update Transaction
    $sqlstock="update stock set qty=qty-".$invdetails[$RC]["qty"]." where ProductID=".$invdetails[$RC]["ProductID"];
    $conn->query($sqlstock);
    $sqldetailsstock="select * from stockdetails where ProductID=".$invdetails[$RC]["ProductID"]." and batchno='".$invdetails[$RC]["batchno"]."'";
    $result=$conn->query($sqldetailsstock);
    if($result->num_rows>0){
        $conn->query("update stockdetails set qty=qty-".$invdetails[$RC]["qty"]." where ProductID=".$invdetails[$RC]["ProductID"]." and batchno='".$invdetails[$RC]["batchno"]."'");
    }else{
        
    }
    $RC++;
}


//Ledger Update
$conn->query("delete from ledgertran where VoucherType='Invoice' and VoucherSlno=".$lastid);
$lresult=$conn->query("select * from ledgermaster where AccName='SALES ACCOUNT'");

if($lresult->num_rows>0){ 
       
    if($rs=$lresult->fetch_assoc()){
        $temp_paccid=$rs['AccID'];
        $pgroupid=$rs['GroupID'];
        $temp_party_id=$invhead['partyid'];
        $res=$conn->query("select * from ledgermaster where AccID=".$temp_party_id);
        //echo "select * from ledgermaster where AccID=".$temp_party_id;

        if($res->num_rows>0){
            
            if($rs=$res->fetch_assoc()){
                $party_stcode=$rs['StateCode'];
                $party_group=$rs['GroupID'];
                //Tax ledgers
                //echo "1-";
                $res1=$conn->query("select * from ledgermaster where AccName='CGST'");
                if($res1->num_rows>0){
                    if($rec1=$res1->fetch_assoc()){
                        $cgst=$rec1['AccID'];
                    }
                }
                //echo "2-";
                $res1=$conn->query("select * from ledgermaster where AccName='SGST'");
                if($res1->num_rows>0){
                    if($rec1=$res1->fetch_assoc()){
                        $sgst=$rec1['AccID'];
                        $taxgroupid=$rec1['GroupID'];
                    }
                }
                //echo "3-";
                $res1=$conn->query("select * from ledgermaster where AccName='IGST'");
                if($res1->num_rows>0){
                    if($rec1=$res1->fetch_assoc()){
                        $igst=$rec1['AccID'];
                    }
                }
                $res1=$conn->query("select max(Slno) as max_sl from ledgermaster");
                if($res1->num_rows>0){
                    if($rec1=$res1->fetch_assoc()){
                        $slno=$rec1['max_sl']+1;
                    }
                }else{
                    $slno=1;
                }
                
                $taxable=$invhead['totalgross']-$invhead['totaldiscount'];
                $taxamount=$invhead['totalgstamt']+$invhead['freightgst'];
                $tdate=$invhead['pdate'];
                $partyname=$invhead['partyname'];
                
                //sales Ledger Entry
                $conn->query("insert into LedgerTran (TDate,Particulars,Dr,Cr,Balance,AccId,Remarks,VoucherType,VoucherSlno,GroupId,TranAccId) values('".$tdate."','By ".$partyname."',0,".$taxable.",0,".$temp_paccid.",'Remarks','Invoice',".$lastid.",".$pgroupid.",".$invhead['partyid'].")");
                //echo "insert into LedgerTran (TDate,Particulars,Dr,Cr,Balance,AccId,Remarks,VoucherType,VoucherSlno,GroupId,TranAccId) values('".$tdate."','By ".$partyname."',0,".$taxable.",0,".$temp_paccid.",'Remarks','Invoice',".$lastid.",".$pgroupid.",".$invhead['partyid'].")";
                $slno++;
                
                //Party Ledger Entry
                $conn->query("insert into LedgerTran (TDate,Particulars,Dr,Cr,Balance,AccId,Remarks,VoucherType,VoucherSlno,GroupId,TranAccId) values('".$tdate."','To Sales A/c',".$invhead['grandtotal'].",0,0,".$invhead['partyid'].",'Remarks','Invoice',".$lastid.",".$party_group.",".$temp_paccid.")");
                //echo "insert into LedgerTran (TDate,Particulars,Dr,Cr,Balance,AccId,Remarks,VoucherType,VoucherSlno,GroupId,TranAccId) values('".$tdate."','To Sales A/c',".$invhead['grandtotal'].",0,0,".$invhead['partyid'].",'Remarks','Invoice',".$lastid.",".$party_group.",".$temp_paccid.")";
                $slno++;
                
                
                //Tax Ledger Entry
                if($party_stcode==21){
                    //CGST
                    $conn->query("insert into LedgerTran (TDate,Particulars,Dr,Cr,Balance,AccId,Remarks,VoucherType,VoucherSlno,GroupId,TranAccId) values('".$tdate."','By ".$partyname."',0,".($taxamount/2).",0,".$cgst.",'Including FreightGST','Invoice',".$lastid.",".$taxgroupid.",".$invhead['partyid'].")");
                    
                    
                    //SGST
                    $conn->query("insert into LedgerTran (TDate,Particulars,Dr,Cr,Balance,AccId,Remarks,VoucherType,VoucherSlno,GroupId,TranAccId) values('".$tdate."','By ".$partyname."',0,".($taxamount/2).",0,".$sgst.",'Including FreightGST','Invoice',".$lastid.",".$taxgroupid.",".$invhead['partyid'].")");
                    
                }else{
                    $conn->query("insert into LedgerTran (TDate,Particulars,Dr,Cr,Balance,AccId,Remarks,VoucherType,VoucherSlno,GroupId,TranAccId) values('".$tdate."','By ".$partyname."',0,".$taxamount.",0,".$igst.",'Including FreightGST','Invoice',".$lastid.",".$taxgroupid.",".$invhead['partyid'].")");
                    
                }
                
                $famt=$invhead['freight'];
                
                if($famt>0){
                    $res1=$conn->query("select * from ledgermaster where AccName like 'FREIGHT%'");
                    if($res1->num_rows>0){
                        if($rec1=$res1->fetch_assoc()){
                            $freightac=$rec1['AccID'];
                            $freightg=$rec1['GroupID'];
                            $conn->query("insert into LedgerTran (TDate,Particulars,Dr,Cr,Balance,AccId,Remarks,VoucherType,VoucherSlno,GroupId,TranAccId) values('".$tdate."','By ".$partyname."',0,".$invhead['freight'].",0,".$freightac.",'Including FreightGST','Invoice',".$lastid.",".$freightg.",".$invhead['partyid'].")");
                            
                        }

                    }
                }
                
            }
        }
    }
}
echo $lastid;
?>