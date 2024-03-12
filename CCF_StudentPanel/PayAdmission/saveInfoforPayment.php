<?php
 include("../../connection_CCF.php");
 include("../function.php");
 include("../../configuration_CCF.php");

$cnt = 0;
  
$arr = array();
$val = array();

  
$paydetailid = $_POST["hdnpaydetailid"];
$admittedsemester = $_POST["choAdmitedSemester"];
$mobileno = $_POST["txtmobile"];
$email = $_POST["txtemail"];
$collegerollno = $_POST["hdncollegerollno"];

$reqInternshipVal = $_POST["hdnInternshipVal"];

if($reqInternshipVal==1) {
	if($admittedsemester=='VI') {
		$Internship = 'Yes';	
		}
	else {
		$Internship = $_POST["choInternship"];
		}
}
else {
		$Internship = '';
}	

 
 $checkrecord=array();
 
 $checkqry = "select id from studentPaymentDetail WHERE collegeRollNo='".$collegerollno."' and studentStatusforPay=1 and session='".ACADEMIC_SESSION."' and FeeCode='ADMFEE'   and admissionToSemester='".$admittedsemester."' and id<>".$paydetailid."";

$checkresult = $dbConn->query($checkqry);

if($checkresult) {
	while ($checkrow=$checkresult->fetch(PDO::FETCH_ASSOC)){
					$checkrecord[] = $checkrow;
			}
}
 if(count($checkrecord)>0 ) {
	 $arr["status"]=0;
	$arr["msg"]="Please Check the - To be Admitted Semester. A fee record with the selected  - To be Admitted Semester for the Session already Exists. Please using the existing link if you want to pay Fee for the selected - To be Admitted Semester.";  
	 
 }
 else {
 $qry	= "UPDATE studentSemesterCourse SET Internship='".$Internship."' where collegeRollno='".$collegerollno."' and semester='".$admittedsemester."';";

 $qry	.= "UPDATE studentPaymentDetail SET admissionToSemester='".$admittedsemester."',applcntMobNo='".$mobileno."', applcntEmail='".$email."' where id=".$paydetailid.";"; 
 
 if(isset($_POST["choSEC"])){
	 
	 $qry	.= "EXEC [dbo].[update_courseSemester] '".$_POST["choSEC"]."','".$admittedsemester."','".$collegerollno."';";
	 
	// $qry	.= "UPDATE studentSemesterCourse SET SEC = '".$_POST["choSEC"]."' WHERE semester='".$admittedsemester."' and collegeRollno='".$collegerollno."';"; 
}
 
 $qryresult = $dbConn->query($qry);

	if($qryresult) {
		 $arr["status"]=1;
		$arr["msg"]="";	 
	 }
	 else {
			$arr["status"]=0;
			$arr["msg"]="Please Check the - To be Admitted Semester. A fee record with the selected  - To be Admitted Semester for the Session already Exists. Please contact College Office / System Administrator";  
		}
		
 }

echo json_encode($arr);

?>