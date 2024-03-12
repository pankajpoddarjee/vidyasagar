
/*$("#dialog").dialog({
	
    autoOpen: false,
	 width: '400',
    height: '400',
    show: {
        effect: "blind",
        duration: 1000,
		dialogClass: "noclose"
		
    },
		position: {my: "center top",
	   at: "center top",
	   of: window},
	hide: {
        effect: "fade",
        duration: 1000
    }
});

$('.closebutton').click(function () {
    $("#dialog").dialog('close');
});*/

function clear_form_elements(divid) {
  jQuery("#"+divid).find(':input').each(function() {
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

function verifyforprint(printtype)
	{
		if($.trim($("#chosession").val())=="")
		{
			alert("Choose Session.");
			$("#chosession").focus();
			return false;
		}
		if($.trim($("#chosemester").val())=="")
		{
			alert("Choose Semester.");
			$("#chosemester").focus();
			return false;
		}
		if(printtype=='Individual') {
			if($.trim($("#txtCollegeRollNo").val())=="")
			{
				alert("Enter College Roll No.");
				$("#txtCollegeRollNo").focus();
				return false;
			}
		}
		else if(printtype=='Subject') {
			if($.trim($("#chosubject").val())=="")
			{
			alert("Choose Subject");
			$("#chosubject").focus();
			return false;
			}
		}
 		 
		return true
	}
	
	
	 


function printIndividual()
{
	var err = false;
	var parm = '';
	 
		if(verifyforprint('Individual')==true)
		{
		
			var  CollegeRollNo =$.trim($("#txtCollegeRollNo").val())
			//var  applno =$.trim($("#txtapplicationNo").val())
			 
	
		parm =	"session="+$("#chosession").val()+"&semester="+$("#chosemester").val()+"&CollegeRollNo="+CollegeRollNo
		//alert(parm)	
			}
			else
			{
				err = true;
			}
 						if(err == false)
						{
 							$.ajax({
 								type:"POST",
								url:"SDMS_ID_CARD/verifyIndividual.php",
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
  										$("#hdnprintoption").val('Individual')
 										$("#frmIDCard").submit();
									}
								}	
 					});
			}
			else
			{
				return false;
			}
  }
  
 /* function verifydataforSubject()
	{
		if($.trim($("#chosubject").val())=="")
		{
			alert("Choose Subject");
			$("#chosubject").focus();
			return false;
		}
 		 
		return true
	} */
	
	
function printBy(printtype){
	if(printtype=='Individual'){
		printIndividual();
	}
	else if(printtype=='Subject'){
		if(!verifyforprint('Subject'))
			return false;
		$("#hdnprintoption").val('BySubject')
		 $("#frmIDCard").submit();
	}
		
}
	
 
	
	function showForm(optvalue){
		clear_form_elements('div_frmIndividual');
		clear_form_elements('div_frmSubject');
		$("#div_frmIndividual").hide();
		$("#div_frmSubject").hide();
		$("#span_totalrecord").html('');
		if(optvalue=='Individual'){
			$("#div_frmIndividual").show();
			$("#div_frmSubject").hide();
			//$("#optDiv").hide();
		}
		else if(optvalue=='BySubject'){
			$("#div_frmIndividual").hide();
			$("#div_frmSubject").show();
			//$("#optDiv").hide();
		}
		
	}
	
	function displayIDCardCount(subj){
		
		$.ajax({
			type:"POST",
			url:"SDMS_ID_CARD/getIDCardCount.php",
			dataType:"json",
			data:"session="+$("#chosession").val()+"&semester="+$("#chosemester").val()+'&subject='+subj,
			error:function(obj)
			{
				//alert(obj.status);
			},
			success:function(obj)
			{
			  //alert(JSON.stringify(obj))
			  if(subj!='')
			  $("#span_totalrecord").html('Total ID Card to be Generated : '+obj)
			  else
			    $("#span_totalrecord").html('')
 			}	
		});
	}