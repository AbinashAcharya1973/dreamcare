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
        $error=1;
    }
    $result=$conn->query("select * from members where membercode='".$_SESSION['userid']."'");
    if($result->num_rows>0){

    }else{
        //header("Location: login.php");
    }
    $result=$conn->query("select * from withdrawreq inner join members on withdrawreq.memid=members.memid where withdrawreq.slno=".$_GET['id']);
    if($result->num_rows>0){
        if($rec=$result->fetch_assoc()){
            $amount=$rec['amount'];
            $memid=$rec['memid'];
            $mname=$rec['mname'];
            $bankac=$rec['bankac'];
            $ifsc=$rec['ifsc'];
            $mobileno=$rec['mobileno'];
        }
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
        <div id="content">
        <?php include "nav.php"?>
        <div id="layoutSidenav">
            <?php include "menu.php"?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    <div class="row">
                    	<div class="col"><br></div>
                    </div>
                        <!--<ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>-->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area mr-1"></i>
                                Withdrawal Request
                            </div>
                            <div class="card-body" style="overflow:auto">
                                <div class="form-vertical">
                                    <div class="form-group">
                                        <!--<p>Your Balance:{{closingbalance}}</p>-->
                                        <label>Request Amount</label>
                                        <input type="text" class="form-control" name="amount" placeholder="0.00" id="amount" value="<?php echo $amount?>" required/>
                                        <input type="hidden" id="slno" name="slno" value="<?php echo $_GET['id']?>">
                                        <input type="hidden" id="memid" name="memid" value="<?php echo $memid?>">                                    
                                        <p class="text-danger">Member Name:<?php echo $mname?></p>
                                        <p class="text-danger">Bank A/c:<?php echo $bankac?></p>
                                        <p class="text-danger">IFSC:<?php echo $ifsc?></p>
                                        <p class="text-danger">Contact NO:<?php echo $mobileno?></p>
                                        <button class="btn btn-primary" @click="approve">Approve</button>
                                    </div>
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
        <script src="js/appwithdraw.js"></script>
        <script>
        

            var app=new Vue({
                el:'#content',
                data:{
                    
                },
                mixins: [mainMixin,AppWithdraw],
                
                methods:{
                    
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
