var PurchaseJs={
data:{
    NewParty:false,
    ProductList:"",
    CrPartyList:"",
    CrPartyCount:"",
    selectedParty:"",
    selectedItem:"",
    partyaddress:"",
    partygst:"",
    partymobile:"",
    subcategory:"",
    hsn:"",
    MRP:"",
    selectunit:"",
    qty:0,
    rate:0,    
    disp:0,
    cd:0,    
    gst:0,    
    batchno:"",
    temppurchase:[],
    totalqty:0,
    totalgross:0,
    totalgstamt:0,
    totalnetamt:0,
    totaldis:0,
    freight:0,
    freightgst:18,
    batchprefix:"",
    StateList:"",
    SelectedState:""    
},

mounted:function(){
    
    axios.post('pg1')
            .then(function(response){
                app.ProductList=response.data;

            })
            .catch(function(error){ alert(error);})
    axios.post('gtpcr')
            .then(function(response){
                app.CrPartyList=response.data;
                app.CrPartyCount=Object.keys(app.CrPartyList).length;
            })
            .catch(function(error){ alert(error);})
    axios.post('getbatchprefix')
            .then(function(response){
                app.batchprefix=response.data;    
                let newdate=new Date();
                app.batchno=app.batchprefix+"-"+newdate.getDate()+"-"+newdate.getMonth()+"-"+newdate.getFullYear();            
            })
            .catch(function(error){ alert(error);})    
            axios.post('gtstatecode')
            .then(function(response){
                app.StateList=response.data;                
            })
            .catch(function(error){
                alert(error);
            })        
    this.$refs.txtpdate.valueAsDate=new Date();
    this.$refs.txtinvdate.valueAsDate=new Date();
    this.$refs.txtpdate.focus();
    
},
computed:{
    gross:function(){
        let temp=this.qty*this.rate;
        return temp.toFixed(2);
    },
    dis:function(){
        let temp= this.gross*(this.disp/100);
        return temp.toFixed(2);
    },
    tdis:function(){
        let temp=this.dis+parseFloat(this.cd);
        return temp;
    },
    gstamount:function(){
        let temp=(this.gross-this.tdis)*(this.gst/100);
        return temp.toFixed(2);
    },
    netamt:function(){
        let temp=(this.gross-this.tdis)+parseFloat(this.gstamount);
        return temp;
    },
    freightamt:function(){
        let temp=(this.freight)*(this.freightgst/100);
        return temp;
    },
    totalamount:function(){
        let temp=(this.totalnetamt)+(this.freightamt);
        return temp;
    }
},
methods:{        
    txtpdate_enter:function(){
        app.$refs.txtinvno.focus();
    },
    txtinvno_enter:function(){
        app.$refs.txtinvdate.focus();
    },
    txtinvdate_enter:function(){
        app.$refs.txtpartycr.focus();
    },
    txtpartycr_enter:function(){
        app.$refs.txtorderno.focus();
    },txtparty_change:function(){
        app.partyaddress=app.CrPartyList[app.selectedParty].Address;
        app.partygst=app.CrPartyList[app.selectedParty].GSTN;
        app.partymobile=app.CrPartyList[app.selectedParty].MobileNO;
    },
    txtproduct_change:function(){
        app.subcategory=app.ProductList[app.selectedItem].Subcategory;
        app.hsn=app.ProductList[app.selectedItem].HSN;
        app.MRP=app.ProductList[app.selectedItem].MRP;
        app.rate=app.ProductList[app.selectedItem].PurchasePrice;
        app.gst=app.ProductList[app.selectedItem].TaxP;
        let newdate=new Date();
        this.batchno=app.batchprefix+"-"+newdate.getDate()+"-"+newdate.getMonth()+"-"+newdate.getFullYear()+"-"+app.ProductList[app.selectedItem].ProductID;
    },
    txtorderno_enter:function(){
        app.$refs.txtorderdate.focus();
    },txtorderdate_enter:function(){
        app.$refs.txtwaybill.focus();
    },txtwaybill_enter:function(){
        app.$refs.txtproduct.focus();
    },
    txtqty_enter:function(){
        app.$refs.txtrate.focus();
    },
    txtrate_enter:function(){
        app.$refs.txtgross.focus();
    },
    txtgross_enter:function(){
        app.$refs.txtdisp.focus();
    },
    txtdisp_enter:function(){
        app.$refs.txtdisamt.focus();
    },
    txtdisamt_enter:function(){
        app.$refs.txtcd.focus();
    },
    txtcd_enter:function(){
        app.$refs.txtgst.focus();
    },
    txtgst_enter:function(){
        app.$refs.txtgstamt.focus();
    },
    txtgstamt_enter:function(){
        app.$refs.txtamt.focus();
    },txtamt_enter:function(){
        app.$refs.txtbatch.focus();
    },txtbatch_enter:function(){
        try{
        let newdata={};
        newdata.ProductID=this.ProductList[this.selectedItem].ProductID;
        newdata.ProductName=this.ProductList[this.selectedItem].ItemName;
        newdata.MRP=this.ProductList[this.selectedItem].MRP;
        newdata.qty=this.qty;
        newdata.rate=this.rate;
        newdata.gross=this.gross;
        newdata.disp=this.disp;
        newdata.dis=this.dis;
        newdata.cd=this.cd;
        newdata.tdis=this.tdis;
        newdata.gst=this.gst;
        newdata.gstamt=this.gstamount;
        newdata.netamt=this.netamt;
        newdata.batchno=this.batchno;
        this.temppurchase.push(newdata);
        this.totalqty=(parseFloat(this.totalqty)+parseFloat(this.qty)).toFixed(2);
        this.totalgross=(parseFloat(this.totalgross)+parseFloat(this.gross)).toFixed(2);
        this.totalgstamt=parseFloat(this.totalgstamt)+parseFloat(this.gstamount);
        this.totaldis=parseFloat(this.totaldis)+parseFloat(this.tdis);
        this.totalnetamt=parseFloat(this.totalnetamt)+parseFloat(this.netamt);
        this.qty=0;
        this.disp=0;
        this.cd=0;
        let newdate=new Date();
        this.batchno=app.batchprefix+"-"+newdate.getDate()+"-"+newdate.getMonth()+"-"+newdate.getFullYear();
        app.$refs.txtproduct.focus();
        } catch(error){
            alert(error);
        }
    },
    newpartycr:function(){
        if(app.NewParty) 
            app.NewParty=false; 
        else 
            app.NewParty=true;
    },
    setscode:function(){
        app.$refs.txtgstno.value=app.SelectedState;
    },
    savenewparty:async function(){
        app.auth=await app.chkauth("Master Data","Save");
        if(app.auth){
            var PartyCr={}
            PartyCr.party=app.$refs.txtnewparty.value;
            PartyCr.address1=app.$refs.txtnewadd1.value;
            PartyCr.address2=app.$refs.txtnewadd2.value;
            PartyCr.pincode=app.$refs.txtnewpin.value;
            PartyCr.phoneno=app.$refs.txtcontactno.value;
            PartyCr.emailid=app.$refs.txtemailid.value;
            PartyCr.gstn=app.$refs.txtgstno.value;
            PartyCr.obalance=0;
            PartyCr.obalancetype="Cr";
            PartyCr.scode=app.SelectedState;
            let senddata=app.toFormData(PartyCr);
            axios.post('partycrsave',senddata)
            .then(function(response){
                var result=response.data;
                    let newaccid=result;                                 
                    alert("Supplier Saved Successfuly");
                    var newparty={};
                    newparty.AccId=newaccid;
                    newparty.Address=PartyCr.address1;
                    newparty.Address2=PartyCr.address2;
                    newparty.Email=PartyCr.emailid;
                    newparty.Fax="";
                    newparty.GSTN=PartyCr.gstn;
                    newparty.MobileNO=PartyCr.phoneno;
                    newparty.PINCode=PartyCr.pincode;
                    newparty.Party=PartyCr.party;
                    newparty.Password="xx";
                    newparty.Phone=PartyCr.phoneno;
                    newparty.StateCode=PartyCr.scode;
                    app.CrPartyList.push(newparty);
                    app.$refs.txtnewparty.value='';
                    app.$refs.txtnewadd1.value='';
                    app.$refs.txtnewadd2.value='';
                    app.$refs.txtnewpin.value='';
                    app.$refs.txtcontactno.value='';
                    app.$refs.txtemailid.value='';
                    app.$refs.txtgstno.value='';
                    app.NewParty=false;
                    
                })
            .catch(function(error){ alert(error);})
        }else{
            alert("Access Denied");
        }
    },
    delete_i:function(idx){
        this.totalqty=Number(this.totalqty)-Number(this.temppurchase[idx].qty);
        this.totalgross=Number(this.totalgross)-Number(this.temppurchase[idx].gross);
        this.totalgstamt=Number(this.totalgstamt)-Number(this.temppurchase[idx].gstamt);
        this.totaldis=Number(this.totaldis)-Number(this.temppurchase[idx].tdis);
        this.totalnetamt=Number(this.totalnetamt)-Number(this.temppurchase[idx].netamt);
        this.temppurchase.splice(idx,1);
        this.$refs.txtproduct.focus();
    },
    save:async function(){        
        app.auth=await app.chkauth("Inventory","Save");
        if(app.auth){
            var ans=confirm("Are you sure you want to Save your Inventory?");
            if(ans){
                if(this.$refs.txtinvno.value=='') {alert("Enter Invoice NO");this.$refs.txtinvno.focus();}
                else if(this.$refs.txtpartycr.value=='') {alert("Select Party");this.$refs.txtpartycr.focus();}
                else if(this.temppurchase.length==0){alert("No Item To Save");this.$refs.txtproduct.focus();}
                else{
                    let headerdata={};
                    headerdata.pdate=this.$refs.txtpdate.value;
                    headerdata.invno=this.$refs.txtinvno.value;
                    headerdata.invdate=this.$refs.txtinvdate.value;
                    headerdata.partyid=app.CrPartyList[this.$refs.txtpartycr.value].AccId; 
                    headerdata.partyname=app.CrPartyList[this.$refs.txtpartycr.value].Party; 
                    headerdata.orderno=this.$refs.txtorderno.value;
                    headerdata.orderdate=this.$refs.txtorderdate.value;
                    headerdata.waybill=this.$refs.txtwaybill.value;
                    headerdata.totalqty=this.totalqty;
                    headerdata.totalgross=this.totalgross;
                    headerdata.totalgstamt=this.totalgstamt;
                    headerdata.totaldiscount=this.totaldis;
                    headerdata.freight=this.freight;
                    headerdata.freightgst=this.freightgst;
                    headerdata.freightamt=this.freightamt;
                    headerdata.grandtotal=this.totalamount;
                    axios.post('savepurchase',{phead:headerdata,pdetails:this.temppurchase})
                    .then(function(response){
                        alert("The last Purchase Slno:"+response.data);
                        app.temppurchase=[];
                        app.totalqty=0;
                        app.totalgross=0;
                        app.totalgstamt=0;
                        app.totaldis=0;
                        app.totalnetamt=0;
                        app.$refs.txtpdate.focus();

                    })
                    .catch(function(error){ alert(error);})
                }
            }
        }else{
          alert("Access Denied");
        }
    },
    printslip:function(){
        if(app.$refs.txtpslno.value){
            axios.post('printslip',{pslno:app.$refs.txtpslno.value})
            .then(function(response){
                window.open('pdfs/productslips-'+app.$refs.txtpslno.value+".pdf","_blank");
            })
            .catch(function(error){ alert(error);})
        }
    },
    update:async function(){
        app.auth=await app.chkauth("Master Data","Edit");
       if(app.auth){
       let senddata=app.toFormData(app.Product);
       var ans=confirm("Do you want to Update the Product Info?");
       if(ans){
       axios.post('productupdate',senddata,{header:{'Content-Type': 'multipart/form-data'}})
       .then(function(response){
           var result=response.data;
               //alert(result);                                                                                                                                                                                        							               
               app.Product.prcid="";
               app.Product.pname="";
               app.Product.mrp="0.00";
               app.Product.salerate="0.00";
               app.Product.printingcharge="0.00";                                                                               
               app.Product.hsn="";
               app.Product.tax="0.00";
               app.Product.oqty="0";
               app.Product.PrImage="";
               app.Product.sku="";
               app.Product.rackno="";
               app.Product.weight="0";               
               app.requery();
           })
       .catch(function(error){ alert(error);})
       }
       }else{
           alert("Access Denied");
       }
   },
   requery:function(){
    axios.post('productlist')
        .then(function(response){
            app.ProductList=response.data;

        })
        .catch(function(error){ alert(error);})
},
scget:function(){
    axios.post('scategorylist',{stext:app.Product.Cid})
        .then(function(response){
            app.subcategorylist=response.data;

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
edititem:async function(pid){
    //alert(pid);
    app.auth=await app.chkauth("Master Data","Edit");
    if(app.auth){
        
            app.Product.prcid=app.ProductList[pid].ProductID;
            app.Product.pname=app.ProductList[pid].ItemName;
            app.Product.mrp=app.ProductList[pid].MRP;
            app.Product.salerate=app.ProductList[pid].SalePrice;
            app.Product.printingcharge=app.ProductList[pid].PrintingCharge;
            app.Product.Brandid=app.ProductList[pid].BrandID;
            app.Product.Cid=app.ProductList[pid].CategoryID;
            app.scget();                                
            app.Product.unit=app.ProductList[pid].Unit;
            app.Product.hsn=app.ProductList[pid].HSN;
            app.Product.tax=app.ProductList[pid].TaxP;
            app.Product.oqty=app.ProductList[pid].OpeningStock;
            app.Product.PrImage=app.ProductList[pid].PrImage;
            app.Product.sku=app.ProductList[pid].SKU;
            app.Product.rackno=app.ProductList[pid].RackNo;
            app.Product.weight=app.ProductList[pid].Weight;
            app.Product.Sid=app.ProductList[pid].SubcategoryID;
            app.Product.TColor=app.ProductList[pid].TColor;
        /*axios.post('srvscript/pq.php?pid='+pid)
        .then(function(response){
            app.tempProduct=response.data;
            app.Product.prcid=app.tempProduct[0].ProductID;
            app.Product.pname=app.tempProduct[0].ItemName;
            app.Product.mrp=app.tempProduct[0].MRP;
            app.Product.salerate=app.tempProduct[0].SalePrice;
            app.Product.printingcharge=app.tempProduct[0].PrintingCharge;
            app.Product.Brandid=app.tempProduct[0].BrandID;
            app.Product.Cid=app.tempProduct[0].CategoryID;
            app.Product.Sid=app.tempProduct[0].SubcategoryID;
            app.Product.unit=app.tempProduct[0].Unit;
            app.Product.hsn=app.tempProduct[0].HSN;
            app.Product.tax=app.tempProduct[0].TaxP;
            app.Product.oqty=app.tempProduct[0].OpeningStock;
            app.Product.PrImage=app.tempProduct[0].PrImage;
        })
        .catch(function(error){ alert(error);})*/
    }else{
        alert("Access Denied");
    }
},
deleteitem:async function(pid){
    //alert(pid);
    app.auth=await app.chkauth("Master Data","Delete");
    if(app.auth){
    var ans=confirm("Delete the Product?");
    if(ans)
    {
    axios.post("deleteproduct",{pid:pid})
        .then(function(response){
            var result=response.data;
            alert(result);
            app.requery();
        })
        .catch(function(error){ alert(error);})
      }
  }else{
      alert("Access Denied");
  }
}


}
}