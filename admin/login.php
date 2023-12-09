<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head runat="server">
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dream Care Login</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Dream Care Login</h3></div>
                                    <div class="card-body">
                                        <form id="login">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Member Code </label>
                                                <input class="form-control py-4" id="userid" name="userid" type="text" placeholder="Enter User ID" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="password" name="password" type="password" placeholder="Enter password" />
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Forgot Password?</a>
                                                <button class="btn btn-primary">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="#">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <!--<script src="js/scripts.js"></script>-->
    </body>
<!--<script src="jquery/jquery.min.js"></script>-->
<!--<script type="text/javascript">
$(document).ready(function() {
    $('#login').submit(function(e) {
    e.preventDefault();
    $.ajax({
       type: "POST",
       url: '/enliteweb1/checklogin',
       data: $(this).serialize(),
       success: function(data)
       {
          var res=$.trim(data);
          //alert(res);
          if (res==='OK') {
            window.location.assign("/enliteweb1/");
            //alert("Ok");
            /*var logform=document.getElementById('logindiv');
            logindiv.style.display='none';
            var tranform=document.getElementById('tran');
            tranform.style.display='block';*/
          }
          else {
            alert('Invalid Credentials');
          }
       }
   });
  });
});
</script>-->
<script type="text/javascript">

    $(document).ready(function() {  
        $('#login').submit(function(e) {
        e.preventDefault();
        axios({
            method:"post",
            url:"checklogin.php",
            data:$(this).serialize()})
            .then(function(response){                            
                var spdx=document.getElementById('userid').value;
                var result=JSON.parse($.trim(response.data));
                if(result.Status){
                    alert("Login Successful");                    
                    localStorage.ulsid=spdx;
                    localStorage.kt=result.UT;
                    localStorage.ptx=result.ptx;
                    localStorage.BID=result.BID;
                    localStorage.BN=result.BName;
                    sessionStorage.setItem("ulsid",spdx );
                    window.location.assign(result.ptx);
                }else{
                    let tmsg=result.msg;
                    alert(tmsg);
                    if(result.origin){
                        if(localStorage.ulsid===spdx){
                            localStorage.ptx=result.ptx;
                            sessionStorage.setItem("ulsid",spdx );
                            window.location.assign(result.ptx);
                        }
                    }
                }
                
            })
            .catch(function(error){alert(error);});
      });
      
    });
    
    $(window).on("load",function(){
      if(localStorage.getItem('ulid')){
            if(sessionStorage.getItem("ulsid")==localStorage.getItem('ulsid'))
            //window.location.assign(localStorage.ptx);
            var result="No";
        }
    });
    </script>
</html>
