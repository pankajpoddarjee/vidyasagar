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
			  url:'../../Meritlist_wishlist/getSection.php',                     
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
			  url:'../../Meritlist_wishlist/getStream.php',                     
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
			  url:'../../Meritlist_wishlist/getSubject.php',                     
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


function fillSection_report(phase){
	 
 $('#dvLoading').show();
var  str = "<option value='All'>All</option>";

$("#chosection").html(str);
$("#chostream").html(str);
$("#chosubject").html(str);
//$("#choCategory").val('');
//allstream()


//alert(form1.serialize())
		$.ajax({                                      
			  url:'../../Meritlist_wishlist/getSection.php',                     
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


function fillStream_report(){
	 
 $('#dvLoading').show();
var  str = "<option value='All'>All</option>";

 
$("#chostream").html(str);
$("#chosubject").html(str);
//$("#choCategory").val('');
//allstream()


//alert(form1.serialize())
		$.ajax({                                      
			  url:'getWLStream.php',                     
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


function fillsubject_report(){
	 
 $('#dvLoading').show();
var  str = "<option value='All'>All</option>";
 
 
$("#chosubject").html(str);
//$("#choCategory").val('');
//allstream()


//alert(form1.serialize())
		$.ajax({                                      
			  url:'getWLSubject.php',                     
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
		 $('#frm').attr('action', baseurl+"/Meritlist_wishlist/meritlistBySubject.php") ;	
	}
	else if(optionval=='Excel') {
		 $('#frm').attr('action', "CSV_meritlist.php") ;	
	}
	 $('#frm').submit();
}

function resetform(){
	$("#frm")[0].reset()
}

 function GetwishlistMLRankDetail(){
		$('#dvLoading').show();
	 var form = $("#frmMLRank")
	var pars = form.serialize();
	 $("#detailrecord").html('')
		  
		  	var str = '<table class="table table-bordered table-hover text-nowrap text-center" border="1" bordercolor="#333">';
            	str +='<thead>';
				str +='<tr class="bg-light font-weight-bold" style="background:#e0e0e0; text-align:center">';
                str +='<td>#</td>';
                str +='<td>Form No.</td>';
                str +='<td>Status</td>';
				str +='<td>Name</td>';
				str +='<td>DOB</td>';
				str +='<td>Category</td>';
				str +='<td>State of Domicile</td>';
				str +='<td>Religion</td>';
				str +='<td>Belong to CNI</td>';
                str +='<td>Phase</td>';
				str +='<td>Wishlist Phase</td>';
				str +='<td>Section</td>';
                str +='<td>Honours</td>';
				str +='<td>Stream</td>';
                str +='<td>Merit Marks</td>';
				str +='<td>General Rank</td>';
                str +='<td>SC Rank</td>';
                str +='<td>ST Rank</td>';
				str +='<td>CH Rank</td>';
                str +='<td>CNI Rank</td>';
               // str +='<td>OBC-A Rank</td>';
               // str +='<td>OBC-B Rank</td>';

// ================   PH STARTS =================
				str +='<td>PH Rank</td>';
				//str +='<td>PH (General) Rank</td>';
				//str +='<td>PH (SC) Rank</td>';
				//str +='<td>PH (ST) Rank</td>';
				//str +='<td>PH (OBC-A) Rank</td>';
				//str +='<td>PH (OBC-B) Rank</td>';
// ================   PH ENDS =================
            	
				str +='</tr>';
				str +='</thead>';
		$.ajax({
		type: "post",
		async: false,
		url: "getStudentRankInMLWishlist.php",//"getStudentRankInML.php", 
		data: pars, 
		dataType: "json",
		
		success: function(data) {
			if(data.length>0){
				for(var i=0; i<data.length; i++){
						str +='<tbody id="myTable">';
						str +='<tr>';
						str +='<td style="text-align:center">'+(i+1)+'</td>';
						str +='<td style="text-align:center">'+data[i]["applicationNo"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["admitstatus"] +'</td>';
						str +='<td style="text-align:left">'+data[i]["name"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["dob"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["caste"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["stateofdomicile"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["religion"]+'</td>';
						str +='<td style="text-align:center">'+data[i]["CNI"]+'</td>';
						str +='<td style="text-align:center">'+data[i]["phaseApplied"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["wishlistphase"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["appsection"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["appsubject"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["appstream"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["indexmark"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["GeneralRank"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["SCRank"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["STRank"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["CHRank"] +'</td>';
						str +='<td style="text-align:center">'+data[i]["CNIRank"] +'</td>';
						//str +='<td style="text-align:center">'+data[i]["OBCARank"] +'</td>';
						//str +='<td style="text-align:center">'+data[i]["OBCBRank"] +'</td>';
			// ================   PH STARTS =================
						str +='<td style="text-align:center">'+data[i]["PHRank"] +'</td>';
						//str +='<td style="text-align:center">'+data[i]["PH_GENRank"] +'</td>';
						//str +='<td style="text-align:center">'+data[i]["PH_SCRank"] +'</td>';
						//str +='<td style="text-align:center">'+data[i]["PH_STRank"] +'</td>';
						//str +='<td style="text-align:center">'+data[i]["PH_OBCARank"] +'</td>';
						//str +='<td style="text-align:center">'+data[i]["PH_OBCBRank"] +'</td>';
			// ================   PH ENDS =================

						str +='</tr>';
						str +='</tbody>';
						} 
					}
					else
					{
					 str +='<tr style="text-align:center"><td colspan="7" class="font-weight-bold text-danger">No Records</td></tr>';
					}
					
					 str +='</table>';
					  $("#countrecord").html("Total records : "+data.length)
					  $('#countrecord').show()
					 $("#detailrecord").html(str)
					 $("#detailrecord").show()
					 $("#showExport").show()
					 $("#searchBar").show()
			},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});

	} 