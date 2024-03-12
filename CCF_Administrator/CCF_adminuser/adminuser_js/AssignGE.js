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
function displayGELabel(streamval){
	var  electstr="CC &amp; GE";
	$("#streamtext1").hide();
	$("#streamtext2").hide();
	$("#streamtext3").hide();
	$("#streamtext4").hide();
	if(streamval=='BA' || streamval=='BSC' || streamval=='BAM'){
	   electstr="GE";
	   $("#streamtext1").show();
	}
	else if(streamval=='BCOM' || streamval=='BCOMGEN')
	{
	   electstr="Elective subject combination for course";
	   $("#streamtext2").show();
	}
	else if(streamval=='BAGEN')
	{
	   electstr="CC &amp; GE";
	   $("#streamtext3").show();
	}
	else if(streamval=='BSCGEN')
	{
	   electstr="CC";
	   $("#streamtext4").show();
	}
	
	$("#labeltext").html(electstr);
	
}

 function getInfo(){
		if($.trim($("#txtapplicationNo").val())=="")
		{
			 
			$("#msgcontent").html("Enter Form No.");
			$("#ValidationAlert").modal();
			$("#txtapplicationNo").focus();
			return false;
		}
	var applno = $("#txtapplicationNo").val()	
	
		$.ajax({                                      
				url: 'verifyForAssignElective.php',                     
				data: "applno="+applno,
				type:"post",
				dataType: 'json',
				success: function(data)         
				{
				// alert(JSON.stringify(data))
					if(data.status==0)
					{
						$("#msgcontent").html(data.msg);
						$("#ValidationAlert").modal();
					}
					else
					{
						$('#hdnappno').val(data["appno"])
						 //$('#hdnappointCateg').val(data["allotmentcateg"])
						$('#frmAssignGE').attr('action', "assignElective.php");
						$('#frmAssignGE').submit()
					}
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
	
	
	
	 