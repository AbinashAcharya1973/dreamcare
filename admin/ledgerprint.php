<?php
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
$_POST = json_decode(file_get_contents('php://input'), true);
	$templegno=$_POST['od'];
	$fdate=$_POST['frmDate'];
	$tdate=$_POST['toDate'];
	$ipadd=$_SERVER['REMOTE_ADDR'];
	$uid=$_POST['uid'];
$companydetails=$conn->query("select * from CompanyMaster");
if($companydetails->num_rows>0){
	if($row=$companydetails->fetch_assoc()){
		$companyname=$row['CompanyName'];$ContactNo=$row['ContactNo'];$Address=$row['Address1'];$EmailID=$row['EmailID'];$gstno=$row['gstno'];} else { $companyname='';$ContactNo=0;$Address=0;$EmailID=0;$gstno=0;
	}
}
$conn->query("insert into useractions (UserID,Module,ActionD,IPAdd) values(".$uid.",'Accounting','Ledger Print -".$od."','".$ipadd."')");
require('fpdf.php');

$daterange=false;
if($fdate!='' && $tdate!=''){
	$daterange=true;
}else{
	$daterange=false;
}
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetMargins(4,0,4);
$pdf->SetAutoPageBreak(true);
//order details
//echo "select * from OrderHead inner join OrderDetails on OrderHead.OrderID=OrderDetails.OrderID INNER JOIN ItemMaster on OrderDetails.ProductID=ItemMaster.ProductID where OrderHead.OrderID=".$tempordno;
if($daterange){
	$invoice=$conn->query("select * from LedgerMaster inner join ledgertran on LedgerMaster.AccID=ledgertran.Accid where LedgerMaster.AccID=".$templegno." and ledgertran.TDate between '".$fdate."' and '".$tdate."'");
}else{
	$invoice=$conn->query("select * from LedgerMaster inner join ledgertran on LedgerMaster.AccID=ledgertran.Accid where LedgerMaster.AccID=".$templegno);
}

if($invoice->num_rows>0){
	if($row=$invoice->fetch_assoc()){
		$accid=$row['AccID'];
		$name=$row['AccName'];$address=$row['Address1'].",".$row['Address1'];$Phone=$row['Phone'];$gstn=$row['GSTIN'];$Paks=$row['Pack'];$Free=$row['gstno'];$productid=$row['ProductID'];
	} else { $companyname='';$ContactNo=0;$Address=0;$EmailID=0;$gstn='';
	}
}
//Customer Details
/*$partydr=$conn->query("select * from users where AccID=".$acc);
if($partydr->num_rows>0){
	if($row=$partydr->fetch_assoc()){
		$name=$row['FirstName'];$address=$row['Address1'];$Phone=$row['Phone'];$email=$row['EmailID'];$gst=$row['GSTNo'];} else { $name='';$Phone=0;$address=0;$email=0;$gst=0;
	}
}*/
/*$orderd=$conn->query("select * from OrderHead where OrderID=".$orderid);
if($orderd->num_rows>0){
	if($row=$orderd->fetch_assoc()){
		$orderdate=$row['OrderDate'];} else { $orderdate='__/__/____';
	}
}
$itemp=$conn->query("select * from ItemMaster where ProductID=".$productid);
if($itemp->num_rows>0){
	if($row=$itemp->fetch_assoc()){
		$HSN=$row['HSN'];}
}
$pdf->Ln(.2);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'INVOICE-'.$tempinvno);
$pdf->Ln(7);
$pdf->Align('R');
$pdf->SetFont('Arial','',16);
$pdf->Cell(60,10,'Invoice No');
$pdf->Ln(8);
$pdf->Cell(20,10,'Invoice Type');
$pdf->Ln(9);
$pdf->Cell(50,10,'Product Type');*/
$lm=1;
//company details
$pdf->Ln(.2);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,0,$companyname,0,0,'C');
$pdf->Ln(8);
$pdf->Cell(0,0,$Address,0,0,'C');//companymaster,CompanyName
$pdf->Ln(8);
$pdf->SetFont('Arial','',14);
$pdf->Cell(40,0,'');
$pdf->Cell(30,0,'Phone No','C');$pdf->Cell(32,0,': '.$ContactNo);$pdf->Cell(2,0,', ');//companymaster.ContactNo
$pdf->Cell(20,0,'Email ID','C');$pdf->Cell(0,0,': '.$EmailID);//companymaster.EmailID
$pdf->Ln(8);
$pdf->Cell(20,0,'GSTN','C');$pdf->Cell(0,0,': '.$gstno);
$pdf->Line(0,14,210,14);
//$pdf->Line(0,20,10,20);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',14);
$pdf->Ln(10);
$pdf->Cell(0,0,'Ledger Statement',0,0,'C');
$pdf->Line(0,43,210,43);
$pdf->SetFont('Arial','',10);
$pdf->Ln(5);
$pdf->Cell(25,0,'Ledger A/C');$pdf->Cell(4,0,":");$pdf->Cell(101,0,$name);
//$pdf->Cell(20,0,'Tranaction No');$pdf->Cell(4,0,":");$pdf->Cell(40,0,$orderid);
$pdf->Ln(5);
$pdf->Cell(25,0,'Shop Name');$pdf->Cell(4,0,":");$pdf->Cell(101,0,$name);
$pdf->Ln(5);
$pdf->Cell(25,0,'Address');$pdf->Cell(4,0,":");$pdf->Cell(101,0,$address);
//$pdf->Cell(20,0,'Tranaction Date');$pdf->Cell(4,0,":");$pdf->Cell(40,0,$tdate);
$pdf->Ln(5);
$pdf->Cell(25,0,'Alter Address');$pdf->Cell(4,0,":");$pdf->Cell(101,0,$address);
$pdf->Ln(5);
$pdf->Cell(25,0,'Phone');$pdf->Cell(4,0,":");$pdf->Cell(101,0,$Phone);
$pdf->Ln(5);
$pdf->Cell(25,0,'Email');$pdf->Cell(4,0,":");$pdf->Cell(101,0,$email);
$pdf->Ln(5); 
$pdf->Cell(25,0,'GST');$pdf->Cell(4,0,":");$pdf->Cell(101,0,$gstn);
$pdf->SetFont('Arial','',7);
//invoice Details
if($daterange){
	$invoice=$conn->query("select * from LedgerMaster inner join ledgertran on LedgerMaster.AccID=ledgertran.Accid where LedgerMaster.AccID=".$templegno." and ledgertran.TDate between '".$fdate."' and '".$tdate."'");
}else{
	$invoice=$conn->query("select * from LedgerMaster inner join ledgertran on LedgerMaster.AccID=ledgertran.Accid where LedgerMaster.AccID=".$templegno);
}
$pdf->Ln(7);
$pdf->Cell(10,0,'Slno');$pdf->Cell(20,0,'Tranaction Date');$pdf->Cell(45,0,'Particulars');$pdf->Cell(20,0,'Voucher Type');
$pdf->Cell(20,0,'Voucher Slno');$pdf->Cell(20,0,'Dr',0,0,'C');$pdf->Cell(20,0,'Cr');$pdf->Cell(20,0,'Remarks');
//$pdf->Line(0,81,210,81);
$linepos=93;
$slno=1;
$totaldr=0;
$totalcr=0;
if($invoice->num_rows>0){
	while($row=$invoice->fetch_assoc()){
		$opbalance=$row['OBalance'];
		$opbalancetype=$row['BalanceType'];
		$pdf->Ln(5);
		$pdf->Cell(10,0,$slno);$pdf->Cell(20,0,$row['TDate']);$pdf->Cell(45,0,$row['Particulars']);$pdf->Cell(20,0,$row['VoucherType']);$pdf->Cell(20,0,$row['VoucherSlno'],0,0,'L');
		$pdf->Cell(14,0,nf($row['Dr'],2),0,0,'R');$pdf->Cell(14,0,nf($row['Cr'],2),0,0,'R');$pdf->Cell(20,0,$row['Remarks']);
		$totaldr+=$row['Dr'];
		$totalcr+=$row['Cr'];
		$linepos+=5;
		$slno++;
		$pdf->Line(0,$linepos,210,$linepos);
		if($linepos>=250){
			$pdf->AddPage();
			$linepos=12;
			$pdf->Ln(10);
			$pdf->Cell(10,0,'Slno');$pdf->Cell(20,0,'Tranaction Date');$pdf->Cell(45,0,'Particulars');$pdf->Cell(20,0,'Voucher Type');
			$pdf->Cell(20,0,'Voucher Slno');$pdf->Cell(20,0,'Dr');$pdf->Cell(20,0,'Cr');$pdf->Cell(20,0,'Remarks');
			$pdf->Line(0,$linepos,210,$linepos);
		}
				
	}
	if($daterange){
		$sql1=$conn->query("select * from LedgerMaster where AccID=".$templegno);
		if($sql1->num_rows>0){
			if($row=$sql1->fetch_assoc()){
				$obalance=$row['OBalance'];
				$balancetype=$row['BalanceType'];
			}
		}
		$sql = "SELECT sum(Dr) as total_dr,Sum(Cr) as total_cr FROM ledgertran where AccId=".$templegno." and TDate<'".$_REQUEST['frmDate']."'";
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
		$opbalancetype=$balancetype;
		if(($TotalCr+$ObalanceCr)>($TotalDr+$ObalanceDr)){
			$opbalance=($ObalanceCr+$TotalCr)-($TotalDr+$ObalanceDr);
		}
		if(($TotalDr+$ObalanceDr)>($TotalCr+$ObalanceCr)){
			$opbalance=($ObalanceDr+$TotalDr)-($TotalCr+$ObalanceCr);
		}
	}
	$pdf->Line(0,251,210,251);
	$pdf->SetY(255);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(115,0,"Opening Balance",0,0,'R');
		if($opbalancetype=="Dr")
		$pdf->Cell(20,0,nf($opbalance,2),0,0,'R'); else $pdf->Cell(20,0,"0.00",0,0,'R');
		if($opbalancetype=="Cr")
		$pdf->Cell(20,0,nf($opbalance,2),0,0,'R'); else $pdf->Cell(20,0,"0.00",0,0,'R');
		$pdf->Ln(5);
		$pdf->Cell(115,0,"Total",0,0,'R');$pdf->Cell(20,0,nf($totaldr,2),0,0,'R');$pdf->Cell(20,0,nf($totalcr,2),0,0,'R');
		$pdf->Ln(5);
		
			if($opbalancetype=="Dr"){
				$temptotaldr=$opbalance+$totaldr;
				$temptotalcr=$totalcr;
			}
			if($opbalancetype=="Cr"){
				$temptotalcr=$opbalance+$totalcr;
				$temptotaldr=$totaldr;
			}
			if($temptotaldr>$temptotalcr){
				$clbalancecr=$temptotaldr-$temptotalcr;
				$clbalancedr=0;
			}else{
				$clbalancedr=$temptotalcr-$temptotaldr;
				$clbalancecr=0;
			}
		
		
		$pdf->Cell(115,0,"Closing",0,0,'R');$pdf->Cell(20,0,nf($clbalancedr,2),0,0,'R');$pdf->Cell(20,0,nf($clbalancecr,2),0,0,'R');
	
}
$pdf->Output("F","pdfs/legprint-".$templegno.".pdf");

function nf($n,$d){
	return number_format($n,$d);
}
?>
