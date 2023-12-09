<?php
session_start();
/*$hostname_oCn = "localhost";
$username_oCn = 'root';
$password_oCn = 'pass09876';
$databasename='enliteweb';*/
include 'dbconfig.php';
$conn = new mysqli($hostname, $username, $pwd, $databasename);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    $error = 1;
}
$result = $conn->query("select * from members where membercode='" . $_SESSION['userid'] . "'");
if ($result->num_rows > 0) {
} else {
    //header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dream Care Solution</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <?php
    $tempmemcode = $_GET['memcode'];
    $restul2 = $conn->query("select * from members where membercode='" . $tempmemcode . "'");
    if ($restul2->num_rows > 0) {
        if ($rec = $restul2->fetch_assoc()) {
            $mname = $rec['mname'];;
            $address = $rec['address'];
            $city_village = $rec['city_village'];
            $pin = $rec['pin'];
            $emailid = $rec['emailid'];
            $mobileno = $rec['mobileno'];
            $aadhar = $rec['aadhar'];
            $bankac = $rec['bankac'];
            $ifsc = $rec['ifsc'];
            $affiliatelink = $rec['affiliatelink'];
        }
    }
    ?>
    <div id="content">
        <?php include "nav.php" ?>
        <div id="layoutSidenav">
            <?php include "menu.php" ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col"><br></div>
                        </div>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area mr-1"></i>
                                Profile Setting
                            </div>
                            <div class="card-body" style="overflow:auto">
                                <div class="form">
                                    <label>Member Code</label>
                                    <input type="text" class="form-control"  name="membercode" id="membercode" value="<?php echo $tempmemcode ?>" readonly/>
                                    <p>Referral Link: <?php echo $affiliatelink ?></p>
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="username" id="usname"  value="<?php echo $mname?>" />
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" id="address"  value="<?php echo $address ?>" />
                                    <label>City/Village</label>
                                    <input type="text" class="form-control" name="city" id="city"  value="<?php echo $city_village ?>" />
                                    <label>PIN Code</label>
                                    <input type="text" class="form-control" name="pin" id="pin"  value="<?php echo $pin ?>" />
                                    <label>Email ID</label>
                                    <input type="text" class="form-control" name="email" id="email"  value="<?php echo $emailid ?>" />
                                    <label>Mobile No</label>
                                    <input type="text" class="form-control" name="mobileno" id="mobileno"  value="<?php echo $mobileno ?>" />
                                    <label>PAN/Aadhar</label>
                                    <input type="text" class="form-control" name="pan" id="pan"  value="<?php echo $aadhar ?>" />
                                    <label>Bank A/c</label>
                                    <input type="text" class="form-control" name="bankac" id="bankac"  value="<?php echo $bankac ?>" />
                                    <label>IFSC</label>
                                    <input type="text" class="form-control" name="ifsc" id="ifsc"  value="<?php echo $ifsc ?>" />

                                    <button type="button" class="btn btn-primary form-control" @click="updateprof">Update</button>
                                    <label>Current Password</label>
                                    <input type="password" :type="showPassword ? 'text' : 'password'" class="form-control" name="cpwd" id="cpwd" />

                                    <label>New Password</label>
                                    <input type="password" :type="showPassword ? 'text' : 'password'" class="form-control" name="npwd" id="npwd" v-model="npwd" />
                                    <label>
                                        <input type="checkbox" v-model="showPassword">
                                        Show Password
                                    </label>
                                    <button type="button" class="btn btn-success form-control" @click="updatepwd">Reset Password</button>
                                </div>
                            </div>
                            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>        -->
    <!--<script src="../vendor/chart.js/Chart.min.js"></script>-->
    <!--<script src="../assets/demo/chart-area-demo.js"></script>-->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <!--<script src="../assets/demo/datatables-demo.js"></script>-->
    <script src="js/main.js"></script>
    <script src="js/memprofile.js"></script>
    <script>
        var app = new Vue({
            el: '#content',
            data: {

            },
            mixins: [mainMixin, MemberProfile],

            methods: {

            }
        });
    </script>
    <script>
        /*$(function(){
            $("#menu").load("amenu.html");
          });*/
    </script>
</body>

</html>