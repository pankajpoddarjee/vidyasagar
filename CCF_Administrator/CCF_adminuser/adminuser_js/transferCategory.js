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
	var applno = $("#txtapplicationNo").val()	
	
		$.ajax({                                      
				url: 'verifyForChangeAdmittedCategory.php',                     
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
						$('#frmchangeCateg').attr('action', "changeAdmittedCategory.php");
						$('#frmchangeCateg').submit()
					}
				}
				});
 	}
	
	
	function CancelAssign(){
	 location.reload();
	}
	
	
	function saveCategoryTransfer(){
		if($("#cho_admittedcateg").val()==''){
			$("#msgcontent").html("Select Category for admission");
			$("#ValidationAlert").modal();
			return false;
			$("#cho_admittedcateg").focus()
		}
		else {
			if($("#cho_admittedcateg").val()==$("#hdnAdmittedCategory").val()){
			$("#msgcontent").html("You can't choose same category.");
			$("#ValidationAlert").modal();
			return false;
			$("#cho_admittedcateg").focus()
			}
		}
		 
			var form = $("#frm");
			 $.ajax({
				type: "post",
				url: "saveCategoryChange.php", 
				data: form.serialize(), 
				dataType: "json",
				//dataType: "text",
				
				
				success: function(data) {
				
						if(data.status==1)
						{
							$("#frmthankyou").submit();
						}
						else
						{
						$("#msgcontent").html(data.msg);
						$("#ValidationAlert").modal();
						return false;
						}
					}
				});
 } 
	
	
	
	 