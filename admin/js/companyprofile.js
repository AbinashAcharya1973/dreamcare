var companyMixin={
	data:{
		    tempCmas:"",
			CompanyName:"",
			ContactNo:"",
			Address1:"",
			Address2:"",
			pin:"",
			gstno:"",
			EmailID:"",
			Website:"",
			jurisdiction:"",
			bankname:"",		
			AccID:"",
			bankno:"",
			ifsc:"",
			Dealin:"",
			Description:"",
			Password:"",
			CompanyID:"",
			auth:false,
			State:"",
	        CompanyLogo:""
        },
        mounted:function(){
        	axios.post('gcm')
                            .then(function(response){
                                app.tempCmas=response.data;
                                app.CompanyID=app.tempCmas[0].CompanyID;
                                app.CompanyName=app.tempCmas[0].CompanyName;
                                app.ContactNo=app.tempCmas[0].ContactNo;
                                app.Address1=app.tempCmas[0].Address1;
								app.Address2=app.tempCmas[0].Address2;
								app.State=app.tempCmas[0].State;
								app.pin=app.tempCmas[0].pin;
								app.gstno=app.tempCmas[0].gstno;
								app.Website=app.tempCmas[0].Website;
								app.jurisdiction=app.tempCmas[0].jurisdiction;
								app.CompanyLogo=app.tempCmas[0].CompanyLogo;
								app.bankname=app.tempCmas[0].bankname;
								app.bankno=app.tempCmas[0].bankno;
								app.ifsc=app.tempCmas[0].ifsc;
								app.Dealin=app.tempCmas[0].Dealin;
								app.Description=app.tempCmas[0].Description;
								app.Password=app.tempCmas[0].Password;
								app.EmailID=app.tempCmas[0].EmailID;

                            })
                            .catch(function(error){ alert(error);})
        },
        methods:{
	        save:async function(){
					 app.auth=await app.chkauth("Master Data","Save");
					 if(app.auth){
						app.tempCmas.CompanyID=app.ulid;
            			app.tempCmas.CompanyName=app.CompanyName;
            			app.tempCmas.ContactNo=app.ContactNo;
            			app.tempCmas.Address1=app.Address1;
            			app.tempCmas.Address2=app.Address2;
            			app.tempCmas.State=app.State;
            			app.tempCmas.pin=app.pin;
            			app.tempCmas.gstno=app.gstno;
            			app.tempCmas.Website=app.Website;
            			app.tempCmas.jurisdiction=app.jurisdiction;
            			app.tempCmas.bankname=app.bankname;
            			app.tempCmas.bankno=app.bankno;
            			app.tempCmas.ifsc=app.ifsc;
            			app.tempCmas.EmailID=app.EmailID;
            			app.tempCmas.Dealin=app.Dealin;
            			app.tempCmas.Description=app.Description;
            			app.tempCmas.Password=app.Password;
                        let senddata=app.toFormData(app.tempCmas);
                        var ans=confirm("Update the Profile Info?");
                        if(ans){
                        axios.post('svcmpup',senddata,{header:{'Content-Type': 'multipart/form-data'}})
                        .then(function(response){
                            var result=response.data;
                                alert(result);
                                /*app.tempPrf.FirstName="";
                                app.tempPrf.LastName="";
                                app.tempPrf.StoreName="";
                                app.tempPrf.WhatsappNo="";
                                app.tempPrf.EmailID="";
                                app.tempPrf.Address1="";
                                app.tempPrf.Address2="";
                                app.tempPrf.PINCode="";
                                app.tempPrf.GSTNo="";
                                app.tempPrf.Password="";*/
                                //app.requery();
                            })
                        .catch(function(error){ alert(error);})
                        }
					  }else{
						  alert("Access Denied");
					  }
                    },
                    toFormData: function(obj) {
                        let formData = new FormData();
                        for(let key in obj) {
                            formData.append(key, obj[key]);
                        }
                        //this.file = this.$refs.file.files[0];
                        //formData.append('file',this.file);
                        return formData;
                    }
                    
        		}

	}

