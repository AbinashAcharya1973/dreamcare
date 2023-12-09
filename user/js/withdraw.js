var Withdraw = {
  data: {
    closingbalance: 0.0,
    withdrawalamount: 0.0,
    otp:''
  },

  mounted: function () {
    this.ulsid = localStorage.ulsid;
    axios
      .post("getbalance.php", { expt: this.ulsid })
      .then(function (response) {
        app.trns = response.data;
        app.closingbalance = response.data[0].ClosingBalance;
      })
      .catch(function (error) {
        alert(error);
      });
  },
  methods: {
    withdraw: function () {
      this.closingbalance=document.getElementById("balance").value;
      this.withdrawalamount=document.getElementById("amount").value;
      if (parseFloat(this.closingbalance) > parseFloat(this.withdrawalamount) && parseFloat(this.closingbalance) >500){
        axios
          .post("withdrawreq.php", {
            expt: this.ulsid,
            amt: app.withdrawalamount,
            otp: app.otp,
          })
          .then(function (response) {
            alert(response.data);
            app.withdrawalamount = 0.0;
            if(response.data!="Invalid OTP"){
              window.location.href="index.php";
            }
          })
          .catch(function (error) {
            alert(error);
          });
      }else {
        alert("Closing Balance is less than Requested Amount or Minimum Balance is not available");
      }
    },
  },
};
