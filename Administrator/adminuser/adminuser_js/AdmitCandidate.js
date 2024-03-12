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
 

function getInfo(){
	
		 if($.trim($("#txtapplicationNo").val())=="")
		{
			  
			$("#msgcontent").html("Enter Form No.");
			$("#ValidationAlert").modal();
			$("#txtapplicationNo").focus();
			return false;
		}
	var applno = $("#txtapplicationNo").val();
	
	
		$.ajax({                                      
				url: 'getApplicantInfo.php',                     
				data: "applno="+applno,
				type:"post",
				dataType: 'json',
				success: function(data)         
				{
				// alert(JSON.stringify(data))
					if(data.length>0){
					var str = "<div class='row'><div class='col-md-8'><div class='row'><div class='col-md-2 text-center'><img src='../../Upload_Images/Photograph/"+data[0]["photo"]+"' width='104' style='border:1px solid #999; padding:1px; margin-bottom:7px'></div><div class='col-md-10'><table class='table table-bordered table-hover font-weight-normal'>";
					
					//str +="<tr><td colspan='2' width='14%' align='center' style='border:1px solid #CCC'><img src='<?php echo BASE_URL;?>/Upload_Images/Photograph/"+data[0]["photo"]+"'width='100' height='120' style='border:1px solid #999; padding:1px'></td></tr>";
					str +="<tr><td align='left'>Name</td><td width='2%'>:</td><td>"+data[0]["name"]+"</td></tr>";
					str +="<tr><td align='left'>Form No.</td><td>:</td><td><strong>"+data[0]["applicationNo"]+"</strong></td></tr>";
					if($.trim(data[0]["Paid"])=='')
					str +="<tr><td align='left'>Application Fee</td><td>:</td><td class='text-danger'>N/A</td></tr>";
					else
					str +="<tr><td align='left'>Application Fee</td><td>:</td><td>"+data[0]["Paid"]+"</td></tr>";
 					str +="<tr><td align='left'>Applied Section</td><td>:</td><td>"+data[0]["appsection"]+"</td></tr>";
 					str +="<tr><td align='left'>Applied Stream</td><td>:</td><td>"+data[0]["appstream"]+"</td></tr>";
					str +="<tr><td align='left'>Applied Subject</td><td>:</td><td>"+data[0]["appsubject"]+"</td></tr>";
					str +="<tr><td align='left'>Applied Category</td><td>:</td><td>"+data[0]["caste"]+" ("+data[0]["stateofdomicile"]+")</td></tr>";
					
					if($.trim(data[0]["PH"])=='Yes')
					str +="<tr><td align='left'>PwD</td><td>:</td><td>Yes</td></tr></table>";
					else
					str +="<tr><td align='left'>PwD</td><td>:</td><td>No</td></tr></table>";

					str +="<table class='table table-bordered table-hover font-weight-normal'><tr class='text-danger bg-light'><td align='center' colspan='3'>Admission Detail</td></tr>";
					if($.trim(data[0]["admittedCategory"])=='')					
					str +="<tr><td align='left'>Admitted Category</td><td width='2%'>:</td><td  style='color:#FF0000'><strong>N/A</strong></td></tr>";
					else
					str +="<tr><td align='left'>Admitted Category</td><td width='2%'>:</td><td><strong>"+data[0]["admittedCategory"]+"</strong></td></tr>";
					if($.trim(data[0]["AdmissionFeePaid"])=='')					
					str +="<tr><td align='left'>Admisison Fee</td><td width='2%'>:</td><td  style='color:#FF0000'><strong>N/A</strong></td></tr>";
					else
					str +="<tr><td align='left'>Admission Fee</td><td width='2%'>:</td><td><strong>"+data[0]["AdmissionFeePaid"]+"</strong></td></tr>";
					str +="<tr><td align='left'>Combination</td><td>:</td><td><strong>"+data[0]["combinationCode"]+" ("+data[0]["combination"]+")</strong></td></tr>";
					if(data[0]["appstream"]=='BA' || data[0]["appstream"]=='BSC' || data[0]["appstream"]=='BAM') {
					str +="<tr><td align='left'>GE Sem 1</td><td>:</td><td><strong>"+data[0]["GESem1"]+"</strong></td></tr>";
					str +="<tr><td align='left'>GE Sem 2</td><td>:</td><td>"+data[0]["GESem2"]+"</td></tr>";
					str +="<tr><td align='left'>GE Sem 3</td><td>:</td><td>"+data[0]["GESem3"]+"</td></tr>";
					str +="<tr><td align='left'>GE Sem 4</td><td>:</td><td>"+data[0]["GESem4"]+"</td></tr>";
					}
					str +="<tr><td align='left'>Fee Type</td><td>:</td><td>"+data[0]["feeType"]+"</td></tr>";
					str +="<tr><td align='left'>Fee Code</td><td>:</td><td>"+data[0]["feecode"]+"</td></tr>";
					str +="<tr><td align='left'>Fee</td><td>:</td><td>"+data[0]["feeAmount"]+"</td></tr>";
					str +="</table></div></div>";
					str +="</div>";
					
					str += "<div class='col-md-4'><table class='table table-bordered table-hover font-weight-normal'><tr class='text-danger bg-light'><td align='center' colspan='3'>Rank Detail</td></tr>";
					if($.trim(data[0]["GeneralRank"])=='')
					str +="<tr><td align='left' width='48%'>General Rank</td><td width='2%'>:</td><td  style='color:#FF0000'>N/A</td></tr>";
					else
					str +="<tr><td align='left' width='48%'>General Rank</td><td width='2%'>:</td><td>"+data[0]["GeneralRank"]+"</td></tr>";
					if($.trim(data[0]["SCRank"])=='')
					str +="<tr><td align='left'>SC Rank</td><td>:</td><td style='color:#FF0000'>N/A</td></tr>";
					else
					str +="<tr><td align='left'>SC Rank</td><td>:</td><td>"+data[0]["SCRank"]+"</td></tr>";
					if($.trim(data[0]["STRank"])=='')
					str +="<tr><td align='left'>ST Rank</td><td>:</td><td  style='color:#FF0000'>N/A</td></tr>";
					else
					str +="<tr><td align='left'>ST Rank</td><td>:</td><td>"+data[0]["STRank"]+"</td></tr>";
					if($.trim(data[0]["OBCARank"])=='')
					str +="<tr><td align='left'>OBC-A Rank</td><td>:</td><td  style='color:#FF0000'>N/A</td></tr>";
					else
					str +="<tr><td align='left'>OBC-A Rank</td><td>:</td><td>"+data[0]["OBCARank"]+"</td></tr>";
					if($.trim(data[0]["OBCBRank"])=='')
					str +="<tr><td align='left'>OBC-B Rank</td><td>:</td><td  style='color:#FF0000'>N/A</td></tr>";
					else
					str +="<tr><td align='left'>OBC-B Rank</td><td>:</td><td>"+data[0]["OBCBRank"]+"</td></tr>";
					
					
					if($.trim(data[0]["PHRank"])=='')
					str +="<tr><td align='left'>PH Rank</td><td>:</td><td  style='color:#FF0000'>N/A</td></tr>";
					else
					str +="<tr><td align='left'>PH Rank : </td><td>:</td><td>"+data[0]["PHRank"]+"</td></tr>";
					
					if($.trim(data[0]["PH_GENRank"])=='')
					str +="<tr><td align='left'>PH (General) Rank</td><td>:</td><td style='color:#FF0000'>N/A</td></tr>";
					else
					str +="<tr><td align='left'>PH (General) Rank</td><td>:</td><td>"+data[0]["PH_GENRank"]+"</td></tr>";
					
					if($.trim(data[0]["PH_SCRank"])=='')
					str +="<tr><td align='left'>PH (SC) Rank</td><td>:</td><td style='color:#FF0000'>N/A</td></tr>";
					else
					str +="<tr><td align='left'>PH (SC) Rank</td><td>:</td><td>"+data[0]["PH_SCRank"]+"</td></tr>";
					
					if($.trim(data[0]["PH_STRank"])=='')
					str +="<tr><td align='left'>PH (ST) Rank</td><td>:</td><td style='color:#FF0000'>N/A</td></tr>";
					else
					str +="<tr><td align='left'>PH (ST) Rank</td><td>:</td><td>"+data[0]["PH_STRank"]+"</td></tr>";
					
					if($.trim(data[0]["PH_OBCARank"])=='')
					str +="<tr><td align='left'>PH (OBC-A) Rank</td><td>:</td><td style='color:#FF0000'>N/A</td></tr>";
					else
					str +="<tr><td align='left'>PH (OBC-A) Rank</td><td>:</td><td>"+data[0]["PH_OBCARank"]+"</td></tr>";
					
					if($.trim(data[0]["PH_OBCBRank"])=='')
					str +="<tr><td align='left'>PH (OBC-B) Rank</td><td>:</td><td style='color:#FF0000'>N/A</td></tr>";
					else
					str +="<tr><td align='left'>PH (OBC-B) Rank</td><td>:</td><td>"+data[0]["PH_OBCBRank"]+"</td></tr>";
					 
					str +="</table></div>";
					$("#div_applicantInfo").html(str)
					$("#hdnregNo").val(data[0]["registrationNo"]);
					$("#txtapplicationNo").attr('readonly',true);
					$("#span_btnnext").hide() 
					$("#div_action").show() 
					}
					else {
						$("#msgcontent").html("Record not found");
						$("#ValidationAlert").modal();
					 
					} 
					
				}
				});  
 	}
	
	
	  function CancelAssign(){
	 location.reload();
	}
	
	
	function AssignElective()
	{
		  
		if($.trim($("#txtadmitDate").val())=="")
		{
			$("#msgcontent").html("Enter date of Admission");
			$("#ValidationAlert").modal();
			$("#txtCancelDate").focus()
			return false;
			 
		}  
		
		//alert(selvalue);
			var applno = $("#txtapplicationNo").val()
 			$.ajax({                                      
				url: 'UpdateMLPayment.php',                     
				data: "applno="+applno+'&registrationno='+$("#hdnregNo").val()+'&admittedon='+$("#txtadmitDate").val(),
				//data: "applno="+applno+'&registrationno='+$("#hdnregNo").val(),
				//+'&admittedon='+$("#txtadmitDate").val(),
				type:"post",
				dataType: 'json',
				success: function(data)         
				{
					
				if(data.status==1){
					$("#msgcontent").html(data.msg);
						$("#ValidationAlert").modal();
					$("#div_applicantInfo").html('')
					$("#txtapplicationNo").attr('readonly',false);
					$("#txtapplicationNo").val('')
					$("#span_btnnext").show() 
					$("#div_action").hide() 
				}
				else {
					$("#msgcontent").html(data.msg);
						$("#ValidationAlert").modal();
				}
					//cbo.innerHTML=data
				}
				});
 	}
	
	function fillElectSubject(applicationno){

var  str = "<option value=''>Select</option>";
$("#choelective").html(str);
 $('#dvLoading').show();
$.ajax({
		type: "post",
		url: "../getGESubjects.php", 
		data: 'applicationno='+applicationno, 
		dataType: "json",
		
		success: function(data) {
				//alert(JSON.stringify(data))
				for(var i=0; i<data["Availelectkey"].length; i++) {
					// alert(data["Availelectkey"][i][0])
					str +="<option value='"+data["Availelectkey"][i]+"' >"+data["Availelectsub"][i]+"</option>";
				}
				
				
				
				if(data["Allelectkey"].length>0) {
				for(var j=0; j<data["Allelectkey"].length; j++) {
					str +="<option value='"+data["Allelectkey"][j]+"' disabled  style='color:red'>"+data["Allelectsub"][j]+"</option>";
					}
				}
				 $("#choelective").html(str);
				
				//$("#choelective").val(setelective);
				 
				
			},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});

}


function saveElectiveInfo(){
		if($("#cho_admittedcateg").val()==''){
			$("#msgcontent").html("Select Category for admission");
			$("#ValidationAlert").modal(); 
			return false;
			$("#cho_admittedcateg").focus()
		}
		if($("#hdnstream").val()=='BAGEN'){
			if($("#choLCC2").val()==''){
			$("#msgcontent").html("Select LCC 2.");
			$("#ValidationAlert").modal(); 
			return false;
			$("#choLCC2").focus()
		}
		}			

		if($("#choelective").val()==''){
			$("#msgcontent").html("Select Subject Combination for Course");
			$("#ValidationAlert").modal(); 
			return false;
			$("#cboelecsub").focus()
		}
		 

		if($("#choelective").val()==''){
		$("#msgcontent").html("Select Subject Combination for Course");
		$("#ValidationAlert").modal();
		return false;
		$("#choelective").focus()
		}
		 
	 var  form = $('#frm'); 
	 $('#dvLoading').show();
					 $.ajax({
				type: "post",
				async: false,
				url: "saveElectiveInfo.php", 
				data: form.serialize(), 
				dataType: "json",
				//dataType: "text",
				
				
				success: function(data) {
 				
						if(data.status==1)
						{
							$("#frmthankyou").attr('action',data.actionurl);
 							$("#frmthankyou").submit();
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

function fillElectSubjectByLCC(LCCsubj){
	//alert(LCCsubj);
var  str = "<option value=''>Select</option>";
$("#choelective").html(str);
 $('#dvLoading').show();
$.ajax({
		type: "post",
		url: "../getGESubjectsWOLCC.php", 
		data: 'applicationno='+$("#hdnapplicationno").val()+'&LCC='+LCCsubj, 
		dataType: "json",
		
		success: function(data) {
				//alert(JSON.stringify(data))
 
				 for(var i=0; i<data["Availelectkey"].length; i++) {
					// alert(data["Availelectkey"][i][0])
					str +="<option value='"+data["Availelectkey"][i]+"' >"+data["Availelectsub"][i]+"</option>";
				}
				if(data["Allelectkey"].length>0) {
				for(var j=0; j<data["Allelectkey"].length; j++) {
					str +="<option value='"+data["Allelectkey"][j]+"' disabled  style='color:red'>"+data["Allelectsub"][j]+"</option>";
					}
				}
				
				//alert(str)
				$("#choelective").html(str);
				//$("#choelective").val(setElectSubject);
			
			},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});	
}
	
	
function validateInput(){
	 if($("#hdnstream").val()=='BA' || $("#hdnstream").val()=='BSC' || $("#hdnstream").val()=='BAM'){
	if($("#cbosubSem1").val()==''){
		$("#msgcontent").html("Select Generic Elective Subject for Semester 1.");
		$("#ValidationAlert").modal();
		return false;
		$("#cbosubSem1").focus()
		}
	if($("#cbosubSem2").val()==''){
		$("#msgcontent").html("Select Generic Elective Subject for Semester 2.");
		$("#ValidationAlert").modal();
		return false;
		$("#cbosubSem2").focus()
		}
	if($("#cbosubSem3").val()==''){
		$("#msgcontent").html("Select Generic Elective Subject for Semester 3.");
		$("#ValidationAlert").modal();
		return false;
		$("#cbosubSem3").focus()
		}
	if($("#cbosubSem4").val()==''){
		$("#msgcontent").html("Select Generic Elective Subject for Semester 4.");
		$("#ValidationAlert").modal();
		return false;
		$("#cbosubSem4").focus()
		}
	if($("#cbosubSem1").val()!='' && $("#cbosubSem2").val()!=''  && $("#cbosubSem3").val()!=''  && $("#cbosubSem4").val()!=''){	
		var subarr = [$("#cbosubSem1").val(), $("#cbosubSem2").val(), $("#cbosubSem3").val(),$("#cbosubSem4").val()];
		for(var i=1; i<=4; i++){
			var itemsFound = $.grep(subarr, function (elem) {
								  return elem == $("#cbosubSem"+i).val();
							   }).length;
							  
			if(itemsFound>2){
			$("#msgcontent").html("Same Generic Elective Subject can't choosen for more than 2 Semester.");
			$("#ValidationAlert").modal();
			return false;
			} 
		}
	}				  
	 }	 
 	 if($("#hdnstream").val()=='BAGEN'){
			if($("#cboCC0").val()==''){
				$("#msgcontent").html("Select Generic Elective (GE).");
				$("#ValidationAlert").modal();
				return false;
				$("#cboCC0").focus()
			}
			if($("#cboCC1").val()==''){
				$("#msgcontent").html("Select Core Course 1.");
				$("#ValidationAlert").modal();
				return false;
				$("#cboCC1").focus()
			}
			if($("#cboCC2").val()==''){
				$("#msgcontent").html("Select Core Course 2.");
				$("#ValidationAlert").modal();
				return false;
				$("#cboCC2").focus()
			}
				if($("#cboCC0").val()!='' && $("#cboCC1").val()!=''  && $("#cboCC2").val()!='' ){	
				var subarr = [$("#cboCC0").val(), $("#cboCC1").val(), $("#cboCC2").val()];
					for(var i=0; i<=2; i++){
						var itemsFound = $.grep(subarr, function (elem) {
											  return elem == $("#cboCC"+i).val();
										   }).length;
										  
						if(itemsFound>1){
						$("#msgcontent").html("Same Subject can't choosen more than once.");
						$("#ValidationAlert").modal();
						return false;
						} 
					}
				}
		}
	 
	
		return true;
	}
	
	function saveGeneralInfo(){
	if(!validateInput()){
			return false;
		} 	 
		 $('#dvLoading').show(); 
	 var  form = $('#frm'); 
 					 $.ajax({
				type: "post",
				async: false,
				url: "saveGESemInfo.php", 
				data: form.serialize(), 
				dataType: "json",
				//dataType: "text",
				
				
				success: function(data) {
						if(data.status==1)
						{
						//alert(data.msg);
							$("#frmthankyou").attr('action',data.actionurl)
							$("#frmthankyou").submit();
						}
						else
						{
						$("#msgcontent").html(data.msg);
						$("#ValidationAlert").modal();
						//return false;
						$('#dvLoading').hide();
						}
					
					},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				});
			} 
			
			
function saveGeneralInfo_fix(){
	if(!validateInput()){
			return false;
		} 	 
		 $('#dvLoading').show(); 
	 var  form = $('#frm'); 
 					 $.ajax({
				type: "post",
				async: false,
				url: "saveGESemInfo_fix.php", 
				data: form.serialize(), 
				dataType: "json",
				//dataType: "text",
				
				
				success: function(data) {
						if(data.status==1)
						{
						//alert(data.msg);
							$("#frmthankyou").attr('action',data.actionurl)
							$("#frmthankyou").submit();
						}
						else
						{
						$("#msgcontent").html(data.msg);
						$("#ValidationAlert").modal();
						//return false;
						$('#dvLoading').hide();
						}
					
					},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				});
			} 

function GotoChangeGE(){
$("#frmthankyou").attr('action','assignElective.php');
$("#frmthankyou").submit();
}  	
	
	
	
	 