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


function fillSection(phase,setval){
	 
 $('#dvLoading').show();
var  str = "<option value=''>Select</option>";

$("#cbosection").html(str);
$("#cboStream").html(str);
$("#cboSubject").html(str);

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
					$("#cbosection").html(str);
				 $("#cbosection").val(setval);
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});

}

function fillSection_Search(phase){
	 
 $('#dvLoading').show();
var  str = "<option value=''>Select</option>";

$("#cboSearchsection").html(str);
$("#cboSearchStream").html(str);
$("#cboSearchSubject").html(str);

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
					$("#cboSearchsection").html(str);
				 
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});

}




function fillStream(){
	 
 $('#dvLoading').show();
var  str = "<option value=''>Select</option>";

 
$("#cboStream").html(str);
$("#cboSubject").html(str);
 
//allstream()


//alert(form1.serialize())
		$.ajax({                                      
			  url:'../../Meritlist/getStream.php',                     
			   type:'post',
			   data: 'phase='+$("#cbophase").val()+'&section='+$("#cbosection").val(), 
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
function fillStreamUpdt(phase,section,setstream){
	 
 $('#dvLoading').show();
var  str = "<option value=''>Select</option>";

 
$("#cboStream").html(str);
$("#cboSubject").html(str);
 
//allstream()


//alert(form1.serialize())
		$.ajax({                                      
			  url:'../../Meritlist/getStream.php',                     
			   type:'post',
			   data: 'phase='+phase+'&section='+section, 
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

function fillStream_Search(){
	 
 $('#dvLoading').show();
var  str = "<option value=''>Select</option>";

 
$("#cboSearchStream").html(str);
$("#cboSearchSubject").html(str);
 
//allstream()


//alert(form1.serialize())
		$.ajax({                                      
			  url:'../../Meritlist/getStream.php',                     
			   type:'post',
			   data: 'phase='+$("#cboSearchphase").val()+'&section='+$("#cboSearchsection").val(), 
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
			  url:'../../Meritlist/getSubject.php',                     
			   type:'post',
			   data: 'phase='+$("#cbophase").val()+'&section='+$("#cbosection").val()+'&stream='+$("#cboStream").val(), 
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

function fillsubjectUpdt(phase,section,stream,setsubject){
	 
 $('#dvLoading').show();
var  str = "<option value=''>Select</option>";
 
 
$("#cboSubject").html(str);
 
//allstream()


//alert(form1.serialize())
		$.ajax({                                      
			  url:'../../Meritlist/getSubject.php',                     
			   type:'post',
			   data: 'phase='+phase+'&section='+section+'&stream='+stream, 
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

function fillsubject_Search(){
	 
 $('#dvLoading').show();
var  str = "<option value=''>Select</option>";
 
 
$("#cboSearchSubject").html(str);
 
//allstream()


//alert(form1.serialize())
		$.ajax({                                      
			  url:'../../Meritlist/getSubject.php',                     
			   type:'post',
			   data: 'phase='+$("#cboSearchphase").val()+'&section='+$("#cboSearchsection").val()+'&stream='+$("#cboSearchStream").val(), 
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
 
 
 $('#startdateforphase,#lastdtforphase,#lastdtforupdate,#defaultstartdt,#defaultenddt,#genstartdt,#genenddt,#SCstartdt,#SCenddt,#STstartdt,#STenddt,#CHstartdt,#CHenddt,#CNIstartdt,#CNIenddt,#obcAstartdt,#obcAenddt,#obcBstartdt,#obcBenddt,#PHstartdt,#PHenddt,#PH_GENstartdt,#PH_GENenddt,#PH_SCstartdt,#PH_SCenddt,#PH_STstartdt,#PH_STenddt,#PH_OBCAstartdt,#PH_OBCAenddt,#PH_OBCBstartdt,#PH_OBCBenddt').datetimepicker({formatTime: 'g:i A',step:30,ampm: true});

 


function checkdate(startdt,enddt,categ){

var start_date= new Date(startdt);
var end_date= new Date(enddt);
if(start_date>end_date)
{
$("#msgcontent").html("End date must be greater than Start date in "+categ);
$("#ValidationAlert").modal();	
 
return false
}
return true;

}



function displaytotal(from,to,dispid){
var fromval = parseInt($("#"+from).val());
var toval = parseInt($("#"+to).val());

// to make sure that they are numbers
if (!(fromval) || isNaN(fromval)) { fromval = 0; }
if (!(toval) || isNaN(toval)) { toval = 0; }
if(fromval!=0 && toval!=0)
var appcount =(toval-fromval)+1;
else
var appcount =0;
//alert(appcount)
$("#"+dispid).html(appcount);

}

function displayAdmittedcount(categ,rankfrom,rankto,dispspanid){
	
	//alert($("#"+rankfrom).val());
	if($("#"+rankfrom).val()!='' && $("#"+rankto).val()!='') {
		var strdisplay="";
		var uniquecnt =0;
	
		 $("#"+dispspanid).html(strdisplay);
	  $('#dvLoading').show();
	$.ajax({                                      
			  url:'getAdmittedCountMLV.php',                     
			   type:'post',
			   data: 'phase='+$("#cbophase").val()+'&section='+$("#cbosection").val()+'&stream='+$("#cboStream").val()+'&subject='+$("#cboSubject").val()+'&category='+categ+'&rankfrom='+$("#"+rankfrom).val()+'&rankto='+$("#"+rankto).val(), 
			   dataType: 'json',
			 success: function(data)
			  { 
			  //alert(JSON.stringify(data))
				
				uniquecnt = data.actualactivecnt-(data.admittedcnt+data.cancelcnt);
				
					strdisplay="Max Rank : "+data.maxrank+", Avail. Seat : "+data.seatcnt+", Admitted : "+data.admittedcnt+", Cancelled : "+data.cancelcnt+", Total Active: "+data.actualactivecnt+", Unique Count : "+uniquecnt;
					 $("#"+dispspanid).show();
					 $("#"+dispspanid).html(strdisplay);
					//alert(data)
				 
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});
	}
	
}
function displayotherCategCount(rankfrom,rankto,dispspanid){
	
	//alert($("#"+rankfrom).val());
	if($("#"+rankfrom).val()!='' && $("#"+rankto).val()!='') {
	  $('#dvLoading').show();
	$.ajax({                                      
			  url:'getCountReserveCateg.php',                     
			   type:'post',
			   data: 'phase='+$("#cbophase").val()+'&section='+$("#cbosection").val()+'&stream='+$("#cboStream").val()+'&subject='+$("#cboSubject").val()+'&rankfrom='+$("#"+rankfrom).val()+'&rankto='+$("#"+rankto).val(), 
			   dataType: 'text',
			 success: function(data)
			  { 
					 $("#"+dispspanid).show();
					 $("#"+dispspanid).html(data);
					//alert(data)
				 
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});
	}
	
}


function displayCountInGeneralRange(categ,rankfrom,rankto,dispspanid){
	
	//alert($("#"+rankfrom).val());
	if($("#txtgenrankfrom").val()!='' && $("#txtgenrankto").val()!='' && $("#"+rankfrom).val()!='' && $("#"+rankto).val()!='') {
	  $('#dvLoading').show();
	$.ajax({                                      
			  url:'getCountInGeneralRange.php',                     
			   type:'post',
			   data: 'phase='+$("#cbophase").val()+'&section='+$("#cbosection").val()+'&stream='+$("#cboStream").val()+'&subject='+$("#cboSubject").val()+'&category='+categ+'&genrankfrom='+$("#txtgenrankfrom").val()+'&genrankto='+$("#txtgenrankto").val()+'&rankfrom='+$("#"+rankfrom).val()+'&rankto='+$("#"+rankto).val(), 
			   dataType: 'text',
			 success: function(data)
			  { 
			   $("#"+dispspanid).show();
					 $("#"+dispspanid).html("In General Range : "+data);
					//alert(data)
				 
				},
			 complete: function(){
				$('#dvLoading').hide();
			  }
		});
	}
	
}

function checkRange(fromrank,torank,categ){

var fromappno = parseInt(fromrank);
var toappno = parseInt(torank);

if(fromappno>toappno)
{
 $("#msgcontent").html("From rank must be greater than to rank in "+categ);
$("#ValidationAlert").modal();	
return false
}
return true;

}
function setDefaultdatefromphase(){
if ($("#chksetdefaultdt").is(":checked")) 
{
if ($("#startdateforphaset").val()=='' || $("#lastdtforphase").val()=='') {
	 $("#msgcontent").html("Enter Start and Stop date of Phase.");
	$("#ValidationAlert").modal();	
 
	$("#startdateforphase").focus();
	$("#chksetdefaultdt").attr('checked',false)
	return false;
}
$("#defaultstartdt").val($.trim($("#startdateforphase").val()));
$("#defaultenddt").val($.trim($("#lastdtforphase").val()));
}
else
{
$("#defaultstartdt").val('');
$("#defaultenddt").val('');
}

}

function SetIndividualDefaultdate(optcntrl,startcntrl,endcntrl){
if ($("#"+optcntrl).is(":checked")) 
{
if ($("#defaultstartdt").val()=='' || $("#defaultenddt").val()=='') {
	$("#msgcontent").html("Enter Start and Stop date of Default.");
	$("#ValidationAlert").modal();	
	$("#defaultstartdt").focus();
	$("#"+optcntrl).attr('checked',false)
	return false;

}
$("#"+startcntrl).val($.trim($("#defaultstartdt").val()));
$("#"+endcntrl).val($.trim($("#defaultenddt").val()));
}
else
{
$("#"+startcntrl).val('');
$("#"+endcntrl).val('');
}
}

function SetDefaultdate(){
if ($("#optsettoall").is(":checked")) 
{
if ($("#defaultstartdt").val()=='' || $("#defaultenddt").val()=='') {
	$("#msgcontent").html("Enter Start and Stop date of Default.");
	$("#ValidationAlert").modal();	
	$("#defaultstartdt").focus();
	$("#optsettoall").attr('checked',false)
	return false;
}
else
{
if(!(checkdate($("#defaultstartdt").val(),$("#defaultenddt").val(),'Default'))) {
$("#optsettoall").attr('checked',false)
return false;
}
}

$("#genstartdt").val($.trim($("#defaultstartdt").val()));
$("#genenddt").val($.trim($("#defaultenddt").val()));
$("#SCstartdt").val($.trim($("#defaultstartdt").val()));
$("#SCenddt").val($.trim($("#defaultenddt").val()));
$("#STstartdt").val($.trim($("#defaultstartdt").val()));
$("#STenddt").val($.trim($("#defaultenddt").val()));
$("#obcAstartdt").val($.trim($("#defaultstartdt").val()));
$("#obcAenddt").val($.trim($("#defaultenddt").val()));
$("#obcBstartdt").val($.trim($("#defaultstartdt").val()));
$("#obcBenddt").val($.trim($("#defaultenddt").val()));

/*  PH STARTS */
$("#PHstartdt").val($.trim($("#defaultstartdt").val()));
$("#PHenddt").val($.trim($("#defaultenddt").val()));

$("#PH_GENstartdt").val($.trim($("#defaultstartdt").val()));
$("#PH_GENenddt").val($.trim($("#defaultenddt").val()));

$("#PH_SCstartdt").val($.trim($("#defaultstartdt").val()));
$("#PH_SCenddt").val($.trim($("#defaultenddt").val()));

$("#PH_STstartdt").val($.trim($("#defaultstartdt").val()));
$("#PH_STenddt").val($.trim($("#defaultenddt").val()));

$("#PH_OBCAstartdt").val($.trim($("#defaultstartdt").val()));
$("#PH_OBCAenddt").val($.trim($("#defaultenddt").val()));

$("#PH_OBCBstartdt").val($.trim($("#defaultstartdt").val()));
$("#PH_OBCBenddt").val($.trim($("#defaultenddt").val()));
/* ================   PH ENDS ================= */

}
else {

$("#genstartdt").val('');
$("#genenddt").val('');
$("#SCstartdt").val('');
$("#SCenddt").val('');
$("#STstartdt").val('');
$("#STenddt").val('');
$("#obcAstartdt").val('');
$("#obcAenddt").val('');
$("#obcBstartdt").val('');
$("#obcBenddt").val('');

/* ================   PH STARTS ================= */
$("#PHstartdt").val('');
$("#PHenddt").val('');

$("#PH_GENstartdt").val('');
$("#PH_GENenddt").val('');

$("#PH_SCstartdt").val('');
$("#PH_SCenddt").val('');

$("#PH_STstartdt").val('');
$("#PH_STenddt").val('');

$("#PH_OBCAstartdt").val('');
$("#PH_OBCAenddt").val('');

$("#PH_OBCBstartdt").val('');
$("#PH_OBCBenddt").val('');
/* ================   PH ENDS ================= */

}

}
//checkdate('2016-06-01 00:30:00','2016-05-31 00:40:00');
function validinput(){
if($.trim($("#cbophase").val())=="")
{
	$("#msgcontent").html("Choose Phase.");
	$("#ValidationAlert").modal();
	$("#cbophase").focus()
	return false;	 
}
if($.trim($("#cbosection").val())=="")
{
	$("#msgcontent").html("Choose Shift.");
	$("#ValidationAlert").modal();
	$("#cbosection").focus()
	return false;	 
}	
if($.trim($("#cboStream").val())=="")
{
	$("#msgcontent").html("Choose Stream");
	$("#ValidationAlert").modal();
	$("#cboStream").focus();
	return false;
}
if($.trim($("#cboSubject").val())=="")
{
	$("#msgcontent").html("Choose Subject");
	$("#ValidationAlert").modal();
	$("#cboSubject").focus();
	return false;
}
if($("#txtgenrankfrom").val()!=''){
if(!(checkRange($("#txtgenrankfrom").val(),$("#txtgenrankto").val(),'General'))) return false;

if ($("#genstartdt").val()=='' || $("#genenddt").val()=='') {
	$("#msgcontent").html("Enter Start and Stop date of general.");
	$("#ValidationAlert").modal();	
	$("#genstartdt").focus();
	return false;
}
else
{
if(!(checkdate($("#genstartdt").val(),$("#genenddt").val(),'General'))) return false;
}
}
if($("#txtSCrankfrom").val()!=''){

if(!(checkRange($("#txtSCrankfrom").val(),$("#txtSCrankto").val(),'SC'))) return false;

if($("#SCstartdt").val()=='' || $("#SCenddt").val()=='') {
	$("#msgcontent").html("Enter Start and Stop date of SC.");
	$("#ValidationAlert").modal();	
	$("#SCstartdt").focus();
	return false;
}
else
{
if(!(checkdate($("#SCstartdt").val(),$("#SCenddt").val(),'SC'))) return false;
}
}
if($("#txtSTrankfrom").val()!=''){
if(!(checkRange($("#txtSTrankfrom").val(),$("#txtSTrankto").val(),'ST'))) return false;

if($("#STstartdt").val()=='' || $("#STenddt").val()=='') {
	$("#msgcontent").html("Enter Start and Stop date of ST.");
	$("#ValidationAlert").modal();	
	$("#genstartdt").focus();
	return false;
}
else
{
if(!(checkdate($("#STstartdt").val(),$("#STenddt").val(),'ST'))) return false;
}
}
if($("#txtobcArankfrom").val()!=''){

if(!(checkRange($("#txtobcArankfrom").val(),$("#txtobcArankto").val(),'OBC-A'))) return false;

if($("#obcAstartdt").val()=='' || $("#obcAenddt").val()=='') {
	$("#msgcontent").html("Enter Start and Stop date of OBC-A.");
	$("#ValidationAlert").modal();
	$("#obcAstartdt").focus();
	return false;
}
else
{
if(!(checkdate($("#obcAstartdt").val(),$("#obcAenddt").val(),'OBC-A'))) return false;
}
}
if($("#txtobcBrankfrom").val()!=''){
if(!(checkRange($("#txtobcBrankfrom").val(),$("#txtobcBrankto").val(),'OBC-B'))) return false;

if($("#obcBstartdt").val()=='' || $("#obcBenddt").val()=='') {
	$("#msgcontent").html("Enter Start and Stop date of OBC-B.");
	$("#ValidationAlert").modal();	
	$("#obcBstartdt").focus();
	return false;
}
else
{
if(!(checkdate($("#obcBstartdt").val(),$("#obcBenddt").val(),'OBC-B'))) return false;
}
}

// ================   PH (NORMAL) STARTS ================= -->
if($("#txtPHrankfrom").val()!=''){
if(!(checkRange($("#txtPHrankfrom").val(),$("#txtPHrankto").val(),'PH'))) return false;

if($("#PHstartdt").val()=='' || $("#PHenddt").val()=='') {
	$("#msgcontent").html("Enter Start and Stop date of PH.");
	$("#ValidationAlert").modal();	
	$("#PHstartdt").focus();
	return false;
}
else
{
if(!(checkdate($("#PHstartdt").val(),$("#PHenddt").val(),'PH'))) return false;
}
}
/* ================   PH (NORMAL) ENDS ================= */

/* ================   PH (GEN) STARTS ================= */
if($("#txtPH_GENrankfrom").val()!=''){
if(!(checkRange($("#txtPH_GENrankfrom").val(),$("#txtPH_GENrankto").val(),'PHGEN'))) return false;

if($("#PH_GENstartdt").val()=='' || $("#PH_GENenddt").val()=='') {
	$("#msgcontent").html("Enter Start and Stop date of PH (General).");
	$("#ValidationAlert").modal();	
	$("#PH_GENstartdt").focus();
	return false;
}
else
{
if(!(checkdate($("#PH_GENstartdt").val(),$("#PH_GENenddt").val(),'PHGEN'))) return false;
}
}
/* ================   PH (GEN) ENDS ================= */

/* ================   PH (SC) STARTS ================= */
if($("#txtPH_SCrankfrom").val()!=''){
if(!(checkRange($("#txtPH_SCrankfrom").val(),$("#txtPH_SCrankto").val(),'PHSC'))) return false;

if($("#PH_SCstartdt").val()=='' || $("#PH_SCenddt").val()=='') {
	$("#msgcontent").html("Enter Start and Stop date of PH (SC).");
	$("#ValidationAlert").modal();	
	$("#PH_SCstartdt").focus();
	return false;
}
else
{
if(!(checkdate($("#PH_SCstartdt").val(),$("#PH_SCenddt").val(),'PHSC'))) return false;
}
}
/* ================   PH (SC) ENDS ================= */

/* ================   PH (ST) STARTS ================= */
if($("#txtPH_STrankfrom").val()!=''){
if(!(checkRange($("#txtPH_STrankfrom").val(),$("#txtPH_STrankto").val(),'PHST'))) return false;

if($("#PH_STstartdt").val()=='' || $("#PH_STenddt").val()=='') {
	$("#msgcontent").html("Enter Start and Stop date of PH (ST).");
	$("#ValidationAlert").modal();	
	$("#PH_STstartdt").focus();
	return false;
}
else
{
if(!(checkdate($("#PH_STstartdt").val(),$("#PH_STenddt").val(),'PHST'))) return false;
}
}
/* ================   PH (ST) ENDS ================= */

/* ================   PH (OBCA) STARTS ================= */
if($("#txtPH_OBCArankfrom").val()!=''){
if(!(checkRange($("#txtPH_OBCArankfrom").val(),$("#txtPH_OBCArankto").val(),'PHOBCA'))) return false;

if($("#PH_OBCAstartdt").val()=='' || $("#PH_OBCAenddt").val()=='') {
	$("#msgcontent").html("Enter Start and Stop date of PH (OBC-A).");
	$("#ValidationAlert").modal();	
	$("#PH_OBCAstartdt").focus();
	return false;
}
else
{
if(!(checkdate($("#PH_OBCAstartdt").val(),$("#PH_OBCAenddt").val(),'PHOBCA'))) return false;
}
}
/* ================   PH (OBCA) ENDS ================= */

/* ================   PH (OBCB) STARTS ================= */
if($("#txtPH_OBCBrankfrom").val()!=''){
if(!(checkRange($("#txtPH_OBCBrankfrom").val(),$("#txtPH_OBCBrankto").val(),'PHOBCB'))) return false;

if($("#PH_OBCBstartdt").val()=='' || $("#PH_OBCBenddt").val()=='') {
	$("#msgcontent").html("Enter Start and Stop date of PH (OBC-B).");
	$("#ValidationAlert").modal();	
	$("#PH_OBCBstartdt").focus();
	return false;
}
else
{
if(!(checkdate($("#PH_OBCBstartdt").val(),$("#PH_OBCBenddt").val(),'PHOBCB'))) return false;
}
}
/* ================   PH (OBCA) ENDS ================= */
 
return true;
}






function openphasedate(){
if($("#chkphasestatus").is(':checked'))
$("#phasedate").show()
else{
$("#phasedate").hide()
$("#startdateforphase").val('')
$("#lastdtforphase").val('')
}

}
openphasedate();

function addPhase(){

if($.trim($("#txtphase").val())=="")
{
	$("#msgcontent").html("Enter Phase");
	$("#ValidationAlert").modal();	
	$("#txtphase").focus();
	return false;
} 
if($.trim($("#txtphaselastdate").val())=="")
{
	$("#msgcontent").html("Enter Last date of Phase");
	$("#ValidationAlert").modal();	
	$("#txtphaselastdate").focus();
	return false;
}
if($("#chkphasestatus").is(':checked'))
{
	if($("#startdateforphase").val()=="")
	{
		$("#msgcontent").html("Enter Start date for Phase");
		$("#ValidationAlert").modal();	
		$("#startdateforphase").focus();
		return false;
	}
	if($("#lastdtforphase").val()=="")
	{
			$("#msgcontent").html("Enter Last date for Phase");
			$("#ValidationAlert").modal();	
			$("#lastdtforphase").focus();
			return false;
	}
	if(!(checkdate($("#startdateforphase").val(),$("#lastdtforphase").val(),'Phase'))) {

	return false;
	}
} 

var phasestatus ="";
if($("#chkphasestatus").is(':checked'))
phasestatus = "ON";
else
phasestatus = "OFF";

var parm = 'phase='+$.trim($("#txtphase").val())+'&phaselastdate='+$.trim($("#txtphaselastdate").val())+'&phasestatus='+phasestatus+'&startdateforphase='+$("#startdateforphase").val()+'&lastdtforphase='+$("#lastdtforphase").val()+'&lastdtforupdate='+$("#lastdtforupdate").val()

$.ajax({
type:"POST",
url:"addphase.php",
dataType:"json",
data:parm,
success: function(data)         
{
	 $("#msgcontent").html(data.msg);
	$("#ValidationAlert").modal();	
        location.reload();
    
}
});


}
function addtomeritlistValidity(){

 
if(!validinput()){
return false;
}
var parm = $("#frmadd").serialize()

$.ajax({
type:"POST",
url:"addtomeritlistValidity.php",
dataType:"json",
data:parm,
success: function(data)         
{
//alert(JSON.stringify(data))
    if(data.status==0)
    {
		 $("#msgcontent").html(data.msg);
		$("#ValidationAlert").modal();	
        
        displayRecord();
        clearAll();
    }
    else
    {
		 $("#msgcontent").html(data.msg);
		$("#ValidationAlert").modal();	
        					
    }
}
});


}

function displayRecord()
{
$("#basicInfo").html('')
$("#totalcount").html('')

var form = $("#frmfilter");
$.ajax({
type:"POST",
url:"getAllMLValidityList.php",
dataType:"json",
data:form.serialize(),
success: function(data)         
{
//alert(data)
    /*if(data.length>0)
    {
        */
        $("#basicInfo").html(data.str)
        $("#totalcount").html("Total Record : "+data.totalcount)
        
    //}
    
}
});
}


function loadRecord(phase,section,stream,subject)
{

$(".countdiv").html('');
$(".countdiv").hide();
var parm = 'phase='+phase+'&section='+section+'&stream='+stream+'&subject='+subject;
$.ajax({
type:"POST",
url:"getMLValidityListforEdit.php",
dataType:"json",
data:parm,
success: function(data)         
{
$('#addform').show(); 
 clearAll();
    if(data.length>0)
    {
    $('#addoption').hide(); 
	 $("#cbophase").val(data[0]["appphase"]);
	  $("#hdncbophase").val(data[0]["appphase"]);
	  fillSection(data[0]["appphase"],data[0]["appsection"]);
	  $("#hdncbosection").val(data[0]["appsection"]);
	 fillStreamUpdt(data[0]["appphase"],data[0]["appsection"],data[0]["appstream"]);
    //$("#cboStream").val(data[0]["appstream"]);
    $("#hdncboStream").val(data[0]["appstream"]);
    fillsubjectUpdt(data[0]["appphase"],data[0]["appsection"],data[0]["appstream"],data[0]["appsubjectcode"]);
    
    
	$("#cbophase").attr("disabled",true);
	$("#cbosection").attr("disabled",true);
    $("#cboStream").attr("disabled",true);
    $("#cboSubject").attr("disabled",true);
    $("#hdncboSubject").val(data[0]["appsubjectcode"]);
    $("#txtgenrankfrom").val(data[0]["GeneralRankFrom"]);
    $("#genstartdt").val(data[0]["GeneralStartDate"]);
    $("#genenddt").val(data[0]["GeneralStopDate"]);
    $("#txtgenrankto").val(data[0]["GeneralRankTo"]);
    $("#txtSCrankfrom").val(data[0]["SCRankfrom"]);
    $("#txtSCrankto").val(data[0]["SCRankTo"]);
    $("#SCstartdt").val(data[0]["SCStartDate"]);
    $("#SCenddt").val(data[0]["SCStopDate"]);
    $("#txtSTrankfrom").val(data[0]["STRankFrom"])
    $("#txtSTrankto").val(data[0]["STRankTo"]);
    $("#STstartdt").val(data[0]["STStartDate"]);
    $("#STenddt").val(data[0]["STStopDate"]);
	//alert(data[0]["CHRankFrom"]);
	$("#txtCHrankfrom").val(data[0]["CHRankFrom"]);
    $("#txtCHrankto").val(data[0]["CHRankTo"]);
	  $("#CHstartdt").val(data[0]["CHStartDate"]);
    $("#CHenddt").val(data[0]["CHStopDate"]);
	//alert(data[0]["CNIRankFrom"]);
	$("#txtCNIrankfrom").val(data[0]["CNIRankFrom"]);
    $("#txtCNIrankto").val(data[0]["CNIRankTo"]);
	  $("#CNIstartdt").val(data[0]["CNIStartDate"]);
    $("#CNIenddt").val(data[0]["CNIStopDate"]);
    $("#txtobcArankfrom").val(data[0]["OBCARankFrom"]);
    $("#txtobcArankto").val(data[0]["OBCARankTo"]);
    $("#obcAstartdt").val(data[0]["OBCAStartDate"]);
    $("#obcAenddt").val(data[0]["OBCAStopDate"]);
    $("#txtobcBrankfrom").val(data[0]["OBCBRankFrom"]);
    
    $("#txtobcBrankto").val(data[0]["OBCBRankTo"]);
    $("#obcBstartdt").val(data[0]["OBCBStartDate"]);
    $("#obcBenddt").val(data[0]["OBCBStopDate"]);

/* ================   PH (NORMAL) STARTS ================= */
    $("#txtPHrankfrom").val(data[0]["PHRankFrom"]);
        //$("#basicInfo").html(data)
    $("#txtPHrankto").val(data[0]["PHRankTo"]);
    $("#PHstartdt").val(data[0]["PHStartDate"]);
    $("#PHenddt").val(data[0]["PHStopDate"]);
/* ================   PH (NORMAL) ENDS ================= */

/* ================   PH (GEN) STARTS ================= */
    $("#txtPH_GENrankfrom").val(data[0]["PH_GENRankFrom"]);
        //$("#basicInfo").html(data)
    $("#txtPH_GENrankto").val(data[0]["PH_GENRankTo"]);
    $("#PH_GENstartdt").val(data[0]["PH_GENStartDate"]);
    $("#PH_GENenddt").val(data[0]["PH_GENStopDate"]);
/* ================   PH (GEN) ENDS ================= */

/* ================   PH (SC) STARTS ================= */
    $("#txtPH_SCrankfrom").val(data[0]["PH_SCRankFrom"]);
        //$("#basicInfo").html(data)
    $("#txtPH_SCrankto").val(data[0]["PH_SCRankTo"]);
    $("#PH_SCstartdt").val(data[0]["PH_SCStartDate"]);
    $("#PH_SCenddt").val(data[0]["PH_SCStopDate"]);
/* ================   PH (SC) ENDS ================= */

/* ================   PH (ST) STARTS ================= */
    $("#txtPH_STrankfrom").val(data[0]["PH_STRankFrom"]);
        //$("#basicInfo").html(data)
    $("#txtPH_STrankto").val(data[0]["PH_STRankTo"]);
    $("#PH_STstartdt").val(data[0]["PH_STStartDate"]);
    $("#PH_STenddt").val(data[0]["PH_STStopDate"]);
/* ================   PH (ST) ENDS ================= */

/* ================   PH (OBCA) STARTS ================= */
    $("#txtPH_OBCArankfrom").val(data[0]["PH_OBCARankFrom"]);
        //$("#basicInfo").html(data)
    $("#txtPH_OBCArankto").val(data[0]["PH_OBCARankTo"]);
    $("#PH_OBCAstartdt").val(data[0]["PH_OBCAStartDate"]);
    $("#PH_OBCAenddt").val(data[0]["PH_OBCAStopDate"]);
/* ================   PH (OBCA) ENDS ================= */

/* ================   PH (OBCB) STARTS ================= */
    $("#txtPH_OBCBrankfrom").val(data[0]["PH_OBCBRankFrom"]);
        //$("#basicInfo").html(data)
    $("#txtPH_OBCBrankto").val(data[0]["PH_OBCBRankTo"]);
    $("#PH_OBCBstartdt").val(data[0]["PH_OBCBStartDate"]);
    $("#PH_OBCBenddt").val(data[0]["PH_OBCBStopDate"]);
/* ================   PH (OBCB) ENDS ================= */



    
    displaytotal('txtgenrankfrom','txtgenrankto','gencount');
    displaytotal('txtSCrankfrom','txtSCrankto','sccount');
    displaytotal('txtSTrankfrom','txtSTrankto','stcount');
	 displaytotal('txtCHrankfrom','txtCHrankto','CHcount');
    displaytotal('txtCNIrankfrom','txtCNIrankto','CNIcount');
    displaytotal('txtobcArankfrom','txtobcArankto','obcAcount');
    displaytotal('txtobcBrankfrom','txtobcBrankto','obcBcount');

/* ================   PH (NORMAL) STARTS ================= */
    displaytotal('txtPHrankfrom','txtPHrankto','PHcount');
/* ================   PH (NORMAL) ENDS ================= */

/* ================   PH (GEN) STARTS ================= */
    displaytotal('txtPH_GENrankfrom','txtPH_GENrankto','PH_GENcount');
/* ================   PH (GEN) ENDS ================= */

/* ================   PH (SC) STARTS ================= */
    displaytotal('txtPH_GENrankfrom','txtPH_GENrankto','PH_GENcount');
/* ================   PH (SC) ENDS ================= */

/* ================   PH (ST) STARTS ================= */
    displaytotal('txtPH_SCrankfrom','txtPH_SCrankto','PH_SCcount');
/* ================   PH (ST) ENDS ================= */

/* ================   PH (OBCA) STARTS ================= */
    displaytotal('txtPH_OBCArankfrom','txtPH_OBCArankto','PH_OBCAcount');
/* ================   PH (OBCA) ENDS ================= */

/* ================   PH (OBCB) STARTS ================= */
    displaytotal('txtPH_OBCBrankfrom','txtPH_OBCBrankto','PH_OBCBcount');
/* ================   PH (OBCB) ENDS ================= */

    $("#addbutton").hide();
        
    $("#updtbutton").show();
    }
    
}
});
}

function updatetomeritlistValidity()
{
//alert(327)
if(!validinput())
return false;
var parm = $("#frmadd").serialize()

$.ajax({
type:"POST",
url:"updatetomeritlistValidity.php",
dataType:"json",
data:parm,
success: function(data)         
{
//alert(JSON.stringify(data))
    if(data.status==0)
    {
		$("#msgcontent").html(data.msg);
		$("#ValidationAlert").modal();	
       
        $("#frmadd")[0].reset();
		$("#cbophase").attr("disabled",false)
		$("#cbosection").attr("disabled",false)
		$("#cboStream").attr("disabled",false)
		$("#cboSubject").attr("disabled",false)
		$("#cboSubject").html('<option value="">Select</option>')
        $("#addbutton").show()
        $("#addoption").show()
        $("#updtbutton").hide()
        $('#addform').hide(); 
        displayRecord()
    }
    else
    {
        alert(data.msg)						
    }
}
});
}
function clearAll(){
$("#frmadd")[0].reset();
$("#cbophase").attr("disabled",false);
$("#cbosection").attr("disabled",false);
$("#cboStream").attr("disabled",false);
$("#cboSubject").attr("disabled",false);
$("#cboSubject").html('<option value="">Select</option>');

$("#gencount").html('0');
$("#sccount").html('0');
$("#stcount").html('0');
$("#CHcount").html('0');
$("#CNIcount").html('0');
$("#obcAcount").html('0');
$("#obcBcount").html('0');
// ================   PH STARTS =================  
$("#PHcount").html('0');
$("#PH_GENcount").html('0');
$("#PH_SCcount").html('0');
$("#PH_STcount").html('0');
$("#PH_OBCAcount").html('0');
$("#PH_OBCBcount").html('0');
// ================   PH ENDS =================  

$("#addbutton").show();
$("#updtbutton").hide();
}

function deletefromMLValidity(phase,section,stream,subject)
{
if (!confirm("Are you sure you want to delete this?")) return false;
var parm = 'phase='+phase+'&section='+section+'&stream='+stream+'&subject='+subject;
$.ajax({
type:"POST",
url:"DeletefromMLValidity.php",
dataType:"json",
data:parm,
success: function(data)         
{
	 $("#msgcontent").html(data.msg);
	$("#ValidationAlert").modal();	
 
    if(data.status==1)
    {
        displayRecord();
    }
    
}
});
}

 