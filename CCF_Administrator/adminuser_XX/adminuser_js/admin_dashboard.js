function validinput(){
	
	  
	if($("#txtapplicationnoforprint").val()=='')
		{
			$("#msgcontent").html("Enter Application No.");
			$("#ValidationAlert").modal();
		 $("#txtapplicationnoforprint").focus();
		 return false;
		}
		
		return true;
	
}

function getprintform(){
 
	if(!validinput())
	return false;
	
  		$.ajax({
		type:"POST",
		url:"verifyforPrintForm.php",
		dataType:"json",
		data:'applicationno='+$("#txtapplicationnoforprint").val(),
		error:function(obj)
		{
		},
		success:function(obj)
		{
		// alert(obj.msg)
		 //alert(JSON.stringify(obj))
		 if(obj.status==1){
			$("#frmprintform").submit(); 
		 }
		 else
		 {
			 $("#msgcontent").html(obj.msg);
			$("#ValidationAlert").modal();
			
		 }

		}	
		
	});	
}

function resetprintform(){
	
	$("#frmprintform")[0].reset()
}

function getpayslip(){
 
	if(!validinput())
	return false;
	
  		$.ajax({
		type:"POST",
		url:"verifyforpaySlip.php",
		dataType:"json",
		data:'applicationno='+$("#txtapplicationnoforprint").val(),
		error:function(obj)
		{
		},
		success:function(obj)
		{
		// alert(obj.msg)
		 //alert(JSON.stringify(obj))
		 if(obj.status==1){
			$("#frmprintform").submit(); 
		 }
		 else
		 {
			 $("#msgcontent").html(obj.msg);
			$("#ValidationAlert").modal();
			
		 }

		}	
		
	});	
}
 