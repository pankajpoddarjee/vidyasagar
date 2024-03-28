function verifyLogin()
{
	if($.trim($('#txtcourseType').val())=="")	
	{
		$("#msgcontent").html("Select User Type");
		$("#ValidationAlert").modal();
		$('#txtcourseType').focus()
		return false;
	}
	
	if($.trim($('#txtusername').val())=="")	
	{
		$("#msgcontent").html("Enter Username");
			$("#ValidationAlert").modal();
		$('#txtusername').focus()
		return false;
	}
	if($.trim($('#txtpassword').val())=="")	
	{
		$("#msgcontent").html("Enter Password");
			$("#ValidationAlert").modal();
		$('#txtpassword').focus()
		return false;
	}
		
		 
		var form = $("#frmuser");
	
		$.ajax({                                      
		  url:'verifyuser.php',                     
		   type:'post',
		   data: "courseType="+$('#txtcourseType').val()+"&username="+$('#txtusername').val()+"&password="+$('#txtpassword').val(),
		   dataType: 'json',
		  success: function(data)
		  {
		// alert(JSON.stringify(data));
 				if(data.status==0)
				{
					$("#msgcontent").html(data.msg);
					$("#ValidationAlert").modal();
					return false
				}
				else
				{
					if(data.actionurl!=''){
					$("#frmlogin").attr('action', data.actionurl); 
					 $("#frmlogin").submit();
					}
				}
				
			}
		});
	
}