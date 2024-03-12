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
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> | Update Course Detail</title>
<?php include("../head_includes.php");?>
<style type="text/css">	
.footer{background:#039; padding:0; margin:0; width:100%}
/*@media only screen and (min-width: 1050px) {.footer{position:fixed; bottom:0; padding:0}}*/
</style>
</head>
<body  onload="loadcourseDetail('<?php echo $collegerollno;?>');">
    <?php include("headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("headermenu_top.php");?>
         
        <div class="container-fluid">
        	<div class="row">
            	<div class="col-md-12">
                    <h5 class="text-danger border-bottom mb-3 pb-2">
                    	<i class="fa fa-pencil-square-o"></i> Update Course Detail
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
            
            <form id="frmnext" name="frmnext" action="GE_edit.php" method="post">
                <input type="hidden" id="txtcollegeRollno" name="txtcollegeRollno" value="">  
            </form>
            
            <form id="coursefrm" name="coursefrm" action="" method="post">
                <input type="hidden" id="hdncollegerollno" name="hdncollegerollno" value="<?php  echo $collegerollno?>">
                <input type="hidden" id="hdnpresentstream" name="hdnpresentstream" value="<?php  echo $record["appstream"];?>">
                <input type="hidden" id="hdnpresentsubject" name="hdnpresentsubject" value="<?php  echo $record["appsubject"]?>">
                
                <div id="courseDetail"><!--	NOT FOR DESIGN	-->
                
                <div class="row mt-3">                
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Section <span class="text-danger">*</span></span>
                            </div>                        
                            <select class="custom-select" id="cboappsection" name="cboappsection" onchange="fillcourse(this.value,'')"> <!--fillappsubject('',this.value,'')-->
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">                    
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Stream <span class="text-danger">*</span></span>
                            </div>                        
                            <select class="custom-select" id="cboappstream" name="cboappstream" onchange="fillappsubject(this.value,'','');displaycoursecode(this.value);">
                            	<option value="">Select</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Course Code <span class="text-danger">&dagger;</span></span>
                            </div>                        
                            <input class="form-control" type="text" id="coursecode" name="coursecode" readonly size="10">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Subject <span class="text-danger">*</span></span>
                            </div>  
                            <select class="custom-select" id="cboappsubject" name="cboappsubject" onchange="displayhonsub(this.value)">
                            	<option value="">Select</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Subject Code <span class="text-danger">&dagger;</span></span>
                            </div>                        
                            <input class="form-control" type="text" id="txtappsubjectcode" name="txtappsubjectcode" readonly size="10">
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <hr>
                    </div>
            	</div>
                
                <div class="row">
                	<div class="col-md-6 mb-3 text-center">
                    	<a class="btn btn-info btn-block" href="javascript: void(0)" onclick="getNewRollNo()"><i class="fa fa-refresh"></i> Generate New College Roll No</a>
                    </div>
                	<div class="col-md-6 text-center">
                    	<!--<p class="alert-info" id="suggested_Collrollno"></p>-->
                    	<p class="bg-warning p-2 rounded" href="javascript: void(0)" id="suggested_Collrollno"></p>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">New College Roll No. <span class="text-danger">*</span></span>
                            </div>                        
                            <input class="form-control" type="text" id="txtCollrollno_prefix" name="txtCollrollno_prefix">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Serial No. <span class="text-danger">*</span></span>
                            </div>                        
                            <input class="form-control" type="text" id="txtCollrollno_srlno" name="txtCollrollno_srlno" maxlength="4">
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <hr>
                    </div>
            	</div>
                
                <div class="row">
                    <div class="col-md-12 text-center">
                    	<a class="btn btn-dark btn-sm" href="javascript:void(0)" onclick="javascript: $('#frmback').submit();">
                            <i class="fa fa-arrow-circle-o-left"></i> Go Back
                        </a>
                                            
                        <button type="button" class="btn btn-success" id="btnupdtcourse" name="btnupdtcourse" onclick="updateMainCourse()">
                        	<i class="fa fa-check-square-o"></i> Save & Update
                        </button>
                        
                        <!--<button type="button" class="btn btn-dark" id="btnupdtnext" name="btnupdtnext" onclick="javascript: $('#frmnext').submit();">
                        	Go to Next Step <i class="fa fa-long-arrow-right"></i>
                        </button>-->
                        
                        <button type="button" class="btn btn-danger" id="btncancel2" name="btncancel2" onclick="javascript: history.go(0);  location.reload(true);">
                        	<i class="fa fa-repeat"></i> Reset Data
                        </button>
                    </div>
            	</div>
                
               </div><!--	NOT FOR DESIGN	-->
            </form>
            
            <form id="frmback" name="frmback" action="ViewCourse.php" method="post">
			<input type="hidden" id="txtRollnoforcourse" name="txtRollnoforcourse" class="form-control" maxlength="10" value="<?php echo $collegerollno;?>">
			</form>
 
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