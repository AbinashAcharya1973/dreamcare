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
                                <i class="fas fa-chart-area mr-1"></i>New Stock Transfer
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">Challan No</label>
                                            <input type="txt" class="form-control" ref="txtchno"/>
                                        </div>
                                    </div>
                                    <div class="col col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">Challan Date</label>
                                            <input type="date" class="form-control" ref="txtchdate"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">From</label>
                                            <select class="form-control" v-model="frombranch">
                                                <option value='HO'>HO</option>
                                                <option v-for="(branch,index) in fromBranchList" :value="index">{{branch.Branch}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">To</label>
                                            <select class="form-control" v-model="tobranch">     
                                                <option value='HO'>HO</option>                                           
                                                <option v-for="(branch,index) in toBranchList" :value="index">{{branch.Branch}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="label">Select Product</label>
                                            <select class="form-control" v-model="SelectedProduct" @change="getbatches">
                                                <option v-for="(item,index) in ProductList" :value='index'>{{item.ItemName}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">Batch No</label>
                                            <select class="form-control" v-model="SelectedBatch">
                                                <option v-for="batch in BatchList" :value='batch.batchno'>{{batch.batchno}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">Qty</label>
                                            <input type="text" class="form-control" v-model="Qty" @keyup.enter="addtolist"/>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                <th>Product Name</th>
                                                <th>Batch NO</th>
                                                <th>HSN</th>
                                                <th>Qty</th>
                                                <th>MRP</th>                                                
                                                <th>Amount</th>
                                                <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item,index) in tempItem">
                                                    <td>{{item.ProductName}}</td>
                                                    <td>{{item.BatchNo}}</td>
                                                    <td>{{item.HSN}}</td>
                                                    <td>{{item.Qty}}</td>
                                                    <td>{{item.MRP}}</td>
                                                    <td>{{item.Amount}}</td>                                                
                                                    <td><button class="btn btn-primary btn-sm" @click="deleteitem(index)"><i class="fas fa-trash mr-1"></button></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                <th>Total</th>
                                                <th></th>
                                                <th></th>
                                                <th>{{totalqty}}</th>
                                                <th></th>                                                
                                                <th>{{totalamount}}</th>
                                                <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button class="btn btn-primary" @click="save">Save</button> <button class="btn btn-primary" @click="print">Print</button>
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
        <script src="js/newstocktran.js"></script>
        <script>
        

            var app=new Vue({
                el:'#content',
                data:{
                    
                },
                mixins: [mainMixin,StockTran],
                
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
