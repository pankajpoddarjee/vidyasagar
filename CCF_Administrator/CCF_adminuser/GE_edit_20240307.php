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
if($record["courseCode"]=='10' || $record["courseCode"]=='13'){
$actionurl ='ViewCourse.php';	
} else {
$actionurl ='GE_editNext.php';

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
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> | Update GE / CC / AECC / LCC</title>
<?php include("../head_includes.php");?>
<style type="text/css">	
.footer{background:#039; padding:0; margin:0; width:100%}
/*@media only screen and (min-width: 1050px) {.footer{position:fixed; bottom:0; padding:0}}*/
</style>
</head>
<body  onload="loadGEDetail('<?php echo $collegerollno;?>');">
    <?php include("headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("headermenu_top.php");?>
         
        <div class="container-fluid">
        	<div class="row">
            	<div class="col-md-12">
                    <h5 class="text-danger border-bottom mb-3 pb-2">
                    	<i class="fa fa-pencil-square-o"></i> Update GE / CC / AECC / LCC
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
                
                <div class="col-md-12">
                    <hr>
                </div>
            </div>            
                
                <div id="courseDetail"><!--	NOT FOR DESIGN	-->
                <form id="coursefrm" name="coursefrm" action="" method="post">
                <input type="hidden" id="hdncollegerollno" name="hdncollegerollno" value="<?php  echo $collegerollno?>">
                <input type="hidden" id="hdncourseCode" name="hdncourseCode" value="<?php echo $record["courseCode"]?>">
                    
                    <div class="row mt-3" id="HonoursGEInfo" style="display:none;">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">GE 1 <span class="text-danger">*</span></span>
                                </div> 
                                <select class="custom-select" id="cboGE1subject" name="cboGE1subject" onchange="dispalygensubject(this.value,'GE1subjectcode')">
                                	<option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">GE 1 Code <span class="text-danger">&dagger;</span></span>
                                </div>                        
                                <input class="form-control" type="text" id="GE1subjectcode" name="GE1subjectcode" readonly size="10">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">GE 2 <span class="text-danger">*</span></span>
                                </div> 
                                <select class="custom-select" id="cboGE2subject" name="cboGE2subject" onchange="dispalygensubject(this.value,'GE2subjectcode')">
                                	<option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">GE 2 Code <span class="text-danger">&dagger;</span></span>
                                </div>                        
                                <input class="form-control" type="text" id="GE2subjectcode" name="GE2subjectcode" readonly size="10">
                            </div>
                        </div>                        
                    </div>
                    
                    
                    <div class="row mt-3" id="GeneralGEInfo" style="display:none;">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">General Subject 1 <span class="text-danger">*</span></span>
                                </div> 
                                <select class="custom-select" id="cboGeneral1subject" name="cboGeneral1subject" onchange="dispalygensubject(this.value,'General1subjectcode')">
                                	<option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">General Subject 1 Code <span class="text-danger">&dagger;</span></span>
                                </div>                        
                                <input class="form-control" type="text" id="General1subjectcode" name="General1subjectcode" readonly size="10">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">General Subject 2 <span class="text-danger">*</span></span>
                                </div> 
                                <select class="custom-select" id="cboGeneral2subject" name="cboGeneral2subject" onchange="dispalygensubject(this.value,'General2subjectcode')">
                                	<option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">General Subject 2 Code <span class="text-danger">&dagger;</span></span>
                                </div>                        
                                <input class="form-control" type="text" id="General2subjectcode" name="General2subjectcode" readonly size="10">
                            </div>
                        </div>
                        
                        <div class="col-md-6" id="GeneralGE3Info" style="display:none">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">General Subject 3 <span class="text-danger">*</span></span>
                                </div> 
                                <select class="custom-select" id="cboGeneral3subject" name="cboGeneral3subject" onchange="dispalygensubject(this.value,'General3subjectcode')">
                                	<option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6" id="GeneralGE3Info" style="display:none">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">General Subject 3 Code <span class="text-danger">&dagger;</span></span>
                                </div>                        
                                <input class="form-control" type="text" id="General3subjectcode" name="General3subjectcode" readonly size="10">
                            </div>
                        </div>                        
                    </div>
                    
                    
                    <div class="row" id="GeneralElectiveInfo" style="display:none;">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">General Elective <span class="text-danger">*</span></span>
                                </div>
                                <select class="custom-select" id="cboGEGeneralsubject" name="cboGEGeneralsubject" onchange="dispalygensubject(this.value,'GEGeneralsubjectcode')">
                                	<option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">General Elective Code <span class="text-danger">&dagger;</span></span>
                                </div>                        
                                <input class="form-control" type="text" id="GEGeneralsubjectcode" name="GEGeneralsubjectcode" readonly size="10">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>
                    
                    
                    <div class="row mt-3" id="GeneralLCCInfo" style="display:none;">
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">LCC 2 <span class="text-danger">*</span></span>
                                </div>
                                <select class="custom-select" id="cboLCCSub" name="cboLCCSub" onchange="displayLCCCode(this.value)">
                                    <option value="">Select</option>
                                    <?php foreach($LCCrecord as $LCCrec) {?>
                                    <option value="<?php echo $LCCrec["LCC"]?>"><?php echo $LCCrec["LCC"]?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">LCC 2 Code <span class="text-danger">&dagger;</span></span>
                                </div>                        
                                <input class="form-control" type="text" id="txtLCCCode" name="txtLCCCode" readonly>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">LCC 1 <span class="text-danger">&dagger;</span></span>
                                </div>                        
                                <select class="custom-select">
                                	<option value="" selected>ENGC</option>
                                </select>
                            </div>
                        </div>
                    </div>
                                        
                    
                    <div class="row" id="AECCInfo" style="display:none;">
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">AECC 1 <span class="text-danger">*</span></span>
                                </div>
                                <select class="custom-select" id="cboLanguage" name="cboLanguage" onchange="displayMIL(this.value)">
                                	<option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">AECC 1 Code <span class="text-danger">&dagger;</span></span>
                                </div>                        
                                <input class="form-control" type="text" id="txtMIL" name="txtMIL" readonly>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">AECC 2 <span class="text-danger">&dagger;</span></span>
                                </div>                        
                                <select class="custom-select">
                                	<option value="" selected>ENVS</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-12 text-center">
                            <a class="btn btn-dark btn-sm" href="javascript:void(0)" onclick="javascript: $('#frmback').submit();">
                                <i class="fa fa-arrow-circle-o-left"></i> Go Back
                            </a>
                            
                            <button type="button" class="btn btn-success" id="btnupdtcourse" name="btnupdtcourse" onclick="updateGE()">
                                <i class="fa fa-check-square-o"></i> Save & Update
                            </button>
                            
                            <button type="button" class="btn btn-dark" id="btnupdtnext" name="btnupdtnext" onclick="javascript: $('#frmnext').submit();" style="display:none">
                                Go to Next Step <i class="fa fa-long-arrow-right"></i>
                            </button>
                            
                            <button type="button" class="btn btn-danger" id="btncancel2" name="btncancel2" onclick="javascript: history.go(0);  location.reload(true);">
                                <i class="fa fa-repeat"></i> Reset Data
                            </button>
                        </div>
                    </div>
                    </form>
                    
                    <form id="frmnext" name="frmnext" action="<?php echo $actionurl;?>" method="post">
                        <input type="hidden" id="hdncollegerollno" name="hdncollegerollno" value="<?php echo $collegerollno;?>" />  
                         <input type="hidden" id="txtRollnoforcourse" name="txtRollnoforcourse" value="<?php echo $collegerollno;?>" /> 
                    </form>
                    
                    <form id="frmback" name="frmback" action="ViewCourse.php" method="post">
                    	<input type="hidden" id="txtRollnoforcourse" name="txtRollnoforcourse" class="form-control" maxlength="10" value="<?php echo $collegerollno;?>">
                    </form>
                </div><!--	NOT FOR DESIGN	-->    
            
        </div>

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