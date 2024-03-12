// JavaScript Document
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

function getOtherSubforsemester(tobeAdmitSem){
	 $("#othersubjectinfo").hide();
	  $("#Internship").hide();
	$("#choInternship").val('');  
	$("#hdnInternshipVal").val('');
	$("#choInternship").attr('disabled',false);
	if(tobeAdmitSem!='')
		 $('#dvLoading').show()	;
	$.ajax({
			type:"POST",
			url:"getOtherSubforsemester.php",
			dataType:"json",
			data: 'collegerollno='+$("#hdncollegerollno").val()+'&tobeAdmitSem='+tobeAdmitSem,
			error:function(obj)
			{
				//alert(obj.status);
			},
			success:function(obj)
			{
			   $("#othersubjectinfo").html(obj.str);
			   $("#othersubjectinfo").show();
			    $("#hdnInternshipVal").val(obj.reqInternship);
			   if(obj.reqInternship==1) {
				   $("#Internship").show();
				   if(tobeAdmitSem=='VI') {
					 $("#choInternship").val('Yes');  
					 $("#choInternship").attr('disabled',true);
				   }  
			   }
				 
				 
			},
			 complete: function(){
				$('#dvLoading').hide();
			  }	
		});
}

function verifyInput(feetype){
	if(feetype=='ADMFEE') {
	if($.trim($("#choAdmitedSemester").val())=="")
		{
			alert("Select to be admitted semester");
			$("#choAdmitedSemester").focus();
			return false;
		}
	}
	/* if($("#hdnInternshipVal").val()=='1') {
		if($.trim($("#choInternship").val())=="")
			{
				alert("Do you want apply for Internship.");
				$("#choInternship").focus();
				return false;
			}
	} */
	
	if($.trim($("#txtmobile").val())=="")
		{
			alert("Enter Mobile No.");
			$("#txtmobile").focus();
			return false;
		}
		if($.trim($("#txtmobile").val())!="" && ($.trim($("#txtmobile").val())).length!=10 ) 
		{
			 
			alert("Enter valid Mobile No.");
			$("#txtmobile").focus();
			return false;
		 
			 
		}
		if($.trim($("#txtemail").val())=="")
		{
			alert("Enter email id.");
			$("#txtemail").focus();
			return false;
		}
		else
		{

			var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
			if(!filter.test($.trim($("#txtemail").val())))
			{
				alert("Enter E-mail in valid format");
				$("#txtemail").focus();
				return false;
			}
		}
		if(feetype=='ADMFEE') {
		if($('#choSEC').length )         
		{
			if($.trim($("#choSEC").val())==""){
				alert("Select SEC.");
				$("#choSEC").focus();
				return false;	
			} 
		}
		}
		return true;
}

function saveInfo(){
	var parm = '';
	 
		if(!verifyInput('ADMFEE'))
		{
		return false	
		}
		parm =$("#frmnext1").serialize();
		 
		$.ajax({
			type:"POST",
			url:"saveInfoforPayment.php",
			dataType:"json",
			data:parm,
			error:function(obj)
			{
				//alert(obj.status);
			},
			success:function(obj)
			{
			  //alert(JSON.stringify(obj))
			
				if(obj.status==0)
				{
					alert(obj.msg);
				}
				else 
				{ 
					$("#frmnext1").submit();
				}
			}	
		});	
}

function saveInfoOther(){
	var parm = '';
	 
		if(!verifyInput('OTHER'))
		{
		return false	
		}
		parm =$("#frmnext1").serialize();
		 
		$.ajax({
			type:"POST",
			url:"saveInfoforOther.php",
			dataType:"json",
			data:parm,
			error:function(obj)
			{
				//alert(obj.status);
			},
			success:function(obj)
			{
			  //alert(JSON.stringify(obj))
			
				if(obj.status==0)
				{
					alert(obj.msg);
				}
				else 
				{ 
					$("#frmnext1").submit();
				}
			}	
		});	
}

function goforPayment(feetype,payid) {
	var actionurl =  ""
	if(feetype=='ADMFEE')
	  actionurl =  "PayAdmission/infoforAdmPayment.php";
	else  
	  actionurl =  "PayOther/goforOtherPayment.php";
	if(actionurl!='') {
	$("#hdnpaydetailid").val(payid);
	$("#nextfrm").attr("action",actionurl);
	$("#nextfrm").submit();
	}
	else {
	alert("Try Again.")	;
	return false;
	}
}
