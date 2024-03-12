<?php 
include("config.php");

$collegerollno =  $_POST["txtRollnoforcourse"];
 
  $qry =	"select applicationNo,name,st.collegeRollNo,presentsemester,dob,sex,PH,	caste,	stateofdomicile,scstStateOther,applcntMobNo,alternateMobileNo,hasWhatsAppno,WhatsAppno,	applcntEmail,fathername,motherName,appstream,appsubject,isnull(CuRegNo,'') as CuRegNo,isnull(CuRollNo,'') as CuRollNo,aadharNo,ccm.streamDisplay, ccm.streamType,ccm.subjectName,isnull(photo,'') as photo, isnull(signature,'') as signature  from studentmaster st JOIN College_CourseMaster ccm ON ccm.subjectcode=st.appsubjectcode  where st.collegeRollNo='".$collegerollno."'";
 
$qryresult = $dbConn->query($qry);

if($qryresult) {
 	while($row=$qryresult->fetch(PDO::FETCH_ASSOC))
	{
		foreach ($row as $colNum=>$value ){
					$record[$colNum] = trim($value);
				}
	}
 }
 
 /* print_r($courserecord);
 exit; */

$dbConn = NULL;

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> | Search Candidate</title>
<?php include("../head_includes.php");?>
<style type="text/css">	
.footer{background:#039; padding:0; margin:0; width:inherit}
/*@media only screen and (min-width: 1050px) {*/.footer{position:fixed; bottom:0; padding:0}/*}*/
</style>
</head>
<body  onload="loadcourseDetail('<?php echo $collegerollno;?>');">
    <?php include("headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("headermenu_top.php");?>
         
        <div class="container">
        	<div class="row">
            	<div class="col-md-12">
                    <h5 class="text-danger border-bottom mb-3 pb-2">
                    	<i class="fa fa-pencil-square-o"></i> Update Semester Course Detail
                    </h5>
                </div>
                
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Name <span class="text-danger">&dagger;</span></span>
                        </div>
                        <span class="text-primary form-control"><?php echo $record["name"];?></span>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">College Roll No. <span class="text-danger">&dagger;</span></span>
                        </div>
                        <span class="text-primary form-control"><?php echo $record["collegeRollNo"];?></span>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Stream <span class="text-danger">&dagger;</span></span>
                        </div>
                        <span class="text-primary form-control"><?php echo $record["streamDisplay"];?></span>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Subject <span class="text-danger">&dagger;</span></span>
                        </div>
                        <span class="text-primary form-control"><?php echo $record["subjectName"];?></span>
                    </div>
                </div>
            </div>
            
            <div class="row">
            	
                
 <div id="courseDetail" >
<div style="margin:-11px 0 0 0; position:relative;"><img src="../images/arrow-top.png" style="padding:0 0 0 320px" /></div>
<form id="frmnext" name="frmnext" action="GE_edit.php" method="post">
	<input type="hidden" id="txtcollegeRollno" name="txtcollegeRollno" value="" />  
</form>
<form id="coursefrm" name="coursefrm" action="" method="post">
<input type="hidden" id="hdncollegerollno" name="hdncollegerollno" value="<?php  echo $collegerollno?>"  />
<input type="hidden" id="hdnpresentstream" name="hdnpresentstream" value="<?php  echo $record["appstream"];?>"  />
<input type="hidden" id="hdnpresentsubject" name="hdnpresentsubject" value="<?php  echo $record["appsubject"]?>"  />
<table width="100%" border="1" bordercolor="#cccccc" cellpadding="5" cellspacing="0" align="center" style="text-align: left; border-collapse:collapse; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
<tr>
    <td>
         Section : 
        <select id="cboappsection" name="cboappsection" onchange="fillcourse(this.value,'')"> <!--fillappsubject('',this.value,'')-->
        <option value="">Select</option>
        </select> 
        
    </td>
</tr>
<tr>
    <td>
        Stream : 
        <select id="cboappstream" name="cboappstream" onchange="fillappsubject(this.value,'','');displaycoursecode(this.value);">
        <option value="">Select</option>
        </select> 
        Course Code : <input type="text" id="coursecode" name="coursecode"   readonly="readonly"  size="10"/>
    </td>
</tr>
<tr>
    <td>
        Subject (Honours Subject) Code : 
        <select id="cboappsubject" name="cboappsubject" onchange="displayhonsub(this.value)">
        <option value="">Select</option>
        </select> 
        <input type="text" name="txtappsubjectcode" id="txtappsubjectcode" readonly    size="10"/>
    </td>
</tr>
<tr>
    <td>
        <a href="javascript: void(0)" onclick="getNewRollNo()">Get New College Roll No</a>
    </td>
</tr>
<tr>
    <td>
        New College Roll No : 
        <input type="text" id="txtCollrollno_prefix" name="txtCollrollno_prefix" />  Serial No :<input type="text" id="txtCollrollno_srlno" name="txtCollrollno_srlno" maxlength="4" /> <span id="suggested_Collrollno"></span> 
        
    </td>
</tr>
 
<!--<tr>
    <td>
        Subject : 
        <select id="cboappsubject" name="cboappsubject" onchange="displayAppsubCode(this.value)">
        <option value="">Select</option>
        </select> 
        <input type="text" name="txtappsubjectcode" id="txtappsubjectcode" readonly="readonly"   size="10"/>
    </td>
</tr>-->


</table>

<div style="background:#33b7ff; padding:1px; margin-top:7px"></div>
<table width="100%" border="1" bordercolor="#cccccc" cellpadding="7" cellspacing="0" align="center" style="text-align: left; border-collapse:collapse; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; margin-top:2px">
    <tr>
        <td align="center" colspan="4" style="background:#33b7ff">
        	<input type="button" id="btnupdtcourse" name="btnupdtcourse" value="Update" onclick="updateMainCourse()" style="cursor:pointer; padding:8px 15px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#000000; border:1px solid #27a3e6" />
			<!--<input type="button" id="btnupdtnext" name="btnupdtnext" value="Next Step" onclick="javascript: $('#frmnext').submit();" style="cursor:pointer; padding:8px 15px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#000000; border:1px solid #27a3e6;" />--> 
			<input type="button" id="btncancel2" name="btncancel2" value="Cancel" onclick="javascript: history.go(0);  location.reload(true);" style="cursor:pointer; padding:8px 15px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#000000; border:1px solid #27a3e6" />
        </td>
    </tr>
</table>
</form>



</div>
            </div>            
              
        </div>
		 
		 
		<br/> 
    	<!--MODAL START-->
        <div class="modal fade" id="ValidationAlert" tabindex="-1" role="dialog" aria-labelledby="ValidationAlertTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="ShowValidationAlert"><?php echo MODAL_VALIDATION_TEXT;?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-left" id="msgcontent">
                    	
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--MODAL END-->
        <?php include("../footer.php");?>
    </div>	
    <?php include("../footer_includes.php");?>    
</body>
</html>
<script src="adminuser_js/editform.js"></script>