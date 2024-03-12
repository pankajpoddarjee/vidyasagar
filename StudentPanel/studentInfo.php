<?php
include("sessionConfig.php");
include("../connection.php");
include("function.php");
include("../configuration.php");

$collegerollno = $_POST["txtcollegerollno"];

$courserecord = array();
 
$studqry	=	"select stid,appid,appliedsession,presentsemester,collegeRollno,	registrationNo,	applicationNo,	candidateFirstName,candidateMiddleName,candidateLastName,name,	dd,	mm,	yy,	dob,sex,bloodgroup,	married,nationality,religion,	otherReligion,	hsstream,	caste,	stateofdomicile,scstStateOther, extraActivity, distancefromResidence,	lastResided	,isnull(hasKanyashree,'') as hasKanyashree,	kanyashreeid,	haschronicDisease,aboutchronicDisease, hasCuRegNo	CuRegNo,	NFE,	hasSecLanguage,	hasENVS,	firstGenrLearner,	minoritygrp,MIL,	motherTongue,	PH,	disabilitytype,	disabilityPercentage,	CH,	CNI,	passyear,	isApplySportsQuota,	sportlevel,sportname,	selfFinanceCourse,	isapplyAddonCourse,	AddonCourses,	mediumofinstruction,	APLBPL,	bplno,	EWS,annualIncome,	parentName,	fathername,	fatherQalif,	fatherOccup,	fatherOfficeAddress,	fatherMobNo,	motherName,motherQalif,	motherOccup,	motherMobNo,	parentEmail,	monthlyIncome,	familyMemCnt,	guardianName,	relation,	guardianOccup,guardianOfficeAddress,	guardianStdCode,	guardianContNo,	guardianMobNo,	guardianEmail,	permntFullAddr,	permntAddr,permntPO,	permntPS,	permntCity,	permntDistrict,	permntLocality,	permntState,	permntCountry,	permntPin,	permntMobNo,	permntSTD,permntPhoneNo,	localAddr,	localPO,	localPS,	localCity,	localDistrict,	localLocality,	localState,	localCountry,localPin,	localMobNo,	localSTD,	localPhoneNo,	communicatAddress,	contactNo,	applcntMobNo,	alternateMobileNo,hasWhatsAppno,	WhatsAppno,	applcntEmail,	aadharNo,	candidtLoc,	applcntState,	applcntDistrict,	applcntPO,	applcntRlyStation,migrtnFrom,	migrtnBoard,	TCNo,	TCDate,	CURegistrationNo,	playercateg,	staffWard,	boardflag,	boardCode,	otherBoardName,	WBRoll,	WBNo,rollnoforOB,	RollNo,	HSRegistartionNo,	boardYear,	institution,	institutionAddress,	institutionCity,institutionDistrict,	institutionState,	institutionCountry,	institutionPin,	Passed,	photo,	signature, 	appsection,	appstream,	appsubject,	appsubjectcode  from studentmaster where  collegeRollno='".$collegerollno."'";
 
 
$studqryresult = $dbConn->query($studqry);

if($studqryresult) {
 	while($studrow=$studqryresult->fetch(PDO::FETCH_ASSOC))
	{
		foreach ($studrow as $colNum=>$value ){
					$record[$colNum] = trim($value);
				}
	}
 }
   
 //$headerarr =  array('collegeRollno'=>'Roll No','semester'=>'Semester','subject'=>'Subject','CoreCourse1'=>'Core Course 1','CoreCourse2'=>'Core Course 2','CoreCourse3'=>'Core Course 3','generalCourse'=>'General Course','LCC'=>'LCC','DSE1'=>'DSE 1','DSE2'=>'DSE 2','DSE3'=>'DSE 3','AECC'=>'AECC','SEC'=>'SEC');
 	
$courseqryresult = NULL;

$dbConn = NULL;

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title>Payment Detail - <?php echo COLLEGE_NAME; ?></title>
<?php include("head_includes.php");?>
</head>
<body>
 
<style type="text/css">	
.footer{background:#039; padding:0; margin:0; width:100%}
@media only screen and (min-width: 1050px) {.footer{position:fixed; bottom:0; padding:0}}
</style>
 
    <?php include("candidate_dashboard_menu.php");?>
    
    <div id="content">
    	<?php include("header.php");?>
        <?php include("candidate_dashboard_menu2.php");?>
        
        <div class="pl-3 pr-3 pt-0">        
            <?php include("emergengy_notice_dashboard.php");?>
            
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
                        <table width="100%" cellpadding="4" cellspacing="0" border="1" bordercolor="#d5d5d5" style="border-collapse:collapse">
                            <tr>
                                <td width="4%">1.</td>
                                <td width="16%">Name in Full</td>
                                <td width="2%" class="text-center">:</td>
                                <td colspan="5"><?php echo $record["name"];?></td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Date of Birth</td>
                                <td class="text-center">:</td>
                                <td width="38%"><?php echo $record["dob"];?></td>
                                <td width="4%">3.</td>
                                <td width="17%">Marital Status</td>
                                <td width="2%" class="text-center">:</td>
                                <td width="17%"><?php echo $record["married"];?></td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>Gender</td>
                                <td class="text-center">:</td>
                                <td><?php echo $record["sex"];?></td>
                                <td>5.</td>
                                <td>Nationality</td>
                                <td class="text-center">:</td>
                                <td><?php echo $record["nationality"];?></td>
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td>Religion</td>
                                <td class="text-center">:</td>
                                <td><?php echo preg_replace('/\bOther\b/', $record["otherReligion"], $record["religion"]);?></td>
                                <td>7.</td>
                                <td>Blood Group</td>
                                <td class="text-center">:</td>
                                <td><?php echo $record["bloodgroup"];?></td>
                            </tr>
                            <tr>
                                <td>8.</td>
                                <td>Category</td>
                                <td class="text-center">:</td>
                                <td><?php echo $record["caste"];?></td>
                                <td>9.</td>
                                <td>Domicile</td>
                                <td class="text-center">:</td>
                                <td><?php echo preg_replace('/\bOther State\b/', $record["scstStateOther"], $record["stateofdomicile"]);?></td>
                            </tr>
                            <tr>
                                <td>10.</td>
                                <td>PwD</td>
                                <td class="text-center">:</td>
                                <td>                
                                  <?php echo $record["PH"];?>
                                  <?php if($record["PH"]=='Yes'){ ?>
                                     <span style="font-size:12px">- <?php echo $record["disabilitytype"];?> | <?php echo $record["disabilityPercentage"];?>%</span>
                                  <?php } ?>
                                </td>
                                <td>11.</td>
                                <td>EWS</td>
                                <td class="text-center">:</td>
                                <td><?php echo $record["EWS"];?></td>
                            </tr>
                            <tr>
                              <td>12.</td>
                              <td>Aadhar No.</td>
                              <td class="text-center">:</td>
                              <td><?php echo $record["aadharNo"];?></td>
                              <td>13.</td>
                              <td>Annual Income</td>
                              <td class="text-center">:</td>
                              <td><i class="fa fa-inr"></i> <?php echo moneyFormatIndia($record["annualIncome"]);?></td>
                            </tr>
                            <tr>
                                <td>14.</td>
                                <td>Minority Group</td>
                                <td class="text-center">:</td>
                                <td><?php echo $record["minoritygrp"];?></td>
                                <td>15.</td>
                                <td>Mother Tongue</td>
                                <td class="text-center">:</td>
                                <td><?php echo $record["motherTongue"];?></td>
                            </tr>
                            <!--<tr>
                                <td>16.</td>
                                <td>Reg. under CU?</td>
                                <td class="text-center">:</td>
                                <td>
                                <?php echo $record["hasCuRegNo"];?>
                                <?php if($record["hasCuRegNo"]=='Yes'){ ?>
                                - <?php echo $record["CuRegNo"];?>
                                <?php } ?>
                                </td>
                                <td>17.</td>
                                <td>1st Gen. Learner</td>
                                <td class="text-center">:</td>
                                <td><?php echo $record["firstGenrLearner"];?></td>
                            </tr>-->
                            <tr>
                                <td>18.</td>
                                <td>Whether BPL</td>
                                <td class="text-center">:</td>
                                <td colspan="5">
                                <?php echo $record["APLBPL"];?>
                                <?php if($record["APLBPL"]=='Yes'){ ?>
                                - <?php echo $record["bplno"];?>
                                <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>19.</td>
                                <td>Area of Interest</td>
                                <td class="text-center">:</td>
                                <td colspan="5"><?php echo $record["extraActivity"];?></td>
                            </tr>
                            <!--<tr>
                                <td>21.</td>
                                <td>Add-on courses</td>
                                <td class="text-center">:</td>
                                <td colspan="5">
                                <?php /*?><?php echo $record["isapplyAddonCourse"];?>
                                <?php if($record["isapplyAddonCourse"]=='Yes'){ ?>
                                - <?php echo $record["AddonCourses"];?>
                                <?php } ?><?php */?>
                                </td>
                            </tr>-->
                            <tr>
                                <td>20.</td>
                                <td>Sports</td>
                                <td class="text-center">:</td>
                                <td colspan="5">
                                <?php echo $record["isApplySportsQuota"];?>
                                <?php if($record["isApplySportsQuota"]=='Yes'){ ?>
                                - <?php echo $record["sportlevel"];?>
                                <?php } ?>
                                </td>
                            </tr>
                            <?php if($record["sex"]=='Female'){ ?>
                            <tr>
                                <td>21.</td>
                                <td>Kanyashree</td>
                                <td class="text-center">:</td>
                                <td colspan="5">
                                <?php echo $record["hasKanyashree"];?>
                                <?php if($record["hasKanyashree"]=='Yes'){ ?>
                                 - <?php echo $record["kanyashreeid"];?>
                                <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>	
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-Guardian" role="tabpanel" aria-labelledby="nav-Guardian-tab">
                	<div class="mt-2">
                    	<table width="100%" cellpadding="4" cellspacing="0" border="1" bordercolor="#d5d5d5" style="border-collapse:collapse">
                <tr>
                  <td width="4%">1.</td>
                  <td width="21%">Father Name</td>
                  <td width="2%" class="text-center">:</td>
                  <td width="29%"><?php echo $record["fathername"];?></td>
                  <td width="4%">2.</td>
                  <td width="19%">Qualification</td>
                  <td width="2%" class="text-center">:</td>
                  <td width="19%"><?php echo $record["fatherQalif"];?></td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>Occupation</td>
                  <td class="text-center">:</td>
                  <td><?php echo $record["fatherOccup"];?></td>
                  <td>4.</td>
                  <td>Mobile</td>
                  <td class="text-center">:</td>
                  <td><?php echo $record["fatherMobNo"];?></td>
                </tr>
                <tr>
                  <td>5.</td>
                  <td>Mother Name</td>
                  <td class="text-center">:</td>
                  <td><?php echo $record["motherName"];?></td>
                  <td>6.</td>
                  <td>Qualification</td>
                  <td class="text-center">:</td>
                  <td><?php echo $record["motherQalif"];?></td>
                </tr>
                <tr>
                  <td>7.</td>
                  <td>Occupation</td>
                  <td class="text-center">:</td>
                  <td><?php echo $record["motherOccup"];?></td>
                  <td>8.</td>
                  <td>Mobile</td>
                  <td class="text-center">:</td>
                  <td><?php echo $record["motherMobNo"];?></td>
                </tr>
                <tr>
                  <td>9.</td>
                  <td>Guardian Name</td>
                  <td class="text-center">:</td>
                  <td><?php echo $record["guardianName"];?></td>
                  <td>10.</td>
                  <td>Relationship</td>
                  <td class="text-center">:</td>
                  <td><?php echo $record["relation"];?></td>
                </tr>
                <tr>
                  <td>11.</td>
                  <td>Occupation</td>
                  <td class="text-center">:</td>
                  <td><?php echo $record["guardianOccup"];?></td>
                  <td>12.</td>
                  <td>Mobile</td>
                  <td class="text-center">:</td>
                  <td><?php echo $record["guardianMobNo"];?></td>
                </tr>
                <tr>
                  <td>13.</td>
                  <td>Railway Station</td>
                  <td class="text-center">:</td>
                  <td><?php echo $record["applcntRlyStation"];?></td>
                  <td>14.</td>
                  <td>No. of Family Mem.</td>
                  <td class="text-center">:</td>
                  <td><?php echo $record["familyMemCnt"];?></td>
                </tr>
            </table>
            		</div>
                </div>
                <div class="tab-pane fade" id="nav-Contact" role="tabpanel" aria-labelledby="nav-Contact-tab">
                	<div class="mt-2">
                        <p style="text-align:center; font-weight:bold; background:#f7f7f7; border-bottom:1px solid #d0d0d0; padding:5px 0 5px 0">Permanent Address <i class="fa fa-arrow-circle-o-down"></i></p>
                
                        <table width="100%" cellpadding="4" cellspacing="0" border="1" bordercolor="#d5d5d5" style="border-collapse:collapse">
                            <tr>
                                <td width="3%">1.</td>
                                <td width="14%">Address</td>
                                <td width="2%" class="text-center">:</td>
                                <td colspan="5"><?php echo $record["permntAddr"];?></td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>P.O.</td>
                                <td class="text-center">:</td>
                                <td width="33%"><?php echo $record["permntPO"];?></td>
                                <td width="3%">3.</td>
                                <td width="14%">P.S.</td>
                                <td width="2%">:</td>
                                <td width="29%"><?php echo $record["permntPS"];?></td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>Locality</td>
                                <td class="text-center">:</td>
                                <td><?php echo $record["permntLocality"];?></td>
                                <td>5.</td>
                                <td>City/Village</td>
                                <td class="text-center">:</td>
                                <td><?php echo $record["permntCity"];?></td>            
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td>District</td>
                                <td class="text-center">:</td>
                                <td><?php echo $record["permntDistrict"];?></td>
                                <td>7.</td>
                                <td>State</td>
                                <td class="text-center">:</td>
                                <td><?php echo $record["permntState"];?></td>
                            </tr>
                            <tr>
                                <td>8.</td>
                                <td>Country</td>
                                <td class="text-center">:</td>
                                <td><?php echo $record["permntCountry"];?></td>
                                <td>9.</td>
                                <td>Pin</td>
                                <td class="text-center">:</td>
                                <td><?php echo $record["permntPin"];?></td>
                            </tr>
                        </table>
                        
                        <p style="text-align:center; font-weight:bold; background:#f7f7f7; border-bottom:1px solid #d0d0d0; padding:5px 0 5px 0">Communication Address <i class="fa fa-arrow-circle-o-down"></i></p>
                        
                        <table width="100%" cellpadding="4" cellspacing="0" border="1" bordercolor="#d5d5d5" style="border-collapse:collapse">
                            <tr>
                                <td width="3%">1.</td>
                                <td width="14%">Address</td>
                                <td width="2%" class="text-center">:</td>
                                <td colspan="5"><?php echo $record["localAddr"];?></td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>P.O.</td>
                                <td class="text-center">:</td>
                                <td width="33%"><?php echo $record["localPO"];?></td>
                                <td width="3%">3.</td>
                                <td width="14%">P.S.</td>
                                <td width="2%">:</td>
                                <td width="29%"><?php echo $record["localPS"];?></td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>Locality</td>
                                <td class="text-center">:</td>
                                <td><?php echo $record["localLocality"];?></td>
                                <td>5.</td>
                                <td>City/Village</td>
                                <td class="text-center">:</td>
                                <td><?php echo $record["localCity"];?></td>            
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td>District</td>
                                <td class="text-center">:</td>
                                <td><?php echo $record["localDistrict"];?></td>
                                <td>7.</td>
                                <td>State</td>
                                <td class="text-center">:</td>
                                <td><?php echo $record["localState"];?></td>
                            </tr>
                            <tr>
                                <td>8.</td>
                                <td>Country</td>
                                <td class="text-center">:</td>
                                <td><?php echo $record["localCountry"];?></td>
                                <td>9.</td>
                                <td>Pin</td>
                                <td class="text-center"></td>
                                <td><?php echo $record["localPin"];?></td>
                            </tr>
                        </table>
                        
                        <p style="text-align:center; font-weight:bold; background:#f7f7f7; border-bottom:1px solid #d0d0d0; padding:5px 0 5px 0">Contact info <i class="fa fa-arrow-circle-o-down"></i></p>
                        
                        <table width="100%" cellpadding="4" cellspacing="0" border="1" bordercolor="#d5d5d5" style="border-collapse:collapse">
                            <tr>
                                <td width="2%">1.</td>
                                <td width="13%">Mobile No.</td>
                                <td width="1%" class="text-center">:</td>
                                <td width="15%"><?php echo $record["applcntMobNo"];?></td>
                                <td width="2%">2.</td>
                                <td width="17%">Alt. Mobile No.</td>
                                <td width="1%" class="text-center">:</td>
                                <td width="15%"><?php echo $record["alternateMobileNo"];?></td>
                                <td width="2%">3.</td>
                                <td width="16%">Whatsapp No.</td>
                                <td width="1%" class="text-center">:</td>
                                <td width="15%"><?php echo $record["WhatsAppno"];?></td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>E-mail Id</td>
                                <td class="text-center">:</td>
                                <td colspan="9"><?php echo $record["applcntEmail"];?></td>
                            </tr>
                        </table>
                        <br><br>
                    </div>
                </div>
            </div>
            
        </div>
        <?php include("footer.php");?>
    </div>	
    <?php include("footer_includes.php");?>    
</body>
</html> 
<script src="js/dashboard.js"></script> 
