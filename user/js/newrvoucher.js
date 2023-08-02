var NewRVoucher={
	data:{
            DrAccs:"",
            AccGroups:"",
            CrLedgers:"",
            groupselected:"",
            selecteddracc:"",
            selectedcracc:"",                    
            cramount:"0.00",
            remarks:"",
            edit:false,
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
            axios.post('maxrv')
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
            this.$refs.txtvdate.valueAsDate=new Date();
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
                app.auth=await app.chkauth("Receipt","Save");
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
                       axios.post('srv',newdata)
                       .then(function(response){
                           //var result=response.data;
                               //alert(result);
                               //app.tempPrf.FirstName="";
                               app.edit=false;
                               app.tempVoucher.edit=false;
                               app.cramount=0;
                               app.vno="";
                               app.remarks="";
                               alert("Voucher Saved");
                               window.location.href = "rvoucher";
                               app.maxvno();
                              
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
            }
        }

}

