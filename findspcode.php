<?php
// Assuming you have already established a database connection and stored it in the $conn variable
include 'dbconfig.php';$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['usercode'])) {
        $username = $data['usercode'];
        

        // Query the database to check if the user exists and the password is correct
        // Replace 'users' with the name of your user table
        // Replace 'username' and 'password' with the column names in your user table
        $query = "SELECT * FROM members WHERE membercode ='".$username."'";
        $result=$conn->query($query);

        if($result->num_rows> 0) {
            if($rec=mysqli_fetch_assoc($result)){
                $tempname=$rec['mname'];
                $response = ['success' => $tempname,'memid' => $rec['memid']];
            }
            
        } else {
            $response = ['success' => 'Invalid Code','memid' => 1];
        }

        echo json_encode($response);
    }
}
?>
