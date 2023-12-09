var Withdraw = {
  data: {
    closingbalance: 0.0,
    withdrawalamount: 0.0,
    withdrawlist:[],
    baseurl:'aprovewithdraw.php?id='
  },

  mounted: function () {
    this.ulsid = localStorage.ulsid;
    axios
      .post("getwithdrawlist.php", { expt: this.ulsid })
      .then(function (response) {
        app.withdrawlist = response.data;
        //app.closingbalance = response.data[0].ClosingBalance;
      })
      .catch(function (error) {
        alert(error);
      });
  },
  methods: {
  },
};
