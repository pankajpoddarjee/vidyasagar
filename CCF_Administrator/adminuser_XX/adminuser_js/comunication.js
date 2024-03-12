
	function checkdate(startdt,enddt){
	//alert(startdt)
	var startdtarr = $.trim(startdt).split("-");
	var enddtarr = $.trim(enddt).split("-");
	//alert(startdtarr[2]+'-'+startdtarr[1]+'-'+startdtarr[0])
	var start_date= new Date(startdtarr[1]+'/'+startdtarr[2]+'/'+startdtarr[0]);
	var end_date= new Date(enddtarr[1]+'/'+enddtarr[2]+'/'+enddtarr[0]);
	 //alert(start_date)
	if(start_date>end_date)
	{
	alert("End date must be greater than Start date.")
	return false
	}
	return true;
	
	}
	
	function displayOnChristianity(religion){
	   $("#choChristianityfrom").val('All');
		if(religion=='Yes'){	
		$("#ChristianityOption").show() ;	
		}
		else {
		$("#ChristianityOption").hide() ;
		}		
		 
}
	
	 
	function validation()
	{
		if($("#chophase").val()=='')
		{
			 $("#msgcontent").html("Please choose Phase.");
			$("#ValidationAlert").modal();	
			$("#chophase").focus()
			return false;
		}
		if($("#chosection").val()=='')
		{
			$("#msgcontent").html("Please choose Shift.");
			$("#ValidationAlert").modal();	
			$("#chosection").focus()
			return false;
		}
		if($("#chostream").val()=='')
		{
			$("#msgcontent").html("Please choose Stream.");
			$("#ValidationAlert").modal();	
			$("#chostream").focus()
			return false;
		}
		if($("#chosubject").val()=='')
		{
			$("#msgcontent").html("Please choose Subject.");
			$("#ValidationAlert").modal();	
			$("#chosubject").focus()
			return false;
		}
		if($("#choCategory").val()=='')
		{
			$("#msgcontent").html("Please choose Category");
			$("#ValidationAlert").modal();	
			$("#choCategory").focus()
			return false;
		}
		if($("#txtfromDt").val()=='' || $("#txtToDt").val()=='')
		{
			$("#msgcontent").html("Enter Date Range")
			$("#ValidationAlert").modal();	
			$("#txtfromDt").focus()
			return false;
		}
		else
		{
		if(!checkdate($("#txtfromDt").val(),$("#txtToDt").val()))
		return false;
		}
		return true;
	}
	
	
	function GetValidStudentList(){
	if(!validation())
		return false;
		
	var pars = $("#frmallowedList").serialize();
		$('#dvLoading').show()	
		$.ajax({
		type: "post",
		url: "getMeritStudentForMail.php", 
		data: pars, 
		dataType: "json",
		
		success: function(data) {
				//	alert(data)
					$("#recordcount").html("Total Record : "+data.totalrecord) 
					$("#detailrecord").show();
					$("#detailrecord").html(data.str)
			},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});		
		
	}
	
	function checkall(obj){
 	if(obj.checked)	
	  $(".chksendMail").attr("checked", true);
	 else
	  $(".chksendMail").attr("checked", false);
	 }
	 
	 function sendMail(){
	
	 	if(!confirm("Do you want to send mail?")) { return false }
		
		
		var frm = $("#frmSendMail")
	 var selectedformNo = new Array();
        var h = jQuery(".chksendMail:checked").length;
        if (h > 0){
            jQuery(".chksendMail:checked").each(function(){
                //selectedformNo.push("'"+$(this).val()+"'");
				selectedformNo.push($(this).val());
            });
        }
	 // alert(selectedformNo)
		$.ajax({                                      
				  url:'sendEmail_validStudentforMLPhase.php',                     
			   type:'post',
			   data: 'selectedformNo='+selectedformNo,
			   dataType: 'json',
			  success: function(data)
			  {
				  	$('#dvLoading').show();
			$("#msgcontent").html(data.msg);
			$("#ValidationAlert").modal();						
			  
					GetValidStudentList();	
					 
			  },
			 complete: function(){
				$('#dvLoading').hide();
			  }
				 //	$('#dvLoading').hide()
				 
			});
			}	
function sendMailtoIndividual(appno){
	
	 	if(!confirm("Do you want to send mail?")) { return false }
		
		
		 
		$.ajax({                                      
				  url:'sendEmail_validStudentforMLPhase.php',                     
			   type:'post',
			   data: 'selectedformNo='+appno,
			   dataType: 'json',
			  success: function(data)
			  {
				  	$('#dvLoading').show()	
			 $("#msgcontent").html(data.msg);
			$("#ValidationAlert").modal();	
					GetValidStudentList();
					 	
			  },
			 complete: function(){
				$('#dvLoading').hide();
			  }
				 
				 
			});		 
	}