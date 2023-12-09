var Memberlist = {
  data: {
    members: [],
    page: 1,
    itemsPerPage: 10,
    totalItems: 0,
    baseurl: "memberprofile.php?memcode=",
  },

  mounted: function () {
    this.ulsid = localStorage.ulsid;
    axios
      .post("getmemberlist.php", { page: this.page })
      .then(function (response) {
        app.members = response.data;
      })
      .catch(function (error) {
        alert(error);
      });
    fetch("gettotalcount.php")
      .then((response) => response.json())
      .then((data) => {
        this.totalItems = data.total;
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
