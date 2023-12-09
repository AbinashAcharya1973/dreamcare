var Memberlist={
	data:{
            members:[],
            
        },
        
        mounted:function(){
            this.ulsid=localStorage.ulsid;            
            axios.post('getmemberlist.php',{expt: this.ulsid})
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

