 
function fillstream(){
	 
 $('#dvLoading').show();
var  str = "<option value='All'>All</option>";

$("#chostream").html(str);
$("#chosubject").html(str);
 
$.ajax({
		 
		type: "post",
		url: "../getAllStream.php", 
		data: 'index0=All', 
		dataType: "text",
		success: function(data) {

			  //alert(JSON.stringify(data)) 
				 $("#chostream").html(data); 
			} ,
			 complete: function(){
				$('#dvLoading').hide();
			  } 
		});

 
}
function fillstreamfordetail(){
	 
 $('#dvLoading').show();
var  str = "<option value=''>Select</option>";

$("#chostream").html(str);
$("#chosubject").html(str);
 
$.ajax({
		 
		type: "post",
		url: "../getAllStream.php", 
		data: '', 
		dataType: "text",
		success: function(data) {

			  //alert(JSON.stringify(data)) 
				 $("#chostream").html(data); 
			} ,
			 complete: function(){
				$('#dvLoading').hide();
			  } 
		});

 
}	 

function fillsubject(stream){
 	
var  str = "<option value='All'>All</option>";
$("#chosubject").html(str)

 $('#dvLoading').show();
$.ajax({
	 
		type: "post",
		url: "../getSubjects.php", 
		data: 'stream='+stream+'&index0=All',
		dataType: "text",
		
		success: function(data) {
			 	//alert(JSON.stringify(data))

				 $("#chosubject").html(data); 
			 
			},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});

}


function geteligibleApplicant(){
		$("#recordCount").show();
			$("#recordset").hide();
			$("#exportexcel").hide();
			$('#dvLoading').show();

 var str= "<table class='table table-bordered table-hover'>";
				str= str+"<thead>"
				str= str+"<tr class='bg-light text-nowrap'>"
				str= str+"<td>Sl. No.</td>";
				str= str+"<td>College Roll No</td>";
				str= str+"<td>Session</td>";
				str= str+"<td>Semester</td>";
				str= str+"<td>Name</td>";				
				str= str+"<td>Date of Birth</td>";				  
				str= str+"<td>Stream</td>";
				str= str+"<td>Subject</td>";
				str= str+"<td>Mobile</td>";
				str= str+"<td>Email</td>";
				str= str+"</tr>"
				str= str+"</thead>"
	var parm = $("#frmeligiblereport").serialize()
  		$.ajax({
		type:"POST",
		url:"get_eligibleforpayList.php",
		dataType:"json",
		data: parm,
		error:function(obj)
		{
		},
		success:function(obj)
		{
			 
 
			if(obj.record.length>0){
				for(var i=0; i<obj.record.length; i++){
					 
				str= str+"<tbody id='myTable'>";
				str= str+"<tr class='text-nowrap'>";
				str= str+"<td>"+(i+1)+"</td>";
				str= str+"<td>"+obj.record[i]["collegeRollno"]+"</td>";
				str= str+"<td>"+obj.record[i]["session"]+"</td>";
				str= str+"<td>"+obj.record[i]["semester"]+"</td>";
				str= str+"<td>"+obj.record[i]["name"]+"</td>";
				str= str+"<td>"+obj.record[i]["dob"]+"</td>";
				str= str+"<td>"+obj.record[i]["streamDisplay"]+"</td>";
				str= str+"<td>"+obj.record[i]["subjectName"]+"</td>";
				str= str+"<td>"+obj.record[i]["applcntMobNo"]+"</td>";
				str= str+"<td>"+obj.record[i]["applcntEmail"]+"</td>";
				 
				str= str+"</tr>";
				str= str+"</tbody>";
				}
				
			}
			else {
				str= str+"<tr height='100'><td colspan='17' class='text-danger font-weight-bold'>No record found</td></tr>";
				
			}
			str = str+"</table>";
			$("#recordCount").html(obj.record.length)
			$("#recordCount").show();
			$("#recordset").html(str);
		},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		
	});		
}

 
function getcourseDetail(){
	if($("#chostream").val()=='')
		{
			$("#msgcontent").html("Choose Stream.");
			$("#ValidationAlert").modal();	
			return false;
		}
	
			$("#recordCount").show();
			$("#recordset").hide();
			$("#exportexcel").hide();
			$('#dvLoading').show();

  
	var parm = $("#frmreport").serialize()
  		$.ajax({
		type:"POST",
		url:"getCourseDetail.php",
		dataType:"json",
		data: parm,
		error:function(obj)
		{
		},
		success:function(obj)
		{ 
			$("#recordCount").html(obj.reccount)
			$("#recordCount").show();
			$("#recordset").html(obj.str);
			 
		},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		
	});		
}


function searchPaymentDetail(){
		$("#recordCount").show();
			$("#recordset").hide();
			$("#exportexcel").hide();
			$('#dvLoading').show();

 var str= "<table class='table table-bordered table-hover'>";
				str= str+"<thead>"
				str= str+"<tr class='bg-light text-nowrap'>"
				str= str+"<td>Sl. No.</td>";
				str= str+"<td>College Roll No</td>";
				str= str+"<td>Academic Session</td>";
				str= str+"<td>Semester</td>";
				
				str= str+"<td>Name</td>";				
				str= str+"<td>Date of Birth</td>";				  
				str= str+"<td>Stream</td>";
				str= str+"<td>Subject</td>";
				str= str+"<td>Fee Detail</td>";
				str= str+"<td>Mobile</td>";
				str= str+"<td>Email</td>";
				str= str+"<td>Sem. to be admitted</td>";
				str= str+"<td>Fee Amount</td>";
				str= str+"<td>Paid Amount</td>";
				str= str+"<td>Transaction Id</td>";
				str= str+"<td>Transaction Date</td>";
				str= str+"<td>Payment Date</td>";
				str= str+"<td>Paid Status</td>";
				str= str+"</tr>"
				str= str+"</thead>"
	var parm = $("#frmpayreport").serialize()
  		$.ajax({
		type:"POST",
		url:"searchPaymentDetail.php",
		dataType:"json",
		data: parm,
		error:function(obj)
		{
		},
		success:function(obj)
		{
			 
 
			if(obj.record.length>0){
				for(var i=0; i<obj.record.length; i++){	
					
				str= str+"<tbody id='myTable'>";
				str= str+"<tr class='text-nowrap'>";
				str= str+"<td>"+(i+1)+"</td>";
				str= str+"<td>"+obj.record[i]["collegeRollNo"]+"</td>";
				str= str+"<td>"+obj.record[i]["academicsession"]+"</td>";
				str= str+"<td>"+obj.record[i]["semester"]+"</td>";
				str= str+"<td>"+obj.record[i]["name"]+"</td>";
				str= str+"<td>"+obj.record[i]["dob"]+"</td>";
				str= str+"<td>"+obj.record[i]["streamDisplay"]+"</td>";
				str= str+"<td>"+obj.record[i]["subjectName"]+"</td>";
				str= str+"<td>"+obj.record[i]["FeeDetail"]+"</td>";
				str= str+"<td>"+obj.record[i]["applcntMobNo"]+"</td>";
				str= str+"<td>"+obj.record[i]["applcntEmail"]+"</td>";
				str= str+"<td>"+obj.record[i]["admissionToSemester"]+"</td>";
				str= str+"<td>"+obj.record[i]["FeeAmount"]+"</td>";
				str= str+"<td>"+obj.record[i]["onlineTransactionAmount"]+"</td>";
				str= str+"<td>"+obj.record[i]["onlineTransactionID"]+"</td>";
				str= str+"<td>"+obj.record[i]["onlineTransactionDate"]+"</td>";
				str= str+"<td>"+obj.record[i]["paymentdate"]+"</td>";
				str= str+"<td>"+obj.record[i]["Paid"]+"</td>";
				str= str+"</tr>";
				str= str+"</tbody>";
				}
				
			}
			else {
				str= str+"<tr height='100'><td colspan='15' class='text-danger font-weight-bold'>No record found</td></tr>";
				
			}
			str = str+"</table>";
			$("#recordCount").html(obj.record.length)
			$("#recordCount").show();
			$("#recordset").html(str);
		},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		
	});		
}




function fillfeetype(sessionyr){
	 
 $('#dvLoading').show();
var  str = "<option value='All'>All</option>";

$("#chofeeType").html(str);
 
 
$.ajax({
		 
		type: "post",
		url: "getOtherfeetype.php", 
		data: '', 
		dataType: "text",
		success: function(data) {
				 $("#chofeeType").html(data); 
			} ,
			 complete: function(){
				$('#dvLoading').hide();
			  } 
		});

 
}


function searchOtherPaymentDetail(){
		$("#recordCount").show();
			$("#recordset").hide();
			$("#exportexcel").hide();
			$('#dvLoading').show();

 var str= "<table class='table table-bordered table-hover'>";
				str= str+"<thead>"
				str= str+"<tr class='bg-light text-nowrap'>"
				str= str+"<td>Sl. No.</td>";
				str= str+"<td>College Roll No</td>";
				str= str+"<td>Academic Session</td>";
				str= str+"<td>Semester</td>";
				str= str+"<td>Name</td>";				
				str= str+"<td>Date of Birth</td>";				  
				str= str+"<td>Stream</td>";
				str= str+"<td>Subject</td>";
				str= str+"<td>Fee Detail</td>";
				str= str+"<td>Mobile</td>";
				str= str+"<td>Email</td>";
				str= str+"<td>Fee Amount</td>";
				str= str+"<td>Paid Amount</td>";
				str= str+"<td>Transaction Id</td>";
				str= str+"<td>Transaction Date</td>";
				str= str+"<td>Payment Date</td>";
				str= str+"<td>Paid Status</td>";
				str= str+"</tr>"
				str= str+"</thead>"
	var parm = $("#frmpayreport").serialize()
  		$.ajax({
		type:"POST",
		url:"searchOtherPaymentDetail.php",
		dataType:"json",
		data: parm,
		error:function(obj)
		{
		},
		success:function(obj)
		{
			 
 
			if(obj.record.length>0){
				for(var i=0; i<obj.record.length; i++){
					 
				
				str= str+"<tbody id='myTable'>";
				str= str+"<tr class='text-nowrap'>";
				str= str+"<td>"+(i+1)+"</td>";
				str= str+"<td>"+obj.record[i]["collegeRollNo"]+"</td>";
				str= str+"<td>"+obj.record[i]["academicsession"]+"</td>";
				str= str+"<td>"+obj.record[i]["semester"]+"</td>";
				str= str+"<td>"+obj.record[i]["name"]+"</td>";
				str= str+"<td>"+obj.record[i]["dob"]+"</td>";
				 
				str= str+"<td>"+obj.record[i]["streamDisplay"]+"</td>";
				str= str+"<td>"+obj.record[i]["subjectName"]+"</td>";
				str= str+"<td>"+obj.record[i]["FeeDetail"]+"</td>";
				str= str+"<td>"+obj.record[i]["applcntMobNo"]+"</td>";
				str= str+"<td>"+obj.record[i]["applcntEmail"]+"</td>";
				str= str+"<td>"+obj.record[i]["FeeAmount"]+"</td>";
				str= str+"<td>"+obj.record[i]["onlineTransactionAmount"]+"</td>";
				str= str+"<td>"+obj.record[i]["onlineTransactionID"]+"</td>";
				str= str+"<td>"+obj.record[i]["onlineTransactionDate"]+"</td>";
				str= str+"<td>"+obj.record[i]["paymentdate"]+"</td>";
				str= str+"<td>"+obj.record[i]["Paid"]+"</td>";
				str= str+"</tr>";
				str= str+"</tbody>";
				}
				
			}
			else {
				str= str+"<tr height='100'><td colspan='15' class='text-danger font-weight-bold'>No record found</td></tr>";
				
			}
			str = str+"</table>";
			$("#recordCount").html(obj.record.length)
			$("#recordCount").show();
			$("#recordset").html(str);
		},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		
	});		
}	
	
	