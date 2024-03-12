 
function inputNumber(e,val,allowdecimal)
{
	
    var key=(window.event) ? event.keyCode : e.charCode || 0;
	
	if(allowdecimal==true)
	{
		if(key==0 || key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57))
	    {	
		    if(key==46)
		    {
			    if(val.indexOf(".")!=-1)
			    {
				    if(window.event)
				    {
					    event.returnValue=false
				    }
				    else
				    {
					    e.preventDefault()
				    }
			    }
		    }
	    }      
	    else
	    {
		    if(window.event)
		    {
			    event.returnValue=false
		    }
		    else
		    {
			    e.preventDefault()
		    }
	    }
	}
	else
	{
		if(key==0 || key == 8 || key == 9 || (key >= 48 && key <= 57))
		{	
			
		}      
		else
		{
			if(window.event)
			{
				event.returnValue=false
			}
			else
			{
				e.preventDefault()
			}
		}
	}
}

function inputAlphaNumberic(e,val)
{
    var key=(window.event) ? event.keyCode : e.charCode || 0;
	
				//alert(key)
 
		if(key==0 || key == 8 || key == 9 || (key >= 48 && key <= 57) || (key >= 65 && key <= 90) || (key >  96 && key <= 122) )
		{	
		}      
		else
		{
			if(window.event)
			{
				event.returnValue=false
			}
			else
			{
				e.preventDefault()
			}
		}
	 
}

 
function clear_form_elements(elementid) {
  jQuery("#"+elementid).find(':input').each(function() {
    switch(this.type) {
        case 'password':
        case 'text':
        case 'textarea':
        case 'file':
        case 'select-one':
        case 'select-multiple':
        case 'date':
        case 'number':
        case 'tel':
        case 'email':
            jQuery(this).val('');
            break;
        case 'checkbox':
        case 'radio':
            this.checked = false;
            break;
    }
  });
}

function fillsameasPermanent(){

if ($("#chksameasPermanent").is(":checked")) 
		{
		$("#txtlocalAddr").val($.trim($("#txtpermntAddr").val()));
		$("#txtlocalPO").val($.trim($("#txtpermntPO").val()));
		$("#txtlocalPS").val($.trim($("#txtpermntPS").val()));
		$("#cholocalLocality").val($.trim($("#chopermntLocality").val()));
		$("#txtlocalCity").val($.trim($("#txtpermntCity").val())); 
		$("#txtlocalDistrict").val($.trim($("#txtpermntDistrict").val()));
		$("#cholocalState").val($.trim($("#chopermntState").val()));
		$("#cholocalCountry").val($.trim($("#chopermntCountry").val())); 
		$("#txtlocalPin").val($.trim($("#txtpermntPin").val())); 
		}
		else
		{
		$("#txtlocalAddr").val('');
		$("#txtlocalPO").val('');
		$("#txtlocalPS").val('');
		$("#cholocalLocality").val('');
		$("#txtlocalCity").val('');
		$("#txtlocalDistrict").val('');
		$("#cholocalState").val('');
		$("#cholocalCountry").val('');
		$("#txtlocalPin").val('');
		}
}

function geturl(){
	var d = new Date();
   var myString = window.location.href
		var mySplitResult = myString.split("?");
	
return mySplitResult[0]; 
}

function displayforOther(objval,checkval,dispId,inputbox) {
	if(inputbox!='') {
	$("#"+inputbox).val('');
	}
	if(objval==checkval)
	$("#"+dispId).show() ;	
	else
	$("#"+dispId).hide() ;	
}

function displayforEWS(dispId,inputbox) {
	$("#"+inputbox).val('');
	var category = $("#choCategory").val();
	var domicile = $("#choDomicile").val();
	 
	if(category=='GENERAL' && domicile=='WEST BENGAL')
	{
	$("#"+dispId).show() ;	
	}
	else {
	$("#"+dispId).hide() ;		
	}
}

function displayforPH(objval,checkval,dispId) {
	$("#chodisabilitytype").val('')
	 $("#txtdisabilitypercent").val('')
	if(objval==checkval){
		$(".disabilitydetail").show() ;	
	}
	else{
		$(".disabilitydetail").hide() ;	
	}
}

function fillGuardianDetailasparent(){

	if ($("#inlineRadio1").is(":checked")) 
		{
		$("#txtguardianName").val($.trim($("#txtfathername").val()));
		$("#choguardianOccup").val($.trim($("#chofatherOccup").val()));	
		$("#txtguardianMobNo").val($.trim($("#txtfatherMobNo").val()));	
		$("#txtrelation").val('Father');
		}
	else if ($("#inlineRadio2").is(":checked")) 
		{
		$("#txtguardianName").val($.trim($("#txtmotherName").val()));
		$("#choguardianOccup").val($.trim($("#chomotherOccup").val())); 
		$("#txtguardianMobNo").val($.trim($("#txtmotherMobNo").val()));	
		$("#txtrelation").val('Mother');
		}
		else  
		{
		$("#txtguardianName").val('');
		$("#choguardianOccup").val('');
		$("#txtguardianMobNo").val('');	
		 $("#txtrelation").val('');
		}
}

function loaddataforupdate(StudentRollno){
	 //alert(registrationno)
	  	
	if(StudentRollno!='') {
		$('#dvLoading').show();
	$.ajax({                                      
			  url:'getformdata.php',                     
			   type:'post',
			   data: 'StudentRollno='+StudentRollno,
			   dataType: 'json',
			  success: function(data)
			  {
				 // alert(JSON.stringify(data))
				  
				$("#txtName").val(data["name"]);  
				$("#choDOBdd").val(data["dd"]);  
				$("#choDOBmm").val(data["mm"]);  
				$("#choDOByy").val(data["yy"]);   
				$("#choGender").val(data["sex"]);   
				$("#choBloodgrp").val(data["bloodgroup"]); 
				$("#txtAadharNo").val(data["aadharNo"]);  
				$("#choCategory").val($.trim(data["caste"])); 
				
				$("#choDomicile").val(data["stateofdomicile"]); 
				displayforOther(data["stateofdomicile"],'Other State','otherDomicile','txtotherDomicile')
				$("#txtotherDomicile").val(data["scstStateOther"]); 
				$("#choMarriedStatus").val(data["married"]);
				
				$("#spannationality").html(data["nationality"]); 
				$("#choReligion").val(data["religion"]);
				displayforOther(data["religion"],'Other','otherReligion','txtotherReligion')
				$("#txtotherReligion").val(data["otherReligion"]);
				$("#choWhetherBPL").val(data["APLBPL"]);
				displayforOther(data["APLBPL"],'YES','BPLNo','txtBPLNo')
				$("#txtBPLNo").val(data["bplno"]);
				displayforEWS('Div_EWS','choWhetherEWS')
				$("#choWhetherEWS").val(data["EWS"]);	
				$("#txtannualFamilyIncome").val(data["annualIncome"])	
					$("#choDisability").val(data["PH"]);
				displayforPH(data["PH"],'Yes')
				$("#chodisabilitytype").val(data["disabilitytype"]);
				$("#txtdisabilitypercent").val(data["disabilityPercentage"]);
				
				$("#txtCURegNo").val(data["CuRegNo"]);
				$("#txtCURollNo").val(data["CuRollNo"]);
				  
				$("#chominoritygrp").val(data["minoritygrp"]);
				 $("#chomotherTongue").val(data["motherTongue"]);
				 $("#chofirstGenrLearner").val(data["firstGenrLearner"]);
				 
				 $("#chohasCuRegNo").val(data["hasCuRegNo"]);
				   displayforOther(data["hasCuRegNo"],'Y','div_CuRegNo','')
				$("#dispCuRegNo").val(data["CuRegNo"]);
				 $("#chohasKanyashree").val(data["hasKanyashree"]);
				 displayforOther(data["hasKanyashree"],'Yes','div_KanyashreeID','txtKanyashreeID');
				 $("#txtKanyashreeID").val(data["kanyashreeid"]);
				 
				$("#choSportsQuota").val(data["isApplySportsQuota"]);
				displayforOther(data["isApplySportsQuota"],'Yes','div_sportlevel','chosportlevel');
				$("#chosportlevel").val(data["sportlevel"]);
				 var extraActivityArr = data["extraActivity"].split(',');
				 for(var i=0; i<extraActivityArr.length; i++){ 
					 $('input:checkbox[name="chowilltojoin"][value="' + extraActivityArr[i] + '"]').prop('checked',true);   
				 }
				$("#txtfathername").val(data["fathername"]);
				 $("#chofatherQalif").val(data["fatherQalif"]);
				 $("#chofatherOccup").val(data["fatherOccup"]);
				 $("#txtfatherMobNo").val(data["fatherMobNo"]);
				 $("#txtmotherName").val(data["motherName"]);
				  
				 $("#chomotherQalif").val(data["motherQalif"]);
				$("#chomotherOccup").val(data["motherOccup"]);
				$("#txtmotherMobNo").val(data["motherMobNo"]);
				 
				$("#txtapplcntRlyStation").val(data["applcntRlyStation"]);
				$("#chofamilyMemCnt").val(data["familyMemCnt"]);
				 
				 
				  $("#txtguardianName").val(data["guardianName"]);
				  $("#txtrelation").val(data["relation"]);
				  $("#choguardianOccup").val(data["guardianOccup"]);
				  $("#txtguardianMobNo").val(data["guardianMobNo"]);
				
				$("#txtpermntAddr").val(data["permntAddr"]);
				$("#txtpermntPO").val(data["permntPO"]);
				$("#txtpermntPS").val(data["permntPS"]);
				$("#chopermntLocality").val(data["permntLocality"]);
				$("#txtpermntCity").val(data["permntCity"]); 
				$("#txtpermntDistrict").val(data["permntDistrict"]);
				$("#chopermntState").val(data["permntState"]);
				$("#chopermntCountry").val(data["permntCountry"]); 
				$("#txtpermntPin").val(data["permntPin"]); 
				
				$("#txtlocalAddr").val(data["localAddr"]);
				$("#txtlocalPO").val(data["localPO"]);
				$("#txtlocalPS").val(data["localPS"]);
				$("#cholocalLocality").val(data["localLocality"]);
				$("#txtlocalCity").val(data["localCity"]); 
				$("#txtlocalDistrict").val(data["localDistrict"]);
				$("#cholocalState").val(data["localState"]);
				$("#cholocalCountry").val(data["localCountry"]); 
				$("#txtlocalPin").val(data["localPin"]); 
				 $("#txtMobileNo").val(data["applcntMobNo"]);
				$("#txtotherMobileNo").val(data["alternateMobileNo"]);
				$("#hasWhatsAppno").val(data["hasWhatsAppno"]);
				displayforOther(data["hasWhatsAppno"],'Yes','span_WhatsAppno','txtWhatsAppNo');
				$("#txtWhatsAppNo").val(data["WhatsAppno"]);
				$("#txtemailId").val(data["applcntEmail"]);	
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				
			});
			
	}
	
}

function verifyRegistInput()
	{
		
		if($.trim($("#txtName").val())==""){
			$("#msgcontent").html("Enter Name");
			$("#ValidationAlert").modal();
			$("#txtName").focus();
			return false;
		}
		
		if($.trim($("#choDOBdd").val())=="" || $.trim($("#choDOBmm").val())=="" || $.trim($("#choDOByy").val())=="")
		{
			$("#msgcontent").html("Select Date of Birth.");
			$("#ValidationAlert").modal();
			$("#choDOBdd").focus();
			return false;
			 
		}
		try
		{	
			Date.validateDay(parseInt($("#choDOBdd").val()),parseInt($("#choDOByy").val()),parseInt($("#choDOBmm").val())-1)
		}
		catch(e)
		{
			$("#msgcontent").html("Invalid Date of Birth.");
			$("#ValidationAlert").modal();
			$("#choDOBdd").focus();
			return false;
			 
		}
		if($.trim($("#choGender").val())=="")
		{
			$("#msgcontent").html("Select Gender.");
			$("#ValidationAlert").modal();
			$("#choGender").focus();
			return false;
			 
		}
		if($.trim($("#choBloodgrp").val())=="")
		{
			$("#msgcontent").html("Select Blood Group.");
			$("#ValidationAlert").modal();
			$("#choBloodgrp").focus();
			return false;
			 
		}
		if($.trim($("#choCategory").val())=="")
		{
			$("#msgcontent").html("Select Category.");
			$("#ValidationAlert").modal();
			$("#choCategory").focus();
			return false;
			 
		}
		if($.trim($("#choDomicile").val())=="")
		{ 
			$("#msgcontent").html("Select State of Domicile.");
			$("#ValidationAlert").modal();
			$("#choDomicile").focus();
			return false;
			 
		}
		else if($.trim($("#choDomicile").val())=="OTHER STATE" && $.trim($("#txtotherDomicile").val())=="") {
			$("#msgcontent").html("Enter Domicile Name.");
			$("#ValidationAlert").modal();
			$("#txtotherDomicile").focus();
			return false;
			
		} 
		if($.trim($("#txtAadharNo").val())!="" && ($.trim($("#txtAadharNo").val())).length!=12 ) 
		{
			$("#msgcontent").html("Please enter valid Aadhar No.");
			$("#ValidationAlert").modal();
			$("#txtAadharNo").focus();
			return false;
			 
		}
		 
		if($.trim($("#choMarriedStatus").val())=="")
		{
			$("#msgcontent").html("Select Marrital Status.");
			$("#ValidationAlert").modal();
			$("#choMarriedStatus").focus();
			return false;
		}
		
		if($.trim($("#choReligion").val())=="")
		{
			$("#msgcontent").html("Select Religion.");
			$("#ValidationAlert").modal();
			$("#choReligion").focus();
			return false;
		}
		else if($.trim($("#choReligion").val())=="Other" && $.trim($("#txtotherReligion").val())=="") {
			$("#msgcontent").html("Enter Religion Name.");
			$("#ValidationAlert").modal();
			$("#txtotherReligion").focus();
			return false;
			
		}
		if($.trim($("#choWhetherBPL").val())=="")
		{
			$("#msgcontent").html("Select Whether BPL.");
			$("#ValidationAlert").modal();
			$("#choWhetherBPL").focus();
			return false;
		}
		else if($.trim($("#choWhetherBPL").val())=="Yes" && $.trim($("#txtBPLNo").val())=="") {
			$("#msgcontent").html("Enter BPL Card No.");
			$("#ValidationAlert").modal();
			$("#txtBPLNo").focus();
			return false;
			
		}
		if($.trim($("#choCategory").val())=="General" && $.trim($("#choDomicile").val())=="West Bengal")
		{
			if($.trim($("#choWhetherEWS").val())=="")
			{
				$("#msgcontent").html("Select Whether EWS(Economically Weaker Section).");
				$("#ValidationAlert").modal();
				$("#choWhetherEWS").focus();
				return false;
			}
		}
		
		if($.trim($("#txtannualFamilyIncome").val())=="")
		{
			$("#msgcontent").html("Enter Annual Family Income.");
			$("#ValidationAlert").modal();
			$("#txtannualFamilyIncome").focus();
			return false;
		}
		else
		{
			if($.trim($("#txtannualFamilyIncome").val()).charAt(0)=="0")
			{
				$("#msgcontent").html("Annual Family Income cannot contain leading zero.");
				$("#ValidationAlert").modal();
				$("#txtannualFamilyIncome").focus();
				return false;
				 
			}
		}
		if($.trim($("#choDisability").val())=="")
		{
			$("#msgcontent").html("Select Disability.");
			$("#ValidationAlert").modal();
			$("#choDisability").focus();
			return false;
		}
		else{ 
			if($.trim($("#choDisability").val())=="Yes" && $.trim($("#chodisabilitytype").val())=="") {
			$("#msgcontent").html("Select Disability Type.");
			$("#ValidationAlert").modal();
			$("#chodisabilitytype").focus();
			return false;
			}
			if($.trim($("#choDisability").val())=="Yes" && $.trim($("#txtdisabilitypercent").val())=="") {
			$("#msgcontent").html("Enter Disability Percentage.");
			$("#ValidationAlert").modal();
			$("#txtdisabilitypercent").focus();
			return false;
			}
			if($.trim($("#txtdisabilitypercent").val())!=""){
				if($.trim($("#txtdisabilitypercent").val()).charAt(0)=="0")
				{
				$("#msgcontent").html("Disability Percentage cannot contain leading zero.");
				$("#ValidationAlert").modal();
				$("#txtdisabilitypercent").focus();
				return false;
				 
				}
			}
		} 

		return true;
	}


 function saveRegistrationDetail(){
	 
	if(!verifyRegistInput())
	return false;
	
	 $('#dvLoading').show()	
	var form = $("#frmRegistDetail");
	$.ajax({                                      
			  url:'saveRegistDetails.php',                     
			   type:'post',
			   data: form.serialize()+'&collegerollno='+$("#hdncollRollforEdit").val(),
			   dataType: 'json',
			  success: function(data)
			  {
					if(data.status==1)
					{
							$("#msgcontent").html(data.msg);
							$("#ValidationAlert").modal();
							$('#ValidationAlert').on('hidden.bs.modal', function () {
								$("#txtStudentRollno").val(data.collegerollno)
								$("#frmsession").attr('action', geturl());
								$("#frmsession").submit();
							}) 
									  
					}
					else
					{
							$("#msgcontent").html(data.msg);
							$("#ValidationAlert").modal();
							return false;
					}
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
			});

} 

function verifyOtherPDInput()
	{
		//alert(195) 
	 
		if($.trim($("#chominoritygrp").val())=="")
		{
			$("#msgcontent").html("Do you belong to Minority Group?");
			$("#ValidationAlert").modal();
			$("#chominoritygrp").focus()
			return false;	 
		}
		if($.trim($("#chomotherTongue").val())=="")
		{
			$("#msgcontent").html("Select Mother Tongue");
			$("#ValidationAlert").modal();
			$("#chomotherTongue").focus()
			return false;	 
		}
		if($.trim($("#chofirstGenrLearner").val())=="")
		{
			$("#msgcontent").html("Are you 1st Generation Learner?");
			$("#ValidationAlert").modal();
			$("#chofirstGenrLearner").focus()
			return false;	 
		}
		/* if($.trim($("#choHostelReq").val())=="")
		{
			$("#msgcontent").html("Do you want hostel admission?");
			$("#ValidationAlert").modal();
			$("#choHostelReq").focus()
			return false;	 
		} */
		
		if($.trim($("#chohasCuRegNo").val())=="")
		{
			$("#msgcontent").html("Are you already registered under Calcutta University?");
			$("#ValidationAlert").modal();
			$("#chohasCuRegNo").focus()
			return false;	 
		}
		else if($.trim($("#chohasCuRegNo").val())=="Yes"){
			if($.trim($("#txtCuRegNo").val())=="")
			{
			$("#msgcontent").html("Enter Calcutta University Registration Number.");
			$("#ValidationAlert").modal();
			$("#txtCuRegNo").focus()
			return false;	 
			}
		}
		if($.trim($("#hdngender").val())=="Female") {
			if($.trim($("#chohasKanyashree").val())=="")
			{
			$("#msgcontent").html("Do you Belong to Kanyashree?");
			$("#ValidationAlert").modal();
			$("#chohasKanyashree").focus()
			return false;	 
			}
			else if($.trim($("#chohasKanyashree").val())=="Yes")
			{
				if($.trim($("#txtKanyashreeID").val())=="")
				{
				$("#msgcontent").html("Enter your Kanyashree ID.");
				$("#ValidationAlert").modal();
				$("#txtKanyashreeID").focus()
				return false;	 
				}	 
			}
		}
		
		if($.trim($("#choSportsQuota").val())=="")
		{
			//$("#msgcontent").html("Do you want to apply in Sports Quota?");
			$("#msgcontent").html("Have you Represented in Sports at any level?");
			$("#ValidationAlert").modal();
			$("#choSportsQuota").focus()
			return false;	 
		}
		else if($.trim($("#choSportsQuota").val())=="Yes"){
			if($.trim($("#chosportlevel").val())=="")
			{
			$("#msgcontent").html("Select Representation Level.");
			$("#ValidationAlert").modal();
			$("#chosportlevel").focus()
			return false;	 
			}
		}
		/* if($.trim($("#choapplyAddonCourse").val())=="")
		{
			$("#msgcontent").html("Do you want to apply in add-on courses?");
			$("#ValidationAlert").modal();
			$("#choapplyAddonCourse").focus()
			return false;	 
		} */
		  
	 
		var oBtnswilltojoin  = document.getElementsByName('chowilltojoin');
		var iswilltojoinChecked = false;
		for(i=0; i < oBtnswilltojoin.length; i++){
		if(oBtnswilltojoin[i].checked){
			iswilltojoinChecked = true;
			i = oBtnswilltojoin.length;
			}
		}
	if(!iswilltojoinChecked) { $("#msgcontent").html("Select Willing to join.");
			$("#ValidationAlert").modal();
		$("input[name='chowilltojoin']").focus(); return false;}
			 
		  
		/*if($.trim($("#chowilltojoin").val())=="")
		{
			$("#msgcontent").html("Are you willing to join?");
			$("#ValidationAlert").modal();
			$("#chowilltojoin").focus()
			return false;	 
		}*/
		return true
	}
	
	function saveOtherPersonalDetail(){
		  
				if(!verifyOtherPDInput()){
					return false;
				}
				$('#dvLoading').show();
				var form = $("#frmOtherPersonalDetail");
				 
				
				 var selectedwilltojoin = new Array();
				var n = jQuery(".willtojoin:checked").length;
				if (n > 0){
					jQuery(".willtojoin:checked").each(function(){
						selectedwilltojoin.push($(this).val());
					});
				}
				
				$.ajax({                                      
				  url:'Save_OtherPersonalDetail.php',                     
				   type:'post',
				   data: form.serialize()+'&collegerollno='+$("#hdncollRollforEdit").val()+'&willtojoin='+selectedwilltojoin,
				   
				   dataType: 'json',
				  success: function(data)
				  {
			//	alert(JSON.stringify(data))
						if(data.status==1)
						{
								
								$("#msgcontent").html(data.msg);
								$("#ValidationAlert").modal();
								 
								$('#ValidationAlert').on('hidden.bs.modal', function () {
								$("#txtStudentRollno").val(data.collegerollno)
								$("#frmsession").attr('action', geturl());
								$("#frmsession").submit();
							}) 
						}
						else
						{
								$("#msgcontent").html(data.msg);
								$("#ValidationAlert").modal();
								return false;
						}
						 
					},
				 complete: function(){
					$('#dvLoading').hide();
				  }
				});	
	} 
	
function verifyGuardianInput()
	{
		//alert(195) 
	 
		if($.trim($("#txtfathername").val())=="")
		{
			$("#msgcontent").html("Enter Father Name.");
			$("#ValidationAlert").modal();
			$("#txtfathername").focus()
			return false;	 
		}
		if($.trim($("#chofatherQalif").val())=="")
		{
			$("#msgcontent").html("Select Father Qualification.");
			$("#ValidationAlert").modal();
			$("#chofatherQalif").focus()
			return false;	 
		}
		if($.trim($("#chofatherOccup").val())=="")
		{
			$("#msgcontent").html("Select Father Occupation.");
			$("#ValidationAlert").modal();
			$("#chofatherOccup").focus()
			return false;	 
		}
		if($.trim($("#txtfatherMobNo").val())=="")
		{
			$("#msgcontent").html("Enter Father Mobile No.");
			$("#ValidationAlert").modal();
			$("#txtfatherMobNo").focus()
			return false;	 
		}
		if($.trim($("#txtfatherMobNo").val())!="" && ($.trim($("#txtfatherMobNo").val())).length!=10 ) 
		{
			$("#msgcontent").html("Please enter a valid Mobile No. of Father");
			$("#ValidationAlert").modal();
			$("#txtfatherMobNo").focus();
			return false;
			 
		}
		
		
		if($.trim($("#txtmotherName").val())=="")
		{
			$("#msgcontent").html("Enter Mother Name.");
			$("#ValidationAlert").modal();
			$("#txtmotherName").focus()
			return false;	 
		}
		if($.trim($("#chomotherQalif").val())=="")
		{
			$("#msgcontent").html("Select Mother Qualification.");
			$("#ValidationAlert").modal();
			$("#chomotherQalif").focus()
			return false;	 
		}
		if($.trim($("#chomotherOccup").val())=="")
		{
			$("#msgcontent").html("Select Mother Occupation.");
			$("#ValidationAlert").modal();
			$("#chomotherOccup").focus()
			return false;	 
		}
		
		if($.trim($("#txtmotherMobNo").val())=="")
		{
			$("#msgcontent").html("Enter Mother Mobile No.");
			$("#ValidationAlert").modal();
			$("#txtmotherMobNo").focus()
			return false;	 
		}
		if($.trim($("#txtmotherMobNo").val())!="" && ($.trim($("#txtmotherMobNo").val())).length!=10 ) 
		{
			$("#msgcontent").html("Please enter a valid Mobile No. of Mother");
			$("#ValidationAlert").modal();
			$("#txtmotherMobNo").focus();
			return false;
			 
		}
		 if($.trim($("#txtguardianName").val())=="")
		{
			$("#msgcontent").html("Enter Guardian Name.");
			$("#ValidationAlert").modal();
			$("#txtguardianName").focus()
			return false;	 
		}
		if($.trim($("#txtrelation").val())=="")
		{
			$("#msgcontent").html("Enter Relationship with Guardian.");
			$("#ValidationAlert").modal();
			$("#txtrelation").focus()
			return false;	 
		}
		if($.trim($("#choguardianOccup").val())=="")
		{
			$("#msgcontent").html("Select Guardian Occupation.");
			$("#ValidationAlert").modal();
			$("#choguardianOccup").focus()
			return false;	 
		} 
		if($.trim($("#txtguardianMobNo").val())=="")
		{
			$("#msgcontent").html("Enter Guardian Mobile No.");
			$("#ValidationAlert").modal();
			$("#txtguardianMobNo").focus()
			return false;	 
		}
		if($.trim($("#txtguardianMobNo").val())!="" && ($.trim($("#txtguardianMobNo").val())).length!=10 ) 
		{
			$("#msgcontent").html("Please enter a valid Mobile No. of Gaurdian");
			$("#ValidationAlert").modal();
			$("#txtguardianMobNo").focus();
			return false;
			 
		}
		if($.trim($("#txtapplcntRlyStation").val())=="")
		{
			$("#msgcontent").html("Enter name of Nearest Railway Station.");
			$("#ValidationAlert").modal();
			$("#txtapplcntRlyStation").focus()
			return false;	 
		}
		 
		if($.trim($("#chofamilyMemCnt").val())=="")
		{
			$("#msgcontent").html("Select No. of Family Member.");
			$("#ValidationAlert").modal();
			$("#chofamilyMemCnt").focus()
			return false;	 
		}
		return true
	}
	
	function saveGuardianDetail(){
		 
			if(!verifyGuardianInput()){
					return false;
			}
			$('#dvLoading').show();
			var form = $("#frmGuardianDetails");
			$.ajax({                                      
			  url:'Save_guardianDetail.php',                     
			   type:'post',
			   data: form.serialize()+'&collegerollno='+$("#hdncollRollforEdit").val(),
			   dataType: 'json',
			  success: function(data)
			  {
		//	alert(JSON.stringify(data))
					if(data.status==1)
					{
							$("#msgcontent").html(data.msg);
							$("#ValidationAlert").modal();
							$('#ValidationAlert').on('hidden.bs.modal', function () {
								$("#txtStudentRollno").val(data.collegerollno)
								$("#frmsession").attr('action', geturl());
								$("#frmsession").submit();
							}) 
					}
					else
					{
							$("#msgcontent").html(data.msg);
							$("#ValidationAlert").modal();
							return false;
					}
				
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
			});
	}
	
	function verifyContactDetailsInput(){
	 
	if($.trim($("#txtpermntAddr").val())=="")
	{
		$("#msgcontent").html("Enter your Permanent Address.");
		$("#ValidationAlert").modal();
		$("#txtpermntAddr").focus()
		return false;	 
	}

	
	if($.trim($("#txtpermntPO").val())=="") 
	{
		$("#msgcontent").html("Enter your Post Office name of Permanent Address.");
		$("#ValidationAlert").modal();
		$("#txtpermntPO").focus()
		return false;	 
	}
	
	if($.trim($("#txtpermntPS").val())=="") 
	{
		$("#msgcontent").html("Enter your Police Station name of Permanent Address.");
		$("#ValidationAlert").modal();
		$("#txtpermntPS").focus()
		return false;	 
	}
	
	if($.trim($("#chopermntLocality").val())=="") 
	{
		$("#msgcontent").html("Select your Locality Type of Permanent Address.");
		$("#ValidationAlert").modal();
		$("#chopermntLocality").focus();
		return false;
	}

	if($.trim($("#txtpermntCity").val())=="") 
	{
		$("#msgcontent").html("Enter your City / Village name of Permanent Address.");
		$("#ValidationAlert").modal();
		$("#txtpermntCity").focus();
		return false;
	}
	
	if($.trim($("#txtpermntDistrict").val())=="") 
	{
		$("#msgcontent").html("Enter your District name of Permanent Address.");
		$("#ValidationAlert").modal();
		$("#txtpermntDistrict").focus();
		return false;
	}
	if($.trim($("#chopermntState").val())=="") 
	{
		$("#msgcontent").html("Select State of Permanent Address.");
		$("#ValidationAlert").modal();
		$("#chopermntState").focus();
		return false;
	}
	if($.trim($("#chopermntCountry").val())=="") 
	{
		$("#msgcontent").html("Enter Country of Permanent Address.");
		$("#ValidationAlert").modal();
		$("#chopermntCountry").focus();
		return false;
	}
	if($.trim($("#txtpermntPin").val())=="") 
	{
		$("#msgcontent").html("Enter PIN Code of Permanent Address.");
		$("#ValidationAlert").modal();
		$("#txtpermntPin").focus();
		return false;
	}

	if($.trim($("#txtpermntPin").val())!="" && ($.trim($("#txtpermntPin").val())).length!=6 ) 
	{
		$("#msgcontent").html("Enter valid PIN Code of Permanent Address.");
		$("#ValidationAlert").modal();
		$("#txtpermntPin").focus();
		return false;
		 
	}
		





	if($.trim($("#txtlocalAddr").val())=="")
	{
		$("#msgcontent").html("Enter your Communication Address.");
		$("#ValidationAlert").modal();
		$("#txtlocalAddr").focus()
		return false;	 
	}

	
	if($.trim($("#txtlocalPO").val())=="") 
	{
		$("#msgcontent").html("Enter your Post Office name of Communication Address.");
		$("#ValidationAlert").modal();
		$("#txtlocalPO").focus()
		return false;	 
	}
	
	if($.trim($("#txtlocalPS").val())=="") 
	{
		$("#msgcontent").html("Enter your Police Station name of Communication Address.");
		$("#ValidationAlert").modal();
		$("#txtlocalPS").focus()
		return false;	 
	}
	
	if($.trim($("#cholocalLocality").val())=="") 
	{
		$("#msgcontent").html("Select your Locality Type of Communication Address.");
		$("#ValidationAlert").modal();
		$("#cholocalLocality").focus();
		return false;
	}

	if($.trim($("#txtlocalCity").val())=="") 
	{
		$("#msgcontent").html("Enter your City / Village name of Communication Address.");
		$("#ValidationAlert").modal();
		$("#txtlocalCity").focus();
		return false;
	}
	
	if($.trim($("#txtlocalDistrict").val())=="") 
	{
		$("#msgcontent").html("Enter your District name of Communication Address.");
		$("#ValidationAlert").modal();
		$("#txtlocalDistrict").focus();
		return false;
	}
	if($.trim($("#cholocalState").val())=="") 
	{
		$("#msgcontent").html("Select State of Communication Address.");
		$("#ValidationAlert").modal();
		$("#cholocalState").focus();
		return false;
	}
	if($.trim($("#cholocalCountry").val())=="") 
	{
		$("#msgcontent").html("Enter Country of Communication Address.");
		$("#ValidationAlert").modal();
		$("#cholocalCountry").focus();
		return false;
	}
	if($.trim($("#txtlocalPin").val())=="") 
	{
		$("#msgcontent").html("Enter PIN Code of Communication Address.");
		$("#ValidationAlert").modal();
		$("#txtlocalPin").focus();
		return false;
	}

	if($.trim($("#txtlocalPin").val())!="" && ($.trim($("#txtlocalPin").val())).length!=6 ) 
	{
		$("#msgcontent").html("Enter valid PIN Code of Communication Address.");
		$("#ValidationAlert").modal();
		$("#txtlocalPin").focus();
		return false;
		 
	}
	if($.trim($("#txtMobileNo").val())=="")
		{
			$("#msgcontent").html("Enter Applicant Mobile No.");
			$("#ValidationAlert").modal();
			$("#txtMobileNo").focus();
			return false;
		}
		if($.trim($("#txtMobileNo").val())!="" && ($.trim($("#txtMobileNo").val())).length!=10 ) 
		{
			$("#msgcontent").html("Enter valid Applicant Mobile No.");
			$("#ValidationAlert").modal();
			$("#txtMobileNo").focus();
			return false;
			 
		}
		if($.trim($("#txtotherMobileNo").val())=="")
		{
			$("#msgcontent").html("Enter Alternate Mobile No.");
			$("#ValidationAlert").modal();
			$("#txtotherMobileNo").focus();
			return false;
		}
		if($.trim($("#txtotherMobileNo").val())!="" && ($.trim($("#txtotherMobileNo").val())).length!=10 ) 
		{
			$("#msgcontent").html("Enter valid Alternate Mobile No.");
			$("#ValidationAlert").modal();
			$("#txtMobileNo").focus();
			return false;
			 
		}
		
		if($.trim($("#hasWhatsAppno").val())=="")
		{
			$("#msgcontent").html("Do you have WhatsApp No.");
			$("#ValidationAlert").modal();
			$("#hasWhatsAppno").focus();
			return false;
		}
		if($.trim($("#hasWhatsAppno").val())=="Yes") {
			if($.trim($("#txtWhatsAppNo").val())=="")
			{
				$("#msgcontent").html("Enter WhatsApp No.");
				$("#ValidationAlert").modal();
				$("#txtWhatsAppNo").focus();
				return false;
			}
			if($.trim($("#txtWhatsAppNo").val())!="" && ($.trim($("#txtWhatsAppNo").val())).length!=10 ) 
			{
				$("#msgcontent").html("Enter valid WhatsApp No.");
				$("#ValidationAlert").modal();
				$("#txtWhatsAppNo").focus();
				return false;
				 
			}
		}
		
		
		
		if($.trim($("#txtemailId").val())=="")
		{
			$("#msgcontent").html("Enter Applicant Email Id.");
			$("#ValidationAlert").modal();
			$("#txtemailId").focus();
			return false;
		}
		else
		{

			var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
			if(!filter.test($.trim($("#txtemailId").val())))
			{
				$("#msgcontent").html("Enter Applicant E-mail in valid format");
				$("#ValidationAlert").modal();
				$("#txtemailId").focus();
				return false;
			}
		}
	
		return true;
	 
 }


function saveContactDetail(){
	 
	if(!verifyContactDetailsInput()){
			return false;
			}
		$('#dvLoading').show();	
			var form = $("#frmContactDetail");
			$.ajax({                                      
			  url:'Save_ContactDetail.php',                     
			   type:'post',
			   data: form.serialize()+'&collegerollno='+$("#hdncollRollforEdit").val(),
			   dataType: 'json',
			  success: function(data)
			  {
		//	alert(JSON.stringify(data))
					if(data.status==1)
					{
							$("#msgcontent").html(data.msg);
							$("#ValidationAlert").modal();
							$('#ValidationAlert').on('hidden.bs.modal', function () {
								$("#txtStudentRollno").val(data.collegerollno)
								$("#frmsession").attr('action', geturl());
								$("#frmsession").submit();
							}) 
					}
					else
					{
							$("#msgcontent").html(data.msg);
							$("#ValidationAlert").modal();
							return false;
					}
					
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
			});
			 
	}
 

function getCourseInfo(courseCode,mode){
	 
	$("#HonoursGEInfo").hide();
	$("#GeneralGEInfo").hide();
	$("#SECInfo").hide();
	$("#CVACInfo").hide(); 
	$("#OtherGEInfo").hide(); 
	$("#AECCInfo").hide(); 
	$("#cbohonsubject").val('');
	$("#txtsubjectcode").val('');
 
	clear_form_elements('HonoursGEInfo');
	clear_form_elements('GeneralGEInfo');
	
	
	if(courseCode=='09' || courseCode=='08' ||  courseCode=='14' || courseCode=='15' || courseCode=='16') {
	 		$("#HonoursGEInfo").show();
			$("#OtherGEInfo").show();
			$("#SECInfo").show();
			$("#AECCInfo").show();
			$("#CVACInfo").show();
			fillgensubjectforHonours('','');
	}
	if(courseCode =='11' ||  courseCode =='12' ) {
		$("#GeneralGEInfo").show();
		$("#OtherGEInfo").show();
		$("#SECInfo").show();
		$("#AECCInfo").show();
		$("#CVACInfo").show();
		fillgensubjectforGeneral('','','');
		/* if(courseCode =='12' ) {
		$("#GeneralGE3Info").show();
		clear_form_elements('GeneralGE3Info');
		
		} */
	 }
	 /* if(courseCode=='11'){
		$("#GeneralElectiveInfo").show(); 
		$("#GeneralLCCInfo").show();
		$("#SECInfo").show(); 
		clear_form_elements('GeneralElectiveInfo');
		
		fillGEGeneral(''); 
	 } */
	 if(courseCode =='10' ||  courseCode =='13' ) { 
		$("#AECCInfo").show();
		$("#CVACInfo").show();
		$("#SECInfo").show();
		//fillAECSubject('','');
		 
	 } 
	/* if(courseCode!='18'){
		$("#AECCInfo").show();
		 
		clear_form_elements('AECCInfo');		
	 } */
}


function loadcourseDetail(collegeRoll){
	 
	$.ajax({
	
					type:"POST",
					url:"getCourseDetail.php",
					dataType:"json",
					data:"collegeRollno="+collegeRoll,
					error:function(obj)
					{
						//alert(obj.status);
					},
					success:function(obj)
					{
						//alert(JSON.stringify(obj))
						fillappsection(obj["appsection"]); 
						 fillcourse(obj["appsection"],obj["appstream"]);
						 $("#coursecode").val(obj["courseCode"]);
						 fillappsubject(obj["appstream"],obj["appsection"],obj["appsubject"]);
						 $("#txtappsubjectcode").val(obj["appsubjectcode"]); 
						     
						
					}	
		});
}


function getNewRollNo(){
	if($("#cboappsection").val()==''){
		$("#msgcontent").html("Select Section.");
		$("#ValidationAlert").modal();
		$("#cboappsection").focus()
		return false;
		}
	 if($("#cboappstream").val()==''){
		$("#msgcontent").html("Select stream.");
		$("#ValidationAlert").modal();
		$("#cboappstream").focus()
		return false;
		}
	 if($("#cboappsubject").val()==''){
		$("#msgcontent").html("Select subject.");
		$("#ValidationAlert").modal();
		$("#cboappsubject").focus()
		return false;
		}
	var formparm =$("#coursefrm").serialize();
			$.ajax({
	
					type:"POST",
					url:"getcollegeRollNo.php",
					dataType:"json",
					data: formparm,
					error:function(obj)
					{
						//alert(obj.status);
					},
					success:function(obj)
					{
						if(obj.status==0) {
							$("#msgcontent").html(obj.msg);
							$("#ValidationAlert").modal();
							return false;
						}
						else if(obj.status==1) {
							$("#suggested_Collrollno").html("(Suggested : "+obj.newrollno+")"); 
							$("#txtCollrollno_prefix").val(obj.newrollnoprefix); 
							$("#txtCollrollno_srlno").val(obj.newrollnoSrlno); 
						}
					}	
		});	
}



function loadGEDetail(collegeRoll){
	 
	$.ajax({
	
					type:"POST",
					url:"getCourseDetail.php",
					dataType:"json",
					data:"collegeRollno="+collegeRoll,
					error:function(obj)
					{
						//alert(obj.status);
					},
					success:function(obj)
					{
						getCourseInfo(obj["courseCode"]); 
						if(obj["courseCode"]=='08' || obj["courseCode"]=='09' || obj["courseCode"]=='10' || obj["courseCode"]=='14' || obj["courseCode"]=='15' || obj["courseCode"]=='16') {
						fillgensubjectforHonours(obj["GE1"],obj["GE2"]); 
						}
						 if(obj["courseCode"]=='11' || obj["courseCode"]=='12' ) {
						 fillgensubjectforGeneral(obj["CORE1"],obj["CORE2"],obj["CORE3_GE3"]);
						 }
						 
						 if(obj["courseCode"]=='08' || obj["courseCode"]=='09' || obj["courseCode"]=='11' || obj["courseCode"]=='12') {
						fillIDCSubject(obj["IDC1"],obj["IDC2"],obj["IDC3"]); 
						fillSECSubject(obj["SEC1"],obj["SEC2"],obj["SEC3"]); 
						}
						if(obj["courseCode"]=='08' || obj["courseCode"]=='09' || obj["courseCode"]=='11' || obj["courseCode"]=='12' || obj["courseCode"]=='10' || obj["courseCode"]=='13') {
						fillCVACSubject(obj["CVAC1"],obj["CVAC2"],obj["CVAC4"]); 
						 
						}
						  fillMIL(obj["courseName"],obj["AECC2"])
					 
					}	
		});
}

function loadGESemDetail(collegeRoll){
	var courseCode=$("#hdncourseCode").val();
	$.ajax({
	
					type:"POST",
					url:"getGESemDetail.php",
					dataType:"json",
					data:"collegeRollno="+collegeRoll,
					error:function(obj)
					{
						//alert(obj.status);
					},
					success:function(obj)
					{
						 
						  if(courseCode=='08' || courseCode=='09' || courseCode=='10' || courseCode=='14' || courseCode=='15' || courseCode=='16') {
						
							$("#cboGESem1subject").val(obj['I']['generalCourse']);
							$("#cboGESem2subject").val(obj['II']['generalCourse']);
							$("#cboGESem3subject").val(obj['III']['generalCourse']);
							$("#cboGESem4subject").val(obj['IV']['generalCourse']);
							$("#GESem1subjectcode").val(obj['I']['generalCourseCode']);
							$("#GESem2subjectcode").val(obj['II']['generalCourseCode']);
							$("#GESem3subjectcode").val(obj['III']['generalCourseCode']);
							$("#GESem4subjectcode").val(obj['IV']['generalCourseCode']); 
						}
			}	
		});
}


function fillcourse(sectionval,setval){
	
	var str="<option value=''>Select</option>";
	
	$("#cboappstream").html(str);
	$("#coursecode").val('');
	$("#cboappsubject").html(str);
	$("#txtappsubjectcode").val('');
	$("#txtCollrollno_prefix").val('');
	$("#txtCollrollno_srlno").val('');
	$("#suggested_Collrollno").html('');	
	
			$.ajax({
					type:"POST",
					url:"getAllCourse.php",
					dataType:"json",
					data:'section='+sectionval,
					error:function(obj)
					{
						//alert(obj.status);
					},
					success:function(obj)
					{
						for(var i=0; i<obj.length; i++){
						str +="<option value='"+obj[i]["stream"]+"'>"+obj[i]["streamType"]+"</option>"
						}
						$("#cboappstream").html(str);
						$("#cboappstream").val(setval);
					}	
		});
	
}



function fillsubject(streamval,setval){

var str="<option value=''>Select</option>";
		$.ajax({
	
					type:"POST",
					url:"getAllSubject.php",
					dataType:"json",
					data:"",
					error:function(obj)
					{
						//alert(obj.status);
					},
					success:function(obj)
					{
						for(var i=0; i<obj.length; i++){
						str +="<option value='"+obj[i]["SDMSsubject"]+"'>"+obj[i]["SDMSsubject"]+"</option>"
						}
						$("#cbohonsubject").html(str);
						$("#cbohonsubject").val(setval);
					}	
		});
	
}


function fillgensubjectforHonours(GE1val,GE2val){

var genstr1="<option value=''>Select</option>";

		$.ajax({
	
					type:"POST",
					url:"getAllGenSubject.php",
					dataType:"json",
					data:"subjectType=MINOR",
					error:function(obj)
					{
						//alert(obj.status);
					},
					success:function(obj)
					{
						for(var i=0; i<obj.length; i++){
						genstr1 +="<option value='"+obj[i]["SDMSsubject"]+"'>"+obj[i]["SDMSsubject"]+"</option>"
						
						}
						$("#cboGE1subject").html(genstr1);
						$("#cboGE1subject").val(GE1val);
						$("#cboGE2subject").html(genstr1);
						$("#cboGE2subject").val(GE2val);
						 
					}	
		});
	
}

function fillgensubjectforGeneral(CC1val,CC2val,CC3val){

var genstr1="<option value=''>Select</option>";
 		$.ajax({
 					type:"POST",
					url:"getAllGenSubject.php",
					dataType:"json",
					data:"subjectType=MINOR",
					error:function(obj)
					{
						//alert(obj.status);
					},
					success:function(obj)
					{
						for(var i=0; i<obj.length; i++){
						genstr1 +="<option value='"+obj[i]["SDMSsubject"]+"'>"+obj[i]["SDMSsubject"]+"</option>"
						
						}
						$("#cboCore1subject").html(genstr1);
						$("#cboCore1subject").val(CC1val);
						$("#cboCore2subject").html(genstr1);
						$("#cboCore2subject").val(CC2val);
						$("#cboMinorsubject").html(genstr1);
						$("#cboMinorsubject").val(CC3val);
 					}	
		});
	
}

function fillGEGeneral(GEGenval){

var genstr1="<option value=''>Select</option>";
 		$.ajax({
 					type:"POST",
					url:"getAllGenSubject.php",
					dataType:"json",
					data:"subjectType=MINOR",
					error:function(obj)
					{
						//alert(obj.status);
					},
					success:function(obj)
					{
						for(var i=0; i<obj.length; i++){
						genstr1 +="<option value='"+obj[i]["SDMSsubject"]+"'>"+obj[i]["SDMSsubject"]+"</option>"
						
						}
						$("#cboGEGeneralsubject").html(genstr1);
						$("#cboGEGeneralsubject").val(GEGenval);
 					}	
		});
	
}

function fillCVACSubject(setCVAC13,setCVAC2,setCVAC4){
	var str="<option value=''>Select</option>";
			$.ajax({
		
						type:"POST",
						url:"getAllGenSubject.php",
						dataType:"json",
						data:"subjectType=CVAC",
						error:function(obj)
						{
							//alert(obj.status);
						},
						success:function(obj)
						{
							for(var i=0; i<obj.length; i++){
							str +="<option value='"+obj[i]["SDMSsubject"]+"'>"+obj[i]["SDMSsubject"]+"</option>"
							}
							$("#cboCVAC13subject").html(str);
							$("#cboCVAC2subject").html(str);
							 $("#cboCVAC4subject").html(str);
							$("#cboCVAC13subject").val(setCVAC13);
							$("#cboCVAC2subject").val(setCVAC2);
							$("#cboCVAC4subject").val(setCVAC4);
							 
						}	
			});	
}

function fillIDCSubject(setIDC1,setIDC2,setIDC3){
	var str="<option value=''>Select</option>";
			$.ajax({
		
						type:"POST",
						url:"getAllGenSubject.php",
						dataType:"json",
						data:"subjectType=IDC",
						error:function(obj)
						{
							//alert(obj.status);
						},
						success:function(obj)
						{
							for(var i=0; i<obj.length; i++){
							str +="<option value='"+obj[i]["SDMSsubject"]+"'>"+obj[i]["SDMSsubject"]+"</option>"
							}
							$("#cboIDC1subject").html(str);
							$("#cboIDC2subject").html(str);
							$("#cboIDC3subject").html(str);
							$("#cboIDC1subject").val(setIDC1);
							$("#cboIDC2subject").val(setIDC2);
							$("#cboIDC3subject").val(setIDC3);
						}	
			});	
}

function fillSECSubject(setSEC1,setSEC2,setSEC3){
	var str="<option value=''>Select</option>";
			$.ajax({
		
						type:"POST",
						url:"getAllGenSubject.php",
						dataType:"json",
						data:"subjectType=SEC",
						error:function(obj)
						{
							//alert(obj.status);
						},
						success:function(obj)
						{
							for(var i=0; i<obj.length; i++){
							str +="<option value='"+obj[i]["SDMSsubject"]+"'>"+obj[i]["SDMSsubject"]+"</option>"
							}
							$("#cboSEC1subject").html(str);
							$("#cboSEC2subject").html(str);
							$("#cboSEC3subject").html(str);
							$("#cboSEC1subject").val(setSEC1);
							$("#cboSEC2subject").val(setSEC2);
							$("#cboSEC3subject").val(setSEC3);
						}	
			});	
}
function displaycoursecode(course){
$("#coursecode").val('')
$("#txtCollrollno_prefix").val('');
$("#txtCollrollno_srlno").val('');
$("#suggested_Collrollno").html('');
$.ajax({
	
					type:"POST",
					url:"getcoursecode.php",
					dataType:"json",
					data:"course="+course,
					error:function(obj)
					{
						//alert(obj.status);
					},
					success:function(obj)
					{

					$("#coursecode").val(obj[0]["courseCode"]);
					getCourseInfo(obj[0]["courseCode"]);
					
					}	
		});
	
}


function fillappsection(setsection){
	
	var str="<option value=''>Select</option>";
	$("#cboappstream").html(str);
	$("#cboappsubject").html(str);
	$("#txtappsubjectcode").val('');
	
		$.ajax({
	
				type:"POST",
				url:"getAppSection.php",
				dataType:"json",
				data:'',
				error:function(obj)
				{
					//alert(obj.status);
				},
				success:function(obj)
				{
					for(var i=0; i<obj.length; i++){
						str +="<option value='"+obj[i]["section"]+"'>"+obj[i]["section"]+"</option>"
					}
						$("#cboappsection").html(str);
						$("#cboappsection").val(setsection);
				}	
		});	
	
}

function fillappsubject(streamval,sectionval,setsubject){
	
		var stream = streamval;
		if(sectionval!=''){
		var section = sectionval;		
		}
		else {
			var section = $("#cboappsection").val();	
		}
		
		//alert(section+','+setsubject+','+stream)
	var str="<option value=''>Select</option>";
	$("#txtappsubjectcode").val('');
		$.ajax({
	
				type:"POST",
				url:"getAppSubject.php",
				dataType:"json",
				data:'stream='+stream+'&section='+section,
				error:function(obj)
				{
					//alert(obj.status);
				},
				success:function(obj)
				{
					for(var i=0; i<obj.length; i++){
						str +="<option value='"+obj[i]["subjectName"]+"'>"+obj[i]["subjectName"]+"</option>"
					}
						$("#cboappsubject").html(str);
						$("#cboappsubject").val(setsubject);
				}	
		});	
	
}

function fillMIL(course,setMIL){
//alert(setMIL)
var str="<option value=''>Select</option>";
$.ajax({
	
					type:"POST",
					url:"getAllMIL.php",
					dataType:"json",
					data:"course="+course,
					error:function(obj)
					{
						alert(obj.status);
					},
					success:function(obj)
					{
						
						for(var i=0; i<obj.length; i++){
						str +="<option value='"+obj[i]["SubjectName_SDMS"]+"'>"+obj[i]["SubjectName_SDMS"]+"</option>"
						
						}
						
						
						$("#cboLanguage").html(str);
						$("#cboLanguage").val(setMIL);
						
					}	
		});
	
}

function displayMIL(MIL){
	//alert( $("#coursecode").val())
	$("#txtMIL").val('');
	//alert(MIL)
	var coursecode = $("#hdncourseCode").val()
	//alert(coursecode)
$.ajax({
	
					type:"POST",
					url:"getMILSubject.php",
					dataType:"json",
					data:"MIL="+MIL+'&coursecode='+coursecode,
					error:function(obj)
					{
						//alert(obj.status);
					},
					success:function(obj)
					{
						//alert(JSON.stringify(obj))
						$("#txtMIL").val(obj[0]["compulsarySubjectCode"])
						$("#compulsaryEng").html(obj[0]["compulsaryEnglish"])
					}	
		});	
}
 
function dispalygensubject(gensub,dispElemId){

$("#"+dispElemId).val('')
if(gensub!='') {
			$.ajax({
	
					type:"POST",
					url:"getGenSubjectbycode.php",
					dataType:"json",
					data:"gensub="+gensub,
					error:function(obj)
					{
						//alert(obj.status);
					},
					success:function(obj)
					{						
						$("#"+dispElemId).val(obj[0]["SubjectCode"])
					}	
		});
}
	
}



function displayhonsub(honsub){
	$("#txtappsubjectcode").val('');
	$("#txtCollrollno_prefix").val('');
	$("#txtCollrollno_srlno").val('');
	$("#suggested_Collrollno").html('');
$.ajax({
	
					type:"POST",
					url:"gethonSubjectbycode.php",
					dataType:"json",
					data:"honsub="+honsub,
					error:function(obj)
					{
						//alert(obj.status);
					},
					success:function(obj)
					{						
						$("#txtappsubjectcode").val(obj[0]["subjectcode"])
					}	
		});
	
}

function displayAppsubCode(honsub){
	$("#txtsubjectcode").val('')
$.ajax({
	
					type:"POST",
					url:"getAppSubjectbycode.php",
					dataType:"json",
					data:"honsub="+honsub,
					error:function(obj)
					{
						//alert(obj.status);
					},
					success:function(obj)
					{						
						$("#txtappsubjectcode").val(obj[0]["subjectcode"])
					}	
		});
	
}

function displayLCCCode(LCC){
	//alert( $("#coursecode").val())
	$("#txtLCCCode").val('');
	
$.ajax({
	
					type:"POST",
					url:"getLCCSubject.php",
					dataType:"json",
					data:"LCC="+LCC,
					error:function(obj)
					{
						//alert(obj.status);
					},
					success:function(obj)
					{
 						$("#txtLCCCode").val(obj[0]["LCCCode"])
 					}	
		});	
}

function updateMainCourse(){
	
	if($("#cboappsection").val()==''){
		$("#msgcontent").html("Select Section.");
		$("#ValidationAlert").modal();
		$("#cboappsection").focus()
		return false;
		}
	 if($("#cboappstream").val()==''){
		$("#msgcontent").html("Select stream.");
		$("#ValidationAlert").modal();
		$("#cboappstream").focus()
		return false;
		}
	 if($("#cboappsubject").val()==''){
		$("#msgcontent").html("Select subject.");
		$("#ValidationAlert").modal();
		$("#cboappsubject").focus()
		return false;
		}
	 if($("#txtCollrollno_prefix").val()==''){
		$("#msgcontent").html("Enter Roll No prefix.");
		$("#ValidationAlert").modal();
		$("#txtCollrollno_prefix").focus()
		return false;
		}
	if($("#txtCollrollno_srlno").val()==''){
		$("#msgcontent").html("Enter Roll Serial No.");
		$("#ValidationAlert").modal();
		$("#txtCollrollno_srlno").focus()
		return false;
		}
		
			var pars = $("#coursefrm").serialize();
			
		$.ajax({
					type:"POST",
					url:"updatemaincourse.php",
					dataType:"json",
					data:pars,
					error:function(obj)
					{
						//alert(obj.status);
					},
					success:function(obj)
					{
						//alert(JSON.stringify(obj));
						if(obj.status=1) {
							$("#msgcontent").html(obj.msg);
							$("#ValidationAlert").modal();
							$("#txtcollegeRollno").val(obj.newrollno);
							 
							$("#frmnext").submit();
						}
						else {
							$("#msgcontent").html(obj.msg);
							$("#ValidationAlert").modal();
							return false;
						}
					}	
		});
		
}

function checkIfDuplicateExists(arr) {
    return new Set(arr).size !== arr.length
}


function validateGE(){
	 
	 if($("#hdncourseCode").val()=='08' || $("#hdncourseCode").val()=='09'){
			if($("#cboGE1subject").val()==''){
				$("#msgcontent").html("Select Minor Subject 1.");
				$("#ValidationAlert").modal();
				$("#cboGE1subject").focus();
				return false;
				
			}
		if($("#cboGE2subject").val()==''){
			$("#msgcontent").html("Select Minor Subject 2.");
			$("#ValidationAlert").modal();
			$("#cboGE2subject").focus();
			return false;
		}
		
		if($("#cboGE1subject").val()!='' && $("#cboGE2subject").val()!=''){
		  subarr = [$("#cboGE1subject").val(), $("#cboGE2subject").val(), $("#hdnappsubject").val() ];
				if(checkIfDuplicateExists(subarr)){
					$("#msgcontent").html("Same Subject cannot be choosen as Major, Minor 1&2 and Minor 3&4.");
					$("#ValidationAlert").modal();
					return false;
				}
		}
		
		if($("#cboIDC1subject").val()==''){
			$("#msgcontent").html("Select IDC Subject 1.");
			$("#ValidationAlert").modal();
			$("#cboIDC1subject").focus();
			return false;
			
		}
		if($("#cboIDC2subject").val()==''){
			$("#msgcontent").html("Select IDC Subject 2.");
			$("#ValidationAlert").modal();
			$("#cboIDC2subject").focus();
			return false;		
		}
		if($("#cboIDC3subject").val()==''){
			$("#msgcontent").html("Select IDC Subject 3.");
			$("#ValidationAlert").modal();
			$("#cboIDC3subject").focus();
			return false;
			
		}
		if($("#cboIDC1subject").val()!='' && $("#cboIDC2subject").val()!='' && $("#cboIDC3subject").val()!=''){
			IDCarr = [$("#cboIDC1subject").val(), $("#cboIDC2subject").val(), $("#cboIDC3subject").val() ];
				if(checkIfDuplicateExists(IDCarr)){
					$("#msgcontent").html("Same IDC Subject cannot be choosen more than once.");
					$("#ValidationAlert").modal();
					return false;
				}
				else {
					IDC2arr = [$("#cboIDC1subject").val(), $("#cboIDC2subject").val(), $("#cboIDC3subject").val(),$("#cboGE1subject").val(), $("#cboGE2subject").val(), $("#cboappsubject").val() ];
					if(checkIfDuplicateExists(IDC2arr)){
						$("#msgcontent").html("IDC Subject cannot be same as Major, Minor 1&2 and Minor 3&4.");
						$("#ValidationAlert").modal();
						return false;
					}
				}
		}
		 
	}
	if($("#hdncourseCode").val()=='11' || $("#hdncourseCode").val()=='12'){
		if($("#cboCore1subject").val()==''){
			$("#msgcontent").html("Core Subject 1.");
			$("#ValidationAlert").modal();
			$("#cboCore1subject").focus();
			return false;
			
		}
		if($("#cboCore2subject").val()==''){
			$("#msgcontent").html("Core Subject 2.");
			$("#ValidationAlert").modal();
			$("#cboCore2subject").focus();
			return false;
			
		}
		if($("#cboMinorsubject").val()==''){
			$("#msgcontent").html("Select Minor Subject.");
			$("#ValidationAlert").modal();
			$("#cboMinorsubject").focus();
			return false;
			
		}
		if($("#cboCore1subject").val()!='' && $("#cboCore2subject").val()!='' && $("#cboMinorsubject").val()!=''){
			Corearr = [$("#cboCore1subject").val(), $("#cboCore2subject").val(), $("#cboMinorsubject").val() ];
				if(checkIfDuplicateExists(Corearr)){
					$("#msgcontent").html("Same Subject cannot be choosen as Core 1, Core 2 and Minor.");
					$("#ValidationAlert").modal();
					return false;
				}
		}
		
		if($("#cboIDC1subject").val()==''){
			$("#msgcontent").html("Select IDC Subject 1.");
			$("#ValidationAlert").modal();
			$("#cboIDC1subject").focus();
			return false;
			
		}
		if($("#cboIDC2subject").val()==''){
			$("#msgcontent").html("Select IDC Subject 2.");
			$("#ValidationAlert").modal();
			$("#cboIDC2subject").focus();
			return false;
			
		}
		if($("#cboIDC3subject").val()==''){
			$("#msgcontent").html("Select IDC Subject 3.");
			$("#ValidationAlert").modal();
			$("#cboIDC3subject").focus();
			return false;
			
		}
		if($("#cboIDC1subject").val()!='' && $("#cboIDC2subject").val()!='' && $("#cboIDC3subject").val()!=''){
			IDCarr = [$("#cboIDC1subject").val(), $("#cboIDC2subject").val(), $("#cboIDC3subject").val() ];
				if(checkIfDuplicateExists(IDCarr)){
					$("#msgcontent").html("Same IDC Subject cannot be choosen more than once.");
					$("#ValidationAlert").modal();
					return false;
				}
				else {
				IDC2arr = [$("#cboIDC1subject").val(), $("#cboIDC2subject").val(), $("#cboIDC3subject").val(),$("#cboCore1subject").val(), $("#cboCore2subject").val(), $("#cboMinorsubject").val()];
				if(checkIfDuplicateExists(IDC2arr)){
					$("#msgcontent").html("IDC Subject cannot be same as Core 1, Core 2 and Minor.");
					$("#ValidationAlert").modal();
					return false;
					}
				}
			}
	
	}
	
	if($("#hdncourseCode").val()=='08' || $("#hdncourseCode").val()=='09' || $("#hdncourseCode").val()=='11' || $("#hdncourseCode").val()=='12' || $("#hdncourseCode").val()=='10' || $("#hdncourseCode").val()=='13'){
		if($("#cboCVAC13subject").val()==''){
			$("#msgcontent").html("Select CVAC Subject 1 & 3.");
			$("#ValidationAlert").modal();
			$("#cboCVAC13subject").focus();
			return false;
		}
		if($("#cboCVAC2subject").val()==''){
			$("#msgcontent").html("Select CVAC Subject 2.");
			$("#ValidationAlert").modal();
			$("#cboCVAC2subject").focus();
			return false;
			
		}
		if($("#cboCVAC4subject").val()==''){
			$("#msgcontent").html("Select CVAC Subject 4.");
			$("#ValidationAlert").modal();
			$("#cboCVAC4subject").focus();
			return false;
			
		}
		
		 
		
		if($("#cboSEC1subject").val()==''){
			$("#msgcontent").html("Select SEC Subject 1.");
			$("#ValidationAlert").modal();
			return false;
			$("#cboSEC1subject").focus()
		}
		if($("#cboSEC2subject").val()==''){
			$("#msgcontent").html("Select SEC Subject 2.");
			$("#ValidationAlert").modal();
			return false;
			$("#cboSEC2subject").focus()
		}
		if($("#cboSEC3subject").val()==''){
			$("#msgcontent").html("Select SEC Subject 3.");
			$("#ValidationAlert").modal();
			return false;
			$("#cboSEC3subject").focus()
		} 
		
		if($("#cboLanguage").val()==''){
			$("#msgcontent").html("Select AEC Subject.");
			$("#ValidationAlert").modal();
			$("#cboAEC12subject").focus();
			return false;
			
		}
	}
 	
		return true;
	}

 

 
function updateGE() {
	 if(!validateGE())
	return false; 
	 
			var pars = $("#coursefrm").serialize();
			
		$.ajax({
					type:"POST",
					url:"updateGE.php",
					dataType:"json",
					data:pars,
					error:function(obj)
					{
						//alert(obj.status);
					},
					success:function(obj)
					{
						if(obj.status=1) {
							$("#msgcontent").html(obj.msg);
							$("#ValidationAlert").modal();
							$('#ValidationAlert').on('hidden.bs.modal', function () {
							 $("#frmnext").submit();
							})
							/* $("#btnupdtcourse").hide();
							$("#btnupdtnext").show(); */
						}
					}	
		});
	
}

function validateGESem(){
	 
	if($("#hdncourseCode").val()=='08' || $("#hdncourseCode").val()=='09' || $("#hdncourseCode").val()=='14' || $("#hdncourseCode").val()=='15' || $("#hdncourseCode").val()=='16'){
	 
	 
	  if($("#cboGESem1subject").val()==''){
		alert("Select Generic Elective Subject for Semester 1.");
		return false;
		$("#cboGESem1subject").focus()
		}
	if($("#cboGESem2subject").val()==''){
		alert("Select Generic Elective Subject for Semester 2.");
		return false;
		$("#cboGESem2subject").focus()
		}
	if($("#cboGESem3subject").val()==''){
		alert("Select Generic Elective Subject for Semester 3.");
		return false;
		$("#cboGESem3subject").focus()
		}
	if($("#cboGESem4subject").val()==''){
		alert("Select Generic Elective Subject for Semester 4.");
		return false;
		$("#cboGESem4subject").focus()
		} 
	if($("#cboGESem1subject").val()!='' && $("#cboGESem2subject").val()!=''  && $("#cboGESem3subject").val()!=''  && $("#cboGESem4subject").val()!=''){	
		var subarr = [$("#cboGESem1subject").val(), $("#cboGESem2subject").val(), $("#cboGESem3subject").val(),$("#cboGESem4subject").val()];
		for(var i=1; i<=4; i++){
			var itemsFound = $.grep(subarr, function (elem) {
								  return elem == $("#cboGESem"+i+"subject").val();
							   }).length;
							  
			if(itemsFound>2){
			alert("Same Generic Elective Subject can't choosen for more than 2 Semester.");
			return false;
			} 
		}
		
		/* var GEArr = [$("#cboGE1subject").val(),$("#cboGE2subject").val()];
		for(var j=1; j<=4; j++){
		if(jQuery.inArray( $("#cboGESem"+j+"subject").val(), GEArr)  == -1)  {
			alert("Generic Elective Subject for Semester "+j+" must present in Generic Elective.");
			return false;	
		}
		} */
		
	}	 		  
		 
 	}
 	
		return true;
	}

function updateSemCourse(){
 if(!validateGESem())
	return false; 	
	
	var pars = $("#coursefrm").serialize();
			
		$.ajax({
					type:"POST",
					url:"updateSemCourse.php",
					dataType:"json",
					data:pars,
					error:function(obj)
					{
						//alert(obj.status);
					},
					success:function(obj)
					{
						if(obj.status=1) {
							$("#msgcontent").html(obj.msg);
							$("#ValidationAlert").modal();
							$('#ValidationAlert').on('hidden.bs.modal', function () {
								 
							 $("#frmnext").submit();
							})
							/* $("#btnupdtcourse").hide();
							$("#btnupdtnext").show(); */
						}
					}	
		});
	
}

 