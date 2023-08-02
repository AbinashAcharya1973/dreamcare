<?php
// Assuming you have already established a database connection and stored it in the $conn variable
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['username']) && isset($data['password'])) {
        $username = $data['username'];
        $password = $data['password'];

        // Query the database to check if the user exists and the password is correct
        // Replace 'users' with the name of your user table
        // Replace 'username' and 'password' with the column names in your user table
        $query = "SELECT * FROM members WHERE membercode = ? AND pwd = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $response = ['success' => true];
        } else {
            $response = ['success' => false];
        }

        echo json_encode($response);
    }
}
?>
