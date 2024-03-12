function fillSection(phase){
	 
 $('#dvLoading').show();
var  str = "<option value=''>Select</option>";

$("#chosection").html(str);
$("#chostream").html(str);
$("#chosubject").html(str);
$("#choCategory").val('');
//allstream()


//alert(form1.serialize())
		$.ajax({                                      
			  url:'../../Meritlist/getSection.php',                     
			   type:'post',
			   data: 'phase='+phase, 
			   dataType: 'json',
			 success: function(data)
			  { 
					for(var i=0; i<data.length; i++) {	
					str = str+"<option value='"+data[i]["section"]+"'>"+data[i]["section"]+"</option>";	
					} 
					$("#chosection").html(str);
				 
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});

}


function fillStream(){
	 
 $('#dvLoading').show();
var  str = "<option value=''>Select</option>";

 
$("#chostream").html(str);
$("#chosubject").html(str);
$("#choCategory").val('');
//allstream()


//alert(form1.serialize())
		$.ajax({                                      
			  url:'../../Meritlist/getStream.php',                     
			   type:'post',
			   data: 'phase='+$("#chophase").val()+'&section='+$("#chosection").val(), 
			   dataType: 'text',
			 success: function(data)
			  { 
					 
					$("#chostream").html(data);
				 
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});

}


function fillsubject(){
	 
 $('#dvLoading').show();
var  str = "<option value=''>Select</option>";
 
 
$("#chosubject").html(str);
$("#choCategory").val('');
//allstream()


//alert(form1.serialize())
		$.ajax({                                      
			  url:'../../Meritlist/getSubject.php',                     
			   type:'post',
			   data: 'phase='+$("#chophase").val()+'&section='+$("#chosection").val()+'&stream='+$("#chostream").val(), 
			   dataType: 'text',
			 success: function(data)
			  { 
					 
					$("#chosubject").html(data);
				 
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});

}


function inputValidation(){
	//alert(99)
	if($.trim($("#chophase").val())=="")
		{
			$("#msgcontent").html("Choose Phase.");
			$("#ValidationAlert").modal();
			$("#chophase").focus()
			return false;	 
		}
		if($.trim($("#chosection").val())=="")
		{
			$("#msgcontent").html("Choose Shift.");
			$("#ValidationAlert").modal();
			$("#chosection").focus()
			return false;	 
		}
		if($.trim($("#chostream").val())=="")
		{
			$("#msgcontent").html("Choose Stream.");
			$("#ValidationAlert").modal();
			$("#chostream").focus()
			return false;	 
		}
		if($.trim($("#chosubject").val())=="")
		{
			$("#msgcontent").html("Choose Subject.");
			$("#ValidationAlert").modal();
			$("#chosubject").focus()
			return false;	 
		}
		if($.trim($("#choCategory").val())=="")
		{
			$("#msgcontent").html("Choose Category.");
			$("#ValidationAlert").modal();
			$("#choCategory").focus()
			return false;	 
		}
		return true;
	
}


function generateMeritlist(optionval) {
	var baseurl = $("#hdnbaseurl").val();
	
	if(optionval=='Page') {
		 $('#frm').attr('action', baseurl+"/Meritlist/meritlistBySubject.php") ;	
	}
	else if(optionval=='Excel') {
		 $('#frm').attr('action', "CSV_meritlist.php") ;	
	}
	 $('#frm').submit();
}

function resetform(){
	$("#frm")[0].reset()
}

 