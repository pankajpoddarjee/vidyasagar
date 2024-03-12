<?php 
include("config.php");

 
$collegerollno =  $_POST["txtcollegeRollno"];
 
  $qry =	"select applicationNo,name,st.collegeRollNo,presentsemester,dob,sex,PH,	caste,	stateofdomicile,scstStateOther,applcntMobNo,alternateMobileNo,hasWhatsAppno,WhatsAppno,	applcntEmail,fathername,motherName,courseCode,appstream,appsubject,isnull(CuRegNo,'') as CuRegNo,isnull(CuRollNo,'') as CuRollNo,aadharNo,ccm.streamDisplay, ccm.streamType,ccm.subjectName,isnull(photo,'') as photo, isnull(signature,'') as signature  from studentmaster st JOIN College_CourseMaster ccm ON ccm.subjectcode=st.appsubjectcode  and ccm.stream=st.appstream JOIN CU_course course ON course.stream=st.appstream where st.collegeRollNo='".$collegerollno."'";
 
$qryresult = $dbConn->query($qry);

if($qryresult) {
 	while($row=$qryresult->fetch(PDO::FETCH_ASSOC))
	{
		foreach ($row as $colNum=>$value ){
					$record[$colNum] = trim($value);
				}
	}
 }

 $LCCqry = "SELECT LCCSDMS as LCC,LCCCode from CU_LCCDetail;";
 
$LCCresult = $dbConn->query($LCCqry);

if($LCCresult) {
	while ($LCCrow=$LCCresult->fetch(PDO::FETCH_ASSOC)) {
					$LCCrecord[] = $LCCrow;
			}
}

$LCCresult = NULL;

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
<body  onload="loadGEDetail('<?php echo $collegerollno;?>');">
    <?php include("headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("headermenu_top.php");?>
         
        <div class="container">
        	<div class="row">
            	<div class="col-md-12">
                    <h5 class="text-danger border-bottom mb-3 pb-2">
                    	<i class="fa fa-search"></i> Candidate Course Detail
                    </h5>
                </div>
				<div class="col-md-12">
                   <table class="table table-bordered table-striped shadow">
                         
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td><?php echo $record["name"];?></td>
                            </tr>
							<tr>
                                <td>College Roll No.</td>
                                <td><?php echo $record["collegeRollNo"];?>
								<input type="hidden" id="hdncollegerollno" name="hdncollegerollno" value="<?php echo $collegerollno?>" /></td>
                            </tr>
							<tr>
                                <td>Subject</td>
                                <td colspan="3"><?php echo $record["streamDisplay"];?> | <?php echo $record["subjectName"];?></td>
                            </tr>
						</tbody>
					</table>
                </div>
 <div id="courseDetail" >

<form id="coursefrm" name="coursefrm" action="" method="post">
<input type="hidden" id="hdncollegerollno" name="hdncollegerollno" value="<?php  echo $collegerollno?>"  />
<input type="hidden" id="hdncourseCode" name="hdncourseCode" value="<?php echo $record["courseCode"]?>"  />
<table width="100%" border="1" bordercolor="#cccccc" cellpadding="5" cellspacing="0" align="center" style="text-align: left; border-collapse:collapse; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
 
 
<tr id="HonoursGEInfo" style="display:none;">
<td>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align: left;" align="center" >
        <tr>
            <td style="padding:0 0 5px 0">
            	GE 1 : 
                <select id="cboGE1subject" name="cboGE1subject" onchange="dispalygensubject(this.value,'GE1subjectcode')">
                <option value="">Select</option>
                </select>
                <input type="text" id="GE1subjectcode" name="GE1subjectcode" readonly="readonly" size="10" />
            </td>
        </tr>
        <tr>
            <td style="padding:0 0 5px 0">
            	GE 2 : 
                <select id="cboGE2subject" name="cboGE2subject" onchange="dispalygensubject(this.value,'GE2subjectcode')">
                <option value="">Select</option>
                </select>
                <input type="text" id="GE2subjectcode" name="GE2subjectcode" readonly="readonly" size="10"  />
            </td>
        </tr>
        
    </table>      
</td>
</tr>
 

<?php //if($record["courseCode"]=='11' || $record["courseCode"]=='12' ) {?>
<!--|| $record["courseCode"]=='13'-->

<tr id="GeneralGEInfo" style="text-align:left; display:none">
<td>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align: left;" align="center">
        <tr>
            <td>
            	General Subject 1 : 
                <select id="cboGeneral1subject" name="cboGeneral1subject" onchange="dispalygensubject(this.value,'General1subjectcode')">
                <option value="">Select</option>
                </select>
                <input type="text" id="General1subjectcode" name="General1subjectcode" readonly="readonly" size="10"/>
            </td>
        </tr>
        <tr>
            <td>
            	General Subject 2 :
                <select id="cboGeneral2subject" name="cboGeneral2subject" onchange="dispalygensubject(this.value,'General2subjectcode')">
                <option value="">Select</option>
                </select>
                <input type="text" id="General2subjectcode" name="General2subjectcode" readonly="readonly" size="10"/>
            </td>
        </tr>
          <?php //if($record["courseCode"]=='12'){?> 
        <tr id="GeneralGE3Info" style="display:none">
            <td>
            	General Subject 3 :
                <select id="cboGeneral3subject" name="cboGeneral3subject" onchange="dispalygensubject(this.value,'General3subjectcode')">
                <option value="">Select</option>
                </select>
                <input type="text" id="General3subjectcode" name="General3subjectcode" readonly="readonly" size="10"/>
            </td>
        </tr> 
        <?php //}?> 
    </table>      
</td>
</tr>
<?php //} ?>

<?php //if($record["courseCode"]=='11'){?>
<tr id="GeneralElectiveInfo" style="display:none">
    <td>
        General Elective : 
        <select id="cboGEGeneralsubject" name="cboGEGeneralsubject" onchange="dispalygensubject(this.value,'GEGeneralsubjectcode')">
        <option value="">Select</option>
        </select>
        <input type="text" id="GEGeneralsubjectcode" name="GEGeneralsubjectcode" readonly="readonly" size="10" />
    </td>
</tr>
<tr  id="GeneralLCCInfo" style="display:none">
<td>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align: left" align="center">
        <tr>
            <td style="border-right:1px solid #e0e0e0">
           	LCC2 : 
            <select id="cboLCCSub" name="cboLCCSub" onchange="displayLCCCode(this.value)">
            <option value="">Select</option>
            <?php foreach($LCCrecord as $LCCrec) {?>
            <option value="<?php echo $LCCrec["LCC"]?>"><?php echo $LCCrec["LCC"]?></option>
            <?php }?>
            </select> 
            <input type="text" id="txtLCCCode" name="txtLCCCode"  style="width:20%" /></td>           
            <td style="padding-left:5px">LCC1 : ENGC</td>
        </tr>
    </table>
</td>
</tr>
<?php //}?>
<?php //if($record["courseCode"]!='18'){?>

<tr id="AECCInfo" style="display:none;">
<td>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align: left;" align="center"  >
        <tr>
            <td style="border-right:1px solid #e0e0e0">
            AECC1 : 
            <select id="cboLanguage" name="cboLanguage" onchange="displayMIL(this.value)">
            <option value="">Select</option>
            </select> <input type="text" id="txtMIL" name="txtMIL"  style="width:20%" /></td>
			
            <!--<td style="padding:0 0 0 5px"><span id="compulsaryEng"><?php echo ($record["stream"]=='BCOM'?'ENGC':'ENGC') ?></span></td>-->
            <td style="padding-left:5px">ENVS</td>
        </tr>
    </table>
</td>
</tr>
<?php //}?>
</table>

<div style="background:#33b7ff; padding:1px; margin-top:7px"></div>
<table width="100%" border="1" bordercolor="#cccccc" cellpadding="7" cellspacing="0" align="center" style="text-align: left; border-collapse:collapse; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; margin-top:2px">
    <tr>
        <td align="center" colspan="4" style="background:#33b7ff">
        	<input type="button" id="btnupdtcourse" name="btnupdtcourse" value="Update" onclick="updateGE()" style="cursor:pointer; padding:8px 15px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#000000; border:1px solid #27a3e6" /> 
			<input type="button" id="btnupdtnext" name="btnupdtnext" value="Next Step" onclick="javascript: $('#frmnext').submit();" style="cursor:pointer; padding:8px 15px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#000000; border:1px solid #27a3e6; display:none " /> 
			<input type="button" id="btncancel2" name="btncancel2" value="Cancel" onclick="javascript: history.go(0);  location.reload(true);" style="cursor:pointer; padding:8px 15px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#000000; border:1px solid #27a3e6" />
        </td>
    </tr>
</table>
</form>
<form id="frmnext" name="frmnext" action="GE_editNext.php" method="post">
	<input type="hidden" id="hdncollegerollno" name="hdncollegerollno" value="<?php echo $collegerollno;?>" /> 
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