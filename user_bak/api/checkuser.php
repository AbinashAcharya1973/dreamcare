
<?php
// Set appropriate CORS headers
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

// Database connection
$servername = "localhost";
$username = "root";
$password = "pass09876";
$dbname = "dcs";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle user login
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $data = json_decode(file_get_contents("php://input"), true);

  // Validate input
  $username = $data["username"];
  //$password = $data["password"];

  // Check if user exists in the database (for simplicity, passwords are stored as plaintext)
  $sql = "SELECT memid, mname FROM members WHERE membercode='".$username."'";
  $result = $conn->query($sql);

  if ($result->num_rows== 1) {
    $user = $result->fetch_assoc();
    echo json_encode(array("message" => "Login successful.", "user" => $user));
  } else {
    echo json_encode(array("message" => "Invalid credentials."));
  }
}

$conn->close();
?>
