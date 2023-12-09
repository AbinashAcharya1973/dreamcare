var Ledger = {
  data: {
    trns: [],
    totalincome: 0.0,
    totalwithdraw: 0.0,
    closingbalance: 0.0,
    membercode:''
  },

  mounted: function () {},
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
    serachledger: function () {
      this.membercode = document.getElementById("membercode").value;
      axios
        .post("getledgerst.php", { expt: this.membercode })
        .then(function (response) {
          app.trns = response.data;
          app.totalincome = 0;
          app.totalwithdraw = 0;
          app.closingbalance = 0;
          for (var i = 0; i < app.trns.length; i++) {
            app.totalincome += parseFloat(app.trns[i].income);
            app.totalwithdraw += parseFloat(app.trns[i].withdrawal);
          }
          app.closingbalance = app.totalincome - app.totalwithdraw;
        })
        .catch(function (error) {
          alert(error);
        });
    },
  },
};
