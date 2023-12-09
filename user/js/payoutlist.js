var Payoutlist = {
  data: {
    plist: [],
    pdetails: [],
    rewardlist: [],    
    membercode: "",
  },

  mounted: function () {
    this.ulsid = localStorage.ulsid;
    axios
      .post("getpayoutlist.php",{expt: this.ulsid})
      .then(function (response) {
        app.plist = response.data;
      })
      .catch(function (error) {
        alert(error);
      });
  },
  methods: {
    showdetails: function (id) {
      let pcode = app.plist[id].payoutid;
      axios
        .post("getpayoutdetails.php", { pid: pcode,expt: this.ulsid})
        .then(function (response) {
          app.pdetails = response.data;
          axios.post("getrewarddetails.php", { pid: pcode,expt: app.ulsid})
          .then(function (response){
            app.rewardlist = response.data;
          })
          .catch(function (error) { alert("Error: " + error)});
        })
        .catch(function (error) {
          alert(error);
        });
    },
    
  },
};
