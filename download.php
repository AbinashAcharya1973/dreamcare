<?php
// Database configuration
$servername = 'localhost';
$username = $_POST['userid'];
$password = $_POST['pwd'];
$dbname = 'autosl';
$tableName = 'vehiclebill_head'; // Replace with the name of your table

// Create a mysqli connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($mysqli->connect_error) {
    die('Connect Error: ' . $mysqli->connect_error);
}

// SQL query to fetch data from the table
$sql = "SELECT vehiclebill.VatP as 'TaxP', vehiclebill.Qty as 'Qty', vehiclebill.Rate as 'Rate',vehiclebill.*, vehiclebill_head.*, models.*, customer.*,vehiclebill.vatp AS 'TaxP' FROM vehiclebill_head INNER JOIN vehiclebill ON (vehiclebill_head.BillNo = vehiclebill.BillNo) AND (vehiclebill_head.AccYear = vehiclebill.AccYear) INNER JOIN customer ON (vehiclebill_head.AccId = customer.CustomerCode) INNER JOIN models ON (vehiclebill.ModelId = models.Id) WHERE vehiclebill_head.billno=" . $_POST['billno'] . " AND vehiclebill_head.accyear='" . $_POST['accyear'] . "'";
//echo $sql;
// Execute the query
$result = $mysqli->query($sql);

// Create a file pointer for the CSV file
$file = fopen('export.csv', 'w');

// Write CSV header (column names) based on the table structure
$headerValues = [
    "Bill NO", "Inv Type", "Bill Date", "Customer Name", "Address", "Address2", "Phone", "TIN", "Category", "SW",
    "Hyp", "AccID", "Model", "ModelID", "", "EngineNo", "ChasisNO", "", "", "", "Maker", "", "", "", "", "", "",
    "", "", "", "", "", "", "","","", "DocNO", "", "", "Rate", "Qty", "Amount", "DISCOUNT", "TaxP", "VatAmount", "",
    "BillAmount", "AmountInText", "", "", "ACCYear", "PanO", "TCSVAlue", "TotalBillAmout", "", "", "District",
    "", "PIN", "StateCode", "HSN", "Specification", "CurrentAddress"
];
fputcsv($file,$headerValues);

// Write data rows to the CSV file
while ($row = $result->fetch_assoc()) {
    $rec = array();
    $rec[] = $row['BillNo'];
    $rec[]= $row["InvType"];
    $rec[] = date("d/m/Y", strtotime($row["BillDate"]));
    $rec[]= $row["Customer"];
    $rec[] = $row["Address"];
    $rec[] = $row["Address2"];
    $rec[] = $row["Phone"];
    $rec[] = $row["TIN"];
    $rec[]= $row["Category"];
    $rec[] = $row["Sw"];
    $rec[] = $row["Hyp"];
    $rec[] = $row["AccId"];
    $rec[]= $row["Model"];
    $rec[]= $row["ModelId"];
    $rec[] = "";
    $rec[] = $row["EngineNo"];
    $rec[] = $row["ChasisNo"];
    $rec[] = "";
    $rec[] = "";
    $rec[] = "";
    $rec[] = $row["Makers"];
    $rec[] = "";
    $rec[] = "";
    $rec[] = "";
    $rec[] = "";
    $rec[] = "";
    $rec[] = "";
    $rec[] = "";
    $rec[] = "";
    $rec[] = "";
    $rec[] = "";
    $rec[] = "";
    $rec[] = "";
    $rec[] = "";
    $rec[] = "";
    $rec[] = "";
    // Skipping cells 15 to 46 as they are empty
    $rec[]= $row["DoNo"];
    // Skipping cells 48 to 62 as they are empty
    $rec[] = "";
    $rec[] = "";
    $rec[] = $row["Rate"];
    $rec[] = $row["Qty"];
    $rec[] = "0";
    $rec[] = "0";
    $rec[] = $row["TaxP"];
    $rec[] = $row["VatAmount"];
    $rec[] = "";
    $rec[] = $row["BillAmount"];
    $rec[] = $row["AmountInText"];
    $rec[] = "";
    $rec[] = "";
    $rec[] = $row["AccYear"];
    $rec[] = $row["Panno"];
    $rec[] = $row["tcsvalue"];
    $rec[] = $row["totalbillamount"];    
    $rec[] = "";
    $rec[] = "";
    $rec[] = $row["District"];
    $rec[] = "";
    $rec[] = $row["Pin"];
    $rec[] = $row["StateCode"];
    $rec[] = $row["HSN"];
    $rec[] = trim($row["specification"]);
    $rec[] = $row["Padr1"] . $row["Padr2"];
    fputcsv($file, $rec);
}

// Close the file pointer
fclose($file);

// Set the appropriate headers for file download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="export.csv"');

// Output the CSV file content to the user
readfile('export.csv');

// Delete the temporary CSV file
unlink('export.csv');

// Close the database connection
$mysqli->close();
?>