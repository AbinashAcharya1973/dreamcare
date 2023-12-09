var user1Mixin={
data:{
    UserList:"",
    UStatus:""    
},
mounted:function(){
    axios.post('guf')
            .then(function(response){
                app.UserList=response.data;                
            })
            .catch(function(error){ alert(error);})
},
methods:{    
    newuser:async function(){
        app.auth=await app.chkauth("User Management","Save");
        if(app.auth){
            window.location.assign('add_u');
        }else{
            alert("Access Denied");
        }
    },
    edituser:async function(nid){
        app.auth=await app.chkauth("User Management","Edit");
        if(app.auth){
            localStorage.unid=nid
            window.location.assign("edit_u");
        }else{
            alert("Access Denied");
        }
    },
    togglestatus:function(){
        
    },
    userlog:async function(id){        
        app.auth=await app.chkauth("User Management","Save");
        if(app.auth){
            localStorage.logid=id;
            window.location.assign("userlog");
        }else{
            alert("Access Denied");
        }
    }

    }
}