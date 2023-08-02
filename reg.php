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
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
    header('Accept: application/json;charset=UTF-8');
    include 'dbconfig.php';
    $conn = new mysqli($hostname, $username, $pwd, $databasename) or die("Could not connect to mysql" . mysqli_error($con));
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Retrieve form data
      $mname = $_POST['name'];
      $address = $_POST['address'];
      $city_village = $_POST['village'];
      $pin = $_POST['pin'];
      $statecode = $_POST['state'];
      //$emailid = $_POST['emailid'];
      $emailid = '';
      $mobileno = $_POST['mobileno'];
      //$bankac = $_POST['bankac'];
      //$ifsc = $_POST['ifsc'];
      //$aadhar = $_POST['panno'];
      $bankac = "";
      $ifsc = '';
      $aadhar = '';
      $product = $_POST['products'];
      $joingindate = date("Y-m-d H:i:s");
      $totalamount = $_POST['total'];
      $txid = $_POST['txid'];
      if (is_null($txid)) {
        $paid = 'N';
        $mactive = 'N';
      } else {
        $paid = 'Y';
        $mactive = 'Y';
      }
      if (isset($_POST['sp_id'])) {
        $sponsorid = $_POST['sp_id'];
      } else {
        $sponsorid = 1; // Replace with the sponsor ID if applicable
      }

      $membercode = ''; // Replace with the member code if applicable
      $totalreferral = 0;
      $currentlevel = 0;

      // Prepare the SQL statement
      $sql = "INSERT INTO members (mname, address, city_village, pin, statecode, emailid, mobileno, bankac, ifsc, aadhar, product, joingindate, totalamount, paid, txid, mactive, sponsorid, membercode, totalreferral, currentlevel)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

      // Prepare and bind the statement
      $stmt = $conn->prepare($sql);
      $stmt->bind_param(
        "ssssisssssssdsssisii",
        $mname,
        $address,
        $city_village,
        $pin,
        $statecode,
        $emailid,
        $mobileno,
        $bankac,
        $ifsc,
        $aadhar,
        $product,
        $joingindate,
        $totalamount,
        $paid,
        $txid,
        $mactive,
        $sponsorid,
        $membercode,
        $totalreferral,
        $currentlevel
      );

      // Execute the statement
      if ($stmt->execute()) {
        $memid = $conn->insert_id;
        $membercode = $sponsorid . "-" . $memid . "-" . date("Y");
        $affiliatelink = 'http://dreamcaresolution.in/refjoin.php?ref=' . $memid;
        //$encodedUrl = urlencode($originalUrl);
        $conn->query("update members set affiliatelink='" . $affiliatelink . "',membercode='" . $membercode . "' where memid=" . $memid);
        if ($sponsorid != 1)
          $conn->query("update members set totalreferral=totalreferral+1 where memid=" . $sponsorid);
          $conn->query("insert into ledger (tdate,particulars,income,memid) values('".$joingindate."','On Joining',200,".$memid.")");
        $message = "Thank you for Purchasing the product.";
      } else {
        $message = "Registration failed: " . $stmt->error;
      }

      // Close the statement
      $stmt->close();
    }

    // Close the connection
    $conn->close();

    ?>
    <header class="pagehead">
      <div class="container">
        <div class="h-100 justify-content-center">
          <div class="row">
            <div class="col">
              <div class="card py-4 h-100">
                <div class="card-body text-center">
                  <h5 class="text-danger"><?php echo $message ?></h5><br>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card py-4 h-100">
                <div class="card-body text-center">
                  <p><a href="regcert.php?memid=<?php echo $memid ?>" target="_blank">Download Registration Certificate</a></p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card py-4 h-100">
                <div class="card-body text-center">
                  <p>Your Member Code/Login Code:<?php echo $membercode?></p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card py-4 h-100">
                <div class="card-body text-center">
                  <p>Referral Link:<a href="<?php echo $affiliatelink?>">Copy the Link</a></p>
                </div>
              </div>
            </div>
          </div>


        </div>
      </div>
  </div>

  </header>
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