<?php
include("../../connection.php");
  
$collegerollno = $_POST["StudentRollno"];


 $fetchallqry = "select stid,appid,appliedsession,presentsemester,collegeRollno,	registrationNo,	applicationNo,	candidateFirstName,candidateMiddleName,candidateLastName,name,	dd,	mm,	yy,	dob,sex,bloodgroup,	married,nationality,religion,	otherReligion,	hsstream,	caste,	stateofdomicile,scstStateOther, extraActivity, distancefromResidence,	lastResided	,hasKanyashree,	kanyashreeid,	haschronicDisease,aboutchronicDisease, hasCuRegNo,	CuRegNo,CuRollNo,NFE,hasSecLanguage,	hasENVS,	firstGenrLearner,	minoritygrp,MIL,motherTongue,	PH,	disabilitytype,	disabilityPercentage,	CH,	CNI,	passyear,	isApplySportsQuota,	sportlevel,sportname,	selfFinanceCourse,	isapplyAddonCourse,	AddonCourses,	mediumofinstruction,	APLBPL,	bplno,	EWS,annualIncome,	parentName,	fathername,	fatherQalif,	fatherOccup,	fatherOfficeAddress,	fatherMobNo,	motherName,motherQalif,	motherOccup,	motherMobNo,	parentEmail,	monthlyIncome,	familyMemCnt,	guardianName,	relation,	guardianOccup,guardianOfficeAddress,	guardianStdCode,	guardianContNo,	guardianMobNo,	guardianEmail,	permntFullAddr,	permntAddr,permntPO,	permntPS,	permntCity,	permntDistrict,	permntLocality,	permntState,	permntCountry,	permntPin,	permntMobNo,	permntSTD,permntPhoneNo,	localAddr,	localPO,	localPS,	localCity,	localDistrict,	localLocality,	localState,	localCountry,localPin,	localMobNo,	localSTD,	localPhoneNo,	communicatAddress,	contactNo,	applcntMobNo,	alternateMobileNo,hasWhatsAppno,	WhatsAppno,	applcntEmail,	aadharNo,	candidtLoc,	applcntState,	applcntDistrict,	applcntPO,	applcntRlyStation,migrtnFrom,	migrtnBoard,	TCNo,	TCDate,	CURegistrationNo,	playercateg,	staffWard,	boardflag,	boardCode,	otherBoardName,	WBRoll,	WBNo,rollnoforOB,	RollNo,	HSRegistartionNo,	boardYear,	institution,	institutionAddress,	institutionCity,institutionDistrict,	institutionState,	institutionCountry,	institutionPin,	Passed,	photo,	signature, 	appsection,	appstream,	appsubject,	appsubjectcode  from studentmaster where  collegeRollno='".$collegerollno."'";

$qryresult = $dbConn->query($fetchallqry);

if($qryresult) {
	while ($row=$qryresult->fetch(PDO::FETCH_ASSOC)){
				foreach ($row as $colNum=>$value ){
					
					$record[$colNum] = trim($value);
				}
			}
}

$qryresult = NULL;
$dbConn  = NULL;
 		
echo json_encode($record);


?>
