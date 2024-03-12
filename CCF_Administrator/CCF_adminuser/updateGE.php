<?php
include("../../connection_CCF.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$arr = array();
 
$collegerollno =$_POST["hdncollegerollno"];
$coursecode =$_POST["hdncourseCode"];

$GE1subject = '';
$GE2subject = '';
$core1subject = '';
$core2subject = '';
$core3GE3subject ='';
$AECC2subject = '' ;
$CVAC1subject="";
$CVAC2subject="";
$CVAC3subject="";
$CVAC4subject="";
$SEC1subject="";
$SEC2subject="";
$SEC3subject="";
$AEC4subject="";
$IDC1subject="";
$IDC2subject="";
$IDC3subject="";

$subjectupdtqry='';

if($_POST["hdncourseCode"]=='08' || $_POST["hdncourseCode"]=='09' 
|| $_POST["hdncourseCode"]=='14' || $_POST["hdncourseCode"]=='15' || $_POST["hdncourseCode"]=='16'  ) {
	$GE1subject = $_POST["cboGE1subject"];
	$GE2subject = $_POST["cboGE2subject"];
	$AECC2subject = $_POST["cboLanguage"] ;
    $CVAC1subject =   $_POST["cboCVAC13subject"] ;
	$CVAC2subject =   $_POST["cboCVAC2subject"] ;
	$CVAC3subject =  $_POST["cboCVAC13subject"] ;
	$CVAC4subject =  $_POST["cboCVAC4subject"] ;
	$SEC1subject =  $_POST["cboSEC1subject"] ;
	$SEC2subject =  $_POST["cboSEC2subject"] ;
	$SEC3subject =  $_POST["cboSEC3subject"] ;
	$IDC1subject =   $_POST["cboIDC1subject"] ;
	$IDC2subject =   $_POST["cboIDC2subject"] ;
	$IDC3subject =    $_POST["cboIDC3subject"] ;
	
	//$subjectupdtqry = "UPDATE studentSemesterCourse SET AECC='".$AECC2."' WHERE collegeRollno='".$collegerollno."' and semester='I';";
	
	
}

if($_POST["hdncourseCode"]=='10' || $_POST["hdncourseCode"]=='13') {
	 
	$AECC2 = $_POST["cboLanguage"] ;
   // $AECC1code = $_POST["txtMIL"];
	
	 
}

if($_POST["hdncourseCode"]=='11' || $_POST["hdncourseCode"]=='12' ) {
	$core1subject = $_POST["cboCore1subject"];
	$core2subject = $_POST["cboCore2subject"];
	$core3GE3subject = $_POST["cboMinorsubject"];
	$AECC2subject = $_POST["cboLanguage"] ;
    $CVAC1subject =   $_POST["cboCVAC13subject"] ;
	$CVAC2subject =  $_POST["cboCVAC2subject"] ;
	$CVAC3subject =  $_POST["cboCVAC13subject"] ;
	$CVAC4subject =  $_POST["cboCVAC4subject"] ;
	$SEC1subject =  $_POST["cboSEC1subject"] ;
	$SEC2subject =  $_POST["cboSEC2subject"] ;
	$SEC3subject =  $_POST["cboSEC3subject"] ;
	$IDC1subject =  $_POST["cboIDC1subject"] ;
	$IDC2subject =   $_POST["cboIDC2subject"] ;
	$IDC3subject =   $_POST["cboIDC3subject"] ;
	
	//$subjectupdtqry = "UPDATE studentSemesterCourse SET AECC='".$AECC2."'  WHERE collegeRollno='".$collegerollno."' and semester='I';";
	 
	
}

 
 
 $recordqry ="UPDATE  studentmaster SET GE1='".$GE1subject."'
		,GE2='".$GE2subject."'
		,CORE1='".$core1subject."'
		,CORE2='".$core2subject."'
		,CORE3_GE3='".$core3GE3subject."'
		,CVAC1='".$CVAC1subject."'
		,CVAC2='".$CVAC2subject."'
		,CVAC3='".$CVAC3subject."'
		,CVAC4='".$CVAC4subject."'
		,SEC1='".$SEC1subject."'
		,SEC2='".$SEC2subject."'
		,SEC3='".$SEC3subject."'
		,IDC1='".$IDC1subject."'
		,IDC2='".$IDC2subject."'
		,IDC3='".$IDC3subject."' 
		,AECC2 ='".$AECC2subject."'
		WHERE collegeRollNo='".$collegerollno."';";
	  
 $finalqry= $recordqry.$subjectupdtqry;

 
  
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
