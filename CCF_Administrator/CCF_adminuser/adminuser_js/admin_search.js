var preventSubmit = function(event) {
        if(event.keyCode == 13) {
            //console.log("caught ya!");
            event.preventDefault();
            //event.stopPropagation();
            return false;
        }
    }

$("#frmsearch").keypress(preventSubmit);	
	
	
function validinput(){
	
	  
	if($("#txtRollnoforsearch").val()=='')
		{
			$("#msgcontent").html("Enter College Roll No.");
			$("#ValidationAlert").modal();
		 $("#txtRollnoforsearch").focus();
		 return false;
		}
		
		return true;
	
}

function goforsearchCandidate(){
 
	if(!validinput())
	return false;
	
  		$.ajax({
		type:"POST",
		url:"verifyforcandidatesearch.php",
		dataType:"json",
		data:'collrollno='+$("#txtRollnoforsearch").val(),
		error:function(obj)
		{
		},
		success:function(obj)
		{
		 
		 if(obj.status==1){
			$("#frmsearch").submit(); 
		 }
		 else
		 {
			 $("#msgcontent").html(obj.msg);
			$("#ValidationAlert").modal();
			
		 }

		}	
		
	});	
}


		
	
function goforConfirmReciept(payid) {  
		$("#txtpaydetailid").val(payid);	
		$("#payconfirmfrm").submit();
}

 
 function goforCourseEdit(){
 
	if(!validinput())
	return false;
	
  		$.ajax({
		type:"POST",
		url:"verifyforcandidatesearch.php",
		dataType:"json",
		data:'collrollno='+$("#txtRollnoforsearch").val(),
		error:function(obj)
		{
		},
		success:function(obj)
		{
		 
		 if(obj.status==1){
			$("#frmsearch").submit(); 
		 }
		 else
		 {
			 $("#msgcontent").html(obj.msg);
			$("#ValidationAlert").modal();
			
		 }

		}	
		
	});	
}

function goforCourseeditBySem(semesterval){
	$("#courseSemforChange").val(semesterval);	
	$.ajax({
		type:"POST",
		url:"getSubforsemester.php",
		dataType:"text",
		data:'collrollno='+$("#hdncollegerollno").val()+'&semester='+semesterval,
		error:function(obj)
		{
		},
		success:function(obj)
		{
			$("#div_edit").show();
			$("#othersubjectinfo").html(obj); 
		}	
		
	});	
 }
 
 function updateCourseBySem(){
	 if($('#choSEC').length )         
		{
			if($.trim($("#choSEC").val())==""){
				$("#msgcontent").html("Select SEC.");
				$("#ValidationAlert").modal();	
				 $("#choSEC").focus();
				return false;	
			} 
		}
	var parm = $("#editform").serialize();	
	$.ajax({
		type:"POST",
		url:"updateSubforsemester.php",
		dataType:"json",
		data: parm+'&collrollno='+$("#hdncollegerollno").val(),
		error:function(obj)
		{
		},
		success:function(obj)
		{
			if(obj.status==1){
				$("#msgcontent").html(obj.msg);
				$("#ValidationAlert").modal();	
				$('#ValidationAlert').on('hidden.bs.modal', function () {
					 location.reload();
					})
			}
			else {
				$("#msgcontent").html(obj.msg);
				$("#ValidationAlert").modal();
				return false;			
			}
		}	
		
	});	 
 }
 