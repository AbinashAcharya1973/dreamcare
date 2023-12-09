var StockTran={
	data:{
            ChallanNO:"",
            ChallanDate:"",
            SelectedProduct:"",
            SelectedBatch:"",
            Qty:0,
            tempItem:[],
            ProductList:"",
            frombranch:"",
            tobranch:"",
            fromBranchList:"",
            toBranchList:"",
            BatchList:"",
            totalqty:0,
            totalamount:0

        },
        mounted:function(){
            this.$refs.txtchdate.valueAsDate=new Date();
            axios.post('branch')
            .then(function(response){
                app.fromBranchList=response.data;                                
                app.toBranchList=response.data;
            })
            .catch(function(error){ alert(error);})
            axios.post('pg1')
                .then(function(response){
                    app.ProductList=response.data;

                })
                .catch(function(error){ alert(error);})
        },
        methods:{
            getbatches:function(){
                let pid=app.ProductList[app.SelectedProduct].ProductID;
                axios.post('getbatches',{pid:pid})
                .then(function(response){
                    app.BatchList=response.data;       
                })
                .catch(function(error){ alert(error);})
            },
            addtolist:function(){                
                let tempqty=app.Qty;
                if(tempqty>0){
                    let newdata={};
                    newdata.ProductID=app.ProductList[app.SelectedProduct].ProductID;
                    newdata.ProductName=app.ProductList[app.SelectedProduct].ItemName;
                    newdata.HSN=app.ProductList[app.SelectedProduct].HSN;
                    newdata.BatchNo=app.SelectedBatch;
                    newdata.Qty=app.Qty;
                    newdata.MRP=app.ProductList[app.SelectedProduct].MRP;
                    newdata.Amount=(Number(newdata.Qty)*Number(newdata.MRP)).toFixed(2)
                    app.tempItem.push(newdata);
                    app.Qty=0;
                    app.totalqty=Number(newdata.Qty)+Number(app.totalqty);
                    app.totalamount=Number(newdata.Amount)+Number(app.totalamount);


                }else{
                    alert("Qty Should not 0");
                }
            },
            deleteitem:function(idx){
                app.totalqty=Number(app.totalqty)-Number(app.tempItem[idx].Qty);
                app.totalamount=Number(app.totalamount)-Number(app.tempItem[idx].Amount);
                this.tempItem.splice(idx,1);
            },
            save:async function(){
                app.auth=await app.chkauth("Inventory","Save");
                if(app.auth){
                    var ans=confirm("Are you sure you want to Save the Stock Transfer?");
                    if(ans){
                        let headerdata={};
                        headerdata.ChallanDate=app.$refs.txtchdate.value;
                        headerdata.fromBranch=app.frombranch==="HO"?app.frombranch:app.fromBranchList[app.frombranch].BranchID;
                        headerdata.toBranch=app.tobranch==="HO"?app.tobranch:app.toBranchList[app.tobranch].BranchID;;
                        headerdata.TotalQty=app.totalqty;
                        headerdata.TotalAmount=app.totalamount;
                        axios.post('savestocktran',{Chead:headerdata,Cdetails:app.tempItem})
                        .then(function(response){
                            let lastchallanno=response.data;
                            app.$refs.txtchno.value=lastchallanno;
                            alert("The last Challan Slno:"+response.data);
                            app.tempItem=[];
                            app.totalqty=0;
                            app.totalamount=0;
                            var ans=confirm("Do you want to Print Challan?");
                            if(ans){
                                axios.post('printstocktran',{chno:lastchallanno})
                                .then(function(response){
                                        window.open("pdfs/branchch-"+lastchallanno+".pdf","_blank");
                                    })
                                .catch(function(error){ alert(error);})
                            }
                            app.$refs.txtchdate.focus();

                        })
                        .catch(function(error){ alert(error);})
                    }
                }
            },
            print:async function(){
                app.auth=await app.chkauth("Inventory","Print");
                if(app.auth){
                    let chno=app.$refs.txtchno.value;
                    axios.post('printstocktran',{chno:chno})
                    .then(function(response){
                            window.open("pdfs/branchch-"+chno+".pdf","_blank");
                        })
                    .catch(function(error){ alert(error);})
                    }else{
                        alert("Access Denied");
                    }
            }
        }

}

