var LedgerV={
	data:{
	    GroupList:"",
        LedgerList:"",
        LedgerTran:"",
        groupid:"",
        laccid:"",
        ObalanceDr:"0.00",
        ObalanceCr:"0.00",                    
        TotalDr:0.00,
        TotalCr:0.00,
        ClosingDr:0.00,
        ClosingCr:0.00,
        fdate:"",
        tdate:""
        },
        mounted:function(){
            axios.post('gg')
            .then(function(response){
                app.GroupList=response.data;                                
            })
            .catch(function(error){ alert(error);})         
        },
        methods:{
            loadledger:function(){
                axios.post('loadldg',{gid:app.groupid})
                            .then(function(response){
                                app.LedgerList=response.data;                                
                            })
                            .catch(function(error){ alert(error);})
            },
            loadledgertran:function(){
                app.TotalCr=0;
                        app.TotalDr=0;
                        app.ClosingDr=0;
                        app.ClosingCr=0;                        
                        app.fdate='';
                        app.tdate='';
                        axios.post('ldgtran',{lid:app.laccid})
                            .then(function(response){
                                app.LedgerTran=response.data;
                                var norecs=app.LedgerTran.length;
                                for(var c=0;c<norecs;c++){
                                    app.TotalDr=(Number(app.TotalDr)+Number(app.LedgerTran[c].Dr)).toFixed(2);
                                    app.TotalCr=(Number(app.TotalCr)+Number(app.LedgerTran[c].Cr)).toFixed(2);
                                }
                                var lidx=app.LedgerList.findIndex(x => x.AccID === app.laccid); 
                                if(app.LedgerList[lidx].BalanceType==='Cr') {
                                    app.ObalanceCr=app.LedgerList[lidx].OBalance;
                                    //app.TotalCr=Number(app.TotalCr)+Number(app.ObalanceCr);
                                }else{app.ObalanceCr=0;}
                                if(app.LedgerList[lidx].BalanceType==='Dr') {
                                    app.ObalanceDr=app.LedgerList[lidx].OBalance;
                                    //app.TotalDr=Number(app.TotalDr)+Number(app.ObalanceDr);
                                }else{app.ObalanceDr=0;}
                                if((Number(app.TotalCr)+Number(app.ObalanceCr))>(Number(app.TotalDr)+Number(app.ObalanceDr))){
                                    app.ClosingDr=((Number(app.ObalanceCr)+Number(app.TotalCr))-Number(app.TotalDr)).toFixed(2);
                                }
                                if((Number(app.TotalDr)+Number(app.ObalanceDr))>(Number(app.TotalCr)+Number(app.ObalanceCr))){
                                    app.ClosingCr=((Number(app.ObalanceDr)+Number(app.TotalDr))-Number(app.TotalCr)).toFixed(2);
                                }
                            })
                            .catch(function(error){ alert(error);})                    
            },
            gettran:function(){
                let formData ={};                        
                formData.ldgid=app.laccid;
                formData.frmDate=app.fdate;
                formData.toDate=app.tdate;
                app.TotalCr=0;
                app.TotalDr=0;
                app.ClosingDr=0;
                app.ClosingCr=0;
                axios.post('ldgtran1',formData)
                .then(function(response){
                    app.LedgerTran=response.data;
                    if(app.LedgerTran.length>0){
                        axios.post('getldgbalance',formData)
                        .then(function(response){
                            app.ObalanceCr=response.data.ClosingCr;
                            app.ObalanceDr=response.data.ClosingDr;
                            var norecs=app.LedgerTran.length;
                            for(var c=0;c<norecs;c++){
                                app.TotalDr=(Number(app.TotalDr)+Number(app.LedgerTran[c].Dr)).toFixed(2);
                                app.TotalCr=(Number(app.TotalCr)+Number(app.LedgerTran[c].Cr)).toFixed(2);
                            }
                            if((Number(app.TotalCr)+Number(app.ObalanceCr))>(Number(app.TotalDr)+Number(app.ObalanceDr))){
                            app.ClosingDr=((Number(app.ObalanceCr)+Number(app.TotalCr))-Number(app.TotalDr)).toFixed(2);
                            }
                            if((Number(app.TotalDr)+Number(app.ObalanceDr))>(Number(app.TotalCr)+Number(app.ObalanceCr))){
                                app.ClosingCr=((Number(app.ObalanceDr)+Number(app.TotalDr))-Number(app.TotalCr)).toFixed(2);
                            }

                        })
                        .catch(function(error){

                        })
                    }

                })
                .catch(function(error){
                    alert(error);
                })

            },
            print:async function(){
                let formData = {};                        
                formData.od=app.laccid;
                formData.frmDate=app.fdate;
                formData.toDate=app.tdate;
                formData.uid=app.ulid;
                app.auth=await app.chkauth("Accounting","Print");
                if(app.auth){
                axios.post('ledgerprint',formData)
                .then(function(response){
                        window.open("pdfs/legprint-"+app.laccid+".pdf","_blank");
                    })
                .catch(function(error){ alert(error);})
                }else{
                    alert("Access Denied");
                }
            }
        }

}

