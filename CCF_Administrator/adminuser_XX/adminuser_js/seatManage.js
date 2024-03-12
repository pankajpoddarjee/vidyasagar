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
 
function getSeatCount(categval){
	
	 $('#dvLoading').show();
	 var section = $("#cboSection").val();
	var stream = $("#cboStream").val();
	var subjectval = $("#cboSubject").val()
	//var combinationval = $("#cboCombination").val()
	$("#hdnseatDetailId").val('') 
	$("#txtTotalSeat").val('') 
	$("#txtAllotedSeat").val('') 
	 
		$.ajax({                                      
				url: 'getSeatCount.php',                     
				data: "section="+section+"&stream="+stream+"&subjectval="+subjectval+"&categ="+categval,
				type:"post",
				dataType: 'JSON',
				success: function(data)         
				{
					 
					if(data.length>0){
					// alert(JSON.stringify(data))
					$("#hdnseatDetailId").val(data[0]["ID"]);
					$("#txtTotalSeat").val(data[0]["totalSeat"]);
					$("#txtAllotedSeat").val(data[0]["allotedSeat"]);
					}
					else{
						$("#msgcontent").html("Seat Detail not found.");
						$("#ValidationAlert").modal();	
						$('#dvLoading').hide();
						
					}	
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
		 
		if($.trim($("#cboCategory").val())=="")
		{
			$("#msgcontent").html("Choose Category.");
			$("#ValidationAlert").modal();
			$("#cboCategory").focus();
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
				url:"saveSeat.php",
				dataType:"json",
				data:form.serialize(),
					success: function(data)         
					{
						if(data.status==1) {
						$("#msgcontent").html(data.msg);
						$("#ValidationAlert").modal();
						$('form[name="frmseat"]')[0].reset();
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
	
			var form = $('#frmsearch');
			$.ajax({
				type:"POST",
				url:"getAllseatDetail.php",
				dataType:"text",
				data:form.serialize(),
					success: function(data)         
					{
 						$("#basicInfo").html(data)
							//$("#totalcount").html("Total Record : "+data.totalcount)
					}
				});
	}
	
	function searchdata_report()
	{
	
			var form = $('#frmsearch');
			$.ajax({
				type:"POST",
				url:"getAllseatDetail_report.php",
				dataType:"text",
				data:form.serialize(),
					success: function(data)         
					{
 						$("#basicInfo").html(data)
							//$("#totalcount").html("Total Record : "+data.totalcount)
					}
				});
	}
	
	
	function searchdata_AllCatgory()
	{
	
			var form = $('#frmsearch');
			$.ajax({
				type:"POST",
				url:"getseatDetail_AllCategory.php",
				dataType:"text",
				data:form.serialize(),
					success: function(data)         
					{
 						$("#basicInfo").html(data)
							//$("#totalcount").html("Total Record : "+data.totalcount)
					}
				});
	}
	
	function loaddata(sectionval,streamval,subjectval){
			$('#addform').show(); 
			    $('#addoption').hide(); 
			$("#cboSection").val(sectionval);
			fillStreamUpdt(sectionval,streamval); 
 			 $("#cboStream").val(streamval);
			 fillsubjectUpdt(sectionval,streamval,subjectval); 
			 
 			// getCombination(subjectval,combinationval)
			 /* $("#addbutton").hide()
     			$("#updtbutton").show()*/
  	}
	
	function loaddataforupdate(sectionval,streamval,subjectval){
			$('#addform').show(); 
			    $('#addoption').hide(); 
			$("#cboSection").val(sectionval);
			fillStreamUpdt(sectionval,streamval); 
 			 $("#cboStream").val(streamval);
			 fillsubjectUpdt(sectionval,streamval,subjectval); 
			 getSeatCount_allCategory(sectionval,streamval,subjectval);
 			 
  	}
	function getSeatCount_allCategory(sectionval,streamval,subjectval){
		 $('#dvLoading').show();
	 var section = sectionval;
	var stream = streamval;
	var subjectval = subjectval;
	 
	 
		$.ajax({                                      
				url: 'getSeatCountDetail.php',                     
				data: "section="+section+"&stream="+stream+"&subjectval="+subjectval ,
				type:"post",
				dataType: 'JSON',
				success: function(data)         
				{
					 
					//if(data.length>0){
					// alert(JSON.stringify(data))
					//$("#hdnseatDetailId").val(data[0]["ID"]);
					$("#txtTotalSeat_GENERAL").val(data["GENERAL"][0]);
					$("#txtAllotedSeat_GENERAL").val(data["GENERAL"][1]);
					$("#txtTotalSeat_SC").val(data["SC"][0]);
					$("#txtAllotedSeat_SC").val(data["SC"][1]);
					$("#txtTotalSeat_ST").val(data["ST"][0]);
					$("#txtAllotedSeat_ST").val(data["ST"][1]);
					$("#txtTotalSeat_CH").val(data["CH"][0]);
					$("#txtAllotedSeat_CH").val(data["CH"][1]);
					$("#txtTotalSeat_CNI").val(data["CNI"][0]);
					$("#txtAllotedSeat_CNI").val(data["CNI"][1]);
					 if (data.hasOwnProperty("PH")) {
					$("#txtTotalSeat_PH").val(data["PH"][0]);
					$("#txtAllotedSeat_PH").val(data["PH"][1]);
					}  
					/* $("#txtTotalSeat_PHGEN").val(data["PHGEN"][0]);
					$("#txtAllotedSeat_PHGEN").val(data["PHGEN"][1]);
					$("#txtTotalSeat_PHSC").val(data["PHSC"][0]);
					$("#txtAllotedSeat_PHSC").val(data["PHSC"][1]);
					$("#txtTotalSeat_PHST").val(data["PHST"][0]);
					$("#txtAllotedSeat_PHST").val(data["PHST"][1]);
					$("#txtTotalSeat_PHOBCA").val(data["PHOBCA"][0]);
					$("#txtAllotedSeat_PHOBCA").val(data["PHOBCA"][1]);
					$("#txtTotalSeat_PHOBCB").val(data["PHOBCB"][0]);
					$("#txtAllotedSeat_PHOBCB").val(data["PHOBCB"][1]); */
					
					//}
					//else{
						//$("#msgcontent").html("Seat Detail not found.");
						//$("#ValidationAlert").modal();	
						//$('#dvLoading').hide();
						
					//}	
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				});
		
	}
	

 function clearAll(){
			$('form[name="frmseat"]')[0].reset();
							$("#txtappcombination").attr('readonly',false);
						$("#addmode").show()
						$("#updatemode").hide()
	}
	function clearsearch(){
			$('form[name="frmsearch"]')[0].reset();
			$("#basicInfo").html('')
							 
	}
	
	function getSeatCountDetail(){
		 $('#dvLoading').show();
	 var section = $("#cboSection").val();
	var stream = $("#cboStream").val();
	var subjectval = $("#cboSubject").val()
	//var combinationval = $("#cboCombination").val()
 
	 
		$.ajax({                                      
				url: 'getSeatCountDetail.php',                     
				data: "section="+section+"&stream="+stream+"&subjectval="+subjectval ,
				type:"post",
				dataType: 'JSON',
				success: function(data)         
				{
					 
					//if(data.length>0){
					// alert(JSON.stringify(data))
					//$("#hdnseatDetailId").val(data[0]["ID"]);
					$("#txtTotalSeat_GENERAL").val(data["GENERAL"][0]);
					$("#txtAllotedSeat_GENERAL").val(data["GENERAL"][1]);
					$("#txtTotalSeat_SC").val(data["SC"][0]);
					$("#txtAllotedSeat_SC").val(data["SC"][1]);
					$("#txtTotalSeat_ST").val(data["ST"][0]);
					$("#txtAllotedSeat_ST").val(data["ST"][1]);
					$("#txtTotalSeat_CH").val(data["CH"][0]);
					$("#txtAllotedSeat_CH").val(data["CH"][1]);
					$("#txtTotalSeat_CNI").val(data["CNI"][0]);
					$("#txtAllotedSeat_CNI").val(data["CNI"][1]);
					  if (data.hasOwnProperty("PH")) {
					$("#txtTotalSeat_PH").val(data["PH"][0]);
					$("#txtAllotedSeat_PH").val(data["PH"][1]);
					}  
					/* $("#txtTotalSeat_PHGEN").val(data["PHGEN"][0]);
					$("#txtAllotedSeat_PHGEN").val(data["PHGEN"][1]);
					$("#txtTotalSeat_PHSC").val(data["PHSC"][0]);
					$("#txtAllotedSeat_PHSC").val(data["PHSC"][1]);
					$("#txtTotalSeat_PHST").val(data["PHST"][0]);
					$("#txtAllotedSeat_PHST").val(data["PHST"][1]);
					$("#txtTotalSeat_PHOBCA").val(data["PHOBCA"][0]);
					$("#txtAllotedSeat_PHOBCA").val(data["PHOBCA"][1]);
					$("#txtTotalSeat_PHOBCB").val(data["PHOBCB"][0]);
					$("#txtAllotedSeat_PHOBCB").val(data["PHOBCB"][1]);
					 */
					//}
					//else{
						//$("#msgcontent").html("Seat Detail not found.");
						//$("#ValidationAlert").modal();	
						//$('#dvLoading').hide();
						
					//}	
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
				});
		
	}
	
	
	function verifyInputAllSeat()
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
		 
		 
		
		if($("#txtTotalSeat_GENERAL").val()!="") 
		{ 
			if(parseInt($("#txtTotalSeat_GENERAL").val())<parseInt($("#txtAllotedSeat_GENERAL").val())){
			$("#msgcontent").html("Total Seat cannot be less than Total Alloted Seat in General.");
			$("#ValidationAlert").modal();
			$("#txtTotalSeat_GENERAL").focus();
			return false;
			}
		}
		
		if($("#txtTotalSeat_SC").val()!="") 
		{ 
			if(parseInt($("#txtTotalSeat_SC").val())<parseInt($("#txtAllotedSeat_SC").val())){
			$("#msgcontent").html("Total Seat cannot be less than Total Alloted Seat in SC.");
			$("#ValidationAlert").modal();
			$("#txtTotalSeat_SC").focus();
			return false;
			}
		}
		
		if($("#txtTotalSeat_ST").val()!="") 
		{ 
			if(parseInt($("#txtTotalSeat_SC").val())<parseInt($("#txtAllotedSeat_ST").val())){
			$("#msgcontent").html("Total Seat cannot be less than Total Alloted Seat in ST.");
			$("#ValidationAlert").modal();
			$("#txtTotalSeat_ST").focus();
			return false;
			}
		}
		
		if($("#txtTotalSeat_CH").val()!="") 
		{ 
			if(parseInt($("#txtTotalSeat_CH").val())<parseInt($("#txtAllotedSeat_CH").val())){
			$("#msgcontent").html("Total Seat cannot be less than Total Alloted Seat in CH.");
			$("#ValidationAlert").modal();
			$("#txtTotalSeat_CH").focus();
			return false;
			}
		}
		if($("#txtTotalSeat_CNI").val()!="") 
		{ 
			if(parseInt($("#txtTotalSeat_CNI").val())<parseInt($("#txtAllotedSeat_CNI").val())){
			$("#msgcontent").html("Total Seat cannot be less than Total Alloted Seat in CNI.");
			$("#ValidationAlert").modal();
			$("#txtTotalSeat_CNI").focus();
			return false;
			}
		}
		 if($("#txtTotalSeat_PH").val()!="") 
		{ 
			if(parseInt($("#txtTotalSeat_PH").val())<parseInt($("#txtAllotedSeat_PH").val())){
			$("#msgcontent").html("Total Seat cannot be less than Total Alloted Seat in PH.");
			$("#ValidationAlert").modal();
			$("#txtTotalSeat_PH").focus();
			return false;
			}
		}  
		/* if($("#txtTotalSeat_PHGEN").val()!="") 
		{ 
			if(parseInt($("#txtTotalSeat_PHGEN").val())<parseInt($("#txtAllotedSeat_PHGEN").val())){
			$("#msgcontent").html("Total Seat cannot be less than Total Alloted Seat in PH (General).");
			$("#ValidationAlert").modal();
			$("#txtTotalSeat_PHGEN").focus();
			return false;
			}
		} 
		if($("#txtTotalSeat_PHSC").val()!="") 
		{ 
			if(parseInt($("#txtTotalSeat_PHSC").val())<parseInt($("#txtAllotedSeat_PHSC").val())){
			$("#msgcontent").html("Total Seat cannot be less than Total Alloted Seat in PH (SC).");
			$("#ValidationAlert").modal();
			$("#txtTotalSeat_PHSC").focus();
			return false;
			}
		} 
		if($("#txtTotalSeat_PHST").val()!="") 
		{ 
			if(parseInt($("#txtTotalSeat_PHST").val())<parseInt($("#txtAllotedSeat_PHST").val())){
			$("#msgcontent").html("Total Seat cannot be less than Total Alloted Seat in PH (ST).");
			$("#ValidationAlert").modal();
			$("#txtTotalSeat_PHST").focus();
			return false;
			}
		} 
		if($("#txtTotalSeat_PHOBCA").val()!="") 
		{ 
			if(parseInt($("#txtTotalSeat_PHOBCA").val())<parseInt($("#txtAllotedSeat_PHOBCA").val())){
			$("#msgcontent").html("Total Seat cannot be less than Total Alloted Seat in PH (OBC-A).");
			$("#ValidationAlert").modal();
			$("#txtTotalSeat_PHOBCA").focus();
			return false;
			}
		}
		if($("#txtTotalSeat_PHOBCB").val()!="") 
		{ 
			if(parseInt($("#txtTotalSeat_PHOBCB").val())<parseInt($("#txtAllotedSeat_PHOBCB").val())){
			$("#msgcontent").html("Total Seat cannot be less than Total Alloted Seat in PH (OBC-B).");
			$("#ValidationAlert").modal();
			$("#txtTotalSeat_PHOBCB").focus();
			return false;
			}
		}  */

		
	
		return true
	}
	
	
	function saveAllSeatDetail(){
		if(!verifyInputAllSeat())
		{
		return false;
		}
		 $('#dvLoading').show();
			var form = $('#frmseat');
		//alert(parm)
			$.ajax({
				type:"POST",
				url:"saveSeat_AllCategory.php",
				dataType:"json",
				data:form.serialize(),
					success: function(data)         
					{
						if(data.status==1) {
						$("#msgcontent").html(data.msg);
						$("#ValidationAlert").modal();
						$('form[name="frmseat"]')[0].reset();
						searchdata_AllCatgory()
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
	
	
	
	 