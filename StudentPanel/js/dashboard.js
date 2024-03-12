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

function gonextfor(gofor,baseurl) {
	var actionurl = "";
	if(gofor=='paymentDetail') {
		actionurl ='payment.php';
	}
	if(gofor=='courseDetail') {
			actionurl ='courseDetail.php';
	}
	if(gofor=='studentInfo') {
			actionurl ='studentInfo.php';
	}
	if(gofor=='paymentreciept') {
			actionurl ='paymentReciept.php';
	}
	if(actionurl !='') {
	$("#frmnext").attr('action',baseurl+'/'+actionurl);	
	 $("#frmnext").submit();
	}
	else  {
		alert('Try again!');
	}
}

function goforConfirmReciept(payid) { 
		$("#txtpaydetailid").val(payid);	
		$("#payconfirmfrm").submit();
}

 
