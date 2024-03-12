function fillstream(shift){
	 
 
var  str = "<option value='All'>All</option>";

$("#chostream").html(str);
$("#chosubject").html(str);
if(shift!='All') {
	$('#dvLoading').show();
$.ajax({
		 
		type: "post",
		url: "../getAllStream.php", 
		data: 'section='+shift+'&index0=All', 
		dataType: "text",
		success: function(data) {

			  //alert(JSON.stringify(data)) 
				 $("#chostream").html(data); 
			} ,
			 complete: function(){
				$('#dvLoading').hide();
			  } 
		});
}

}
	 

function fillsubject(stream){
 	
var  str = "<option value='All'>All</option>";
$("#chosubject").html(str)

 $('#dvLoading').show();
$.ajax({
	 
		type: "post",
		url: "../getSubjects.php", 
		data: 'section='+$("#chosection").val()+'&stream='+stream, 
		dataType: "text",
		
		success: function(data) {
			 	//alert(JSON.stringify(data))

				 $("#chosubject").html(data); 
			 
			},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});

}


function getRequestforverify()
	{
 		// var  verifyoption = $("input[name='optverifystatus']:checked").val();
		 var parm = $("#frm").serialize()
		  $("#detailrecord").html('')
		  
		  	var str = '<table class="table table-bordered table-hover text-nowrap text-center" border="1" bordercolor="#333">';
            	str +='<thead>';
				str +='<tr class="bg-light font-weight-bold" style="background:#e0e0e0; text-align:center">';
                str +='<td>#</td>';
                str +='<td>Cancellation Ref. No.</td>';
				str +='<td>Student Id.</td>';
				str +='<td>Form No.</td>';
                str +='<td>Name</td>';
                str +='<td>Phase</td>';
				str +='<td>Shift</td>';
				str +='<td>Honours</td>';
                str +='<td>Stream</td>';
				str +='<td>Combination</td>';
				str +='<td>Sem1 GE</td>';
                str +='<td>Admitted Category</td>';
                str +='<td>Admitted On</td>';
				str +='<td>Reason for Cancellation</td>';
                str +='<td>Application No of Other Course</td>';
                str +='<td>Applicant Remark</td>';
				str +='<td>Bank Name</td>';
				str +='<td>Bank Branch</td>';
				str +='<td>Account No.</td>';
				str +='<td>Account Type</td>';
				str +='<td>Bank IFSC Code</td>';
				str +='<td>Account Holder Name</td>';
                str +='<td>Cancellation Requested On</td>';
				str +='<td>Calcellation Status</td>';
				str +='<td>Calcellation Remarks</td>';
				str +='<td>Cancelled By</td>'; 
				str +='<td>Cancelled On</td>'; 
            	str +='</tr>';
				str +='</thead>';
		 
			$.ajax({                                      
				url: 'getcancelRequestforverify.php',                     
				data: parm,
				type:"post",
				dataType: 'json',
				success: function(data)         
				{
				
				//alert(data.length)
				if(data.length>0){
					for(var i=0; i<data.length; i++){
						str +='<tbody id="myTable">';
						str +='<tr>';
						str +='<td class="text-center">'+(i+1)+'</td>'; 
						var functname = "checkInfoforCancel('"+data[i]["cancellationRefNo"]+"')";
						str +='<td class="text-center"><a href="javascript:void(0)" onclick='+functname+'>'+data[i]["cancellationRefNo"] +'</a></td>';
						str +='<td class="text-center">'+data[i]["registrationNo"] +'</td>';
						str +='<td class="text-center">'+data[i]["applicationNo"] +'</td>';
						str +='<td class="text-left">'+data[i]["name"] +'</td>';
						str +='<td class="text-center">'+'Phase '+data[i]["phaseApplied"] +'</td>';
						str +='<td class="text-center">'+data[i]["appsection"] +'</td>';
						str +='<td class="text-center">'+data[i]["appsubject"] +'</td>';
						str +='<td class="text-center">'+data[i]["appstream"] +'</td>';
						str +='<td class="text-center">'+data[i]["combinationCode"]+'-'+data[i]["combination"]+'</td>';
						str +='<td class="text-center">'+data[i]["GEsem1"] +'</td>';
						str +='<td class="text-center">'+data[i]["admittedcateg"] +'</td>';
						str +='<td class="text-center">'+data[i]["admittedOn"] +'</td>';
						
						str +='<td class="text-left">'+data[i]["reasonForCancellation"] +'</td>';
						str +='<td class="text-center">'+data[i]["admittedappno"] +'</td>';
						str +='<td class="text-left">'+data[i]["remarks"] +'</td>';
						str +='<td class="text-left">'+data[i]["bankName"] +'</td>';
						str +='<td class="text-left">'+data[i]["bankBranch"] +'</td>';
						str +='<td class="text-left">'+data[i]["bankAccountNo"] +'</td>';
						str +='<td class="text-left">'+data[i]["bankAccountType"] +'</td>';
						str +='<td class="text-left">'+data[i]["bankIFSCCode"] +'</td>';
						str +='<td class="text-left">'+data[i]["accountHoldername"] +'</td>';
						
						
						str +='<td class="text-center">'+data[i]["requestedOn"] +'</td>';
						str +='<td class="text-center">'+data[i]["verifystatus"] +'</td>';
						str +='<td class="text-center">'+data[i]["cancellationRemarks"] +'</td>';
						str +='<td class="text-center">'+data[i]["verifyByuser"] +'</td>';
						str +='<td class="text-center">'+data[i]["cancellationAcceptedOn"] +'</td>';
						str +='</tr>';
						str +='</tbody>';
					} 
					}
					else
					{
						str +='<tr class="text-danger font-weight-bold" style="text-align:center"><td colspan="14">No Records</td></tr>';
					}
					
					 str +='</table>';
					// alert(str)
					  $("#recordCount").html(data.length)
					 $("#detailrecord").html(str)
 				}
				});
		
		
	}
	
	function checkInfoforCancel(refno){
	//$("#div_doc").html('')
	 
	 var str = "";
			$.ajax({                                      
				url: 'getInfoForCancel.php',                     
				data: "refno="+refno,
				type:"post",
				dataType: 'json',
				success: function(data)         
				{
 				//alert(data.record[0]["applicationNo"])
				if(data.record.length>0){
				$("#txtappno").val(data.record[0]["applicationNo"]);
				if($.trim(data.record[0]["photo"])!='')
				$("#photoimg").html('<img src="../../Upload_Images/Photograph/'+data.record[0]["photo"]+'" width="104" height="120" />');
				 if($.trim(data.record[0]["signature"])!='')	
				$("#signimg").html('<img src="../../Upload_Images/Signature/'+data.record[0]["signature"]+'" width="100" height="39" />');
				$("#spanname").html(data.record[0]["name"]);
				$("#spanCancelRefNo").html(data.record[0]["cancellationRefNo"]);
 				$("#spanapplno").html('<a href="javascript: void(0)" onclick="viewApplication()">'+data.record[0]["applicationNo"]+'</a>');
				$("#spansubject").html(data.record[0]["appsubject"]);
				$("#spancaste").html(data.record[0]["caste"]);
				$("#spandomicile").html(data.record[0]["stateofdomicile"]);
				$("#spanadmittedCategory").html(data.record[0]["admittedcateg"]);
				var admitstatus="";
				if(data.record[0]["alloted"]=='Y')
					  admitstatus='Admitted';
				if(data.record[0]["alloted"]=='N')
					  admitstatus='Cancelled';
				if(data.record[0]["alloted"]=='')
					  admitstatus='Pending';
				$("#spanPresentStatus").html(admitstatus);
				$("#spanPH").html(data.record[0]["PH"]);
				 
				
str ='<table class="table table-bordered">';
str +='<tr>';
str +='<td>';
str +='<span class="text-danger">Cancellation Type :</span> '+data.record[0]["reasonForCancellation"];
str +='</td>';
str +='</tr>';
str +='<tr>';
str +='<td>';
str +='<span class="text-danger">Name &amp; Form No. of other course :</span> '+data.record[0]["admittedappno"];
str +='</td>';
str +='</tr>';
str +='<tr>';
str +='<td>';
str +='<span class="text-danger">Applicant Remark :</span> '+data.record[0]["remarks"];
str +='</td>';
str +='</tr>';
str +='<tr>';
str +='<td>';
 
str +='<span class="text-danger">Remark on verify <i class="fa fa-arrow-circle-down"></i></span> <input class="form-control mt-2" type="text" id="txtcancellationRemarks" name="txtcancellationRemarks" maxlength="200" value="'+data.record[0]["cancellationRemarks"]+'" placeholder="Enter Remarks here...">';
str +='</td>';
str +='</tr>';
if(data.availrecord[0]["availrec"]==1) {
str +='<tr>';
str +='<td>';
str +='Request CANNOT be Accepted as Candidate Already Transferred and Admitted to Another Subject.';
str +='</td>';
str +='</tr>';
}
str +='<tr>';
var verifyfunctname = "verifyRequest('"+data.record[0]["applicationNo"]+"','"+refno+"','Y')"; 
var rejectfunctname = "verifyRequest('"+data.record[0]["applicationNo"]+"','"+refno+"','N')"; 
if($.trim(data.record[0]["cancellationStatus"])!='Y') {
	str +='<tr><td colspan="5" class="text-center">';
	if(data.availrecord[0]["availrec"]==0) {
str +='<a class="btn btn-success btn-sm" href="javascript: void(0)" onclick="'+verifyfunctname+'"><i class="fa fa-check-circle"></i> Accept</a>'; 
	}
str +='<a class="btn btn-danger btn-sm" href="javascript: void(0)" onclick="'+rejectfunctname+'"><i class="fa fa-times-circle"></i> Reject</a>';

 str +='</td></tr>';
}
str +='</table>';
				 
					}
  					 $("#div_doc").html(str); 
					$("#ReportDetail").modal();
 				}
				});
     
	}
	
	function verifyRequest(applno,cancelrefno,updtstatus){
			$.ajax({                                      
				url: 'verifyCancelRequest.php',                     
				data: "applno="+applno+'&cancelrefno='+cancelrefno+'&cancellationRemarks='+$("#txtcancellationRemarks").val()+'&updtstatus='+updtstatus+'&verifyBy='+$("#hdnuserid").val(),
				type:"post",
				dataType: 'json',
				success: function(data)         
				{
					//alert(data.msg)
					if(data.status==1){
					$('#ReportDetail').modal('hide')
					getRequestforverify();
					
					}
					else {
					return false;
					}
				}
				});
	}
	
	
	
	
function resetform(){
	$("#frm")[0].reset()
}



function getCancelSubtype(Canceltype){
var  str = "<option value='All'>All</option>";
$("#choCancelsubType").html(str)

 $('#dvLoading').show();
$.ajax({
	 
		type: "post",
		url: "../getCancelSubtype.php", 
		data: 'typeofcancel='+Canceltype , 
		dataType: "json",
		
		success: function(data) {
				for(var i=0; i<data.length; i++) {	
					str = str+"<option value='"+data[i]["id"]+"'>"+data[i]["cancellationType"]+"</option>";	
					} 	
				 $("#choCancelsubType").html(str); 
			},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});	
	
}

function getcancelRequest(){
	// var  verifyoption = $("input[name='optverifystatus']:checked").val();
		 var parm = $("#frm").serialize()
		  $("#detailrecord").html('')
		  
		  	var str = '<table class="table table-bordered table-hover text-nowrap text-center" border="1" bordercolor="#333">';
            	str +='<thead>';
				str +='<tr class="bg-light font-weight-bold" style="background:#e0e0e0; text-align:center">';
                str +='<td>#</td>';
                str +='<td>Cancellation Ref. No.</td>';
				str +='<td>Student Id.</td>';
				str +='<td>Form No.</td>';
                str +='<td>Name</td>';
                str +='<td>Phase</td>';
				str +='<td>Shift</td>';
				str +='<td>Honours</td>';
                str +='<td>Stream</td>';
				str +='<td>Combination</td>';
				str +='<td>Sem 1 GE</td>';
                str +='<td>Admitted Category</td>';
                str +='<td>Admitted On</td>';
				str +='<td>Cancellation Type</td>';
                str +='<td>Reason for Cancellation</td>';
				str +='<td>Active Status</td>';
                str +='<td>Application No of Other Course</td>';
                str +='<td>Applicant Remark</td>';
                str +='<td>Cancellation Requested On</td>';
				str +='<td>Calcellation Status</td>';
				str +='<td>Calcellation Remarks</td>';
				str +='<td>Cancelled By</td>'; 
				str +='<td>Cancelled On</td>'; 
            	str +='</tr>';
				str +='</thead>';
		 
			$.ajax({                                      
				url: 'getcancelRequestlist.php',                     
				data: parm,
				type:"post",
				dataType: 'json',
				success: function(data)         
				{
				
				//alert(data.length)
				if(data.length>0){
					for(var i=0; i<data.length; i++){
						str +='<tbody id="myTable">';
						str +='<tr>';
						str +='<td style="text-align:center">'+(i+1)+'</td>'; 
						str +='<td style="text-align:center">'+data[i]["cancellationRefNo"] +'</td>';
						 
						str +='<td style="text-align:center">'+data[i]["registrationNo"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["applicationNo"] +'</td>';
						str +='<td style="text-align:left">'+data[i]["name"] +'</td>';
						str +='<td style="text-align:center">'+'Phase '+data[i]["phaseApplied"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["appsection"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["appsubject"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["appstream"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["combinationCode"]+'-'+data[i]["combination"]+'</td>';
						str +='<td style="text-align:center">'+data[i]["GEsem1"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["admittedcateg"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["admittedOn"] +'</td>';
						if(data[i]["isSubjectTransfer"]==0)
						str +='<td style="text-align:center">Want TC</td>';
						else
						str +='<td style="text-align:center">Subject Transfer</td>';
						str +='<td style="text-align:left">'+data[i]["reasonForCancellation"] +'</td>';
						str +='<td style="text-align:left">'+(data[i]["activeStatus"]==1?'Active':'In-active') +'</td>';
						str +='<td style="text-align:center">'+data[i]["admittedappno"] +'</td>';
						str +='<td style="text-align:left">'+data[i]["remarks"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["requestedOn"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["verifystatus"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["cancellationRemarks"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["verifyByuser"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["cancellationAcceptedOn"] +'</td>';
						str +='</tr>';
						str +='</tbody>';
					} 
					}
					else
					{
						str +='<tr class="text-danger font-weight-bold" style="text-align:center"><td colspan="14">No Records</td></tr>';
					}
					
					 str +='</table>';
					// alert(str)
					  $("#recordCount").html(data.length)
					 $("#detailrecord").html(str)
 				}
				});
}


function getInfoforcancel(){
	
	if($.trim($("#txtapplicationNo").val())=="")
		{
			$("#msgcontent").html("Enter Form No.");
			$("#ValidationAlert").modal();
			$("#txtapplicationNo").focus()
			return false;
			 
		}
	 
	$('#dvLoading').show();
	$.ajax({
	 
		type: "post",
		url: "verifyforCancel.php", 
		data: 'applNo='+$("#txtapplicationNo").val() , 
		dataType: "json",
		
		success: function(data) {
			if(data.status==0){
				$("#msgcontent").html(data.msg);
				$("#ValidationAlert").modal();
			}
			else{
				$("#frm").submit();
			}
				 	
				 
			},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});	

}

function verifycancellationInput()
	{
		// alert(195) 
	 
		if($.trim($("#chocancelType").val())=="")
		{
			$("#msgcontent").html("Select Cancellation Type");
			$("#ValidationAlert").modal();
			$("#chocancelType").focus()
			return false;
			 
		}
		if($("#choAppltobeadmitted").val()==''){
		$("#msgcontent").html("Select Subject you want to get admission");
		$("#ValidationAlert").modal();
		return false;
		$("#choAppltobeadmitted").focus()
	}
		
		//if($.trim($("#txtCancelReason").val())=="")
		if($.trim($("#txtCancelRemark").val())=="")
		{
			$("#msgcontent").html("Enter Reason for Subject Change");
			$("#ValidationAlert").modal();
			$("#txtCancelReason").focus()
			return false;
			 
		}
		
		if($.trim($("#txtCancelDate").val())=="")
		{
			$("#msgcontent").html("Enter Cancellation Date");
			$("#ValidationAlert").modal();
			$("#txtCancelDate").focus()
			return false;
			 
		}
		
		if(!$("#gridCheck1").is(":checked")){
			$("#msgcontent").html("Please <i class='fa fa-check-square-o'></i> tick the declaration to proceed.");
			$("#ValidationAlert").modal();
			$("#txtCancelReason").focus()
			return false;
		}
		return true; 
	}

function Goforcancellation() {
if(!verifycancellationInput())
		return false;	
		
		 $('#dvLoading').show()	;
		var frmdata =  $("#frmcancel").serialize()
		$.ajax({                                      
			  url:'saveCancelForSubjectTransfer.php',                     
			   type:'post',
			   data: frmdata,
			   dataType: 'json',
			  success: function(data)
			  {
				  
			// alert(JSON.stringify(data))
					if(data.status==1)
					{
						 $("#hdncancelRefNo").val(data.cancellationRefNo);
						$("#frmcancel").submit();
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

function searchCancelRequest()
	{
 		// var  verifyoption = $("input[name='optverifystatus']:checked").val();
		 var parm = $("#frm").serialize()
		  $("#detailrecord").html('')
		  
		  	var str = '<table class="table table-bordered table-hover text-nowrap text-center" border="1" bordercolor="#333">';
            	str +='<thead>';
				str +='<tr class="bg-light font-weight-bold" style="background:#e0e0e0; text-align:center">';
                str +='<td>#</td>';
                str +='<td>Cancellation Ref. No.</td>';
				str +='<td>Form No.</td>';
                str +='<td>Name</td>';
                str +='<td>Phase</td>';
				str +='<td>Shift</td>';
				str +='<td>Honours</td>';
                str +='<td>Stream</td>';
				str +='<td>Combination</td>';
				str +='<td>Sem1 GE</td>';
                str +='<td>Admitted Category</td>';
                str +='<td>Admitted On</td>';
				str +='<td>Reason for Cancellation</td>';
                str +='<td>Application No of Other Course</td>';
                str +='<td>Applicant Remark</td>';
				str +='<td>Bank Name</td>';
				str +='<td>Bank Branch</td>';
				str +='<td>Account No.</td>';
				str +='<td>Account Type</td>';
				str +='<td>Bank IFSC Code</td>';
				str +='<td>Account Holder Name</td>';
                str +='<td>Cancellation Requested On</td>';
				str +='<td>Calcellation Status</td>';
				str +='<td>Calcellation Remarks</td>';
				str +='<td>Cancelled By</td>'; 
				str +='<td>Cancelled On</td>'; 
            	str +='</tr>';
				str +='</thead>';
		 
			$.ajax({                                      
				url: 'getcancelRequestforverify.php',                     
				data: parm,
				type:"post",
				dataType: 'json',
				success: function(data)         
				{
				
				//alert(data.length)
				if(data.length>0){
					for(var i=0; i<data.length; i++){
						str +='<tbody id="myTable">';
						str +='<tr>';
						str +='<td class="text-center">'+(i+1)+'</td>'; 
						 
						str +='<td class="text-center">'+data[i]["cancellationRefNo"] +'</td>';
						str +='<td class="text-center">'+data[i]["applicationNo"] +'</td>';
						str +='<td class="text-left">'+data[i]["name"] +'</td>';
						str +='<td class="text-center">'+'Phase '+data[i]["phaseApplied"] +'</td>';
						str +='<td class="text-center">'+data[i]["appsection"] +'</td>';
						str +='<td class="text-center">'+data[i]["appsubject"] +'</td>';
						str +='<td class="text-center">'+data[i]["appstream"] +'</td>';
						str +='<td class="text-center">'+data[i]["combinationCode"]+'-'+data[i]["combination"]+'</td>';
						str +='<td class="text-center">'+data[i]["GEsem1"] +'</td>';
						str +='<td class="text-center">'+data[i]["admittedcateg"] +'</td>';
						str +='<td class="text-center">'+data[i]["admittedOn"] +'</td>';
						
						str +='<td class="text-left">'+data[i]["reasonForCancellation"] +'</td>';
						str +='<td class="text-center">'+data[i]["admittedappno"] +'</td>';
						str +='<td class="text-left">'+data[i]["remarks"] +'</td>';
						str +='<td class="text-left">'+data[i]["bankName"] +'</td>';
						str +='<td class="text-left">'+data[i]["bankBranch"] +'</td>';
						str +='<td class="text-left">'+data[i]["bankAccountNo"] +'</td>';
						str +='<td class="text-left">'+data[i]["bankAccountType"] +'</td>';
						str +='<td class="text-left">'+data[i]["bankIFSCCode"] +'</td>';
						str +='<td class="text-left">'+data[i]["accountHoldername"] +'</td>';
						
						
						str +='<td class="text-center">'+data[i]["requestedOn"] +'</td>';
						str +='<td class="text-center">'+data[i]["verifystatus"] +'</td>';
						str +='<td class="text-center">'+data[i]["cancellationRemarks"] +'</td>';
						str +='<td class="text-center">'+data[i]["verifyByuser"] +'</td>';
						str +='<td class="text-center">'+data[i]["cancellationAcceptedOn"] +'</td>';
						str +='</tr>';
						str +='</tbody>';
					} 
					}
					else
					{
						str +='<tr class="text-danger font-weight-bold" style="text-align:center"><td colspan="14">No Records</td></tr>';
					}
					
					 str +='</table>';
					// alert(str)
					  $("#recordCount").html(data.length)
					 $("#detailrecord").html(str)
 				}
				});
		
		
	}