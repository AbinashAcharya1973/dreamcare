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
    $result=$conn->query("select * from users where MobileNO='".$_SESSION['userid']."'");
    if($result->num_rows>0){

    }else{
        header("Location: login.html");
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
      <title>Enlite Web</title>
      <link href="css/styles.css" rel="stylesheet" />
      <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
    <div id="content">
        <?php include 'nav.php'?>
        <div id="layoutSidenav">
            <?php include "menu.php"?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    <div class="row">
                    	<div class="col"><br></div>
                    </div>

                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area mr-1"></i>
                                Company Profile
                            </div>
                            <div class="card-body">
                              <div class="row">
                                <div class="col">
                                    <div class="form row">
                                        <div class="col-md-6 offset-md-4 my-5">
                                            <div class="row">
                                                <div class="col-4 text-center">
                                                    <img class="uplodedImg img-thumbnail" v-bind:src="CompanyLogo" id='imagepreview'/>
                                                </div>
                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <label class="label d-block">Upload Logo [Only .png file]</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">Company Name</label>
                                                <input type="text" class="form-control" v-model='CompanyName'/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">Contact NO</label>
                                                <input type="text" class="form-control" v-model='ContactNo'/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">Address</label>
                                                <textarea class="form-control" v-model='Address1'></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">Alternet Address</label>
                                                <textarea class="form-control" v-model='Address2'></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">India State</label>
                                                <input type="text" class="form-control" v-model='State'/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">PIN</label>
                                                <input type="text" class="form-control" v-model='pin'/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">GST No</label>
                                                <input type="text" class="form-control" v-model='gstno'/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">Email Id</label>
                                                <input type="email" class="form-control" v-model='EmailID'/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">Website</label>
                                                <input type="url" class="form-control" v-model='Website'/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">Jurisdiction</label>
                                                <input type="text" class="form-control" v-model='jurisdiction'/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">Bank Name</label>
                                                <input type="text" class="form-control" v-model='bankname'/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">Bank A/C No</label>
                                                <input type="text" class="form-control" v-model='bankno'/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">IFSC</label>
                                                <input type="text" class="form-control" v-model='ifsc'/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">Deal In</label>
                                                <input type="text" class="form-control" v-model='Dealin'/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">Description</label>
                                                <textarea class="form-control" v-model='Description'></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">Password</label>
                                                <input type="password" class="form-control" v-model='Password'/>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group text-right py-5">
                                                <button class="btn btn-primary" v-on:click="save">Save</button>
                                            </div>
                                        </div>
                                    </div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>  
        <script src="js/main.js"></script>
        <script src="js/companyprofile.js"></script>
        <script>            
            var app=new Vue({
                el:'#content',
                data:{
                                       
                },
                mixins: [mainMixin,companyMixin],
                
                methods:{
                    
                }
            });            
        </script>
    </body>
</html>
