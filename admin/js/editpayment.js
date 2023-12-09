var EditPayment={
	data:{
        DrAccs:"",
        AccGroups:"",
        CrLedgers:"",
        groupselected:"",
        selecteddracc:"",
        selectedcracc:"",                    
        cramount:"0.00",
        remarks:"",
        edit:true,
        vno:"",
        deletev:false,
        lastvno:"",
        tempVoucher:{
            selecteddracc:"",
            selectedcracc:"",                    
            cramount:"0.00",
            remarks:"",
            vdate:"",
            vno:"",
            edit:false
        },
        vdate:"",
        curdate:""
    },
    computed:{        
        dramount:function(){
            return this.cramount;
        }
    },
    mounted:function(){
        this.vno=localStorage.temprvno;
        axios.post('maxpv')
        .then(function(response){
            app.lastvno=response.data;                                
        })
        .catch(function(error){ alert(error);})
        axios.post('gdraccs')
                .then(function(response){
                    app.DrAccs=response.data;                                
                })
                .catch(function(error){ alert(error);})
        axios.post('gg')
                .then(function(response){
                    app.AccGroups=response.data;                                
                })
                .catch(function(error){ alert(error);}) 
        axios.post('getpv',{vid:this.vno})
                .then(function(response){
                    //app.CrLedgers=response.data;
                    var tempVoucher=response.data;
                    app.groupselected=tempVoucher[0].GroupID;
                    app.loadledger();                        
                    app.groupselected=tempVoucher[0].GroupID;                                
                    app.selecteddracc=tempVoucher[0].DrAcc;
                    app.$refs.txtvdate.value=tempVoucher[0].RDate;
                    app.cramount=tempVoucher[0].Amount;
                    app.selectedcracc=tempVoucher[0].CrAcc;
                    app.remarks=tempVoucher[0].Remark;
                    
                })
                .catch(function(error){ alert(error);})                        
            this.$refs.txtvdate.focus();
        },
    methods:{
           loadledger:function() {
            axios.post('loadldg',{gid:app.groupselected})
            .then(function(response){
                app.CrLedgers=response.data;                                
            })
            .catch(function(error){ alert(error);})
           },
           save:async function(){
            app.auth=await app.chkauth("Payment","Save");
            if(app.auth){
               //let senddata=app.toFormData(app.tempCmas);
               var ans=confirm("Save the Voucher?");
               if(ans){
                   let newdata={};
                   newdata.cramount=app.cramount;                            
                   newdata.selectedcracc=app.selectedcracc;
                   newdata.selecteddracc=app.selecteddracc;
                   newdata.vdate=this.$refs.txtvdate.value;
                   newdata.remarks=app.remarks;
                   newdata.vno=app.vno;
                   newdata.edit=app.edit;
                   //let senddata=app.toFormData(app.tempVoucher);
                   axios.post('spv',newdata)
                   .then(function(response){
                       //var result=response.data;
                           //alert(result);
                           //app.tempPrf.FirstName="";
                           app.edit=false;
                           app.tempVoucher.edit=true;
                           app.cramount=0;
                           app.vno="";
                           app.remarks="";
                           alert("Voucher Saved");
                           //window.location.href = "pvlist";
                           //app.maxvno();
                          
                           //app.requery();
                       })
                   .catch(function(error){ alert(error);})
               }
            }else{
               alert("Access Denied");
           }
        },
        maxvno:function(){
            axios.post('maxrv')
                .then(function(response){
                    app.lastvno=response.data;                                
                })
                .catch(function(error){ alert(error);})                            
        },
        toFormData: function(obj) {
            let formData = new FormData();
            for(let key in obj) {
                formData.append(key, obj[key]);
            }
            //this.file = this.$refs.file.files[0];
            //formData.append('file',this.file);
            return formData;
        },
        print:async function(){
            app.auth=await app.chkauth("Receipt Vouchers","Save");
            if(app.auth){
                axios.post('receiptprint',{vno:app.vno})
                .then(function(response){
                        window.open("pdfs/receipt-"+app.vno+".pdf","_blank");
                    })
                .catch(function(error){ alert(error);})
            }else{
                alert("Access Denied");
            }
        },
        editclicked:async function(){
            app.auth=await app.chkauth("Receipt","Edit");
            if(app.auth){
                document.getElementById("vslno").focus();
                app.edit=true;
                app.deletev=false;
            }else{
                alert("Access Denied");
            }
        },
        deleteclicked:async function(){
            app.auth=await app.chkauth("Receipt","Delete");
            if(app.auth){
                document.getElementById("vslno").focus();
                app.deletev=true;
                app.edit=false;
            }else{
                alert("Access Denied");
            }
        },
        editv:async function(){
            app.auth=await app.chkauth("Receipt","Edit");
            if(app.auth){
            var ans=confirm("Edit the Voucher?");
            if(ans){
                app.edit=true;
                app.tempVoucher.edit=true;
                axios.post('rvinfo',{vid:app.vno})
                .then(function(response){
                    //app.CrLedgers=response.data;
                    if(response.data.length>0){
                        var tempVoucher=response.data;
                        app.groupselected=tempVoucher[0].GroupID;
                        app.loadledger();
                        app.vdate=tempVoucher[0].ReceiptDate;
                        app.groupselected=tempVoucher[0].GroupID;                                
                        app.selecteddracc=tempVoucher[0].DrAcc;
                        app.vdate=tempVoucher[0].RDate;
                        app.cramount=tempVoucher[0].Amount;
                        app.selectedcracc=tempVoucher[0].CrAcc;
                    }else{
                        alert("Invalid Voucher No");
                    }
                    
                    
                })
                .catch(function(error){ alert(error);})                    
                
            }
            }else{
                alert("Access Denied");
            }
        },
        deletevoucher:async function(){
            app.auth=await app.chkauth("Receipt","Delete");
            if(app.auth){
            axios.post('srvscript/editrv.php?vid='+app.vno)
                .then(function(response){
                    //app.CrLedgers=response.data;
                    var tempVoucher=response.data;
                    app.groupselected=tempVoucher[0].GroupID;
                    app.loadledger();
                    app.vdate=tempVoucher[0].ReceiptDate;
                    app.groupselected=tempVoucher[0].GroupID;                                
                    app.selecteddracc=tempVoucher[0].DrAcc;
                    app.vdate=tempVoucher[0].RDate;
                    app.cramount=tempVoucher[0].Amount;
                    app.selectedcracc=tempVoucher[0].CrAcc;
                    app.maxvno();
                    
                })
                .catch(function(error){ alert(error);})                    
                var ans=confirm("Delete the Voucher?");
                if(ans){
                    axios.post('srvscript/deleterv.php?vid='+app.vno)
                    .then(function(response){
                        //app.CrLedgers=response.data;                                                                        
                        app.edit=false;
                        app.deletev=false;                                    
                        app.cramount=0;
                        app.vno="";
                        app.remarks="";
                        alert("Voucher Deleted");
                        window.location.assign("rvlist.html");
                    })
                    .catch(function(error){ alert(error);})
                }
            }else{
                alert("Access Denied");
            }
        },
        edit_delete:function(){
            if(app.edit){                            
                app.editv();
            }
            if(app.deletev){
                app.deletevoucher();
            }
        }
    }

}

