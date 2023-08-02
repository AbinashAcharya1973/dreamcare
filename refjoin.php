<!DOCTYPE html>
<html lang="en">

<head>
  <title>DCC - Dream Care Cosmetics, Hair Oil, Pain Relief Oil</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Dream Care Cosmetics Hair Oil, Pain Relief Oil">
  <meta name="keywords" content="Hair Oil, Cosmetics, and FMCG Products">
  <meta name="author" content="">



  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/grayscale.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <Style>
    .pagehead {
      position: relative;
      width: 100%;
      height: auto;
      min-height: 35rem;
      padding: 15rem 0;
      background: linear-gradient(to top, rgba(255, 255, 255, .5) 0, rgba(255, 255, 255, .7) 75%, #161616 100%);
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: scroll;
      background-size: cover;
    }
  </Style>
</head>

<body id="page-top">
  <div id="content">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger text-capitalize" href="#page-top"><img src="img/logo.png" /></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.html#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.html#products">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.html#ref">Affiliat/Referral</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.html#buy">Buy</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.html#contact">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.html#login">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <?php
    include 'dbconfig.php';
    $conn = new mysqli($hostname, $username, $pwd, $databasename) or die("Could not connect to mysql" . mysqli_error($con));
    if (isset($_GET['ref'])) {
      $ref = $_GET['ref'];
    }
    $result = $conn->query("select * from members where memid=" . $ref);
    if ($result->num_rows > 0) {
      if ($row = $result->fetch_assoc()) {
        $name = $row['mname'];
        $mcode = $row['membercode'];
      }
    }
    ?>

    <section id="buy" class="about-section text-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2 class="text-white mb-4">Buy</h2>
            <p class="text-white-50"></p>
          </div>
        </div>
      </div>
    </section>
    <section id="" class="projects-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <div class="mb-3">
              <h3>Product Order</h3>
            </div>
            <form accept="" class="shadow p-4" action="reg.php" method="post">
              <p>Sponsor Name:<?php echo $name ?></p>
              <p>Sponsor Code:<?php echo $mcode ?></p>
              
              <input type="hidden" name="sp_id" value="<?php echo $ref; ?>" id="sp_id" />
              <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
              </div>

              <div class="mb-3">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" id="address" placeholder="Address" required>
              </div>
              <div class="mb-3">
                <label for="village">City/Village</label>
                <input type="text" class="form-control" name="village" id="Village" placeholder="Village/City" required>
              </div>
              <div class="mb-3">
                <label for="state">State</label>
                <select class="form-control" name="" v-model="scode">
                  <option v-bind:value="statec.STCode" v-for="statec in StateCodes">{{statec.StateName}}</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="pin">PIN Code</label>
                <input type="text" class="form-control" name="pin" id="pin" placeholder="PIN Code" required>
              </div>
              <!--<div class="mb-3">
                <label for="pin">Email ID</label>
                <input type="email" class="form-control" name="emailid" id="emailid" placeholder="Email ID">
              </div>-->
              <div class="mb-3">
                <label for="pin">Contact No</label>
                <input type="text" class="form-control" name="mobileno" id="mobileno" placeholder="Mobile No" required>
              </div>
              <!--<div class="mb-3">
                <label for="pin">Aadhar/PAN</label>
                <input type="text" class="form-control" name="panno" id="panno" placeholder="Aadhar" required>
              </div>
              <div class="mb-3">
                <label for="pin">Bank A/c</label>
                <input type="text" class="form-control" name="bankac" id="bankac" placeholder="Bank A/c" required>
              </div>
              <div class="mb-3">
                <label for="pin">IFSC</label>
                <input type="text" class="form-control" name="ifsc" id="ifsc" placeholder="IFSC" required>
              </div>-->
              <div class="mb-3">
                <label for="pin">Select Product</label>
                <select class="form-control" name="products" id="product">
                  <option value="Zorich">Zorich</option>
                  <option value="Zorum">Zoruma</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="pin">Product Cost</label>
                <input type="text" class="form-control" name="product_cost" id="product_cost" placeholder="Product Cost" value="Rs. 1000">
              </div>
              <div class="mb-3">
                <label for="pin">Freight</label>
                <input type="text" class="form-control" name="frieght" id="frieght" placeholder="Freight" value="Rs.50">
              </div>
              <div class="mb-3">
                <label for="pin">Total Cost</label>
                <input type="text" class="form-control" name="total" id="total" placeholder="Rs. 1050">
              </div>
              <label class="mb-3">
                <input type="checkbox" name="RememberMe"> Understood the Terms and Conditions
              </label>
              <div class="mb-3">
                <label for="pin">Payment QR Code</label>
                <div>
                  <img src="img/qr2.png" alt="QR Code" />
                </div>
              </div>
              <div class="mb-3">
                <label for="pin">Transaction ID</label>
                <input type="text" class="form-control" name="txid" id="txid" placeholder="UTR NO" required="true">
              </div>
              <!--<a href="#" class="float-end text-decoration-none">Reset Password</a>-->

              <div class="mb-3">
                <button type="submit" class="btn btn-primary">Place Order</button>
              </div>

              <hr>

              <!--<p class="text-center mb-0">If you have not account <a href="#">Register Now</a></p>-->

            </form>
          </div>
        </div>

      </div>
    </section>

    <!-- Signup Section -->
    <section id="signup" class="signup-section">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-lg-8 mx-auto text-center">

            <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
            <h2 class="text-white mb-5">Subscribe to receive updates!</h2>
            <form class="form-inline d-flex">
              <input type="email" class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" id="inputEmail" placeholder="Enter email address...">
              <button type="submit" class="btn btn-primary mx-auto">Subscribe</button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section bg-black">
      <div class="container">

        <div class="row">

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">CORPORATE OFFICE</h4>
                <hr class="my-4">
                <div class="small text-black-50">Dream Care Solution</div>
                <div class="small text-black-50">B07, Chandaka Meadows,</div>
                <div class="small text-black-50">Bhubaneswar - 754012</div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-envelope text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Email</h4>
                <hr class="my-4">
                <div class="small text-black-50">
                  <a href="#">dreamcaresolution@gmail.com</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Phone</h4>
                <hr class="my-4">
                <div class="small text-black-50">9437120198</div>
              </div>
            </div>
          </div>
        </div>

        <div class="social d-flex justify-content-center">
          <a href="#" class="mx-2">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="mx-2">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="mx-2">
            <i class="fab fa-github"></i>
          </a>
        </div>

      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black small text-center text-white-50">
      <div class="container">
        Copyright &copy; Dream Care Solution
      </div>
    </footer>
  </div>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/grayscale.min.js"></script>
  <script>
    var app = new Vue({
      el: '#content',
      data: {
        StateCodes: "",
        scode: ""
      },
      mounted: function() {
        axios.post('gtstatecode.php')
          .then(function(response) {
            app.StateCodes = response.data;
          })
          .catch(function(error) {
            alert(error);
          })
      },
      method: {
        saveform: function() {
          if (this.scode == "") {
            alert("Please Select State");
            return false;
          }

        }
      }

    });
  </script>
</body>

</html>