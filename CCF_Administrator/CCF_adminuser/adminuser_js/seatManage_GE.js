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

 

function fillstream(section){
	 
 $('#dvLoading').show();
var  str = "<option value=''>Select</option>";

 
$("#cboStream").html(str);
$("#cboSubject").html(str);
$("#cboElective").html(str);
  $("#div_seatDetail").html('');
//allstream()


//alert(form1.serialize())
		$.ajax({                                      
			  url:'../getAllStream.php',                     
			   type:'post',
			   data: 'section='+section, 
			   dataType: 'text',
			 success: function(data)
			  { 
					 
					$("#cboStream").html(data);
				 
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});

}
function fillStreamUpdt(section,setstream){
	 
 $('#dvLoading').show();
var  str = "<option value=''>Select</option>";

 
$("#cboStream").html(str);
$("#cboSubject").html(str);
 
//allstream()


//alert(form1.serialize())
		$.ajax({                                      
			  url:'../getAllStream.php',                     
			   type:'post',
			   data: 'section='+section, 
			   dataType: 'text',
			 success: function(data)
			  { 
					 
					$("#cboStream").html(data);
				 $("#cboStream").val(setstream);
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});

}

function fillStream_Search(section){
	 
 $('#dvLoading').show();
var  str = "<option value=''>Select</option>";

 
$("#cboSearchStream").html(str);
$("#cboSearchSubject").html(str);
 
//allstream()


//alert(form1.serialize())
		$.ajax({                                      
			  url:'../getAllStream.php',                     
			   type:'post',
			   data: 'section='+section, 
			   dataType: 'text',
			 success: function(data)
			  { 
					 
					$("#cboSearchStream").html(data);
				 
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});

}

function fillsubject(){
	 
 $('#dvLoading').show();
var  str = "<option value=''>Select</option>";
 
 
$("#cboSubject").html(str);
$("#cboElective").html(str);
  $("#div_seatDetail").html('');
//allstream()


//alert(form1.serialize())
		$.ajax({                                      
			  url:'../getAllSubject.php',                     
			   type:'post',
			   data: 'section='+$("#cboSection").val()+'&stream='+$("#cboStream").val(), 
			   dataType: 'text',
			 success: function(data)
			  { 
					 
					$("#cboSubject").html(data);
					 
				 
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});

}

function fillsubjectUpdt(section,stream,setsubject){
	 
 $('#dvLoading').show();
var  str = "<option value=''>Select</option>";
 
 
$("#cboSubject").html(str);
 
//allstream()


//alert(form1.serialize())
		$.ajax({                                      
			  url:'../getAllSubject.php',                     
			   type:'post',
			   data: 'section='+section+'&stream='+stream, 
			   dataType: 'text',
			 success: function(data)
			  { 
					 
					$("#cboSubject").html(data);
					$("#cboSubject").val(setsubject);
				 
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});

}

function fillsubject_search(){
	 
 $('#dvLoading').show();
var  str = "<option value=''>Select</option>";
 
 
$("#cboSearchSubject").html(str);
 
//allstream()


//alert(form1.serialize())
		$.ajax({                                      
			  url:'../getAllSubject.php',                     
			   type:'post',
			   data: 'section='+$("#cboSearchSection").val()+'&stream='+$("#cboSearchStream").val(), 
			   dataType: 'text',
			 success: function(data)
			  { 
					 
					$("#cboSearchSubject").html(data);
				 
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});

}
 
 function fillCombination(){
		 $('#dvLoading').show();
		var  str = "<option value=''>Select</option>";
 
			$("#cboElective").html(str);
			 $("#div_seatDetail").html('');
		$.ajax({                                      
			  url:'../getAllcombination.php',                     
			   type:'post',
			   data: 'section='+$("#cboSection").val()+'&stream='+$("#cboStream").val()+'&subject='+$("#cboSubject").val(), 
			   dataType: 'text',
			 success: function(data)
			  { 
					 
					$("#cboElective").html(data);
					 
				 
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});
	}
	
	function fillCombinationUpdt(section,stream,subject,setval){
		 $('#dvLoading').show();
		var  str = "<option value=''>Select</option>";
 
			$("#cboElective").html(str);
			 $("#div_seatDetail").html('');
		$.ajax({                                      
			  url:'../getAllcombination.php',                     
			   type:'post',
			   data: 'section='+section+'&stream='+stream+'&subject='+subject, 
			   dataType: 'text',
			 success: function(data)
			  { 
					 
					$("#cboElective").html(data);
					 $("#cboElective").val(setval);
				 
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});
	}

 function getSeatCountByGE(){
	$('#dvLoading').show();
	 var section = $("#cboSection").val();
	var stream = $("#cboStream").val();
	var subjectval = $("#cboSubject").val();
	 var combinationval = $("#cboElective").val();
	 
	 
	 
		$.ajax({                                      
				url: 'getSeatCountByGE.php',                     
				data: "section="+section+"&stream="+stream+"&subjectval="+subjectval+"&combination="+combinationval,
				type:"post",
				dataType: 'text',
				success: function(data)         
				{
										 
					 $("#div_seatDetail").html(data);
						
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				}); 
	 
 }
 
 function getSeatCountByGEUpdt(section,stream,subjectval,combinationval){
	$('#dvLoading').show();
	  
		$.ajax({                                      
				url: 'getSeatCountByGE.php',                     
				data: "section="+section+"&stream="+stream+"&subjectval="+subjectval+"&combination="+combinationval,
				type:"post",
				dataType: 'text',
				success: function(data)         
				{
										 
					 $("#div_seatDetail").html(data);
						
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				}); 
	 
 }
	
	
	function verifyInput()
	{
		if($.trim($("#cboSection").val())=="")
		{
			$("#msgcontent").html("Choose Section.");
			$("#ValidationAlert").modal();	
			$("#cboSection").focus();
			return false;
		}
		if($.trim($("#cboStream").val())=="")
		{
			$("#msgcontent").html("Choose Stream.");
			$("#ValidationAlert").modal();	
			$("#cboStream").focus();
			return false;
		}
		if($.trim($("#cboSubject").val())=="")
		{
			$("#msgcontent").html("Choose Subject.");
			$("#ValidationAlert").modal();
			return false;
		}
		 
		if($.trim($("#cboElective").val())=="")
		{
			$("#msgcontent").html("Choose Combination.");
			$("#ValidationAlert").modal();
			$("#cboElective").focus();
			return false;
		}
		
		if($("#txtTotalSeat").val()=="")
		{
			$("#msgcontent").html("Enter Total nos. of Seat.");
			$("#ValidationAlert").modal();
			$("#txtTotalSeat").focus();
			return false;
		}
		else
		{
			//alert($("#txtTotalSeat").val())
			if(parseInt($("#txtTotalSeat").val())<parseInt($("#txtAllotedSeat").val())){
			$("#msgcontent").html("Total Seat cannot be less than Total Alloted Seat.");
			$("#ValidationAlert").modal();
			$("#txtTotalSeat").focus();
			return false;
			}
		}
		if($("#cboStream").val()=="BA" || $("#cboStream").val()=="BSC" || $("#cboStream").val()=="BAM") {
			if($("#txtTotalSeat_GE1").val()=="")
			{
				$("#msgcontent").html("Enter Total nos. of Seat of GE1.");
				$("#ValidationAlert").modal();
				$("#txtTotalSeat_GE1").focus();
				return false;
			}
			else
			{
				if(parseInt($("#txtTotalSeat_GE1").val())<parseInt($("#txtAllotedSeat_GE1").val())){
				$("#msgcontent").html("Total Seat cannot be less than Total Alloted Seat in GE1.");
				$("#ValidationAlert").modal();
				$("#txtTotalSeat_GE1").focus();
				return false;
				}
			}
			if($("#txtTotalSeat_GE2").val()=="")
			{
				$("#msgcontent").html("Enter Total nos. of Seat of GE2.");
				$("#ValidationAlert").modal();
				$("#txtTotalSeat_GE2").focus();
				return false;
			}
			else
			{
				if(parseInt($("#txtTotalSeat_GE2").val())<parseInt($("#txtAllotedSeat_GE2").val())){
				$("#msgcontent").html("Total Seat cannot be less than Total Alloted Seat in GE2.");
				$("#ValidationAlert").modal();
				$("#txtTotalSeat_GE2").focus();
				return false;
				}
			}
		}
	
		 
	
		return true
	}
	
	function savedata(){
		if(!verifyInput())
		{
		return false;
		}
		 $('#dvLoading').show();
			var form = $('#frmseat');
		//alert(parm)
			$.ajax({
				type:"POST",
				url:"saveSeatByGE.php",
				dataType:"json",
				data:form.serialize(),
					success: function(data)         
					{
						if(data.status==1) {
						$("#msgcontent").html(data.msg);
						$("#ValidationAlert").modal();
						$('form[name="frmseat"]')[0].reset();
						$("#div_seatDetail").html('');
						searchdata()
						}
						else
						{
						$("#msgcontent").html(data.msg);
						$("#ValidationAlert").modal();
						}
					},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				});
	}
	
	
	function searchdata()
	{
		$('#dvLoading').show();
			var form = $('#frmsearch');
			$.ajax({
				type:"POST",
				url:"getAllseatDetail_GE.php",
				dataType:"text",
				data:form.serialize(),
					success: function(data)         
					{
 						$("#basicInfo").html(data)
							//$("#totalcount").html("Total Record : "+data.totalcount)
					},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				});
	}
	
	function searchdata_report()
	{
		$('#dvLoading').show();
			var form = $('#frmsearch');
			$.ajax({
				type:"POST",
				url:"getAllseatDetail_GE_report.php",
				dataType:"text",
				data:form.serialize(),
					success: function(data)         
					{
 						$("#basicInfo").html(data)
							//$("#totalcount").html("Total Record : "+data.totalcount)
					},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				});
	}
	
	
	 
	function loaddata(sectionval,streamval,subjectval,combinationval){
			$('#addform').show(); 
			    $('#addoption').hide(); 
			$("#cboSection").val(sectionval);
			fillStreamUpdt(sectionval,streamval); 
 			 $("#cboStream").val(streamval);
			 fillsubjectUpdt(sectionval,streamval,subjectval); 
			 fillCombinationUpdt(sectionval,streamval,subjectval,combinationval); 
 			getSeatCountByGEUpdt(sectionval,streamval,subjectval,combinationval);
  	}
	
	 
	

 function clearAll(){
			$('form[name="frmseat"]')[0].reset();
							//$("#txtappcombination").attr('readonly',false);
							$("#div_seatDetail").html('');
						$("#addmode").show()
						$("#updatemode").hide()
	}
	function clearsearch(){
			$('form[name="frmsearch"]')[0].reset();
			$("#basicInfo").html('')
							 
	}
	
	 
	function getSeatCountALLGE(){
	$('#dvLoading').show();
	 var section = $("#cboSection").val();
	var stream = $("#cboStream").val();
	var subjectval = $("#cboSubject").val();
	  
		$.ajax({                                      
				url: 'getSeatCount_AllGE.php',                     
				data: "section="+section+"&stream="+stream+"&subjectval="+subjectval ,
				type:"post",
				dataType: 'text',
				success: function(data)         
				{
										 
					 $("#div_seatDetail").html(data);
						
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				}); 
	 
 }
 
 function verifyInputAllGE()
	{
		if($.trim($("#cboSection").val())=="")
		{
			$("#msgcontent").html("Choose Section.");
			$("#ValidationAlert").modal();	
			$("#cboSection").focus();
			return false;
		}
		if($.trim($("#cboStream").val())=="")
		{
			$("#msgcontent").html("Choose Stream.");
			$("#ValidationAlert").modal();	
			$("#cboStream").focus();
			return false;
		}
		if($.trim($("#cboSubject").val())=="")
		{
			$("#msgcontent").html("Choose Subject.");
			$("#ValidationAlert").modal();
			return false;
		}
		 
		 var nosofrow = $("#hdnnosofrow").val();
		 
		for(var i=1; i<=nosofrow; i++){
		if($("#txtTotalSeat_"+i).val()=="")
		{
			$("#msgcontent").html("Enter Total nos. of Seat in row "+i+".");
			$("#ValidationAlert").modal();
			$("#txtTotalSeat_"+i).focus();
			return false;
		}
		else
		{
			 
			if(parseInt($("#txtTotalSeat_"+i).val())<parseInt($("#txtAllotedSeat_"+i).val())){
			$("#msgcontent").html("Total Seat cannot be less than Total Alloted Seat in row "+i+".");
			$("#ValidationAlert").modal();
			$("#txtTotalSeat_"+i).focus();
			return false;
			}
		}
		if($("#cboStream").val()=="BA" || $("#cboStream").val()=="BSC" || $("#cboStream").val()=="BAM") {
			if($("#txtTotalSeat_GE1_"+i).val()=="")
			{
				$("#msgcontent").html("Enter Total nos. of Seat of GE1 in row "+i+".");
				$("#ValidationAlert").modal();
				$("#txtTotalSeat_GE1_"+i).focus();
				return false;
			}
			else
			{
				if(parseInt($("#txtTotalSeat_GE1_"+i).val())<parseInt($("#txtAllotedSeat_GE1_"+i).val())){
				$("#msgcontent").html("Total Seat cannot be less than Total Alloted Seat in GE1 in row "+i+".");
				$("#ValidationAlert").modal();
				$("#txtTotalSeat_GE1_"+i).focus();
				return false;
				}
			}
			if($("#txtTotalSeat_GE2_"+i).val()=="")
			{
				$("#msgcontent").html("Enter Total nos. of Seat of GE2 in row "+i+".");
				$("#ValidationAlert").modal();
				$("#txtTotalSeat_GE2_"+i).focus();
				return false;
			}
			else
			{
				if(parseInt($("#txtTotalSeat_GE2_"+i).val())<parseInt($("#txtAllotedSeat_GE2_"+i).val())){
				$("#msgcontent").html("Total Seat cannot be less than Total Alloted Seat in GE2 in row "+i+".");
				$("#ValidationAlert").modal();
				$("#txtTotalSeat_GE2_"+i).focus();
				return false;
				}
			}
			}
		}
	
		 
	
		return true
	}
 
 function saveSeatAllGE(){
		if(!verifyInputAllGE())
		{
		return false;
		}
		 $('#dvLoading').show();
			var form = $('#frmseat');
		//alert(parm)
			$.ajax({
				type:"POST",
				url:"saveSeat_AllGE.php",
				dataType:"json",
				data:form.serialize(),
					success: function(data)         
					{
						if(data.status==1) {
						$("#msgcontent").html(data.msg);
						$("#ValidationAlert").modal();
						$('form[name="frmseat"]')[0].reset();
						$("#div_seatDetail").html('');
						searchdata_AllGE()
						}
						else
						{
						$("#msgcontent").html(data.msg);
						$("#ValidationAlert").modal();
						}
					},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				});
	}
	
	function searchdata_AllGE() 
	{
		$('#dvLoading').show();
			var form = $('#frmsearch');
			$.ajax({
				type:"POST",
				url:"getAllseatDetail_AllGE.php",
				dataType:"text",
				data:form.serialize(),
					success: function(data)         
					{
 						$("#basicInfo").html(data)
							//$("#totalcount").html("Total Record : "+data.totalcount)
					},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				});
	}
	