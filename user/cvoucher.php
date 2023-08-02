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
                                <i class="fas fa-chart-area mr-1"></i>Contra Voucher
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                    <div class="form row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label">Voucher Slno</label>
                                            <input type="text" class="form-control" v-model='vno' id="vslno" v-on:keyup.13='edit_delete'/><br>
                                            <small>Last Voucher No:{{lastvno}}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label">Voucher Date</label>
                                            <input type="date" class="form-control" v-model='vdate' ref="txtvdate"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label">Paid From [Cr. A/c]</label>
                                            <select class="form-control" v-model='selecteddracc'>
                                                <option v-for='ldgr in DrAccs' v-bind:value='ldgr.AccID'>{{ldgr.AccName}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label">Dr. Amount</label>
                                            <input type="number" class="form-control" disabled v-model='dramount'/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label">Account Group</label>
                                            <select class="form-control" v-on:change='loadledger' v-model='groupselected'>
                                                <option v-for='lgroup in AccGroups' v-bind:value='lgroup.GroupID'>{{lgroup.GroupName}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <!--<label class="label">PIN</label>
                                            <input type="text" class="form-control" v-model='pin'/>-->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label">Paid To</label>
                                            <select class="form-control" v-model='selectedcracc'>
                                                <option v-for="crledger in CrLedgers" v-bind:value='crledger.AccID'>{{crledger.AccName}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label">Cr Amount</label>
                                            <input type="number" class="form-control" v-model='cramount'/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label">Ledger Balance</label>
                                            <input type="number" class="form-control" disabled/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label">Remarks</label>
                                            <textarea class="form-control" v-model='remarks'></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col">
                                       <div class="clearfix text-center">
                                        <button class="btn btn-primary save_customar" v-on:click='save'>SAVE</button>
                                        <!--<button class="btn btn-success save_customar" v-on:click='editclicked'>EDIT</button>-->
                                        <!--<button class="btn btn-success save_customar" v-on:click='deleteclicked'>DELETE</button>-->
                                        <button class="btn btn-primary save_customar" v-on:click='print'>PRINT</button>
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
                    DrAccs:"",
                    AccGroups:"",
                    CrLedgers:"",
                    groupselected:"",
                    selecteddracc:"",
                    selectedcracc:"",                    
                    cramount:"0.00",
                    remarks:"",
                    edit:false,
                    vno:"",
                    deletev:false,
                    lastvno:"",
                    tempVoucher:{
                        selecteddracc:"",
                        selectedcracc:"",                    
                        cramount:"",
                        remarks:"",
                        vdate:"",
                        vno:"",
                        edit:false
                    },
                    vdate:"",
                    dramount:0.00
                },
                mixins: [mainMixin],
                mounted:function(){
                    /*axios.post('maxpvslno')
                            .then(function(response){
                                app.lastvno=response.data;                                
                            })
                            .catch(function(error){ alert(error);})*/
                    axios.post('gdraccs')
                            .then(function(response){
                                app.DrAccs=response.data;                                
                            })
                            .catch(function(error){ alert(error);})
                    axios.post('gg')
                            .then(function(response){
                                app.AccGroups=response.data;                                
                            })
                            .catch(function(error){ alert(error);})
                    this.$refs.txtvdate.valueAsDate=new Date();
                },

                methods:{
                    loadledger:function(){
                        axios.post('loadldg',{gid:app.groupselected})
                            .then(function(response){
                                app.CrLedgers=response.data;                                
                            })
                            .catch(function(error){ alert(error);})
                    },
                    save:async function(){
						app.auth=await app.chkauth("Payment","Save");
						if(app.auth){
							//let senddata=app.toFormData(app.tempCmas);
							var ans=confirm("Save the Voucher?");
							if(ans){
								app.tempVoucher.cramount=app.cramount;                            
								app.tempVoucher.selectedcracc=app.selectedcracc;
								app.tempVoucher.selecteddracc=app.selecteddracc;
								app.tempVoucher.vdate=app.vdate;
								app.tempVoucher.remarks=app.remarks;
								app.tempVoucher.vno=app.vno;
								app.tempVoucher.edit=app.edit;
								let senddata=app.toFormData(app.tempVoucher);
								axios.post('spv',senddata)
								.then(function(response){
									var result=response.data;
										alert("The last Voucher No"+result);
										//app.tempPrf.FirstName="";
										app.edit=false;
										app.tempVoucher.edit=false;
										app.cramount=0;
										app.vno="";
										app.remarks="";
										alert("Voucher Saved");
										window.location.href = "pvlist";
										//app.maxvno();

										//app.requery();
									})
								.catch(function(error){ alert(error);})
								}
						}else{
							alert("Access Denied");
						}
                    },
                    print:async function(){
                        app.auth=await app.chkauth("Payment","Save");
						if(app.auth){
							axios.post('paymentprint?vno='+app.vno)
							.then(function(response){
									window.open("pdfs/payment-"+app.vno+".pdf","_blank");
								})
							.catch(function(error){ alert(error);})
						}else{
							alert("Access Denied");
						}
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
