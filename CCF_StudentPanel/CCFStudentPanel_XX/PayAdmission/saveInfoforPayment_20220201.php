<?php
 include("../../connection.php");
 include("../function.php");
 include("../../configuration.php");

$cnt = 0;
  
$arr = array();
$val = array();

  
$paydetailid = $_POST["hdnpaydetailid"];
$admittedsemester = $_POST["choAdmitedSemester"];
$mobileno = $_POST["txtmobile"];
$email = $_POST["txtemail"];
$collegerollno = $_POST["hdncollegerollno"];
 

 
// $qry	= "UPDATE studentmaster SET admissionToSemester='".$admittedsemester."',applcntMobNo='".$mobileno."', applcntEmail='".$email."' where session='".ACADEMIC_SESSION."' and semester='".$presentsemester."' and RollNo='".$rollno."' ;";

 $qry	= "UPDATE studentPaymentDetail SET admissionToSemester='".$admittedsemester."',applcntMobNo='".$mobileno."', applcntEmail='".$email."' where id=".$paydetailid.";"; 
 
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
			$arr["msg"]="Try Again.";  
		}

echo json_encode($arr);

?>