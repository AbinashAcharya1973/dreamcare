var AppWithdraw = {
  data: {
    closingbalance: 0.0,
    withdrawalamount: 0.0,
    appslno: "",
    balaceavailable:false
  },

  mounted: function () {

  },
  methods: {
    approve: async function () {
      this.withdrawalamount = document.getElementById("amount").value;
      this.appslno = document.getElementById("slno").value;
      const memid=document.getElementById("memid").value;
      await axios.post("balancecheck.php", {amt:this.withdrawalamount,memid:memid})
      .then(function(response){
        app.balaceavailable=response.data.avail;
      })
      .catch(function(error){
        alert(error);
      });
      if(app.balaceavailable){
      await axios
        .post("appwithdraw.php", { amt: this.withdrawalamount,id:this.appslno })
        .then(function (response) {
          alert(response.data); 
          window.location.href = 'withdrawreq.php';         
        })
        .catch(function (error) {
          alert(error);
        });
      }else{
        alert("Not having enough Debit Balance");
      }
    },
  },
};
