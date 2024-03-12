 function displayOnChristianity(religion){
	   $("#choChristianityfrom").val('All');
		if(religion=='Yes'){	
		$("#ChristianityOption").show() ;	
		}
		else {
		$("#ChristianityOption").hide() ;
		}		
		 
}


function fillstream(shift){
	 
 $('#dvLoading').show();
var  str = "<option value='All'>All</option>";

$("#chostream").html(str);
$("#chosubject").html(str);
if(shift!='All') {
$.ajax({
		 
		type: "post",
		url: "../getAllStream.php", 
		data: 'section='+shift, 
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


function getstudentlistforverify()
	{
 		// var  verifyoption = $("input[name='optverifystatus']:checked").val();
		
		 $("#recordCount").show();
			$("#recordset").hide();
			$("#exportexcel").hide();
			$('#dvLoading').show();
		  $("#recordset").html('');
		   var parm = $("#frm").serialize();
		  var str= "<table class='table table-bordered table-hover'>";
		  str= str+"<thead>"
            	str= str+"<tr class='bg-light text-nowrap'>"
                str +='<td>Sr. No.</td>';
				str +='<td>Student Id</td>';
                str +='<td>Form No.</td>';
                str +='<td>Name</td>';
				str +='<td>Phase</td>';
				str +='<td>Shift</td>';
                str +='<td>Honours</td>';
                str +='<td>Stream</td>';
                str +='<td>Remark</td>';
				str +='<td>Verify Status</td>';
                str +='<td>Verify On</td>';
				str +='<td>Verify By</td>'; 
            	str +='</tr>';
				str= str+"</thead>"
		 
			$.ajax({                                      
				url: 'getstudentlistforverify.php',                     
				data: parm,
				type:"post",
				dataType: 'json',
				success: function(data)         
				{
				
				//alert(JSON.stringify(data))
				if(data.length>0){
					for(var i=0; i<data.length; i++){
					str= str+"<tbody id='myTable'>";
					str= str+"<tr class='text-nowrap'>";
                    str +='<td>'+(i+1)+'</td>';
					 str +='<td>'+data[i]["registrationNo"] +'</td>';
					var functname = "checkDoc('"+data[i]["applicationNo"]+"')";
                     str +='<td><a href="javascript:void(0)" onclick='+functname+'>'+data[i]["applicationNo"] +'</a></td>';
                     str +='<td align="left">'+data[i]["name"] +'</td>';
					 str +='<td>'+data[i]["phaseApplied"] +'</td>';
					 str +='<td>'+data[i]["appsection"] +'</td>';
					 str +='<td>'+data[i]["appsubject"] +'</td>';
                     str +='<td>'+data[i]["appstream"] +'</td>';
                     str +='<td>'+data[i]["remark"] +'</td>';
					  str +='<td>'+data[i]["verifystatus"] +'</td>';
                      str +='<td>'+data[i]["verifyedon"] +'</td>';
                      str +='<td>'+data[i]["verifyByuser"] +'</td>';
                	str= str+"</tr>";
					str= str+"</tbody>";
					} 
					}
					else
					{
					 str +='<tr><td colspan="6">No Records</td></tr>';
					}
					
					 str +='</table>';
					  $("#recordCount").html(data.length)
					 $("#recordset").html(str)
 				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				});
		
		
	}

function checkDoc(applno){
	//$("#div_doc").html('')
	//alert(applno)
	 var str = "";
			$.ajax({                                      
				url: 'getallDoc.php',                     
				data: "applno="+applno,
				type:"post",
				dataType: 'json',
				success: function(data)         
				{
 				//alert(JSON.stringify(data))
				if(data.length>0){
				$("#txtappno").val(data[0]["applicationNo"]);
				if($.trim(data[0]["photo"])!='')
				$("#photoimg").html('<img src="../../Upload_Images/Photograph/'+data[0]["photo"]+'" width="104" height="120" />');
				 if($.trim(data[0]["signature"])!='')	
				$("#signimg").html('<img src="../../Upload_Images/Signature/'+data[0]["signature"]+'" width="100" height="39" />');
				$("#spanname").html(data[0]["name"]);
 				$("#spanapplno").html('<a href="javascript: void(0)" onclick="viewApplication()">'+data[0]["applicationNo"]+'</a>');
				$("#spansubject").html(data[0]["appsubject"]);
				$("#spancaste").html(data[0]["caste"]);
				$("#spandomicile").html(data[0]["stateofdomicile"]);
				$("#spanPH").html(data[0]["PH"]);
				$("#spanReligion").html(data[0]["religion"]);
				 
				
str ='<table class="table table-bordered table-hover">';
str +='<tr>';
str +='<td width="20%">';
str +='<a href="../../Upload_Images/Marksheet/'+data[0]["marksheet"]+'" target="_blank">';
str +='<img src="../../Upload_Images/Marksheet/'+data[0]["marksheet"]+'" width="100%" height="140" style="border:1px solid #ccc; padding:1px" title="Click to enlarge" />';
str +='</a>';
str +='</td>';
if(data[0]["APLBPL"]=='YES'){
str +='<td width="20%">';
str +='<a href="../../Upload_Images/BPLcertificate/'+data[0]["BPLcertificate"]+'" target="_blank">';
str +='<img src="../../Upload_Images/BPLcertificate/'+data[0]["BPLcertificate"]+'" width="100%" height="140" style="border:1px solid #ccc; padding:1px" title="Click to enlarge" />';
str +='</a>';
str +='</td>';
}
/*str +='<td width="20%">';
str +='<a href="../Upload_Images/Admitcard_HS/'+data[0]["admitcardHS"]+'" target="_blank">';
str +='<img src="../Upload_Images/Admitcard_HS/'+data[0]["admitcardHS"]+'" width="100%" height="140" style="border:1px solid #ccc; padding:1px" title="Click to enlarge" />';
str +='</a>';
str +='</td>';*/
str +='<td width="20%">';
str +='<a href="../../Upload_Images/Admitcard_Secondary/'+data[0]["admitcardSec"]+'" target="_blank">';
str +='<img src="../../Upload_Images/Admitcard_Secondary/'+data[0]["admitcardSec"]+'" width="100%" height="140" style="border:1px solid #ccc; padding:1px" title="Click to enlarge" />';
str +='</a>';
str +='</td>';
if(data[0]["caste"]!='GENERAL' && data[0]["stateofdomicile"]=='WEST BENGAL'){
str +='<td width="20%">';
str +='<a href="../../Upload_Images/Castecertificate/'+data[0]["castecertificate"]+'" target="_blank">';
str +='<img src="../../Upload_Images/Castecertificate/'+data[0]["castecertificate"]+'" width="100%" height="140" style="border:1px solid #ccc; padding:1px" title="Click to enlarge" />';
str +='</a>';
str +='</td>';
} 
if(data[0]["PH"]=='Yes'){ 
str +='<td width="20%">';
str +='<a href="../../Upload_Images/PHcertificate/'+data[0]["phcertificate"]+'" target="_blank">';
str +='<img src="../../Upload_Images/PHcertificate/'+data[0]["phcertificate"]+'" width="100%" height="140" style="border:1px solid #ccc; padding:1px" title="Click to enlarge" />';
str +='</a>';
str +='</td>';
} 
if(data[0]["CH"]=='Yes'){ 
str +='<td width="20%">';
str +='<a href="../../Upload_Images/DedicationCertificate/'+data[0]["DedicationCertificate"]+'" target="_blank">';
str +='<img src="../../Upload_Images/DedicationCertificate/'+data[0]["DedicationCertificate"]+'" width="100%" height="140" style="border:1px solid #ccc; padding:1px" title="Click to enlarge" />';
str +='</a>';
str +='</td>';

str +='<td width="20%">';
str +='<a href="../../Upload_Images/MembershipCertificate/'+data[0]["MembershipCertificate"]+'" target="_blank">';
str +='<img src="../../Upload_Images/MembershipCertificate/'+data[0]["MembershipCertificate"]+'" width="100%" height="140" style="border:1px solid #ccc; padding:1px" title="Click to enlarge" />';
str +='</a>';
str +='</td>';
} 

str +='</tr>';
str +='<tr>';
str +='<td>Class 12 Marksheet</td>';
if(data[0]["APLBPL"]=='YES' ){ 
str +='<td>BPL Certificate</td>';
}
//str +='<td>Class 12 Admit Card</td>';
str +='<td>Age Proof Document</td>';
if(data[0]["caste"]!='GENERAL' && data[0]["stateofdomicile"]=='WEST BENGAL'){ 
str +='<td>Caste Certificate</td>';
} 
if(data[0]["PH"]=='Yes'){ 
str +='<td>PH Certificate</td>';
}
if(data[0]["CH"]=='Yes'){ 
str +='<td>Baptism / Dedication Certificate</td>';
str +='<td>Letter from Parish Priest / Proof of Church Membership</td>';
}
str +='</tr>';
str +='<tr><td colspan="5"><div class="form-group row"><label class="col-sm-1 col-form-label">Remark:</label> <div class="col-sm-11"><input class="form-control select" type="text" id="txtremark" name="txtremark" maxlength="250" value="'+$.trim(data[0]["remark"])+'" /></div></div></td></tr>';
var verifyfunctname = "verifystudent('"+applno+"','Y')"; 
var rejectfunctname = "verifystudent('"+applno+"','N')"; 
str +='<tr><td colspan="5"><a class="btn btn-success btn-sm" href="javascript: void(0)" onclick="'+verifyfunctname+'">&#10004; Verify</a> <a class="btn btn-danger btn-sm" href="javascript: void(0)" onclick="'+rejectfunctname+'">&#10006; Reject</a> </td></tr>';
str +='</table>';
				 
					}
  					 $("#div_doc").html(str)
 				}
				});
		
  		   $('.hover_bkgr_fricc').show();
 		/*$('.hover_bkgr_fricc').click(function(){
			$('.hover_bkgr_fricc').hide();
		});*/
		$('.popupCloseButton').click(function(){
			$('.hover_bkgr_fricc').hide();
		});
	} 
 

function verifystudent(applno,updtstatus){
			$.ajax({                                      
				url: 'verifystudent.php',                     
				data: "applno="+applno+'&updtstatus='+updtstatus+'&remark='+$("#txtremark").val()+'&verifyBy='+$("#hdnuserid").val(),
				type:"post",
				dataType: 'json',
				success: function(data)         
				{
					//alert(data.msg)
					$("#msgcontent").html(data.msg);
					$("#ValidationAlert").modal();
					if(data.status==1){
					$('.hover_bkgr_fricc').hide();
					getstudentlistforverify();
					
					}
					else {
					return false;
					}
				}
				});
	}




function getrecieptforverify()
	{
 		// var  verifyoption = $("input[name='optverifystatus']:checked").val();
		
		 $("#recordCount").show();
			$("#recordset").hide();
			$("#exportexcel").hide();
			$('#dvLoading').show();
		  $("#recordset").html('');
		   var parm = $("#frm").serialize();
		  var str= "<table class='table table-bordered table-hover'>";
		  str= str+"<thead>"
            	str= str+"<tr class='bg-light text-nowrap'>"
                str +='<td>Sr. No.</td>';
				str +='<td>Student Id</td>';
                str +='<td>Form No.</td>';
                str +='<td>Name</td>';
				str +='<td>Phase</td>';
				str +='<td>Shift</td>';
                str +='<td>Honours</td>';
                str +='<td>Stream</td>';
                str +='<td>Remark</td>';
				str +='<td>Verify Status</td>';
                str +='<td>Verify On</td>';
				str +='<td>Verify By</td>'; 
            	str +='</tr>';
				str= str+"</thead>"
		 
			$.ajax({                                      
				url: 'getrecieptforverify.php',                     
				data: parm,
				type:"post",
				dataType: 'json',
				success: function(data)         
				{
				
				//alert(JSON.stringify(data))
				if(data.length>0){
					for(var i=0; i<data.length; i++){
					str= str+"<tbody id='myTable'>";
					str= str+"<tr class='text-nowrap'>";
                    str +='<td>'+(i+1)+'</td>';
					 str +='<td>'+data[i]["registrationNo"] +'</td>';
					var functname = "checkReciept('"+data[i]["applicationNo"]+"')";
                     str +='<td><a href="javascript:void(0)" onclick='+functname+'>'+data[i]["applicationNo"] +'</a></td>';
                     str +='<td align="left">'+data[i]["name"] +'</td>';
					 str +='<td>'+data[i]["phaseApplied"] +'</td>';
					 str +='<td>'+data[i]["appsection"] +'</td>';
					 str +='<td>'+data[i]["appsubject"] +'</td>';
                     str +='<td>'+data[i]["appstream"] +'</td>';
                     str +='<td>'+data[i]["remark"] +'</td>';
					  str +='<td>'+data[i]["verifystatus"] +'</td>';
                      str +='<td>'+data[i]["verifyedon"] +'</td>';
                      str +='<td>'+data[i]["verifyByuser"] +'</td>';
                	str= str+"</tr>";
					str= str+"</tbody>";
					} 
					}
					else
					{
					 str +='<tr><td colspan="6">No Records</td></tr>';
					}
					
					 str +='</table>';
					  $("#recordCount").html(data.length)
					 $("#recordset").html(str)
 				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				});
		
		
	}
 

	function checkReciept(applno){
	//$("#div_doc").html('')
	//alert(applno)
	 var str = "";
			$.ajax({                                      
				url: 'getReciept.php',                     
				data: "applno="+applno,
				type:"post",
				dataType: 'json',
				success: function(data)         
				{
 				//alert(JSON.stringify(data))
				if(data.length>0){
				$("#txtappno").val(data[0]["applicationNo"]);
				if($.trim(data[0]["photo"])!='')
				$("#photoimg").html('<img src="../../Upload_Images/Photograph/'+data[0]["photo"]+'" width="104" height="120" />');
				 if($.trim(data[0]["signature"])!='')	
				$("#signimg").html('<img src="../../Upload_Images/Signature/'+data[0]["signature"]+'" width="100" height="39" />');
				$("#spanname").html(data[0]["name"]);
 				$("#spanapplno").html('<a href="javascript: void(0)" onclick="viewApplication()">'+data[0]["applicationNo"]+'</a>');
				$("#spansubject").html(data[0]["appsubject"]);
				$("#spancaste").html(data[0]["caste"]);
				$("#spandomicile").html(data[0]["stateofdomicile"]);
				$("#spanadmittedCategory").html(data[0]["admittedcateg"]);
				if(data[0]["PH"]==1)
				$("#spanPH").html('Yes');
				else
				$("#spanPH").html('No');
				
		str ='<table class="" width="100%" border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="7" align="center" style="text-align: center; font-size:14px; border-collapse:collapse; font-weight:normal">';
		str +='<tr>';
		str +='<td width="20%">';
		str +='<a href="../../Upload_Images/AdmissionReciept/'+data[0]["AdmissionReciept"]+'" target="_blank">';
		str +='<img src="../../Upload_Images/AdmissionReciept/'+data[0]["AdmissionReciept"]+'" width="30%" height="140" style="border:1px solid #ccc; padding:1px" title="Click to enlarge" />';
		str +='</a>';
		str +='</td>';
		 str +='</tr>';
		str +='<tr>';
		str +='<td>Admission Reciept</td>';
		 str +='</tr>';
		str +='<tr><td colspan="5"><div class="form-group row"><label class="col-sm-1 col-form-label">Remark:</label> <div class="col-sm-11"><input class="form-control select" type="text" id="txtremark" name="txtremark" maxlength="250" value="'+$.trim(data[0]["remark"])+'" /></div></div></td></tr>';
		var verifyfunctname = "verifystudentReciept('"+applno+"','Y')"; 
		var rejectfunctname = "verifystudentReciept('"+applno+"','N')"; 
		if(data[0]["verifystatus"]!='Y'){
		str +='<tr><td colspan="5"><a class="btn btn-success btn-sm" href="javascript: void(0)" onclick="'+verifyfunctname+'">&#10004; Verify</a> <a class="btn btn-danger btn-sm" href="javascript: void(0)" onclick="'+rejectfunctname+'">&#10006; Reject</a> </td></tr>';
		}
		str +='</table>';
				 
					}
  					 $("#div_doc").html(str)
 				}
				});
		
  		   $('.hover_bkgr_fricc').show();
 		/*$('.hover_bkgr_fricc').click(function(){
			$('.hover_bkgr_fricc').hide();
		});*/
		$('.popupCloseButton').click(function(){
			$('.hover_bkgr_fricc').hide();
		});
	} 
	
	function verifystudentReciept(applno,updtstatus){
			$.ajax({                                      
				url: 'verifystudentReciept.php',                     
				data: "applno="+applno+'&updtstatus='+updtstatus+'&remark='+$("#txtremark").val()+'&verifyBy='+$("#hdnuserid").val(),
				type:"post",
				dataType: 'json',
				success: function(data)         
				{
					//alert(data.msg)
					$("#msgcontent").html(data.msg);
					$("#ValidationAlert").modal();
					if(data.status==1){
					$('.hover_bkgr_fricc').hide();
					getstudentlistforverify();
					
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
 
function getadmittedstudentforverify(){
	// var  verifyoption = $("input[name='optverifystatus']:checked").val();
		
		 $("#recordCount").show();
		 $("#recordset").hide();
		 $("#exportexcel").hide();
		 $('#dvLoading').show();
		  $("#recordset").html('');
		   var parm = $("#frm").serialize();
		  var str= "<table class='table table-bordered table-hover'>";
		  str= str+"<thead>"
            	str= str+"<tr class='bg-light text-nowrap'>"
                str +='<td>Sr. No.</td>';
				str +='<td>Student Id</td>';
                str +='<td>Form No.</td>';
                str +='<td>Name</td>';
				str +='<td>Phase</td>';
				str +='<td>Shift</td>';
                str +='<td>Honours</td>';
                str +='<td>Stream</td>';
				str +='<td>Dept Remark</td>';
				str +='<td>Dept Verify Status</td>';
                str +='<td>Dept Verify On</td>';
				str +='<td>Dept Verify By</td>';
                str +='<td>Admin Remark</td>';
				str +='<td>Admin Verify Status</td>';
                str +='<td>Admin Verify On</td>';
				str +='<td>Admin Verify By</td>'; 
            	str +='</tr>';
				str= str+"</thead>"
		 
			$.ajax({                                      
				url: 'getAdmittedstudentforverify.php',                     
				data: parm,
				type:"post",
				dataType: 'json',
				success: function(data)         
				{
				
				//alert(JSON.stringify(data))
				if(data.length>0){
					for(var i=0; i<data.length; i++){
					str= str+"<tbody id='myTable'>";
					str= str+"<tr class='text-nowrap'>";
                    str +='<td>'+(i+1)+'</td>';
					 str +='<td>'+data[i]["registrationNo"] +'</td>';
					var functname = "checkDocforAdmission('"+data[i]["applicationNo"]+"')";
                     str +='<td><a href="javascript:void(0)" onclick='+functname+'>'+data[i]["applicationNo"] +'</a></td>';
                     str +='<td align="left">'+data[i]["name"] +'</td>';
					 str +='<td>'+data[i]["phaseApplied"] +'</td>';
					 str +='<td>'+data[i]["appsection"] +'</td>';
					 str +='<td>'+data[i]["appsubject"] +'</td>';
                     str +='<td>'+data[i]["appstream"] +'</td>';
					 str +='<td>'+data[i]["deptremark"] +'</td>';
					  if(data[i]["deptverifystatus"]=='Y')
					  var deptstatus="Approved";
					else if(data[i]["deptverifystatus"]=='N')
					  var deptstatus="Rejected";
					 else  deptstatus="";
					 str +='<td>'+deptstatus+'</td>';
                      str +='<td>'+data[i]["Dept_verifyedon"] +'</td>';
                      str +='<td>'+data[i]["deptuser"] +'</td>';
					  str +='<td>'+data[i]["Admin_remark"] +'</td>';
					  if(data[i]["Admin_verifystatus"]=='Y')
					  var adminstatus="Approved";
					else if(data[i]["Admin_verifystatus"]=='N')
					  var adminstatus="Rejected";
					 else  adminstatus="";
					  str +='<td>'+adminstatus +'</td>';
                      str +='<td>'+data[i]["Admin_verifyedon"] +'</td>';
                      str +='<td>'+data[i]["adminuser"] +'</td>';
                	str= str+"</tr>";
					str= str+"</tbody>";
					} 
					}
					else
					{
					 str +='<tr><td colspan="6">No Records</td></tr>';
					}
					
					 str +='</table>';
					  $("#recordCount").html(data.length)
					 $("#recordset").html(str)
 				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				});	
		
	}
	
	
	function checkDocforAdmission(applno){
	//$("#div_doc").html('')
	//alert(applno)
	 var str = "";
			$.ajax({                                      
				url: 'getallDoc.php',                     
				data: "applno="+applno,
				type:"post",
				dataType: 'json',
				success: function(data)         
				{
 				//alert(JSON.stringify(data))
				if(data.length>0){
				$("#txtappno").val(data[0]["applicationNo"]);
				if($.trim(data[0]["photo"])!='')
				$("#photoimg").html('<img src="../../Upload_Images/Photograph/'+data[0]["photo"]+'" width="104" height="120" />');
				 if($.trim(data[0]["signature"])!='')	
				$("#signimg").html('<img src="../../Upload_Images/Signature/'+data[0]["signature"]+'" width="100" height="39" />');
				$("#spanname").html(data[0]["name"]);
 				$("#spanapplno").html('<a href="javascript: void(0)" onclick="viewApplication()">'+data[0]["applicationNo"]+'</a>');
				$("#spansubject").html(data[0]["appsubject"]);
				$("#spancaste").html(data[0]["caste"]);
				$("#spandomicile").html(data[0]["stateofdomicile"]);
				$("#spanPH").html(data[0]["PH"]);
				$("#spanReligion").html(data[0]["religion"]);
				 
				
str ='<table class="table table-bordered table-hover">';
str +='<tr>';
str +='<td width="20%">';
str +='<a href="../../Upload_Images/Marksheet/'+data[0]["marksheet"]+'" target="_blank">';
str +='<img src="../../Upload_Images/Marksheet/'+data[0]["marksheet"]+'" width="100%" height="140" style="border:1px solid #ccc; padding:1px" title="Click to enlarge" />';
str +='</a>';
str +='</td>';
if(data[0]["APLBPL"]=='YES'){
str +='<td width="20%">';
str +='<a href="../../Upload_Images/BPLcertificate/'+data[0]["BPLcertificate"]+'" target="_blank">';
str +='<img src="../../Upload_Images/BPLcertificate/'+data[0]["BPLcertificate"]+'" width="100%" height="140" style="border:1px solid #ccc; padding:1px" title="Click to enlarge" />';
str +='</a>';
str +='</td>';
}
/*str +='<td width="20%">';
str +='<a href="../Upload_Images/Admitcard_HS/'+data[0]["admitcardHS"]+'" target="_blank">';
str +='<img src="../Upload_Images/Admitcard_HS/'+data[0]["admitcardHS"]+'" width="100%" height="140" style="border:1px solid #ccc; padding:1px" title="Click to enlarge" />';
str +='</a>';
str +='</td>';*/
str +='<td width="20%">';
str +='<a href="../../Upload_Images/Admitcard_Secondary/'+data[0]["admitcardSec"]+'" target="_blank">';
str +='<img src="../../Upload_Images/Admitcard_Secondary/'+data[0]["admitcardSec"]+'" width="100%" height="140" style="border:1px solid #ccc; padding:1px" title="Click to enlarge" />';
str +='</a>';
str +='</td>';
if(data[0]["caste"]!='GENERAL' && data[0]["stateofdomicile"]=='WEST BENGAL'){
str +='<td width="20%">';
str +='<a href="../../Upload_Images/Castecertificate/'+data[0]["castecertificate"]+'" target="_blank">';
str +='<img src="../../Upload_Images/Castecertificate/'+data[0]["castecertificate"]+'" width="100%" height="140" style="border:1px solid #ccc; padding:1px" title="Click to enlarge" />';
str +='</a>';
str +='</td>';
} 
if(data[0]["PH"]=='Yes'){ 
str +='<td width="20%">';
str +='<a href="../../Upload_Images/PHcertificate/'+data[0]["phcertificate"]+'" target="_blank">';
str +='<img src="../../Upload_Images/PHcertificate/'+data[0]["phcertificate"]+'" width="100%" height="140" style="border:1px solid #ccc; padding:1px" title="Click to enlarge" />';
str +='</a>';
str +='</td>';
} 
if(data[0]["CH"]=='Yes'){ 
str +='<td width="20%">';
str +='<a href="../../Upload_Images/DedicationCertificate/'+data[0]["DedicationCertificate"]+'" target="_blank">';
str +='<img src="../../Upload_Images/DedicationCertificate/'+data[0]["DedicationCertificate"]+'" width="100%" height="140" style="border:1px solid #ccc; padding:1px" title="Click to enlarge" />';
str +='</a>';
str +='</td>';

str +='<td width="20%">';
str +='<a href="../../Upload_Images/MembershipCertificate/'+data[0]["MembershipCertificate"]+'" target="_blank">';
str +='<img src="../../Upload_Images/MembershipCertificate/'+data[0]["MembershipCertificate"]+'" width="100%" height="140" style="border:1px solid #ccc; padding:1px" title="Click to enlarge" />';
str +='</a>';
str +='</td>';
} 

str +='</tr>';
str +='<tr>';
str +='<td>Class 12 Marksheet</td>';
if(data[0]["APLBPL"]=='YES' ){ 
str +='<td>BPL Certificate</td>';
}
//str +='<td>Class 12 Admit Card</td>';
str +='<td>Age Proof Document</td>';
if(data[0]["caste"]!='GENERAL' && data[0]["stateofdomicile"]=='WEST BENGAL'){ 
str +='<td>Caste Certificate</td>';
} 
if(data[0]["PH"]=='Yes'){ 
str +='<td>PH Certificate</td>';
}
if(data[0]["CH"]=='Yes'){ 
str +='<td>Baptism / Dedication Certificate</td>';
str +='<td>Letter from Parish Priest / Proof of Church Membership</td>';
}
str +='</tr>';
str +='<tr><td colspan="5"><div class="form-group row"><label class="col-sm-1 col-form-label">Remark:</label> <div class="col-sm-11"><input class="form-control select" type="text" id="txtremark" name="txtremark" maxlength="250" value="'+$.trim(data[0]["remark"])+'" /></div></div></td></tr>';
var verifyfunctname = "verifyadmittedstudent('"+applno+"','Y')"; 
var rejectfunctname = "verifyadmittedstudent('"+applno+"','N')"; 
str +='<tr><td colspan="5"><a class="btn btn-success btn-sm" href="javascript: void(0)" onclick="'+verifyfunctname+'">&#10004; Verify</a> <a class="btn btn-danger btn-sm" href="javascript: void(0)" onclick="'+rejectfunctname+'">&#10006; Reject</a> </td></tr>';
str +='</table>';
				 
					}
  					 $("#div_doc").html(str)
 				}
				});
		
  		   $('.hover_bkgr_fricc').show();
 		/*$('.hover_bkgr_fricc').click(function(){
			$('.hover_bkgr_fricc').hide();
		});*/
		$('.popupCloseButton').click(function(){
			$('.hover_bkgr_fricc').hide();
		});
	} 
	
	
	function verifyadmittedstudent(applno,updtstatus){
			$.ajax({                                      
				url: 'verifyadmittedstudentByAdmin.php',                     
				data: "applno="+applno+'&updtstatus='+updtstatus+'&remark='+$("#txtremark").val()+'&verifyBy='+$("#hdnuserid").val(),
				type:"post",
				dataType: 'json',
				success: function(data)         
				{
					//alert(data.msg)
					$("#msgcontent").html(data.msg);
					$("#ValidationAlert").modal();
					if(data.status==1){
					$('.hover_bkgr_fricc').hide();
					getstudentlistforverify();
					
					}
					else {
					return false;
					}
				}
				});
	}
 