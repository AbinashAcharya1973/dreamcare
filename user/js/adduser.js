var UserForm={
    data:{
        tempPrf:{},
        FirstName:"",
        LastName:"",
        StoreName:"",
        WhatsappNo:"",
        MobileNo:"",
        EmailID:"",
        Address1:"",
        Address2:"",
        PINCode:"",
        GSTNo:"",
        UserType:"",
        Password:"",        
        AccID:"",
        AppModules:"",
        UserPermission:[],
        Branches:"",
        Zones:"",
        BranchSelected:"",
        ZoneSelected:"",
        SelectedState:"21",
        StateList:""

    },
    mounted:function(){
        axios.post('getmodules')
                .then(function(response){
                    app.AppModules=response.data;
                    var counter=0;
                    
                    while(counter<app.AppModules.length){
                        var temppermission={};
                        temppermission.ModuleID=app.AppModules[counter].ModuleID;
                        temppermission.ModuleName=app.AppModules[counter].ModuleName;
                        temppermission.Save=false;
                        temppermission.Edit=false;
                        temppermission.Print=false;
                        temppermission.Delete=false;
                        app.UserPermission.push(temppermission);
                        counter++;
                
                    }

                })
                .catch(function(error){ alert(error);})
        axios.post('bg')
            .then(function(response){
                app.Branches=response.data;
            })
            .catch(function(error){
                alert(error);
            })
        axios.post('gtstatecode')
            .then(function(response){
                app.StateList=response.data;                
            })
            .catch(function(error){
                alert(error);
            })
        
    },
    methods:{
     save:async function(){
         app.auth=await app.chkauth("User Management","Save");
         if(app.auth){
             try{
            app.tempPrf.FirstName=app.FirstName;
            app.tempPrf.LastName=app.LastName;
            app.tempPrf.StoreName=app.StoreName;
            app.tempPrf.WhatsappNo=app.WhatsappNo;
            app.tempPrf.EmailID=app.EmailID;
            app.tempPrf.MobileNo=app.MobileNo;
            app.tempPrf.Address1=app.Address1;
            app.tempPrf.Address2=app.Address2;
            app.tempPrf.PINCode=app.PINCode;
            app.tempPrf.GSTNo=app.GSTNo;
            app.tempPrf.UserType=app.UserType;
            app.tempPrf.Password=app.Password;
            app.tempPrf.BranchID=app.Branches[app.BranchSelected].BranchID;
            app.tempPrf.BName=app.Branches[app.BranchSelected].Branch;
            app.tempPrf.ZoneID=app.Zones[app.ZoneSelected].ZoneID;
            app.tempPrf.ZName=app.Zones[app.ZoneSelected].Zone;
            app.tempPrf.IStateCode=app.SelectedState;
            app.tempPrf.IStateN=app.StateList.find(({STCode})=>STCode==app.SelectedState).StateName;
            let senddata=app.toFormData(app.tempPrf);
            var ans=confirm("Save the Profile Info?");
            if(ans){
            axios.post('svprfnu',senddata)
            .then(function(response){
                var result=response.data;
         
                    if(result==="NO"){
                        alert("Already Registered");
                    }else{
                    axios.post('upermission',{pdata:app.UserPermission,uid:result})
                    .then(function(response){
                        alert("User Added Successfuly");
                        var ans=confirm("Do you want to Add More User?");
                        if(ans){
                            window.location.assign("add_u");
                        }else{
                            window.location.assign("users");
                        }
                        
                    })
                    .catch(function(error){alert(error);})
                    }
                })
            .catch(function(error){ alert(error);})
            }
            }catch(error){ alert(error);}
           }else{
               alert("Access Denied");
           }
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
        getzones:function(){
            let tempid=app.Branches[app.BranchSelected].BranchID;
            axios.post('getzones',{bid:tempid})
            .then(function(response){
                app.Zones=response.data;
            })
            .catch(function(error){
                alert(error);
            })           
        }

    }
    
}