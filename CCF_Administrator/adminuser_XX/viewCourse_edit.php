<?php 
include("config.php");

$collegerollno = $_POST["txtRollnoforsearch"];
 
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
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> | Update Course by Semester</title>
<?php include("../head_includes.php");?>
<style type="text/css">	
.footer{background:#039; padding:0; margin:0; width:100%}
@media only screen and (min-width: 1367px) {.footer{position:fixed; bottom:0; padding:0}}
</style>
</head>
<body>
    <?php include("headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("headermenu_top.php");?>
        <form id="frmsearch" name="frmsearch" action="search_candidate_details.php" method="post">
        <div class="container-fluid">
        
        	<div class="row">
            	<div class="col-md-12">
                    <h5 class="text-danger border-bottom mb-3 pb-2">
                    	<i class="fa fa-pencil-square-o"></i> Update Course by Semester
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
                        <input type="hidden" id="hdncollegerollno" name="hdncollegerollno" value="<?php echo $collegerollno?>">
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
            
        	<div class="row">
            	<div class="col-md-12">				
                    <div id="printdivcontent">
                        <table class="table table-bordered text-center">
                        <tr class="bg-light font-weight-bold text-nowrap align-middle">
                        <td>Srl.</td>
                        <?php foreach($headerarr as $headkey=>$headlabel) { ?>
                        <td><?php echo $headlabel; ?></td>
                        <?php } ?> 
                        <td>Action</td>					
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
                        <?php    				
                        }
                        ?>  
                        <td>
                        <?php 
                        if($record["appstream"]=='BAGEN' || $record["appstream"]=='BSCGEN') {
                        if(($record["appstream"]=='BAGEN' &&  $coursedetail["semester"]=='III') || ($record["appstream"]=='BSCGEN' &&  ($coursedetail["semester"]=='III' || $coursedetail["semester"]=='V'))) {
                        ?>
                        <a class="btn btn-sm btn-info" href="javascript: void(0)" onclick="goforCourseeditBySem('<?php echo $coursedetail["semester"];?>')"><i class="fa fa-pencil-square-o"></i> Edit</a>
                        <?php } 
                        }
                        ?>
                        </td>     
                        </tr>
                        
                        <?php  } ?>
                        
                        </table>
                    </div>
                </div>
            </div>          
            
        	<div class="row">
            	<div class="col-md-12 text-center">				
                    <a class="btn btn-dark btn-sm" href="javascript:void(0)" onclick="javascript: $('#frmback').submit();">
                        <i class="fa fa-arrow-circle-o-left"></i> Go Back
                    </a>
                </div>
            </div>
              
        </div>
		</form>
        
		<div id="div_edit"  style="display:none"  class="col-md-12 text-center"> 
		 <form id="editform" name="editform" action="" method="post">				
            
            <input type="hidden" id="courseSemforChange" name="courseSemforChange">
            
            <div id="othersubjectinfo"></div> 
            
            <!--<input type="button" id="btnupdate" name="btnupdate" value="update" onclick="updateCourseBySem()">-->
            
            <button type="button" class="btn btn-success" id="btnupdate" name="btnupdate" onclick="updateCourseBySem()">
                <i class="fa fa-check-square-o"></i> Save & Update
            </button>
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
<script src="adminuser_js/admin_search.js"></script>