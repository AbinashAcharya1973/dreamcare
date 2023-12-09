var MemberProfile = {
    data: {
      members: "",
      showPassword:false,npwd:'',
      membercode:'',
      mname:'',
          address:'',
          city_village:'',
          pin:'',
          emailid:'',
          mobileno:'',
          aadhar:'',
          bankac:'',
          ifsc:'',
          affiliatelink:''
    },
  
    mounted: function () {
      /*this.ulsid = localStorage.ulsid;
      axios
        .post("getmemdetails.php", { expt: app.membercode })
        .then(function (response) {
          app.members = response.data;
        })
        .catch(function (error) {
          alert(error);
        });*/
    },
    methods: {
      updateprof: function () {
          var member=new Object();
          member.mname=document.getElementById("usname").value;
          member.address=document.getElementById("address").value;
          member.city_village=document.getElementById("city").value;
          member.pin=document.getElementById("pin").value;
          member.emailid=document.getElementById("email").value;
          member.mobileno=document.getElementById("mobileno").value;
          member.aadhar=document.getElementById("pan").value;
          member.bankac=document.getElementById("bankac").value;
          member.ifsc=document.getElementById("ifsc").value;
          member.membercode=document.getElementById("membercode").value;        
        axios
          .post("updatemempf.php", { pfdata: member })
          .then(function (response) {
            //app.CrLedgers=response.data;
            alert("Profile updated");
          })
          .catch(function (error) {
            alert(error);
          });
      },
      updatepwd: function () {
        var expwd = document.getElementById("cpwd").value;
        var npwd = document.getElementById("npwd").value;
        var memid = document.getElementById("membercode").value;
        axios
          .post("updatepwd.php", { memid: memid, npwd: npwd, cpwd: expwd })
          .then(function (response) {
            //app.CrLedgers=response.data;
            alert(response.data);
          })
          .catch(function (error) {
            alert(error);
          });
      },
    },
  };
  