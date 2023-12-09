var Analytics = {
  data: {
    trns: [],
    totalmem: "",
    totaldirect: "",
    totalteammem: "",
    totalinvest: "",
    totalpayout: "",
    totalrepurchase: "",
    membercode: "",
    mbonus: "",
    levelin: "",
    totalin: "",
    withdrawal: []
  },

  mounted: function () {
    this.ulsid = localStorage.ulsid;
    axios
      .post("getanalytics.php", { exp: this.ulsid })
      .then(function (response) {
        var tempdata = response.data;
        app.totalmem = tempdata.memcount;
        app.totaldirect = tempdata.direct;
        app.totalteammem = tempdata.temmem;
        app.mbonus = tempdata.mbonus;
        app.levelin = tempdata.levelin;
        app.totalin = tempdata.totalin;
        axios
          .post("getwithdrawal.php", { exp: app.ulsid })
          .then(function (response) {
            app.withdrawal = response.data;
          })
          .catch(function (error) {
            alert(error);
          });
      })
      .catch(function (error) {
        alert(error);
      });
  },
  methods: {},
};
