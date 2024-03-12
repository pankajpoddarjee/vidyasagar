<?php 
include("config.php");

$collegerollno = $_POST["txtRollnoforcourse"];
 
  $qry =	"select applicationNo,name,st.collegeRollNo,presentsemester,dob,sex,PH,	caste,	stateofdomicile,scstStateOther,applcntMobNo,alternateMobileNo,hasWhatsAppno,WhatsAppno,	applcntEmail,fathername,motherName,courseCode,appstream,appsubject,isnull(CuRegNo,'') as CuRegNo,isnull(CuRollNo,'') as CuRollNo,aadharNo,ccm.streamDisplay, ccm.streamType,ccm.subjectName,isnull(photo,'') as photo, isnull(signature,'') as signature  from studentmaster st JOIN College_CourseMaster ccm ON ccm.subjectcode=st.appsubjectcode JOIN CU_course course ON course.stream=st.appstream where st.collegeRollNo='".$collegerollno."'";
 
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
 
    $courseqry	=	"Select collegeRollno,semester,appliedsession,stream,	subject,subjectcode,isnull(CoreCourse1,'') as CoreCourse1,	isnull(CoreCourse2,'') CoreCourse2,	isnull(CoreCourse3,'') as CoreCourse3,isnull(CoreCourse4,'') as CoreCourse4,	isnull(minorCourse1,'') as minorCourse1,isnull(minorCourse2,'') as minorCourse2,isnull(IDC,'') as IDC,isnull(AECC,'') as AECC,isnull(SEC,'') as SEC,isnull(CVAC1,'') as CVAC1, isnull(CVAC2,'') as CVAC2,isnull(Internship,'') as Internship, isnull(Dissertation,'') as Dissertation, isnull(ResearchWork,'') as ResearchWork  from studentSemesterCourse where  collegeRollNo='".$collegerollno."'";
 
 
$courseqryresult = $dbConn->query($courseqry);

if($courseqryresult) {
 	while($courserow=$courseqryresult->fetch(PDO::FETCH_ASSOC))
	{
		$courserecord[] = $courserow;
	}
 }
 
 $headerarr =  array( 'semester'=>'Semester','subject'=>'Subject','CoreCourse1'=>'Core Course 1','CoreCourse2'=>'Core Course 2','CoreCourse3'=>'Core Course 3','CoreCourse4'=>'Core Course 4','minorCourse1'=>'Minor Course 1','minorCourse2'=>'Minor Course 2','IDC'=>'IDC','AECC'=>'AECC','SEC'=>'SEC','CVAC1'=>'CVAC 1','CVAC2'=>'CVAC 2','Internship'=>'Internship'); 
 
  
 	
 $courseqryresult = NULL;

$dbConn = NULL;

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> | Student Course Detail</title>
<?php include("../head_includes.php");?>
<style type="text/css">	
.footer{background:#039; padding:0; margin:0; width:100%}
/*@media only screen and (min-width: 1050px) {.footer{position:fixed; bottom:0; padding:0}}*/
</style>
</head>
<body>
    <?php include("headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("headermenu_top.php");?>
        
        <div class="container-fluid">
        <form id="frmsearch" name="frmsearch" action="search_candidate_details.php" method="post">
        	<div class="row">
            	<div class="col-md-12">
                    <h5 class="text-danger border-bottom mb-3 pb-2">
                    	<i class="fa fa-leanpub"></i> Student Course Detail
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
            
            <div class="row mt-3">
            	<div class="col-md-12" id="printdivcontent">
                    <!--<table width="100%" align="center" border="1" bordercolor="#d5d5d5" cellpadding="" class="table table-bordered table-hover font-weight-normal text-center" style="border-collapse:collapse; text-align:center; font-family:Poppins, Arial, Helvetica, sans-serif; font-size:12px">-->
                    <table class="table table-bordered table-striped shadow text-center">
                        <tr class="bg-light font-weight-bold text-nowrap align-middle">
                        <td>Srl.</td>
                        <?php foreach($headerarr as $headkey=>$headlabel) { ?>
                        <td><?php echo $headlabel; ?></td>
                        <?php } ?>  
                        </tr>
                    
                    <?php
                        $i=0;
                        foreach($courserecord as $coursedetail) {
                        $i=$i+1;
                    ?>
                        <tr>
                        <td><?php echo $i;?> </td>
                        <?php foreach($headerarr as $headkey=>$headlabel) { ?>
                        <td><?php echo $coursedetail[$headkey];?></td>
                        <?php } ?>  
                        
                        </tr>
                    
                    <?php  } ?>
                    </table>
            	</div>              
        	</div>
		</form>
        
		<?php if($usertype=='SYSTEMCREATOR') {?>
        
		 <div class="row m-auto text-center justify-content-center">
         
            <style>
			.round_box {display:inline-block;width:150px;height:150px; padding:35px 18px}
			</style>
            
            <div class="col-md-12 mb-3">
                <hr>
            </div>
				 
			<div class="col-md-3 col-6 mb-5">
                <div class="text-center rounded-circle round_box shadow bg-dark">
                    <div class="mt-2 text-uppercase text-center">
                    <form id="frmcourse" name="frmcourse" action="mainCourse_edit.php" method="post">
                    <input type="hidden" id="txtRollnoforcourse" name="txtRollnoforcourse" class="form-control" maxlength="10" value="<?php echo $collegerollno;?>" />
                    </form>
                        <a class="text-white text-center" href="javascript:void(0)" onclick="javascript: $('#frmcourse').submit();">
                            <i class="fa fa-pencil-square-o" style="font-size:28px"></i><br>Update <br>Course
                        </a>
                    </div>
                </div>
            </div>
				
            <div class="col-md-3 col-6 mb-5">
                <div class="text-center rounded-circle round_box shadow bg-dark">
                    <div class="mt-2 text-uppercase text-center">
                    <form id="frmGEcourse" name="frmGEcourse" action="GE_edit.php" method="post">
                    <input type="hidden" id="txtcollegeRollno" name="txtcollegeRollno" class="form-control" maxlength="10" value="<?php echo $collegerollno;?>" />
                    </form>
                        <a class="text-white text-center" href="javascript:void(0)" onclick="javascript: $('#frmGEcourse').submit();">
                            <i class="fa fa-pencil-square-o" style="font-size:28px"></i><br>Update GE / CC / AECC / LCC
                        </a>
                    </div>
                </div>
            </div>
            
            <?php  if($record["courseCode"]!='10' && $record["courseCode"]!='13'){ ?>
            
            <div class="col-md-3 col-6 mb-5">
                <div class="text-center rounded-circle round_box shadow bg-dark">
                    <div class="mt-2 text-uppercase text-center">
                    <form id="frmGESemcourse" name="frmGESemcourse" action="GE_editNext.php" method="post">
                    <input type="hidden" id="hdncollegerollno" name="hdncollegerollno" class="form-control" maxlength="10" value="<?php echo $collegerollno;?>" />
                    </form>
                        <a class="text-white text-center" href="javascript:void(0)" onclick="javascript: $('#frmGESemcourse').submit();">
                            <i class="fa fa-pencil-square-o" style="font-size:28px"></i><br>Update Semester<br>Course
                        </a>
                    </div>
                </div>
            </div>
          
            
            <div class="col-md-3 col-6 mb-5">
                <div class="text-center rounded-circle round_box shadow bg-dark">
                    <div class="mt-2 text-uppercase text-center">
                    <form id="frmSECupdt" name="frmSECupdt" action="viewCourse_edit.php" method="post">
                    <input type="hidden" id="txtRollnoforsearch" name="txtRollnoforsearch" class="form-control" maxlength="10" value="<?php echo $collegerollno;?>" />
                    </form>
                        <a class="text-white text-center" href="javascript:void(0)" onclick="javascript: $('#frmSECupdt').submit();">
                            <i class="fa fa-pencil-square-o" style="font-size:28px"></i><br>Update Course<br>By Semester 
                        </a>
                    </div>
                </div>
            </div>
              <?php }?>
				
        </div>
        
        <?php }?>
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
<script src="adminuser_js/admin_search.js"></script>