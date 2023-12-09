var Payment = {
  data: {
    membercode:'',
    amount:0,
    trdate:'',
    remarks:'',
    memname:''
  },

  mounted: function () {},
  methods: {
    savevoucher: function () {
      this.amount = document.getElementById("amt").value;
      this.trdate = document.getElementById("rdate").value;
      this.membercode = document.getElementById("membercode").value;
      this.remarks = document.getElementById("remarks").value;
      var formObj=new Object();
      formObj.id = this.membercode;
      formObj.amt = this.amount;
      formObj.tdate = this.trdate;
      formObj.remarks = this.remarks;

      axios
        .post("savepv.php", formObj)
        .then(function (response) {
          if(response.data.localeCompare("OK")==0){
            window.location.href = 'ledger.php';
          }else{
            alert(response.data); 
          }
                    
        })
        .catch(function (error) {
          alert(error);
        });
    },
    getname: function () {
        this.membercode = document.getElementById("membercode").value;
        axios
          .post("getname.php", { expt: this.membercode })
          .then(function (response) {
            app.memname = response.data;
            
          })
          .catch(function (error) {
            alert(error);
          });
      }
  },
};
