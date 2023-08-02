var Withdraw = {
  data: {    
    closingbalance:0.00,
    withdrawalamount:0.00,    
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
      axios
        .post("withdrawreq.php", { expt: this.ulsid,amt: app.withdrawalamount })
        .then(function (response) {
          alert(response.data);
        })
        .catch(function (error) {
          alert(error);
        });
    },
  },
};
