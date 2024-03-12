<?php
include("../../connection.php");


$arr = array();
 
$collegerollno =$_POST["hdncollegerollno"];
$coursecode =$_POST["hdncourseCode"];

$GE1 = '';
$GE1Code = '';
$GE2 = '';
$GE2Code = '';
$core1 = '';
$core1Code = '';
$core2 = '';
$core2Code = '';
$core3GE3 ='';
$core3GE3Code = '';
$LCC1 = '' ;
$LCC1code = '';
$LCC2 = '' ;
$LCC2code = '';
$AECC1 = '' ;
$AECC1code = '';

$subjectupdtqry='';

if($_POST["hdncourseCode"]=='08' || $_POST["hdncourseCode"]=='09' 
|| $_POST["hdncourseCode"]=='14' || $_POST["hdncourseCode"]=='15' || $_POST["hdncourseCode"]=='16'  ) {
	$GE1 = $_POST["cboGE1subject"];
	$GE1Code = $_POST["GE1subjectcode"];
	$GE2 = $_POST["cboGE2subject"];
	$GE2Code = $_POST["GE2subjectcode"];
	$AECC1 = $_POST["cboLanguage"] ;
    $AECC1code = $_POST["txtMIL"];
	
	$subjectupdtqry = "UPDATE studentSemesterCourse SET AECC='".$AECC1."' WHERE collegeRollno='".$collegerollno."' and semester='I';";
	
	
}

if($_POST["hdncourseCode"]=='10' || $_POST["hdncourseCode"]=='13') {
	 
	$AECC1 = $_POST["cboLanguage"] ;
    $AECC1code = $_POST["txtMIL"];
	
	 
}

if($_POST["hdncourseCode"]=='11' ) {
	$core1 = $_POST["cboGeneral1subject"];
	$core1Code = $_POST["General1subjectcode"];
	$core2 = $_POST["cboGeneral2subject"];
	$core2Code = $_POST["General2subjectcode"];
	$core3GE3 = $_POST["cboGEGeneralsubject"];
	$core3GE3Code = $_POST["GEGeneralsubjectcode"];
	$LCC1 = 'English' ;
	$LCC1code = 'ENGC';
	$LCC2 = $_POST["cboLCCSub"] ;
    $LCC2code = $_POST["txtLCCCode"];
	$AECC1 = $_POST["cboLanguage"] ;
    $AECC1code = $_POST["txtMIL"];
	
	$subjectupdtqry = "UPDATE studentSemesterCourse SET AECC='".$AECC1."'  WHERE collegeRollno='".$collegerollno."' and semester='I';";
	$subjectupdtqry .= "UPDATE studentSemesterCourse SET LCC='".$LCC2."' WHERE collegeRollno='".$collegerollno."' and semester in ('IV','VI');";
	
}

if($_POST["hdncourseCode"]=='12' ) {
	$core1 = $_POST["cboGeneral1subject"];
	$core1Code = $_POST["General1subjectcode"];
	$core2 = $_POST["cboGeneral2subject"];
	$core2Code = $_POST["General2subjectcode"];
	$core3GE3  = $_POST["cboGeneral3subject"];
	$core3GE3Code = $_POST["General3subjectcode"];	
	$AECC1 = $_POST["cboLanguage"] ;
    $AECC1code = $_POST["txtMIL"];
	
	$subjectupdtqry = "UPDATE studentSemesterCourse SET AECC='".$AECC1."' WHERE collegeRollno='".$collegerollno."' and semester='I';";
	
}
 
 $recordqry ="UPDATE  studentmaster SET GE1='".$GE1."'
      ,GE1Code='".$GE1Code."'
      ,GE2='".$GE2."'
      ,GE2Code='".$GE2Code."'
      ,CORE1='".$core1."'
      ,CORE1Code='".$core1Code."'
      ,CORE2='".$core2."'
      ,CORE2Code='".$core2Code."'
      ,CORE3_GE3='".$core3GE3."'
      ,CORE3_GE3Code='".$core3GE3Code."'
      ,AECC1 ='".$AECC1."'
      ,AECC1_Code='".$AECC1code."'
	  ,LCC1='".$LCC1."'
	  ,LCC1_Code='".$LCC1code."'
	  ,LCC2='".$LCC2."'
      ,LCC2_Code='".$LCC2code."' WHERE collegeRollNo='".$collegerollno."';";
	  
 $finalqry= $recordqry.$subjectupdtqry;


//echo $finalqry;
//exit;
  
$recordresult = $dbConn->query($finalqry);

if($recordresult) {
	$arr['status'] =1;
	$arr['msg']= "Successfully Updated.";
}
else
{
	$arr['status'] =0;
	$arr['msg']= "Try again.";
}
 
 
 $recordresult =  NULL;
$dbConn=  NULL;

echo json_encode($arr);
?>
