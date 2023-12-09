<?php
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
$companydetails=$conn->query("select * from CompanyMaster");
if($companydetails->num_rows>0){
	if($row=$companydetails->fetch_assoc()){
		$companyname=$row['CompanyName'];$ContactNo=$row['ContactNo'];$Address=$row['Address1'];$EmailID=$row['EmailID'];$gstno=$row['gstno'];} else { $companyname='';$ContactNo=0;$Address=0;$EmailID=0;$gstno=0;
	}
}
//$conn->query("insert into useractions (UserID,Module,ActionD,IPAdd) values(".$uid.",'Accounting','Ledger Print -".$od."','".$ipadd."')");
require('fpdf.php');
$_POST = json_decode(file_get_contents('php://input'), true);
$invno=$_POST['invno'];
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetMargins(5,5,5);
$pdf->SetAutoPageBreak(true);



$lm=1;
//company details
$pdf->Ln(.2);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0,$companyname,0,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Ln(5);
$pdf->Cell(0,0,$Address,0,0,'L');//companymaster,CompanyName
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,0,'Phone No : '.$ContactNo,'L');
$pdf->Ln(5);
$pdf->Cell(20,0,'GSTN: '.$gstno,'L');
$pdf->Ln(3);
$pdf->Cell(0,0,$EmailID);
//$invno=$_REQUEST['invno'];
//$pdf->Line(0,20,10,20);
$pdf->SetFont('Arial','B',12);
$pdf->Ln(12);
$pdf->Cell(0,0,'TAX INVOICE',0,0,'C');
$pdf->Line(0,43,210,43);
$result=$conn->query("select * from invoicehead where invNo=".$invno);
if($result->num_rows>0){
	if($rs=$result->fetch_assoc()){
		$invdate=$rs['InvDate'];
		$partyid=$rs['AccId'];
		$totalqty=$rs['TotalQty'];
		$totalgross=$rs['TotalGross'];
		$totaldis=$rs['totaldiscount'];
		$totaltax=$rs['TaxAmount'];
		$totalnet=$rs['Net'];
		$taxablefreight=$rs['Freight'];
		$freighttaxP=$rs['FreightTaxP'];
		$freighttax=$rs['FreightTax'];
		$freight=$taxablefreight+$freighttax;
		$roundup=$rs['RndUp'];
		$grandtotal=$rs['GrandTotal'];
	}
}
$result=$conn->query("select * from partydr where AccID=".$partyid);
	if($result->num_rows>0){
		if($rec=$result->fetch_assoc())	{
			$address1=$rec['Address'];
			$address2=$rec['Address2'];
			$pin=$rec['PIN'];
			$pgstno=$rec['GSTN'];
			$mobileno=$rec['Mobile'];
			$partyname=$rec['Party'];
			$partystate=$rec['StateCode'];
		}
	}

$pdf->SetFont('Arial','B',10);
$pdf->Ln(10);
$pdf->Cell(110,0,'',0,0,'L');$pdf->Cell(60,0,'Invoice No:'.$invno,0,0,'L');
$pdf->Ln(5);
$pdf->Cell(110,0,'To Customer',0,0,'L');$pdf->Cell(60,0,'Invoice Date:'.$invdate,0,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Ln(5);
$pdf->Cell(110,0,$partyname,0,0,'L');$pdf->Cell(60,0,'',0,0,'L');
$pdf->Ln(5);
$pdf->Cell(110,0,$address1,0,0,'L');$pdf->Cell(60,0,'',0,0,'L');
$pdf->Ln(5);
$pdf->Cell(110,0,$address2,0,0,'L');$pdf->Cell(60,0,'',0,0,'L');
$pdf->Ln(5);
$pdf->Cell(110,0,"PIN:".$pin,0,0,'L');
$pdf->Ln(5);
$pdf->Cell(110,0,"GSTN:".$pgstno,0,0,'L');
$i=0;
$pdf->Line(0,85,210,85);
$pdf->Ln(8);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(10,0,'Sl.No',0,0,'L');$pdf->Cell(60,0,'Product Name',0,0,'L');$pdf->Cell(12,0,'HSN',0,0,'L');$pdf->Cell(15,0,'MRP',0,0,'C');$pdf->Cell(10,0,'Qty',0,0,'C');$pdf->Cell(15,0,'Rate',0,0,'V');$pdf->Cell(15,0,'Gross',0,0,'C');$pdf->Cell(15,0,'Dis',0,0,'C');$pdf->Cell(10,0,'Tax%',0,0,'C');$pdf->Cell(15,0,'Tax.Amt',0,0,'C');$pdf->Cell(15,0,'Net',0,0,'C');
$pdf->Line(0,91,210,91);
$line=91;
$counter=1;
$pdf->SetFont('Arial','',8);
$totalqty=0;
$result2=$conn->query("select * from invoicedetails inner join itemmaster on invoicedetails.ProductID=itemmaster.ProductID where invoicedetails.invno=".$invno);
while($r=$result2->fetch_assoc()){	
	$pdf->Ln(5);
	$pdf->Cell(10,0,$counter,0,0,'L');$pdf->Cell(60,0,$r['ProductName'],0,0,'L');$pdf->Cell(12,0,$r['BatchNO'],0,0,'L');$pdf->Cell(15,0,nf($r['MRP'],2),0,0,'R');$pdf->Cell(10,0,$r['Qty'],0,0,'R');$pdf->Cell(15,0,nf($r['SaleRate'],2),0,0,'R');$pdf->Cell(15,0,nf($r['Gross'],2),0,0,'R');$pdf->Cell(15,0,nf($r['TotalDis'],2),0,0,'R');$pdf->Cell(10,0,nf($r['TaxP'],2),0,0,'C');$pdf->Cell(15,0,nf($r['TaxAmount'],2),0,0,'R');$pdf->Cell(15,0,nf($r['Net'],2),0,0,'R');
	$totalqty=$r['Qty'];
	$totalnet=$totalnet+$r['Net'];
	$line+=5;
	if($line>265){		
		$pdf->AddPage();
		$pdf->Ln(7);
		$line=8;
		$pdf->Line(0,$line,210,$line);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(10,0,'Sl.No',0,0,'L');$pdf->Cell(60,0,'Product Name',0,0,'L');$pdf->Cell(12,0,'HSN',0,0,'L');$pdf->Cell(15,0,'MRP',0,0,'C');$pdf->Cell(10,0,'Qty',0,0,'C');$pdf->Cell(15,0,'Rate',0,0,'V');$pdf->Cell(15,0,'Gross',0,0,'C');$pdf->Cell(15,0,'Dis',0,0,'C');$pdf->Cell(10,0,'Tax%',0,0,'C');$pdf->Cell(15,0,'Tax.Amt',0,0,'C');$pdf->Cell(15,0,'Net',0,0,'C');
		$pdf->SetFont('Arial','',10);
		$line=14;
		$pdf->Line(0,$line,210,$line);
	}
	$counter++;
}
$line=240;
$pdf->SetY($line);
$pdf->SetFont('Arial','B',10);
$pdf->Ln(4);
$pdf->Line(0,$line,210,$line);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(10,0,'',0,0,'L');$pdf->Cell(60,0,'Total',0,0,'L');$pdf->Cell(12,0,'',0,0,'L');$pdf->Cell(15,0,'',0,0,'R');$pdf->Cell(10,0,$totalqty,0,0,'R');$pdf->Cell(15,0,'',0,0,'R');$pdf->Cell(15,0,nf($totalgross,2),0,0,'R');$pdf->Cell(15,0,nf($totaldis,2),0,0,'R');$pdf->Cell(10,0,'',0,0,'C');$pdf->Cell(15,0,nf($totaltax,2),0,0,'R');$pdf->Cell(15,0,nf($totalnet,2),0,0,'R');
$line+=6.5;
if($partystate==21){
	$cgst_sgst=$totaltax/2;
	$igst=0;
}else{
	$cgst_sgst=0;
	$igst=$totaltax;
}
$pdf->Line(0,$line,210,$line);
$pdf->SetFont('Arial','B',8);
$pdf->Ln(5);
$pdf->Cell(10,0,'',0,0,'L');$pdf->Cell(60,0,'',0,0,'L');$pdf->Cell(12,0,'',0,0,'L');$pdf->Cell(5,0,'',0,0,'R');$pdf->Cell(35,0,'Taxable Freight',0,0,'L');$pdf->Cell(15,0,$taxablefreight,0,0,'R');$pdf->Cell(40,0,'Freight',0,0,'L');$pdf->Cell(15,0,nf($freight,2),0,0,'R');
$pdf->Ln(4);
$pdf->Cell(10,0,'',0,0,'L');$pdf->Cell(20,0,'SGST',0,0,'L');$pdf->Cell(20,0,nf($cgst_sgst,2),0,0,'R');$pdf->Cell(20,0,'',0,0,'L');$pdf->Cell(12,0,'',0,0,'L');$pdf->Cell(5,0,'',0,0,'R');$pdf->Cell(35,0,'GST on Freight @18%',0,0,'L');$pdf->Cell(15,0,$freighttaxP,0,0,'R');$pdf->Cell(40,0,'Round Up',0,0,'L');$pdf->Cell(15,0,nf($roundup,2),0,0,'R');
$pdf->Ln(4);
$pdf->Cell(10,0,'',0,0,'L');$pdf->Cell(20,0,'CGST',0,0,'L');$pdf->Cell(20,0,nf($cgst_sgst,2),0,0,'R');$pdf->Cell(20,0,'',0,0,'L');$pdf->Cell(12,0,'',0,0,'L');$pdf->Cell(15,0,'',0,0,'R');$pdf->Cell(10,0,'',0,0,'R');$pdf->Cell(15,0,'',0,0,'R');$pdf->Cell(15,0,'',0,0,'R');$pdf->Cell(40,0,'Grand Total',0,0,'L');$pdf->Cell(15,0,nf($grandtotal,2),0,0,'R');
$pdf->Ln(4);
$pdf->Cell(10,0,'',0,0,'L');$pdf->Cell(20,0,'IGST',0,0,'L');$pdf->Cell(20,0,nf($igst,2),0,0,'R');$pdf->Cell(20,0,'',0,0,'L');
$pdf->SetFont('Arial','B',12);
$pdf->Ln(12);
$pdf->Cell(145,0,'',0,0,'L');$pdf->Cell(0,0,'For',0,0,'C');
$pdf->Ln(12);
$pdf->Cell(145,0,'',0,0,'L');$pdf->Cell(0,0,$companyname,0,0,'C');
$pdf->Output("F","pdfs/branchinv-".$invno.".pdf");
function nf($n,$d){
	return number_format($n,$d);
}
?>
