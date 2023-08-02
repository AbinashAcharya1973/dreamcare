var mainMixin={
	data:{
	    ulsid:"",
        ulsn:"",
        ulid:"",
        sord:"",
        pord:"",
        Proimg:"" 
        },
        mounted:function(){
                    var login=false;                    
                    this.ulsid=localStorage.ulsid;
                    axios.post('gtls.php',{expt: this.ulsid})
                    .then(function(response){
                        var logres=response.data;
                        var checkres=logres[0];
                        if(checkres==="NOT"){
                            delete localStorage.ulsid;
                            delete localStorage.ulsn;
                            delete localStorage.kt;
                            delete localStorage.unid;
                            delete localStorage.ulid;
                            delete localStorage.tempaccid;
                            delete localStorage.temprvno;
                            window.location.assign("login.php");
                        }else{
                            app.ulsn=logres[1];                            
                            app.ulid=logres[2];
                            app.Proimg=logres[5];
                            //this.$cookie.set('ulsn',this.ulsn,1);
                            localStorage.ulsn=app.ulsn;
                            localStorage.ulid=app.ulid;                            
                        }                       
                    })
                    .catch(function(error){ alert(error);})
                },
        methods:{
                togglesidebar:function(){                        
                        $("body").toggleClass("sb-sidenav-toggled");
                    },
                logout:async function(){                        
                    await axios.post('logout.php',{sdf:app.ulsid})
                        .then(function(response){
                            delete localStorage.ulsid;
                            delete localStorage.ulsn;
                            delete localStorage.kt;
                            delete localStorage.unid;
                            delete localStorage.ulid;
                            delete localStorage.tempaccid;
                            delete localStorage.temprvno;
                            window.location.assign("login.php");
                        })
                        .catch(function(error){ alert(error);})                    
                },
                chkauth:async function(md,ta){
                        var result;
                        await axios.post('chkath.php',{m: md,ta: ta,id: app.ulid})
                            .then(function(response){
                                result=response.data;
                                //app.auth=result;
                            }.bind(this))
                            .catch(function(error){ alert(error);});
                            return result;
                    }
        }

}

