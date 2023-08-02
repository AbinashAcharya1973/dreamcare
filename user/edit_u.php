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
        header("Location: /login");
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
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-user mr-1"></i>Edit User
                            </div>
                            <div class="card-body">
                            <div class="col">
                                    <div class="form row">
                                        <div class="col-md-6 offset-md-4 my-5">
                                            <div class="row">
                                                <div class="col-4 text-center">
                                                    <img class="uplodedImg img-thumbnail" v-bind:src="Proimg" id='imagepreview'/>
                                                </div>
                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <label class="label d-block">Upload Image</label>
                                                        <input type="file" id="file" ref="file" class="mt-1 form-control-file" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">First Name</label>
                                                <input type="text" class="form-control" v-model='FirstName' v-uppercase/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">Last Name</label>
                                                <input type="text" class="form-control" v-model='LastName' v-uppercase/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">Branch Name</label>
                                                <select class="form-control" v-model='BranchSelected' @change="getzones">
                                                    <option v-for="(branch,index) in Branches" :value='index'>{{branch.Branch}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">Mobile Number</label>
                                                <input type="text" class="form-control" v-model='MobileNo'/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">Zone</label>
                                                <select class="form-control" v-model='ZoneSelected'>
                                                <option v-for="(zone,index) in Zones" :value='index'>{{zone.Zone}}</option>
                                                </select>
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
                                                <label class="label">Address</label>
                                                <textarea class="form-control" v-model='Address1' v-uppercase></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">Alternet Address</label>
                                                <textarea class="form-control" v-model='Address2' v-uppercase></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">Indian States</label>
                                                <select class="form-control" v-model="SelectedState">
                                                    <option v-for="istate in StateList" :value='istate.STCode'>{{istate.StateName}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">PIN Code</label>
                                                <input type="text" class="form-control" v-model='PINCode'/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">GST Number</label>
                                                <input type="text" class="form-control" v-model='GSTNo' v-uppercase/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">User Type</label>
                                                <select class="form-control" name="" v-model='UserType'>                                                
                                                    <option value="s">Sales Staff</option>                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label">Password</label>
                                                <input type="password" class="form-control" v-model='Password'/>
                                            </div>
                                        </div>
                                        <div class="col">
                                        <h3>Application User Permission</h3>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Module</th>
                                                <th>Save</th>
                                                <th>Edit</th>
                                                <th>Print</th>
                                                <th>Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(module,index) in UserPermission">
                                                <td><small>{{module.ModuleName}}</small></td>
                                                <td><small><input type="checkbox" v-bind:value='module.Save' v-model='UserPermission[index].Save'></small></td>
                                                <td><small><input type="checkbox" v-bind:value='module.Edit' v-model='UserPermission[index].Edit'></small></th>
                                                <td><small><input type="checkbox" v-bind:value='module.Print' v-model='UserPermission[index].Print'></small></td>
                                                <td><small><input type="checkbox" v-bind:value='module.Delete' v-model='UserPermission[index].Delete'></small></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-center">
                                    <button class="btn btn-primary" v-on:click="save">Save</button>
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
                            <div class="text-muted">Copyright &copy; EnliteWeb 2020</div>
                            <div>
                                <a href="privacy">Privacy Policy</a>
                                &middot;
                                <a href="terms">Terms &amp; Conditions</a>
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
        <!--<script src="../assets/demo/chart-bar-demo.js"></script>-->
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <!--<script src="../assets/demo/datatables-demo.js"></script>-->        
        <script src="js/main.js"></script>
        <script src="js/edituser.js"></script>
        <script>
        

            var app=new Vue({
                el:'#content',
                data:{
                    
                },
                mixins: [mainMixin,UserForm],
                
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
