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
                                <i class="fas fa-chart-area mr-1"></i>New Unit
                            </div>
                            <div class="card-body">
                            <div class="row mb-4">
                                        <!-- Earnings (Monthly) Card Example -->
                                        <div class="col-md-12 mb-4">

                                                <div class="card border-left-primary shadow h-100 py-2 mb-4">
                                                    <div class="card-body py-0">
                                                        <div class="row h-100 no-gutters align-items-center">
                                                            <div class="col-auto mr-2">
                                                                <div class="text-xs font-weight-bold text-primary text-uppercase">
                                                                    Unit Group
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <select class="form-control" v-model="selectedgroup" v-on:change="getunits">
																	<option v-bind:value="group.GroupName" v-for="group in MGroupList">{{group.GroupName}}</option>
                                                                </select>
                                                            </div>
                                                            <div class="col"><button class="btn btn-primary" v-on:click="newgroup">New Group</button></div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </div>
                                        <div class="col-md-12 mb-4" v-show="isNewGroup">

                                                <div class="card border-left-primary shadow h-100 py-2 mb-4">
                                                    <div class="card-body py-0">
                                                        <div class="row h-100 no-gutters align-items-center">
                                                            <div class="col-auto mr-2">
                                                                <div class="text-xs font-weight-bold text-primary text-uppercase">
                                                                    New Unit Group
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <input type="text" class="form-control" v-model="ngroup"/>
                                                            </div>
                                                            <div class="col"><button class="btn btn-primary" v-on:click="savegroup">Save</button></div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </div>
                                        <div class="col-md-12 mb-4">

                                                <div class="card border-left-primary shadow h-100 py-2 mb-4">
                                                    <div class="card-body py-0">
                                                        <div class="row h-100 no-gutters align-items-center">
                                                            <div class="col-auto mr-2">
                                                                <div class="text-xs font-weight-bold text-primary text-uppercase">
                                                                    Parent Unit
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <select class="form-control" v-model="punit">
																	                                <option value="0">ROOT</option>
                                                                  <option v-bind:value="unit.UnitID" v-for="unit in units">{{unit.UnitName}}</option>
																	                                <option></option>
                                                                </select>
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
                                                                    Conversion Value
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <input type="text" class="form-control" rows="4" placeholder="" v-model='cvalue'>
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
                                                                    Unit Name
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-control" rows="4" placeholder="" v-model='uname'>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </div>

                                        <!-- Earnings (Monthly) Card Example -->




                                    </div>

                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class="clearfix text-right">
                                        <a class="btn btn-success save_customar" v-on:click='save'>Save</a>
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
                    NewUnit:{
                        groupname:"",
                        punit:"",
                        cvalue:"",
                        unitname:""
                    },
                    MGroupList:[],
                    selectedgroup:"",
                    units:"",
                    isNewGroup:false,
                    ngroup:"",
                    cvalue:"",
                    punit:"",
                    uname:""
                },
                mixins: [mainMixin],
                mounted:function(){
                    axios.post('gtunitgroup')
                            .then(function(response){
                                app.MGroupList=response.data;
                            })
                            .catch(function(error){ alert(error);})
                },
                methods:{
                    save:async function(){
						app.auth=await app.chkauth("Master Data","Save");
						if(app.auth){
							app.NewUnit.groupname=app.selectedgroup;
							app.NewUnit.punit=app.punit;
							app.NewUnit.cvalue=app.cvalue;
							app.NewUnit.unitname=app.uname;
							let senddata=app.toFormData(app.NewUnit);
							axios.post('saveunit',senddata)
							.then(function(response){
								var result=response.data;
									alert(result);
									var ans=confirm("Do you want to Add?");
									if(ans){
										//window.location.assign('newsupplier.html');
									}else{
										window.location.assign('unitm');
									}
								})
							.catch(function(error){ alert(error);})
						}else{
							alert("Access Denied");
						}
                    },
                    savegroup:async function(){
						app.auth=await app.chkauth("Receipt","Save");
						if(app.auth){
							var newg={};
							newg.GroupName=app.ngroup;
							app.MGroupList.push(newg);
							app.ngroup="";
							app.isNewGroup=false;
						}else{
							alert("Access Denied");
						}
                      var newg=[];
                    },
                    getunits:function(){
                      axios.post('gtgunits',{g:app.selectedgroup})
                      .then(function(response){
                          app.units=response.data;
                      })
                      .catch(function(error){ alert(error);})
                    },
                    requery:function(){
                        axios.post('srvscript/pg.php')
                            .then(function(response){
                                app.ProductList=response.data;

                            })
                            .catch(function(error){ alert(error);})
                    },
                    scget:function(){
                        axios.post('srvscript/scg1.php?stext='+app.Product.Cid)
                            .then(function(response){
                                app.subcategorylist=response.data;

                            })
                            .catch(function(error){ alert(error);})
                    },
                    newgroup:function(){
						if(app.isNewGroup)
							app.isNewGroup=false;
                        else
							app.isNewGroup=true;
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
