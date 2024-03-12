<?php 
include("config.php");

$collegerollno =  $_POST["hdncollegerollno"];
 $record =array();
   $qry =	"select applicationNo,name,st.collegeRollNo,presentsemester,dob,sex,  applcntMobNo, courseCode,appstream,appsubject,GE1,GE2,ccm.streamDisplay, ccm.streamType,ccm.subjectName,isnull(photo,'') as photo, isnull(signature,'') as signature  from studentmaster st JOIN College_CourseMaster ccm ON ccm.subjectcode=st.appsubjectcode and ccm.stream=st.appstream JOIN CU_course course ON course.stream=st.appstream where st.collegeRollNo='".$collegerollno."'";
 
$qryresult = $dbConn->query($qry);

if($qryresult) {
 	while($row=$qryresult->fetch(PDO::FETCH_ASSOC))
	{
		foreach ($row as $colNum=>$value ){
					$record[$colNum] = trim($value);
				}
	}
 }
 
 

 $courserecord = array();
 
    $courseqry	=	"select  collegeRollno,semester,stream,subject,subjectcode,	isnull(CoreCourse1,'') as CoreCourse1,	isnull(CoreCourse2,'') CoreCourse2,	isnull(CoreCourse3,'') as CoreCourse3,	isnull(generalCourse,'') as generalCourse,isnull(LCC,'') as LCC,isnull(DSE1,'') as DSE1,isnull(DSE2,'') as DSE2, isnull(DSE3,'') as DSE3,isnull(AECC,'') as AECC,isnull(SEC,'') as SEC from studentSemesterCourse where  collegeRollNo='".$collegerollno."'";
 
 
$courseqryresult = $dbConn->query($courseqry);

if($courseqryresult) {
 	while($courserow=$courseqryresult->fetch(PDO::FETCH_ASSOC))
	{
		$courserecord[] = $courserow;
	}
 }
   
 $headerarr =  array( 'semester'=>'Semester','CoreCourse1'=>'Core Course 1','CoreCourse2'=>'Core Course 2','CoreCourse3'=>'Core Course 3','generalCourse'=>'General Course','LCC'=>'LCC','DSE1'=>'DSE 1','DSE2'=>'DSE 2','DSE3'=>'DSE 3','AECC'=>'AECC','SEC'=>'SEC');
 	
 $courseqryresult = NULL;
 
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
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> | Update Semester Course</title>
<?php include("../head_includes.php");?>
<style type="text/css">	
.footer{background:#039; padding:0; margin:0; width:100%}
@media only screen and (min-width: 1367px) {.footer{position:fixed; bottom:0; padding:0}}
</style>
</head>
<body onload="loadGESemDetail('<?php echo $collegerollno;?>');">
    <?php include("headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("headermenu_top.php");?>
         
        <div class="container-fluid">
        	
            <div class="row">
            	<div class="col-md-12">
                    <h5 class="text-danger border-bottom mb-3 pb-2">
                    	<i class="fa fa-pencil-square-o"></i> Update Semester Course
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
            <input type="hidden" id="hdncollegerollno" name="hdncollegerollno" value="<?php  echo $collegerollno?>"  />
            <input type="hidden" id="hdncourseCode" name="hdncourseCode" value="<?php echo $record["courseCode"]?>"  />
            <?php if($record["courseCode"]=='08' || $record["courseCode"]=='09' || $record["courseCode"]=='10' || $record["courseCode"]=='14' || $record["courseCode"]=='15' || $record["courseCode"]=='16') {?>
            
            	<div class="row mt-3" id="HonoursGEInfo">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">GE 1 <span class="text-danger">&dagger;</span></span>
                            </div> 
                            <input class="form-control" type="text" value="<?php echo $record["GE1"];?>" readonly size="10">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">GE 2 <span class="text-danger">&dagger;</span></span>
                            </div>                        
                            <input class="form-control" type="text" value="<?php echo $record["GE2"];?>" readonly size="10">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">GE Sem 1 <span class="text-danger">*</span></span>
                            </div>                        
                            <select class="custom-select" id="cboGESem1subject" name="cboGESem1subject" onchange="dispalygensubject(this.value,'GESem1subjectcode')">
                                <option value="">Select</option>
                                <option value="<?php echo $record["GE1"];?>"><?php echo $record["GE1"];?></option>
                                <option value="<?php echo $record["GE2"];?>"><?php echo $record["GE2"];?></option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">GE Sem 1 Code <span class="text-danger">&dagger;</span></span>
                            </div>
                            <input class="form-control" type="text" id="GESem1subjectcode" name="GESem1subjectcode" readonly size="10">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">GE Sem 2 <span class="text-danger">*</span></span>
                            </div>
                            <select class="custom-select" id="cboGESem2subject" name="cboGESem2subject" onchange="dispalygensubject(this.value,'GESem2subjectcode')">
                                <option value="">Select</option>
                                <option value="<?php echo $record["GE1"];?>"><?php echo $record["GE1"];?></option>
                                <option value="<?php echo $record["GE2"];?>"><?php echo $record["GE2"];?></option>                            
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">GE Sem 2 Code <span class="text-danger">&dagger;</span></span>
                            </div>
                            <input class="form-control" type="text" id="GESem2subjectcode" name="GESem2subjectcode" readonly size="10">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">GE Sem 3 <span class="text-danger">*</span></span>
                            </div>
                            <select class="custom-select" id="cboGESem3subject" name="cboGESem3subject" onchange="dispalygensubject(this.value,'GESem3subjectcode')">
                                <option value="">Select</option>
                                <option value="<?php echo $record["GE1"];?>"><?php echo $record["GE1"];?></option>
                                <option value="<?php echo $record["GE2"];?>"><?php echo $record["GE2"];?></option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">GE Sem 3 Code <span class="text-danger">&dagger;</span></span>
                            </div>
                            <input class="form-control" type="text" id="GESem3subjectcode" name="GESem3subjectcode" readonly size="10">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">GE Sem 4 <span class="text-danger">*</span></span>
                            </div>
                            <select class="custom-select" id="cboGESem4subject" name="cboGESem4subject" onchange="dispalygensubject(this.value,'GESem4subjectcode')">
                                <option value="">Select</option>
                                <option value="<?php echo $record["GE1"];?>"><?php echo $record["GE1"];?></option>
                                <option value="<?php echo $record["GE2"];?>"><?php echo $record["GE2"];?></option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">GE Sem 4 Code <span class="text-danger">&dagger;</span></span>
                            </div>
                            <input class="form-control" type="text" id="GESem4subjectcode" name="GESem4subjectcode" readonly size="10">
                        </div>
                    </div>
                    
                </div>
                
                <?php } ?>
                
                <div class="row mt-4">
                    <div class="col-md-12 text-center">
                        <a class="btn btn-dark btn-sm" href="javascript:void(0)" onclick="javascript: $('#frmback').submit();">
                            <i class="fa fa-arrow-circle-o-left"></i> Go Back
                        </a>
                        
                        <button type="button" class="btn btn-success" id="btnupdtcourse" name="btnupdtcourse" onclick="updateSemCourse()">
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
            
            <form id="frmnext" name="frmnext" action="viewCourse_edit.php" method="post">
                <input type="hidden" id="txtRollnoforsearch" name="txtRollnoforsearch" value="<?php echo $collegerollno;?>">
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