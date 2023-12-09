var Payoutlist = {
    data: {
      plist: [],
      pdetails:[],
      invlist: [],
      inclist: [],
      membercode: "",
    },
  
    mounted: function () {
      axios
        .post("getpayoutlist.php")
        .then(function (response) {
          app.plist = response.data;        
        })
        .catch(function (error) {
          alert(error);
        });
    },
    methods: {
      showdetails:function(id){                        
          let pcode=app.plist[id].payoutid;
          axios.post('getpayoutdetails.php',{pid:pcode})
          .then(function(response){
              app.pdetails=response.data;
          })
          .catch(function(error){
              alert(error);
          })
      },
      showincentives:function(id){                        
          let pcode=app.pdetails[id].payoutid;
          let mcode=app.pdetails[id].memid;
          axios.post('getincentives.php',{pid:pcode,memid:mcode})
          .then(function(response){
              app.inclist=response.data;
          })
          .catch(function(error){
              alert(error);
          })
          axios.post('getmpshare.php',{pid:pcode,memid:mcode})
          .then(function(response){
              app.invlist=response.data;
          })
          .catch(function(error){
              alert(error);
          })
      }        
    },
  };
  