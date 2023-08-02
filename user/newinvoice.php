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
                                <i class="fas fa-chart-area mr-1"></i>Invoice                             
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">Last Invoice No</label>
                                            <input type="text" class="form-control" ref="txtinvno"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">Invoice Date</label>
                                            <input type="date" class="form-control" ref="txtinvdate" @keyup.enter="txtinvdate_enter"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">Customer/Party Dr</label>
                                            <select class="form-control" ref="txtpartydr" v-model="selectedParty" @change="txtparty_change">
                                                <option v-for="(party,index) in DrPartyList" :value='index'>{{party.Party}}</option>
                                            </select> <button class="btn btn-primary" @click="newpartyDr" >New Customer</button>
                                        </div>
                                        <small class="text-primary">{{partyaddress}},GST:{{partygst}},Mobile No:{{partymobile}}</small>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">Remarks</label>
                                            <input type="text" class="form-control"  />
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row border border-primary" v-if="NewParty">
                                    <div class="col">
                                        <div class="row">
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <label class="label">Customer/Party Dr Name</label>
                                                <input type="text" class="form-control" ref="txtnewparty"/>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <label class="label">Address1</label>
                                                <input type="text" class="form-control" ref="txtnewadd1"/>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <label class="label">Address2</label>
                                                <input type="text" class="form-control" ref="txtnewadd2"/>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <label class="label">PIN</label>
                                                <input type="text" class="form-control" ref="txtnewpin"/>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <label class="label">Contact No</label>
                                                <input type="text" class="form-control" ref="txtcontactno"/>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <label class="label">Email ID</label>
                                                <input type="text" class="form-control" ref="txtemailid"/>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <label class="label">State</label>
                                                <select class="form-control" v-model="SelectedState" @change="setscode">
                                                    <option v-for="istate in StateList" :value='istate.STCode'>{{istate.StateName}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <label class="label">GST No</label>
                                                <input type="text" class="form-control" ref="txtgstno"/>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mt-3"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-center">
                                                <button class="btn btn-primary" @click="savenewparty">Save</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mt-3"></div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">Product Name</label>
                                            <select class="form-control" ref="txtproduct" @keyup.enter="txtproduct_enter" v-model="selectedItem" @change="txtproduct_change">
                                                <option v-for="(item,index) in ProductList" :value="index">{{item.ItemName}}</option>
                                            </select>                                            
                                        </div>
                                        <small class="text-primary">{{subcategory}},Qty:{{stockqty}},MRP:{{MRP}}</small>                                                                                
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">Batch No</label>
                                            <select class="form-control" ref="txtbatch" @keyup.enter="txtbatch_enter" v-model="batchno" @change="txtproduct_change">
                                                <option v-for="batch in productbatches" :value="batch.batchno">{{batch.batchno}}</option>
                                            </select>                                            
                                        </div>
                                        <small class="text-primary"></small>                                                                                
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">Unit</label>
                                            <input type="text" class="form-control" ref="txtunit"/>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">Qty</label>
                                            <input type="text" class="form-control" ref="txtqty" @keyup.enter="txtqty_enter" v-model="qty"/>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">Rate</label>
                                            <input type="text" class="form-control" v-model="rate" ref="txtrate" @keyup.enter="txtrate_enter"/>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">G.Amount</label>
                                            <input type="text" class="form-control" v-model="gross" ref="txtgross" @keyup.enter="txtgross_enter"/>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">Dis%</label>
                                            <input type="text" class="form-control" v-model="disp" ref="txtdisp" @keyup.enter="txtdisp_enter"/>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">Dis.amt</label>
                                            <input type="text" class="form-control" v-model="dis" ref="txtdisamt" @keyup.enter="txtdisamt_enter"/>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">CD</label>
                                            <input type="text" class="form-control" ref="txtcd" @keyup.enter="txtcd_enter" v-model="cd"/>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">GST%</label>
                                            <input type="text" class="form-control" ref="txtgst" @keyup.enter="txtgst_enter" v-model="gst"/>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">GST.amt</label>
                                            <input type="text" class="form-control" ref="txtgstamt" @keyup.enter="txtgstamt_enter" v-model="gstamount"/>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">Amt</label>
                                            <input type="text" class="form-control" ref="txtamt" @keyup.enter="txtamt_enter" v-model="netamt"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">Batch No</label>
                                            <input type="text" class="form-control" ref="txtbatch" @keyup.enter="txtbatch_enter" v-model="batchno"/>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr><th>Product Name</th><th>Unit</th><th>Qty</th><th>Rate</th><th>Gross</th><th>Dis</th><th>GST</th><th>GSTAmt</th><th>Amount</th><th>Batch</th><th></th></tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item,index) in temppurchase">
                                                    <td>{{item.ProductName}}</td><td>Unit</td><td>{{item.qty}}</td><td>{{item.rate}}</td><td>{{item.gross}}</td><td>{{item.tdis}}</td><td>{{item.gst}}</td><td>{{item.gstamt}}</td><td>{{item.netamt}}</td><td>{{item.batchno}}</td>
                                                    <td><button class="btn btn-primary btn-sm" @click='delete_i(index)'><i class="fas fa-trash mr-1"></i></button></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                <td><strong>Total</strong></td><td></td><td><strong>{{totalqty}}</strong></td><td></td><td><strong>{{totalgross}}</strong></td><td><strong>{{totaldis}}</strong></td><td></td><td><strong><strong>{{totalgstamt}}</strong></td><td><strong>{{totalnetamt}}</strong></td><td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-2 col-sm-12"></div>
                                    <div class="col col-md-2 col-sm-12"></div>
                                    <div class="col col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">Freight</label>
                                            <input type="text" class="form-control" ref="txtfreight" @keyup.enter="txtfreight_enter" v-model="freight"/>
                                        </div>
                                    </div>
                                    <div class="col col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">Freight GST%</label>
                                            <input type="text" class="form-control" ref="txtfreightgst" @keyup.enter="txtfreightgst_enter" v-model="freightgst"/>
                                        </div>
                                    </div>
                                    <div class="col col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">GST Amount</label>
                                            <input type="text" class="form-control" ref="txtfreightgst" @keyup.enter="txtfreightgst_enter" v-model="freightamt"/>
                                        </div>
                                    </div>
                                    <div class="col col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label class="label">Total Amount</label>
                                            <input type="text" class="form-control" ref="txtfreightgst" @keyup.enter="txtfreightgst_enter" v-model="totalamount"/>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col text-center">
                                        <button class="btn btn-primary" @click="save">Save</button> 
                                        <!--<button class="btn btn-primary" @click="print">Print</button>-->
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
        <script src="js/newinvoice.js"></script>
        <script>
        

            var app=new Vue({
                el:'#content',
                data:{
                    
                },
                mixins: [mainMixin,PurchaseJs],
                
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
