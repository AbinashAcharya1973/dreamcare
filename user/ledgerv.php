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
                                <i class="fas fa-chart-area mr-1"></i>Ledger View
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">Ledger Group</label>
                                            <select class="form-control" ref="group" v-model="groupid" v-on:change='loadledger'>
                                            <option :value="lgroup.GroupID" v-for="lgroup in GroupList">{{lgroup.GroupName}}</option> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">Ledger A/c</label>
                                            <select class="form-control" ref="ledgers" v-model="laccid" v-on:change='loadledgertran'>
                                                <option :value="ldgr.AccID" v-for="ldgr in LedgerList">{{ldgr.AccName}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">From Date</label>
                                            <input type="date" class="form-control" ref="txtfdate" v-model="fdate"/>
                                        </div>
                                    </div>
                                    <div class="col col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">To Date</label>
                                            <input type="date" class="form-control" ref="txttdate" v-model="tdate" v-on:change="gettran"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped"  cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Particulars</th>
                                                        <th>Voucher Type</th>
                                                        <th>Voucher No</th>
                                                        <th>Dr</th>
                                                        <th>Cr</th>
                                                        <th>Remarks</th>                                                    
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th>O. Balance</th>
                                                        <th class="text-right">{{ObalanceDr}}</th>
                                                        <th class="text-right">{{ObalanceCr}}</th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th>Total</th>
                                                        <th class="text-right">{{TotalDr}}</th>
                                                        <th class="text-right">{{TotalCr}}</th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th>Closing Balance</th>
                                                        <th class="text-right">{{ClosingDr}}</th>
                                                        <th class="text-right">{{ClosingCr}}</th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>                                                
                                                    <tr v-for="tran in LedgerTran">
                                                    <td>{{tran.TDate}}</td>
                                                        <td>{{tran.Particulars}}</td>
                                                        <td>{{tran.VoucherType}}</td>
                                                        <td>{{tran.VoucherSlno}}</td>
                                                        <td class="text-right">{{tran.Dr}}</td>
                                                        <td class="text-right">{{tran.Cr}}</td>
                                                        <td>{{tran.Remarks}}</td>
                                                    </tr>                                                                                                
                                                </tbody>
                                            </table>
                                            <div class="text-center">
                                                <button class="btn btn-primary" v-on:click="print">Print Statement</button>
                                            </div>
                                            <br>
                                            <hr>

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
        <script src="js/ledgerv.js"></script>
        <script>
        

            var app=new Vue({
                el:'#content',
                data:{
                    
                },
                mixins: [mainMixin,LedgerV],
                
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
