<?php 
include("config.php");
 include("../function.php");
$studrecord =array();
 
$collegerollno = $_POST["txtStudentRollno"];
 
$studqry	=	"select stid,appid,appliedsession,presentsemester,collegeRollno,	registrationNo,	applicationNo,	candidateFirstName,candidateMiddleName,candidateLastName,name,	dd,	mm,	yy,	dob,sex,bloodgroup,	married,nationality,religion,	otherReligion,	hsstream,	caste,	stateofdomicile,scstStateOther, extraActivity, distancefromResidence,	lastResided	,isnull(hasKanyashree,'') as hasKanyashree,	kanyashreeid,	haschronicDisease,aboutchronicDisease, hasCuRegNo	,CuRegNo,CuRollNo,	NFE,	hasSecLanguage,	hasENVS,	firstGenrLearner,	minoritygrp,MIL,	motherTongue,	PH,	disabilitytype,	disabilityPercentage,	CH,	CNI,	passyear,	isApplySportsQuota,	sportlevel,sportname,	selfFinanceCourse,	isapplyAddonCourse,	AddonCourses,	mediumofinstruction,	APLBPL,	bplno,	EWS,annualIncome,	parentName,	fathername,	fatherQalif,	fatherOccup,	fatherOfficeAddress,	fatherMobNo,	motherName,motherQalif,	motherOccup,	motherMobNo,	parentEmail,	monthlyIncome,	familyMemCnt,	guardianName,	relation,	guardianOccup,guardianOfficeAddress,	guardianStdCode,	guardianContNo,	guardianMobNo,	guardianEmail,	permntFullAddr,	permntAddr,permntPO,	permntPS,	permntCity,	permntDistrict,	permntLocality,	permntState,	permntCountry,	permntPin,	permntMobNo,	permntSTD,permntPhoneNo,	localAddr,	localPO,	localPS,	localCity,	localDistrict,	localLocality,	localState,	localCountry,localPin,	localMobNo,	localSTD,	localPhoneNo,	communicatAddress,	contactNo,	applcntMobNo,	alternateMobileNo,hasWhatsAppno,	WhatsAppno,	applcntEmail,	aadharNo,	candidtLoc,	applcntState,	applcntDistrict,	applcntPO,	applcntRlyStation,migrtnFrom,	migrtnBoard,	TCNo,	TCDate,	CURegistrationNo,	playercateg,	staffWard,	boardflag,	boardCode,	otherBoardName,	WBRoll,	WBNo,rollnoforOB,	RollNo,	HSRegistartionNo,	boardYear,	institution,	institutionAddress,	institutionCity,institutionDistrict,	institutionState,	institutionCountry,	institutionPin,	Passed,	photo,	signature, 	appsection,	appstream,	appsubject,	appsubjectcode,ccm.streamDisplay,subjectName  from studentmaster st JOIN College_CourseMaster ccm ON ccm.subjectcode=st.appsubjectcode JOIN CU_course course ON course.stream=st.appstream where  collegeRollno='".$collegerollno."'";
 
 
$studqryresult = $dbConn->query($studqry);

if($studqryresult) {
 	while($studrow=$studqryresult->fetch(PDO::FETCH_ASSOC))
	{
		foreach ($studrow as $colNum=>$value ){
					$studrecord[$colNum] = trim($value);
				}
	}
 }


$qryresult = NULL;
$dbConn = NULL;
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> | Student Info</title>
<?php include("../head_includes.php");?>
</head>
<body>
    <?php include("headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("headermenu_top.php");?>        
        
        <div class="container-fluid mt-4">
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
            	 <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-Personal-tab" data-toggle="tab" href="#nav-Personal" role="tab" aria-controls="nav-Personal" aria-selected="true"><i class="fa fa-user"></i> Personal</a>
                <a class="nav-item nav-link" id="nav-Guardian-tab" data-toggle="tab" href="#nav-Guardian" role="tab" aria-controls="nav-Guardian" aria-selected="false"><i class="fa fa-users"></i> Guardian</a>
                <a class="nav-item nav-link" id="nav-Contact-tab" data-toggle="tab" href="#nav-Contact" role="tab" aria-controls="nav-Contact" aria-selected="false"><i class="fa fa-globe"></i> Contact</a>
                </div>
            </nav>
            	 <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-Personal" role="tabpanel" aria-labelledby="nav-Personal-tab">                	
                    <div class="mt-2">
                        <!--<table width="100%" cellpadding="4" cellspacing="0" border="1" bordercolor="#d5d5d5" style="border-collapse:collapse">-->
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td width="4%">1.</td>
                                <td width="16%">Name in Full</td>
                                <td width="2%" class="text-center">:</td>
                                <td colspan="5"><?php echo $studrecord["name"];?></td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Date of Birth</td>
                                <td class="text-center">:</td>
                                <td width="38%"><?php echo $studrecord["dob"];?></td>
                                <td width="4%">3.</td>
                                <td width="17%">Marital Status</td>
                                <td width="2%" class="text-center">:</td>
                                <td width="17%"><?php echo $studrecord["married"];?></td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>Gender</td>
                                <td class="text-center">:</td>
                                <td><?php echo $studrecord["sex"];?></td>
                                <td>5.</td>
                                <td>Nationality</td>
                                <td class="text-center">:</td>
                                <td><?php echo $studrecord["nationality"];?></td>
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td>Religion</td>
                                <td class="text-center">:</td>
                                <td><?php echo preg_replace('/\bOther\b/', $studrecord["otherReligion"], $studrecord["religion"]);?></td>
                                <td>7.</td>
                                <td>Blood Group</td>
                                <td class="text-center">:</td>
                                <td><?php echo $studrecord["bloodgroup"];?></td>
                            </tr>
                            <tr>
                                <td>8.</td>
                                <td>Category</td>
                                <td class="text-center">:</td>
                                <td><?php echo $studrecord["caste"];?></td>
                                <td>9.</td>
                                <td>Domicile</td>
                                <td class="text-center">:</td>
                                <td><?php echo preg_replace('/\bOther State\b/', $studrecord["scstStateOther"], $studrecord["stateofdomicile"]);?></td>
                            </tr>
                            <tr>
                                <td>10.</td>
                                <td>PwD</td>
                                <td class="text-center">:</td>
                                <td>                
                                  <?php echo $studrecord["PH"];?>
                                  <?php if($studrecord["PH"]=='Yes'){ ?>
                                     <span style="font-size:12px">- <?php echo $studrecord["disabilitytype"];?> | <?php echo $studrecord["disabilityPercentage"];?>%</span>
                                  <?php } ?>
                                </td>
                                <td>11.</td>
                                <td>EWS</td>
                                <td class="text-center">:</td>
                                <td><?php echo $studrecord["EWS"];?></td>
                            </tr>
                            <tr>
                              <td>12.</td>
                              <td>Aadhar No.</td>
                              <td class="text-center">:</td>
                              <td><?php echo $studrecord["aadharNo"];?></td>
                              <td>13.</td>
                              <td>Annual Income</td>
                              <td class="text-center">:</td>
                              <td><i class="fa fa-inr"></i> <?php echo moneyFormatIndia($studrecord["annualIncome"]);?></td>
                            </tr>
                            <tr>
                                <td>14.</td>
                                <td>Minority Group</td>
                                <td class="text-center">:</td>
                                <td><?php echo $studrecord["minoritygrp"];?></td>
                                <td>15.</td>
                                <td>Mother Tongue</td>
                                <td class="text-center">:</td>
                                <td><?php echo $studrecord["motherTongue"];?></td>
                            </tr>
                            <tr>
                                <td>16.</td>
                                <td>Reg. under CU?</td>
                                <td class="text-center">:</td>
                                <td>
                                <?php //echo $studrecord["hasCuRegNo"];?>
                                <?php //if($studrecord["hasCuRegNo"]=='Yes'){ ?>
                                <?php echo $studrecord["CuRegNo"];?>
                                <?php //} ?>
                                </td>
                                <td>17.</td>
                                <td>CU Roll No.</td>
                                <td class="text-center">:</td>
                                <td><?php echo $studrecord["CuRollNo"];?></td>
                            </tr>
                            <tr>
                                <td>18.</td>
                                <td>Whether BPL</td>
                                <td class="text-center">:</td>
                                <td colspan="5">
                                <?php echo $studrecord["APLBPL"];?>
                                <?php if($studrecord["APLBPL"]=='Yes'){ ?>
                                - <?php echo $studrecord["bplno"];?>
                                <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>19.</td>
                                <td>Area of Interest</td>
                                <td class="text-center">:</td>
                                <td colspan="5"><?php echo $studrecord["extraActivity"];?></td>
                            </tr>
                            <!--<tr>
                                <td>21.</td>
                                <td>Add-on courses</td>
                                <td class="text-center">:</td>
                                <td colspan="5">
                                <?php /*?><?php echo $studrecord["isapplyAddonCourse"];?>
                                <?php if($studrecord["isapplyAddonCourse"]=='Yes'){ ?>
                                - <?php echo $studrecord["AddonCourses"];?>
                                <?php } ?><?php */?>
                                </td>
                            </tr>-->
                            <tr>
                                <td>20.</td>
                                <td>Sports</td>
                                <td class="text-center">:</td>
                                <td colspan="5">
                                <?php echo $studrecord["isApplySportsQuota"];?>
                                <?php if($studrecord["isApplySportsQuota"]=='Yes'){ ?>
                                - <?php echo $studrecord["sportlevel"];?>
                                <?php } ?>
                                </td>
                            </tr>
                            <?php if($studrecord["sex"]=='Female'){ ?>
                            <tr>
                                <td>21.</td>
                                <td>Kanyashree</td>
                                <td class="text-center">:</td>
                                <td colspan="5">
                                <?php echo $studrecord["hasKanyashree"];?>
                                <?php if($studrecord["hasKanyashree"]=='Yes'){ ?>
                                 - <?php echo $studrecord["kanyashreeid"];?>
                                <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>	
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-Guardian" role="tabpanel" aria-labelledby="nav-Guardian-tab">
                	<div class="mt-2">
                    	<!--<table width="100%" cellpadding="4" cellspacing="0" border="1" bordercolor="#d5d5d5" style="border-collapse:collapse">-->
                        <table class="table table-bordered table-striped">
                            <tr>
                              <td width="4%">1.</td>
                              <td width="21%">Father Name</td>
                              <td width="2%" class="text-center">:</td>
                              <td width="29%"><?php echo $studrecord["fathername"];?></td>
                              <td width="4%">2.</td>
                              <td width="19%">Qualification</td>
                              <td width="2%" class="text-center">:</td>
                              <td width="19%"><?php echo $studrecord["fatherQalif"];?></td>
                            </tr>
                            <tr>
                              <td>3.</td>
                              <td>Occupation</td>
                              <td class="text-center">:</td>
                              <td><?php echo $studrecord["fatherOccup"];?></td>
                              <td>4.</td>
                              <td>Mobile</td>
                              <td class="text-center">:</td>
                              <td><?php echo $studrecord["fatherMobNo"];?></td>
                            </tr>
                            <tr>
                              <td>5.</td>
                              <td>Mother Name</td>
                              <td class="text-center">:</td>
                              <td><?php echo $studrecord["motherName"];?></td>
                              <td>6.</td>
                              <td>Qualification</td>
                              <td class="text-center">:</td>
                              <td><?php echo $studrecord["motherQalif"];?></td>
                            </tr>
                            <tr>
                              <td>7.</td>
                              <td>Occupation</td>
                              <td class="text-center">:</td>
                              <td><?php echo $studrecord["motherOccup"];?></td>
                              <td>8.</td>
                              <td>Mobile</td>
                              <td class="text-center">:</td>
                              <td><?php echo $studrecord["motherMobNo"];?></td>
                            </tr>
                            <tr>
                              <td>9.</td>
                              <td>Guardian Name</td>
                              <td class="text-center">:</td>
                              <td><?php echo $studrecord["guardianName"];?></td>
                              <td>10.</td>
                              <td>Relationship</td>
                              <td class="text-center">:</td>
                              <td><?php echo $studrecord["relation"];?></td>
                            </tr>
                            <tr>
                              <td>11.</td>
                              <td>Occupation</td>
                              <td class="text-center">:</td>
                              <td><?php echo $studrecord["guardianOccup"];?></td>
                              <td>12.</td>
                              <td>Mobile</td>
                              <td class="text-center">:</td>
                              <td><?php echo $studrecord["guardianMobNo"];?></td>
                            </tr>
                            <tr>
                              <td>13.</td>
                              <td>Railway Station</td>
                              <td class="text-center">:</td>
                              <td><?php echo $studrecord["applcntRlyStation"];?></td>
                              <td>14.</td>
                              <td>No. of Family Mem.</td>
                              <td class="text-center">:</td>
                              <td><?php echo $studrecord["familyMemCnt"];?></td>
                            </tr>
                        </table>
            		</div>
                </div>
                <div class="tab-pane fade" id="nav-Contact" role="tabpanel" aria-labelledby="nav-Contact-tab">
                	<div class="mt-2">
                        <p class="alert-info text-center font-weight-bold pt-2 pb-2" style="border-bottom:1px solid #d0d0d0">Permanent Address <i class="fa fa-arrow-circle-o-down"></i></p>
                
                        <!--<table width="100%" cellpadding="4" cellspacing="0" border="1" bordercolor="#d5d5d5" style="border-collapse:collapse">-->
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td width="3%">1.</td>
                                <td width="14%">Address</td>
                                <td width="2%" class="text-center">:</td>
                                <td colspan="5"><?php echo $studrecord["permntAddr"];?></td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>P.O.</td>
                                <td class="text-center">:</td>
                                <td width="33%"><?php echo $studrecord["permntPO"];?></td>
                                <td width="3%">3.</td>
                                <td width="14%">P.S.</td>
                                <td width="2%">:</td>
                                <td width="29%"><?php echo $studrecord["permntPS"];?></td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>Locality</td>
                                <td class="text-center">:</td>
                                <td><?php echo $studrecord["permntLocality"];?></td>
                                <td>5.</td>
                                <td>City/Village</td>
                                <td class="text-center">:</td>
                                <td><?php echo $studrecord["permntCity"];?></td>            
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td>District</td>
                                <td class="text-center">:</td>
                                <td><?php echo $studrecord["permntDistrict"];?></td>
                                <td>7.</td>
                                <td>State</td>
                                <td class="text-center">:</td>
                                <td><?php echo $studrecord["permntState"];?></td>
                            </tr>
                            <tr>
                                <td>8.</td>
                                <td>Country</td>
                                <td class="text-center">:</td>
                                <td><?php echo $studrecord["permntCountry"];?></td>
                                <td>9.</td>
                                <td>Pin</td>
                                <td class="text-center">:</td>
                                <td><?php echo $studrecord["permntPin"];?></td>
                            </tr>
                        </table>
                        
                        <p class="alert-info text-center font-weight-bold pt-2 pb-2" style="border-bottom:1px solid #d0d0d0">Communication Address <i class="fa fa-arrow-circle-o-down"></i></p>
                        
                        <!--<table width="100%" cellpadding="4" cellspacing="0" border="1" bordercolor="#d5d5d5" style="border-collapse:collapse">-->
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td width="3%">1.</td>
                                <td width="14%">Address</td>
                                <td width="2%" class="text-center">:</td>
                                <td colspan="5"><?php echo $studrecord["localAddr"];?></td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>P.O.</td>
                                <td class="text-center">:</td>
                                <td width="33%"><?php echo $studrecord["localPO"];?></td>
                                <td width="3%">3.</td>
                                <td width="14%">P.S.</td>
                                <td width="2%">:</td>
                                <td width="29%"><?php echo $studrecord["localPS"];?></td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>Locality</td>
                                <td class="text-center">:</td>
                                <td><?php echo $studrecord["localLocality"];?></td>
                                <td>5.</td>
                                <td>City/Village</td>
                                <td class="text-center">:</td>
                                <td><?php echo $studrecord["localCity"];?></td>            
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td>District</td>
                                <td class="text-center">:</td>
                                <td><?php echo $studrecord["localDistrict"];?></td>
                                <td>7.</td>
                                <td>State</td>
                                <td class="text-center">:</td>
                                <td><?php echo $studrecord["localState"];?></td>
                            </tr>
                            <tr>
                                <td>8.</td>
                                <td>Country</td>
                                <td class="text-center">:</td>
                                <td><?php echo $studrecord["localCountry"];?></td>
                                <td>9.</td>
                                <td>Pin</td>
                                <td class="text-center"></td>
                                <td><?php echo $studrecord["localPin"];?></td>
                            </tr>
                        </table>
                        
                        <p class="alert-info text-center font-weight-bold pt-2 pb-2" style="border-bottom:1px solid #d0d0d0">Contact info <i class="fa fa-arrow-circle-o-down"></i></p>
                        
                        <!--<table width="100%" cellpadding="4" cellspacing="0" border="1" bordercolor="#d5d5d5" style="border-collapse:collapse">-->
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td width="2%">1.</td>
                                <td width="13%">Mobile No.</td>
                                <td width="1%" class="text-center">:</td>
                                <td width="15%"><?php echo $studrecord["applcntMobNo"];?></td>
                                <td width="2%">2.</td>
                                <td width="17%">Alt. Mobile No.</td>
                                <td width="1%" class="text-center">:</td>
                                <td width="15%"><?php echo $studrecord["alternateMobileNo"];?></td>
                                <td width="2%">3.</td>
                                <td width="16%">Whatsapp No.</td>
                                <td width="1%" class="text-center">:</td>
                                <td width="15%"><?php echo $studrecord["WhatsAppno"];?></td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>E-mail Id</td>
                                <td class="text-center">:</td>
                                <td colspan="9"><?php echo $studrecord["applcntEmail"];?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <br>
			<?php if($usertype=='SYSTEMCREATOR'){?>
			<div class="text-center">
			<form id="frmedit" name="frmedit" action="Edit_Form.php" method="post">
				<input type="hidden" id="txtStudentRollno" name="txtStudentRollno" class="form-control" maxlength="10" value="<?php echo $collegerollno;?>" />
			</form>                
            <a class="btn btn-dark btn-sm" href="javascript:void(0)" onclick="javascript: $('#frmback').submit();">
                <i class="fa fa-arrow-circle-o-left"></i> Go Back
            </a>
            
            <a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="javascript: $('#frmedit').submit();">
                <i class="fa fa-pencil-square-o"></i> Update Student Detail
            </a>
            </div>
			<?php }?>
            
            <?php if($usertype!='SYSTEMCREATOR'){?>
			<div class="text-center">			
            <a class="btn btn-dark btn-sm" href="javascript:void(0)" onclick="javascript: $('#frmback').submit();">
                <i class="fa fa-arrow-circle-o-left"></i> Go Back
            </a>
            </div>
			<?php }?>
            
			<form id="frmback" name="frmback" action="search_candidate_details.php" method="post">
			<input type="hidden" id="txtRollnoforsearch" name="txtRollnoforsearch" class="form-control" maxlength="10" value="<?php echo $collegerollno;?>">
			</form>
            
        </div>
   
        <?php include("../footer.php");?>
    </div>	
    <?php include("../footer_includes.php");?>    
</body>
</html>
<script>
function goforAppPayslip(baseurl,paythrough){
	var actionurl="";
	 
	 if(paythrough=='AXIS') {
		actionurl=baseurl+"/Payment_Axis/print_application_slip.php"; 
	 }
	 else if(paythrough=='BILL DESK') {
		actionurl= baseurl+"/Payment_Billdesk/print_application_slip.php"; 
	 }
	 else if(paythrough=='HDFC') {
		actionurl= baseurl+"/Payment_HDFC/print_application_slip.php" ;
	 }
	 else {
		$("#msgcontent").html("There is some problem.");
		$("#ValidationAlert").modal(); 
		return false;
	 }
	 
	 $('#frmprintpayslip').attr('action', actionurl);
    $("#frmprintpayslip").submit(); 
	  
 }
 </script>
