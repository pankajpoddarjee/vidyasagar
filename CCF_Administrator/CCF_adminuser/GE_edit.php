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

 /* $LCCqry = "SELECT LCCSDMS as LCC,LCCCode from CU_LCCDetail;";
 
$LCCresult = $dbConn->query($LCCqry);

if($LCCresult) {
	while ($LCCrow=$LCCresult->fetch(PDO::FETCH_ASSOC)) {
					$LCCrecord[] = $LCCrow;
			}
} */


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
                    	<i class="fa fa-pencil-square-o"></i> Update Minor / CC / AEC   
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
                 <input type="hidden" id="hdnappsubject" name="hdnappsubject" value="<?php echo $record["appsubject"]?>">
                     <div class="row alert-warning mt-5 m-0 p-0 pt-4 img-thumbnail shadow-sm" id="HonoursGEInfo" style="display:none">
					 <div class="col-md-12 mb-3">
						<h4 class="" style="font-family:Oswald"><i class="fa-regular fa-pen-to-square"></i> Assign Minor Course</h4>
						<div class="border-bottom border-warning"></div>
						<div class="border-bottom border-warning" style="margin-top:1px"></div>
					</div>
            
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Minor 1 <span class="text-danger">*</span></span>
                                </div> 
                                <select class="custom-select" id="cboGE1subject" name="cboGE1subject"> 
                                	<option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        
                         
                        
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Minor 2 <span class="text-danger">*</span></span>
                                </div> 
                                <select class="custom-select" id="cboGE2subject" name="cboGE2subject"  >
                                	<option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        
                                                
                    </div>
                    
                    
     <div class="row alert-warning m-0 p-0 pt-4 img-thumbnail shadow-sm" id="GeneralGEInfo" style="display:none"> 
        	<div class="col-md-12 mb-3">
            	<h4 class="" style="font-family:Oswald"><i class="fa-regular fa-pen-to-square"></i> Assign Core Course &amp; Minor Course</h4>
                <div class="border-bottom border-warning"></div>
        		<div class="border-bottom border-warning" style="margin-top:1px"></div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label for="cboCore1subject">Core Subject 1 <span class="text-danger">*</span></label>
                    <select id="cboCore1subject" name="cboCore1subject" class="form-control" onchange="$('#cboSEC1subject').val(this.value)">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label for="cboCore2subject">Core Subject 2 <span class="text-danger">*</span></label>
                    <select id="cboCore2subject" name="cboCore2subject" class="form-control" onchange="$('#cboSEC2subject').val(this.value)">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label for="cboMinorsubject">Minor Subject <span class="text-danger">*</span></label>
                    <select id="cboMinorsubject" name="cboMinorsubject" class="form-control" onchange="$('#cboSEC3subject').val(this.value)">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>
             
        </div>
		
		
		<div class="row alert-warning m-0 p-0 pt-4 img-thumbnail shadow-sm" id="SECInfo" style="display:none">  
        	<div class="col-md-12 mb-3">
            	<h4 class="" style="font-family:Oswald"><i class="fa-regular fa-pen-to-square"></i> Assign Skill Enhancement Course [SEC]</h4>
                <div class="border-bottom border-warning"></div>
        		<div class="border-bottom border-warning" style="margin-top:1px"></div>
            </div>
             
            
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label for="cboSEC1subject">SEC 1 <span class="text-danger">&dagger;</span></label>
					 <select id="cboSEC1subject" name="cboSEC1subject" class="form-control">
                     <option value="">Select</option>
                    </select>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label for="cboSEC2subject">SEC 2 <span class="text-danger">&dagger;</span></label>
                   <select id="cboSEC2subject" name="cboSEC2subject" class="form-control">
                     <option value="">Select</option>
                    </select>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label for="cboSEC3subject">SEC 3 <span class="text-danger">&dagger;</span></label>
                   <select id="cboSEC3subject" name="cboSEC3subject" class="form-control">
                     <option value="">Select</option>
                    </select>
                </div>
            </div>
  
        </div>
		
		<div class="row mt-5 alert-success m-0 p-0 pt-4 img-thumbnail shadow-sm" id="CVACInfo" style="display:none">  
        	<div class="col-md-12 mb-3">
            	<h4 class="" style="font-family:Oswald"><i class="fa-regular fa-pen-to-square"></i> Assign Common Value Added Course [CVAC]</h4>
                <div class="border-bottom border-success"></div>
        		<div class="border-bottom border-success" style="margin-top:1px"></div>
            </div>
            
			<div class="col-md-4 mb-3">
                <div class="form-group">
                    <label for="cboCVAC13subject">CVAC 1 & 3 <span class="text-danger">*</span></label>
                    <select id="cboCVAC13subject" name="cboCVAC13subject" class="form-control">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label for="cboCVAC2subject">CVAC 2 <span class="text-danger">*</span></label>
                    <select id="cboCVAC2subject" name="cboCVAC2subject" class="form-control">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label for="cboCVAC4subject">CVAC 4 <span class="text-danger">*</span></label>
                    <select id="cboCVAC4subject" name="cboCVAC4subject" class="form-control">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>
        </div>
		
		<div class="row mt-5 alert-info m-0 p-0 pt-4 img-thumbnail shadow-sm" id="OtherGEInfo" style="display:none"> 
            
            <div class="col-md-12 mb-3">
            	<h4 class="" style="font-family:Oswald"><i class="fa-regular fa-pen-to-square"></i> Assign Inter Disciplinary Course [IDC]</h4>
                <div class="border-bottom border-info"></div>
        		<div class="border-bottom border-info" style="margin-top:1px"></div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label for="cboIDC1subject">IDC 1 <span class="text-danger">*</span></label>
                    <select id="cboIDC1subject" name="cboIDC1subject" class="form-control">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label for="cboIDC2subject">IDC 2 <span class="text-danger">*</span></label>
                    <select id="cboIDC2subject" name="cboIDC2subject" class="form-control">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label for="cboIDC3subject">IDC 3 <span class="text-danger">*</span></label>
                    <select id="cboIDC3subject" name="cboIDC3subject" class="form-control">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>
        </div>
                     
			<div class="row mt-5 alert-primary m-0 p-0 pt-4 img-thumbnail shadow-sm" id="AECCInfo" style="display:none">
			<div class="col-md-12 mb-3">
            	<h4 class="" style="font-family:Oswald"><i class="fa-regular fa-pen-to-square"></i> Ability Enhancement Course [AEC]</h4>
                <div class="border-bottom border-primary"></div>
        		<div class="border-bottom border-primary" style="margin-top:1px"></div>
            </div>
				<div class="col-md-4">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">AEC 1 <span class="text-danger">&dagger;</span></span>
						</div>                        
						<select class="custom-select">
							<option value="" selected>Compulsory English</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">AEC 2 <span class="text-danger">*</span></span>
						</div>
						<select class="custom-select" id="cboLanguage" name="cboLanguage">
							<option value="">Select</option>
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