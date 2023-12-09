var Analytics = {
    data: {
      trns: [],
      totalmem: '',
      totaldirect:'',
      totalteammem:'',
      totalinvest:'',
      totalpayout:'',
      totalrepurchase:'',
      membercode:''
    },
  
    mounted: function () {
      axios
          .post("getanalytics.php")
          .then(function (response) {
            var tempdata = response.data;
            app.totalmem=tempdata.memcount;
            app.totaldirect=tempdata.direct;
            app.totalteammem=tempdata.temmem;
          })
          .catch(function (error) {
            alert(error);
          });
    },
    methods: {    
    },
  };
  