<?php
// Database configuration
$servername = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'autosl';
$tableName = 'vehiclebill_head'; // Replace with the name of your table

// Create a mysqli connection
$db = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($db->connect_error) {
    die('Connect Error: ' . $mysqli->connect_error);
}

// Assuming you have already connected to the database and $db is the database connection object.

// SQL query
//$strSQL = "SELECT vehiclebill.*, vehiclebill_head.*, models.*, customer.*,vehiclebill.vatp AS 'TaxP' FROM AutoHV.vehiclebill_head INNER JOIN autohv.vehiclebill ON (vehiclebill_head.BillNo = vehiclebill.BillNo) AND (vehiclebill_head.AccYear = vehiclebill.AccYear) INNER JOIN autohv.customer ON (vehiclebill_head.AccId = customer.CustomerCode) INNER JOIN autohv.models ON (vehiclebill.ModelId = models.Id) WHERE vehiclebill_head.billno=" . $_POST['txtbillno'] . " AND vehiclebill_head.accyear='" . $_POST['txtaccyear'] . "'";
$strSQL = "SELECT vehiclebill.*, vehiclebill_head.*, models.*, customer.*,vehiclebill.vatp AS 'TaxP' FROM AutoHV.vehiclebill_head INNER JOIN autohv.vehiclebill ON (vehiclebill_head.BillNo = vehiclebill.BillNo) AND (vehiclebill_head.AccYear = vehiclebill.AccYear) INNER JOIN autohv.customer ON (vehiclebill_head.AccId = customer.CustomerCode) INNER JOIN autohv.models ON (vehiclebill.ModelId = models.Id)";

// Execute the query and get the result set
$rec1 = mysqli_query($db, $strSQL);

// Create Excel file and worksheet
$excelApp = new COM("Excel.Application");
$excelApp->Visible = true;
$excelWB = $excelApp->Workbooks->Add;
$excelWS = $excelWB->Worksheets(1);

// Set header row values
$headerValues = [
    "Bill NO", "Inv Type", "Bill Date", "Customer Name", "Address", "Address2", "Phone", "TIN", "Category", "SW",
    "Hyp", "AccID", "Model", "ModelID", "", "EngineNo", "ChasisNO", "", "", "", "Maker", "", "", "", "", "", "",
    "", "", "", "", "", "", "", "DocNO", "", "", "Rate", "Qty", "Amount", "DISCOUNT", "TaxP", "VatAmount", "",
    "BillAmount", "AmountInText", "", "", "ACCYear", "PanO", "TCSVAlue", "TotalBillAmout", "", "", "District",
    "", "PIN", "StateCode", "HSN", "Specification", "CurrentAddress"
];

// Write header row
for ($i = 0; $i < count($headerValues); $i++) {
    $excelWS->Cells(1, $i + 1)->Value = $headerValues[$i];
}

// Start writing data from row 2
$X = 2;
while ($row = mysqli_fetch_assoc($rec1)) {
    $excelWS->Cells($X, 1)->Value = $row["Billno"];
    $excelWS->Cells($X, 2)->Value = $row["invtype"];
    $excelWS->Cells($X, 3)->Value = date("d/m/Y", strtotime($row["BillDate"]));
    $excelWS->Cells($X, 4)->Value = $row["Customer"];
    $excelWS->Cells($X, 5)->Value = $row["Address"];
    $excelWS->Cells($X, 6)->Value = $row["Address2"];
    $excelWS->Cells($X, 7)->Value = $row["Phone"];
    $excelWS->Cells($X, 8)->Value = $row["TIN"];
    $excelWS->Cells($X, 9)->Value = $row["Category"];
    $excelWS->Cells($X, 10)->Value = $row["SW"];
    $excelWS->Cells($X, 11)->Value = $row["Hyp"];
    $excelWS->Cells($X, 12)->Value = $row["AccID"];
    $excelWS->Cells($X, 13)->Value = $row["Model"];
    $excelWS->Cells($X, 14)->Value = $row["ModelID"];
    // Skipping cells 15 to 46 as they are empty
    $excelWS->Cells($X, 47)->Value = $row["DoNO"];
    // Skipping cells 48 to 62 as they are empty
    $excelWS->Cells($X, 63)->Value = trim($row["Specification"]);
    $excelWS->Cells($X, 64)->Value = $row["padr1"] . $row["padr2"];
    $X++;
}

// Close the database connection and release COM objects
mysqli_close($db);
unset($rec1);
$excelApp->Quit();
unset($excelWS);
unset($excelWB);
unset($excelApp);


?>