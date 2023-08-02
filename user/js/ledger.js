var Ledger = {
  data: {
    trns: [],
    totalincome:0.00,
    totalwithdraw:0.00,
    closingbalance:0.00
  },

  mounted: function () {
    this.ulsid = localStorage.ulsid;
    axios
      .post("getledgerst.php", { expt: this.ulsid })
      .then(function (response) {
        app.trns = response.data;
        app.totalincome = 0;
        app.totalwithdraw = 0;
        app.closingbalance = 0;
        for (var i = 0; i < app.trns.length; i++) {
            app.totalincome += parseFloat(app.trns[i].income);
            app.totalwithdraw += parseFloat(app.trns[i].withdrawal);            
        }
        app.closingbalance =app.totalincome - app.totalwithdraw;
      })
      .catch(function (error) {
        alert(error);
      });
  },
  methods: {
    loadledger: function () {
      axios
        .post("loadldg", { gid: app.groupselected })
        .then(function (response) {
          app.CrLedgers = response.data;
        })
        .catch(function (error) {
          alert(error);
        });
    },
  },
};
