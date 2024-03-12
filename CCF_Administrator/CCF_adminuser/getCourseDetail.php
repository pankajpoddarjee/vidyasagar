<?php
include("../../connection_CCF.php");
include("../../function.php");

  
$record  = array();
 
 $collegerollno = $_POST["collegeRollno"];
 
 // $qry = "SELECT  appsection,stream,appsubject,appsubjectcode,subjectName,subjectCode, UPPER(general1) as general1,UPPER(general2) as general2 ,UPPER(general3) as general3,general1code,general2code,general3code,UPPER(LCC) as LCC,LCCCode,board,boardcode,boardType,courseCode,courseName,UPPER(MIL) as MIL,compulsarySubjectCode,disabilitytype ,disabilityPercentage,annualFamilyIncome ,APLorBPL,localitytype,AadharCardNo, UPPER(GE1) as GE1,UPPER(GE2) as GE2,UPPER(CORE1) as CORE1,UPPER(CORE2) as CORE2,UPPER(CORE3_GE3) as CORE3_GE3,UPPER(GESem1) as GESem1,UPPER(GESem2) as GESem2,UPPER(GESem3) as GESem3,UPPER(GESem4) as GESem4,UPPER(CC1) as CC1,UPPER(CC2) as CC2,UPPER(CC3) as CC3,UPPER( GEGeneral) as GEGeneral ,GE1Code,GE2Code, CORE1Code,CORE2Code, CORE3_GE3Code, GESem1Code,GESem2Code,GESem3Code,GESem4Code,CC1Code,CC2Code,CC3Code,GEGeneralCode, examName  FROM studentmaster WHERE applicationNo='".$applicationNo."';";
 
  $qry = "select appsection,appstream,appsubject,appsubjectcode, courseCode,
courseName,UPPER(MIL) as MIL, GE1 , GE2 , CORE1 , CORE2 , CORE3_GE3 ,CVAC1,CVAC2,	CVAC3,CVAC4, SEC1,	SEC2,	SEC3,	IDC1,	IDC2,	IDC3 , AECC2,	LCC2,LCC2_Code  from studentmaster st JOIN CU_course course ON course.stream=st.appstream WHERE st.collegeRollNo='".$collegerollno."';";
 

 
$qryresult =$dbConn->query($qry);

if($qryresult) {
	while ($row=$qryresult->fetch(PDO::FETCH_ASSOC)) {
				foreach ($row as $colNum=>$value) {
					$record[$colNum] = trim($value);
				}
			}
}

$qryresult = NULL;
$dbConn = NULL;

echo json_encode($record);
?>
