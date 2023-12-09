var PMaster={
data:{
    sc_entry_txt:"",
    categorylist:"",
    subcategorylist:"",
    brandslist:"",
    c_text:"",
    Product:{
        Cid:"",
        Sid:"",
        Brandid:"",
        pname:"",
        unit:"",
        salerate:"0.00",
        printingcharge:"0",
        mrp:"0",
        hsn:"",
        tax:"0.00",
        oqty:"0",
        sku:"",
        rackno:"",
        weight:"0",
        TColor:"",
        Description:"",
        Warranty:"6"
    },
    ProductList:"",
    tempProduct:"",
    file:"",
    sku:"",
    rackno:""        
},
mounted:function(){
    axios.post('cg')
            .then(function(response){
                app.categorylist=response.data;

            })
            .catch(function(error){ alert(error);})
    axios.post('bdns')
            .then(function(response){
                app.brandslist=response.data;

            })
            .catch(function(error){ alert(error);})
    axios.post('pg')
            .then(function(response){
                app.ProductList=response.data;

            })
            .catch(function(error){ alert(error);})
},
methods:{    
    
    save:async function(){
        app.auth=await app.chkauth("Master Data","Save");
        if(app.auth){
        let senddata=app.toFormData(app.Product);
        if (document.getElementById('ddlcategory').value == "") {
                alert("Please Select Category !");
                document.getElementById("ddlcategory").focus();
            }
        else if (document.getElementById('ddlsubcategory').value == "") {
                alert("Please Select Subcategory !");
                document.getElementById("ddlsubcategory").focus();
            }
        else if (document.getElementById('txtbrand').value == "") {
                alert("Please Select Brand Name !");
                document.getElementById("txtbrand").focus();
            }
        else if (document.getElementById('ddlproductname').value == "") {
                alert("Please input Product name !");
                document.getElementById("ddlproductname").focus();
            }	
        else
        {
        var ans=confirm("Save the Product Info?");
        if(ans){
        axios.post('ps',senddata,{header:{'Content-Type': 'multipart/form-data'}})
        .then(function(response){
            var result=response.data;
                //alert(result);
                app.Product.pname="";
                app.Product.salerate="0.00";
                app.Product.printingcharge="0.00";
                app.Product.mrp="0.00";
                app.Product.hsn="";
                app.Product.tax="0.00";
                app.Product.oqty="0";
                app.Product.weight="0.00"
                app.Product.PrImage="";
                app.Product.Description="";
                app.Product.Warranty=6;
                app.requery();
            })
        .catch(function(error){ alert(error);})
        }
      }
      }else{
          alert("Access Denied");
      }
    },
    update:async function(){
        app.auth=await app.chkauth("Master Data","Edit");
       if(app.auth){
       let senddata=app.toFormData(app.Product);
       var ans=confirm("Do you want to Update the Product Info?");
       if(ans){
       axios.post('pu',senddata,{header:{'Content-Type': 'multipart/form-data'}})
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
               app.Product.Description="";
               app.Product.Warranty=0;
               app.requery();
           })
       .catch(function(error){ alert(error);})
       }
       }else{
           alert("Access Denied");
       }
   },
   requery:function(){
    axios.post('pg')
        .then(function(response){
            app.ProductList=response.data;

        })
        .catch(function(error){ alert(error);})
},
scget:function(){
    axios.post('scg1',{stext:app.Product.Cid})
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
    this.file = this.$refs.file.files[0];
    formData.append('file',this.file);
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
            app.Product.Description=app.ProductList[pid].Description;
            app.Product.Warranty=app.ProductList[pid].Warranty;
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
    axios.post("ditem",{pid:pid})
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
},
toggle:function(pid){
    app.chkauth("Master Data","Edit");
    if(app.auth){
  var ans=confirm("Switch Product Status?");
  if(ans){
    if(app.ProductList[pid].Status==0){
      app.ProductList[pid].Status=1;
    }else{
      app.ProductList[pid].Status=0;
    }
    var tempid=app.ProductList[pid].ProductID;
    axios.post('productstatus',{pid:tempid})
        .then(function(response){
            var result=response.data;
            //alert(result);
        })
        .catch(function(error){ alert(error);})
  }
}else{
    alert("Access Denied");
}
}

}
}