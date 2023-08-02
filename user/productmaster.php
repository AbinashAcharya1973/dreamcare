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
                                <i class="fas fa-chart-area mr-1"></i>Product Master Entry
                            </div>
                            <div class="card-body">
                            <div class="col">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label">Category</label>
                                        <select class="form-control" v-on:change="scget()" v-model='Product.Cid' id="ddlcategory">
                                            <option :value="category.CategoryID" v-for="category in categorylist">{{category.Category}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label">SubCategory</label>
                                        <select class="form-control" v-model='Product.Sid' id="ddlsubcategory">
                                            <option :value="subcategory.SubcategoryID" v-for="subcategory in subcategorylist">{{subcategory.Subcategory}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label">Brand</label>
                                        <select class="form-control" v-model='Product.Brandid' id="txtbrand">
                                            <option :value="brand.BrandID" v-for="brand in brandslist">{{brand.BrandName}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label">Product Name</label>
                                        <input type="text" class="form-control" v-model='Product.pname' id="ddlproductname" required/>
                                        <input type="hidden" class="form-control" v-model='Product.prcid'/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label">SKU</label>
                                        <input type="text" class="form-control" v-model="Product.sku"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label">Rack No</label>
                                        <input type="text" class="form-control" v-model="Product.rackno"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label">Weight</label>
                                        <input type="text" class="form-control" v-model="Product.weight"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label">Unit</label>
                                        <select id="unit" class="form-control" v-model="Product.unit">
                                            <option value='PACKS'>PACKS</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label">Sale Rate</label>
                                        <input type="text" class="form-control" v-model='Product.salerate'/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label">MRP</label>
                                        <input type="text" class="form-control" v-model='Product.mrp'/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label">Printing Price</label>
                                        <input type="text" class="form-control" v-model='Product.printingcharge'/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label">Tax</label>
                                        <input type="text" class="form-control" v-model='Product.tax'/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label">HSN</label>
                                        <input type="text" class="form-control" v-model='Product.hsn'/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label">Product Description</label>
                                        <textarea class="form-control" v-model='Product.Description'></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label">Warranty [In Months]</label>
                                        <input type="text" class="form-control" v-model='Product.Warranty'/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label">Opening Qty</label>
                                        <input type="text" class="form-control" v-model='Product.oqty'/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label">Product Color</label>
                                        <input type="color" class="form-control" v-model='Product.TColor'/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="form-group">
                                                <label class="label d-block">Upload Image</label>
                                                <input type="file" class="mt-1" id="file" ref="file" style="border-color: transparent;" onchange="imgpreview()"/>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <img class="uplodedImg" v-bind:src="Product.PrImage" id='imagepreview' height="120px" width="120px"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group text-right py-5">
                                        <button class="btn btn-secondary" v-on:click="update()">Update</button> <button class="btn btn-primary" v-on:click="save()">Save</button>
                                    </div>
                                </div>

                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Product Description</th>
                                            <th style="width: 200px;">Action[Edit/Delete/Active]</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Product Description</th>
                                            <th>Action[Delete/Edit]</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr v-for="(product,index) in ProductList">
                                            <td>
                                                <div class="row align-items-center">
                                                    <img v-bind:src='product.PrImage' class="px-3" height="50px"/><br>
                                                    {{product.ItemName}}<br>
                                                    MRP:{{product.MRP}}<br>
                                                    Sales Price:{{product.SalePrice}}<br>
                                                    {{product.ProductID}}<br>
                                                    <div v-bind:style="{color:product.TColor}">&#9608</div><br>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row justify-content-around mx-0">
                                                    <button class="btn btn-primary btn-sm" @click="edititem(index)"><i :id=product.ProductID class="fas fa-edit fa-fw" ></i></button>
                                                    <button class="btn btn-primary btn-sm" @click="deleteitem(product.ProductID)"><i class="fas fa-trash fa-fw" ></i></button>
                                                    <button v-if="product.Status==1" class="btn btn-primary btn-sm" @click="toggle(index)"><i class="fas fa-toggle-on fa-fw" ></i></button>
                                                    <button v-if="product.Status==0" class="btn btn-primary btn-sm" @click="toggle(index)"><i class="fas fa-toggle-off fa-fw"></i></button>
                                                </div>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
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
        <script src="js/itementry.js"></script>
        <script>
            function imgpreview(){
            var reader = new FileReader();
                reader.onload = function()
                {
                    var output = document.getElementById('imagepreview');
                    output.src = reader.result;
                }
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>
        <script>        
            var app=new Vue({
                el:'#content',
                data:{
                    
                },
                mixins: [mainMixin,PMaster],
                
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
