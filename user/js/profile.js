var Profile = {
  data: {
    members: "",
    showPassword:false,npwd:'',
  },

  mounted: function () {
    this.ulsid = localStorage.ulsid;
    axios
      .post("getuserdetails.php", { expt: this.ulsid })
      .then(function (response) {
        app.members = response.data;
      })
      .catch(function (error) {
        alert(error);
      });
  },
  methods: {
    updateprof: function () {
      axios
        .post("updatepf.php", { pfdata: app.members })
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
      var memid = this.members[0].memid;
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
