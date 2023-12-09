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
                                <i class="fas fa-user mr-1"></i>New Party Dr [Customer]
                            </div>
                            <div class="card-body">
                            <div class="row">

                                <!-- Pending Orders Table-->
                                <div class="card col px-0 shadow mb-4">
                                    
                                    <!-- Card Body -->
                                    <div class="card-body new_branchesForm">
                                        <form class="" action="">

                                            <div class="row mb-4">
                                                <!-- Earnings (Monthly) Card Example -->
                                                <div class="col-md-12 mb-4">
                                                        
                                                        <div class="card border-left-primary shadow h-100 py-2 mb-4">
                                                            <div class="card-body py-0">
                                                                <div class="row h-100 no-gutters align-items-center">
                                                                    <div class="col-auto mr-2">
                                                                        <div class="text-xs font-weight-bold text-primary text-uppercase">
                                                                            Customer
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <input type="text" class="form-control" placeholder="" v-model='party'>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                </div>
                                                
                                                <!-- Earnings (Monthly) Card Example -->
                                                <div class="col-md-6 mb-4">
                                                        
                                                        <div class="card border-left-primary shadow h-100 py-2 mb-4">
                                                            <div class="card-body py-0">
                                                                <div class="row h-100 no-gutters align-items-center">
                                                                    <div class="col-auto mr-2">
                                                                        <div class="text-xs font-weight-bold text-primary text-uppercase">
                                                                            Address 1
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="form-control" rows="4" placeholder="" v-model='address1'></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                </div>
                                                
                                                <!-- Earnings (Monthly) Card Example -->
                                                <div class="col-md-6 mb-4">
                                                        
                                                        <div class="card border-left-primary shadow h-100 py-2 mb-4">
                                                            <div class="card-body py-0">
                                                                <div class="row h-100 no-gutters align-items-center">
                                                                    <div class="col-auto mr-2">
                                                                        <div class="text-xs font-weight-bold text-primary text-uppercase">
                                                                            Address 2
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <textarea class="form-control" rows="4" placeholder="" v-model='address2'></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                </div>
                                                
                                                <!-- Earnings (Monthly) Card Example -->
                                                <div class="col-md-4 mb-4">
                                                        
                                                        <div class="card border-left-primary shadow h-100 py-2 mb-4">
                                                            <div class="card-body py-0">
                                                                <div class="row h-100 no-gutters align-items-center">
                                                                    <div class="col-auto mr-2">
                                                                        <div class="text-xs font-weight-bold text-primary text-uppercase">
                                                                            PIN Code
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <input type="text" class="form-control" placeholder="" v-model='pincode'>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                    

                                                </div>
                                                
                                                <!-- Earnings (Monthly) Card Example -->
                                                <div class="col-md-4 mb-4">
                                                        
                                                        <div class="card border-left-primary shadow h-100 py-2 mb-4">
                                                            <div class="card-body py-0">
                                                                <div class="row h-100 no-gutters align-items-center">
                                                                    <div class="col-auto mr-2">
                                                                        <div class="text-xs font-weight-bold text-primary text-uppercase">
                                                                            Phone No
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <input type="tel" class="form-control" placeholder="" v-model='phoneno'>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                    

                                                </div>
                                                <div class="col-md-4 mb-4">
                                                        
                                                        <div class="card border-left-primary shadow h-100 py-2 mb-4">
                                                            <div class="card-body py-0">
                                                                <div class="row h-100 no-gutters align-items-center">
                                                                    <div class="col-auto mr-2">
                                                                        <div class="text-xs font-weight-bold text-primary text-uppercase">
                                                                            Email ID
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <input type="email" class="form-control" placeholder="" v-model='emailid'>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                    

                                                </div>
                                                <!-- Earnings (Monthly) Card Example -->
                                                <div class="col-md-4 mb-4">
                                                        
                                                        <div class="card border-left-primary shadow h-100 py-2 mb-4">
                                                            <div class="card-body py-0">
                                                                <div class="row h-100 no-gutters align-items-center">
                                                                    <div class="col-auto mr-2">
                                                                        <div class="text-xs font-weight-bold text-primary text-uppercase">
                                                                            GSTIN
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <input type="text" class="form-control" placeholder="" v-model='gstn'>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>                                                                                        
                                                </div>
                                                
                                                <!-- Earnings (Monthly) Card Example -->
                                                <div class="col-md-4 mb-4">
                                                        
                                                        <div class="card border-left-primary shadow h-100 py-2 mb-4">
                                                            <div class="card-body py-0">
                                                                <div class="row h-100 no-gutters align-items-center">
                                                                    <div class="col-auto mr-2">
                                                                        <div class="text-xs font-weight-bold text-primary text-uppercase">
                                                                            Op. Balance
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="input-group">
                                                                            <input type="number" class="form-control" placeholder="0.00" v-model='obalance' value="0.00">
                                                                            <select class="form-control" name="" v-model='obalancetype'>
                                                                                <option value="Cr">Cr</option>
                                                                                <option value="Dr">Dr</option>
                                                                            </select>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                </div>
                                                
                                                <!-- Earnings (Monthly) Card Example -->
                                                <div class="col-md-4 mb-4">
                                                        
                                                        <div class="card border-left-primary shadow h-100 py-2 mb-4">
                                                            <div class="card-body py-0">
                                                                <div class="row h-100 no-gutters align-items-center">
                                                                    <div class="col-auto mr-2">
                                                                        <div class="text-xs font-weight-bold text-primary text-uppercase">
                                                                            State
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <select class="form-control" name="" v-model="scode">
                                                                            <option v-bind:value="statec.STCode" v-for="statec in StateCodes">{{statec.StateName}}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                </div>
                                                
                                                
                                                
                                            </div>
                                            
                                            <!-- Earnings (Monthly) Card Example -->
                                            <div class="clearfix text-right">
                                                <a class="btn btn-success save_customar" v-on:click='save'>Save</a>
                                            </div>

                                        </form>
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
        <script>
        

            var app=new Vue({
                el:'#content',
                data:{
                    StateCodes:"",
                    party:"",
                    address1:"",
                    address2:"",
                    pincode:"",
                    phoneno:"",
                    emailid:"",
                    gstn:"",
                    obalance:"0",
                    obalancetype:"Dr",
                    scode:"",
                    PartyDr:{
                        party:"",
                        address1:"",
                        address2:"",
                        pincode:"",
                        phoneno:"",
                        emailid:"",
                        gstn:"",
                        obalance:"0.00",
                        obalancetype:"Cr",
                        scode:""
                    }   
                },
                mixins: [mainMixin],
                mounted:function(){
                    axios.post('gtstatecode')
                            .then(function(response){
                                app.StateCodes=response.data;                                
                            })
                            .catch(function(error){ alert(error);})
                },
                methods:{
                    save:function(){
                        app.PartyDr.party=app.party;
                        app.PartyDr.address1=app.address1;
                        app.PartyDr.address2=app.address2;
                        app.PartyDr.pincode=app.pincode;
                        app.PartyDr.phoneno=app.phoneno;
                        app.PartyDr.emailid=app.emailid;
                        app.PartyDr.gstn=app.gstn;
                        app.PartyDr.obalance=app.obalance;
                        app.PartyDr.obalancetype=app.obalancetype;
                        app.PartyDr.scode=app.scode;
                        let senddata=app.toFormData(app.PartyDr);
                        axios.post('partydr_s',senddata)
                        .then(function(response){
                            var result=response.data;
                                //alert(result);                                 
                                var ans=confirm("Customer Saved Successfully, Do you want to Add More?");
                                if(ans){
                                    window.location.assign('newcustomer');
                                }else{
                                    window.location.assign('partydr');
                                }
                            })
                        .catch(function(error){ alert(error);})
                    },
                    toFormData: function(obj) {
                        let formData = new FormData();
                        for(let key in obj) {
                            formData.append(key, obj[key]);
                        }
                        //this.file = this.$refs.file.files[0];
                        //formData.append('file',this.file);
                        return formData;
                    } 
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
