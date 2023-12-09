<?php 
session_start();
//error_reporting(0); //For Zero Error
$user_id = $_SESSION['user_id']; // For Cart
include 'connection/dbcon.php';
/************************************/
if (isset($_POST['login_submit'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "select * from user where email='$email' and password='$password'";
    $res = mysqli_query($con,$sql);
    $check_user = mysqli_num_rows($res);

    if($check_user > 0){
        $row = mysqli_fetch_assoc($res);
        $_SESSION['USER_LOGIN'] = 'yes';
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['USER_NAME'] = $row['name'];
        echo "<script>window.location.href='index.php'</script>";
        
    }else{
        $_SESSION['status'] = "INVALID LOGIN DETAILS";
        echo "<script>window.location.href='login.php'</script>";
    }
}
/************************************/
?>