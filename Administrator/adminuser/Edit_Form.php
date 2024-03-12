<?php 
include("config.php"); 

$collegerollno = $_POST["txtStudentRollno"];
 
   $studrecord = array();
  
 $studqry	=	"select stid,appid,name,collegeRollno,  sex,appyear,passyear,applcntMobNo,	alternateMobileNo,hasWhatsAppno,	WhatsAppno,	applcntEmail,ccm.streamDisplay,subjectName   from studentmaster  st JOIN College_CourseMaster ccm ON ccm.subjectcode=st.appsubjectcode JOIN CU_course course ON course.stream=st.appstream  where  collegeRollno='".$collegerollno."'";
 
 //stid,appid,appliedsession,presentsemester,collegeRollno,	registrationNo,	applicationNo,	candidateFirstName,candidateMiddleName,candidateLastName,name,	dd,	mm,	yy,	dob,sex,bloodgroup,	married,nationality,religion,	otherReligion,	hsstream,	caste,	stateofdomicile,scstStateOther, extraActivity, distancefromResidence,	lastResided	,hasKanyashree,	kanyashreeid,	haschronicDisease,aboutchronicDisease, hasCuRegNo	CuRegNo,	NFE,	hasSecLanguage,	hasENVS,	firstGenrLearner,	minoritygrp,MIL,	motherTongue,	PH,	disabilitytype,	disabilityPercentage,	CH,	CNI,	passyear,	isApplySportsQuota,	sportlevel,sportname,	selfFinanceCourse,	isapplyAddonCourse,	AddonCourses,	mediumofinstruction,	APLBPL,	bplno,	EWS,annualIncome,	parentName,	fathername,	fatherQalif,	fatherOccup,	fatherOfficeAddress,	fatherMobNo,	motherName,motherQalif,	motherOccup,	motherMobNo,	parentEmail,	monthlyIncome,	familyMemCnt,	guardianName,	relation,	guardianOccup,guardianOfficeAddress,	guardianStdCode,	guardianContNo,	guardianMobNo,	guardianEmail,	permntFullAddr,	permntAddr,permntPO,	permntPS,	permntCity,	permntDistrict,	permntLocality,	permntState,	permntCountry,	permntPin,	permntMobNo,	permntSTD,permntPhoneNo,	localAddr,	localPO,	localPS,	localCity,	localDistrict,	localLocality,	localState,	localCountry,localPin,	localMobNo,	localSTD,	localPhoneNo,	communicatAddress,	contactNo,	applcntMobNo,	alternateMobileNo,hasWhatsAppno,	WhatsAppno,	applcntEmail,	aadharNo,	candidtLoc,	applcntState,	applcntDistrict,	applcntPO,	applcntRlyStation,migrtnFrom,	migrtnBoard,	TCNo,	TCDate,	CURegistrationNo,	playercateg,	staffWard,	boardflag,	boardCode,	otherBoardName,	WBRoll,	WBNo,rollnoforOB,	RollNo,	HSRegistartionNo,	boardYear,	institution,	institutionAddress,	institutionCity,institutionDistrict,	institutionState,	institutionCountry,	institutionPin,	Passed,	photo,	signature, 	appsection,	appstream,	appsubject,	appsubjectcode 
$studqryresult = $dbConn->query($studqry);

if($studqryresult) {
 	while($studrow=$studqryresult->fetch(PDO::FETCH_ASSOC))
	{
		foreach ($studrow as $colNum=>$value ){
					$studrecord[$colNum] = trim($value);
				}
	}
 }  
 
 //print_r($studrecord);
?>
 
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> | Edit Student Info</title>
<?php include("../head_includes.php");?>
  
</head>
<body onload="loaddataforupdate('<?php echo $collegerollno;?>');">
    <?php include("headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("headermenu_top.php");?>
        
        <div class="pl-3 pr-3 pt-0">
			<div class="row">
            	 
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Name <span class="text-danger">&dagger;</span></span>
                        </div>
                        <span class="text-primary form-control"><?php echo $studrecord["name"];?></span>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">College Roll No. <span class="text-danger">&dagger;</span></span>
                        </div>
                        <span class="text-primary form-control"><?php echo $studrecord["collegeRollno"];?></span>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Stream <span class="text-danger">&dagger;</span></span>
                        </div>
                        <span class="text-primary form-control"><?php echo $studrecord["streamDisplay"];?></span>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Subject <span class="text-danger">&dagger;</span></span>
                        </div>
                        <span class="text-primary form-control"><?php echo $studrecord["subjectName"];?></span>
                    </div>
                </div>
            </div>
		
		
            <div class="row">
            	<div class="col-md-12 text-center">
                    <form id="frmback" name="frmback" action="search_candidate_details.php" method="post">
                    	<input type="hidden" id="txtRollnoforsearch" name="txtRollnoforsearch" class="form-control" maxlength="10" value="<?php echo $collegerollno;?>">
                    </form>                
                    <a class="btn btn-dark btn-sm" href="javascript:void(0)" onclick="javascript: $('#frmback').submit();">
                    	<i class="fa fa-arrow-circle-o-left"></i> Go Back
                    </a>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 mb-3">			
                    <div class="table-responsive">
                         <section class="p-3 mb-4">						 
							<input type="hidden" id="hdncollRollforEdit" name="hdncollRollforEdit" value="<?php echo $collegerollno; ?>" />
                            <div id="accordion">
                                <div id="registration_details_form">
                                	<?php include("edit_registration_details.php");?>
                              	</div> 
                               
                                <div id="personal_details_form">
                                    <?php  include("edit_other_personal_details.php");?>
                                </div>
                                 
                                <div id="guardian_details_form">
                                    <?php  include("edit_guardian_details.php");?>
                                </div>
                                 
                                <div id="qualifying_details_form">
                                    <?php //include("edit_qualifying_details.php");?>
                                </div>
                                
                                <div id="contact_details_form">
                                    <?php  include("edit_contact_details.php");?>
                                </div>
                                                                 
                            </div>                     
                        </section>
                    </div>
                </div>
            </div>
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
        <div class="clearfix"></div>
        <form id="frmsession" name="frmsession" action="" method="post" >
        	<input type="hidden" id="txtStudentRollno" name="txtStudentRollno"  value="<?php echo $collegerollno;?>" />
        </form>	
        <?php include("../footer.php");?>
    </div>	
    <?php include("../footer_includes.php");?>    
</body>
</html>
<script type="text/javascript" src="adminuser_js/date.js"></script>
<script src="adminuser_js/editform.js"></script>