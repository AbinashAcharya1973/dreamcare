<?php
require_once 'fpdf.php'; // Include the fpdf library
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
$result=$conn->query("SELECT * from members WHERE memid =".$_GET['memid']);
if ($result->num_rows > 0){
    if($rec=mysqli_fetch_array($result))
    {
        $candidateName = $rec['mname'];
        $registrationNumber = $rec['membercode'];
        $registrationDate = date('d-m-Y');

    }
}
// Fetch candidate data from the database or provide dummy data

// Create a new PDF instance
$pdf = new FPDF();

// Add a new page to the PDF
$pdf->AddPage();

// Set font and font size for the company name and address
$pdf->SetFont('Arial', 'B', 16);

// Set the position for the company logo (top-left corner)
$pdf->Image('img/logo.png', 10, 10, 50); // x, y, width, height

// Add the company name and address
$pdf->Cell(0, 10, 'Dream Care Solution', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'b07, Chandaka Meadows, BBSR-754012', 0, 1, 'C');

// Set font and font size for contact details
$pdf->SetFont('Arial', '', 12);

// Add contact number, email address, and website address
$pdf->Cell(0, 10, 'Contact No: +1 (123) 456-7890', 0, 1, 'C');
$pdf->Cell(0, 10, 'Email: dreamcaresolution@yahoo.com', 0, 1, 'C');
$pdf->Cell(0, 10, 'Website: www.dreamcaresolution.in', 0, 1, 'C');

// Set the position and size for the page border (leave space for the header)
$pageBorderX = 10; // x-coordinate of the border
$pageBorderY = 10; // y-coordinate of the border
$pageBorderWidth = 190; // width of the border
$pageBorderHeight = 250; // height of the border

// Draw page border
$pdf->Rect($pageBorderX, $pageBorderY, $pageBorderWidth, $pageBorderHeight); // x, y, width, height

// Set font and font size for the certificate title
$pdf->SetFont('Arial', 'B', 18);

// Add the certificate title
$pdf->Cell(0, 20, 'Registration Certificate', 0, 1, 'C');

// Set font for the certificate details
$pdf->SetFont('Arial', '', 14);

// Add candidate name
$pdf->Cell(0, 10, 'This is to certify that', 0, 1, 'C');
$pdf->Ln(5); // Add some space between lines
$pdf->Cell(0, 10, $candidateName, 0, 1, 'C');

// Add registration number and date
$pdf->Ln(15); // Add some space between lines
$pdf->Cell(0, 10, 'has been registered with the following details:', 0, 1, 'C');
$pdf->Ln(8); // Add some space between lines
$pdf->Cell(0, 10, 'Registration Number: ' . $registrationNumber, 0, 1, 'C');
$pdf->Cell(0, 10, 'Registration Date: ' . $registrationDate, 0, 1, 'C');

// Output the PDF to the browser for download
$pdf->Output('Registration_Certificate.pdf', 'D');
