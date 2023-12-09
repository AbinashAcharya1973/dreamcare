var Downline={
	data:{
            members:[],
            baseurl:'downline_d.php?memid=',
        },
        
        mounted:function(){
            this.ulsid=localStorage.ulsid;            
            axios.post('getdownlines.php',{expt: this.ulsid})
            .then(function(response){
                app.members=response.data;                                
            })
            .catch(function(error){ alert(error);})
            
            },
        methods:{
               loadledger:function() {
                axios.post('loadldg',{gid:app.groupselected})
                .then(function(response){
                    app.CrLedgers=response.data;                                
                })
                .catch(function(error){ alert(error);})
               
        }
    }

}

