// JavaScript Document
function makeUpper(e, obj) {
	
 /*var key = (document.all) ? e.keyCode : e.which
   
    if (key >= 97 && key <= 122) {
      //obj.value=this.value.toUpperCase();
		obj.value += String.fromCharCode(key).toUpperCase();
        return false;
    }*/
	/*input[type="text"] {
    text-transform: uppercase;
}*/
}

/*function noNumerics(evt)
         {
         var e = event || evt;
         var charCode = e.which || e.keyCode;
         if ((charCode >= 48) && (charCode <= 57))
            return false;
         return true;
         }*/

/*function makeUpper(e) {
            var charCode =  e.keyCode;
            if (charCode >= 97 && charCode <= 122) {
                e.keyCode = String.fromCharCode(charCode-32);
				alert(e.keyCode)
            }
          return true;
        }
*/
/*function makeUpper(e) {
	var e = window.event || e;
 	var key=(e.which) ? e.which : event.keyCode
 // 
    if (key >= 97 && key <= 122) {	
		key=key-32; 
		alert(key)
		
	}
	return true;
}*/

function AllowAlphabet(e)
{ 

 isIE = document.all ? 1 : 0
  
  keyEntry = !isIE ? e.which : event.keyCode;

if (((keyEntry >= '65') && (keyEntry <= '90')) || ((keyEntry >= '97') && (keyEntry <= '122')) || (keyEntry == '46') || (keyEntry == '32') || (keyEntry == '45') || (keyEntry == '08')  || (keyEntry == '0'))
	if (navigator.userAgent.search("MSIE") >= 0)
    event.returnValue=true;
	else
	return true;
  else
	{
	if (navigator.userAgent.search("MSIE") >= 0)
	event.returnValue=false;
	else
	return false;
      }
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

	function bstname()
	{
	$("#txtBoardName").val($("#txtName").val());	
	}
	
	function ShowPrev(str)
	{
		if($('#hdnboardflag').val()=='otherboard')
		$("#txtBoardYearforOB").val(str);
		else
		$("#txtBoardYear").val(str);
	}
	
	function dispBoardBox(val)
	{
		if(val=='Other')
		$("#txtBoard").show();
		else
		$("#txtBoard").hide();
		
	}