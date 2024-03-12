<?php
 include("../../../connection_CCF.php");
include("../../../function.php");
 
$cnt = 0;
 
$arr = array();
$val = array();

$session = $_POST["session"];
$semester = $_POST["semester"];
 $collegeRollno =$_POST["CollegeRollNo"];
 //$applicationno =$_POST["applno"];
 
 
 
if($collegeRollno !='') {
	if($semester=='I') {
		 $qry	=	"select * from studentmaster st WHERE st.collegeRollno='".$collegeRollno."' and presentsemester='I' and presentsession='".$session."';";

	}
  else {
	    $qry	=	"select * from studentmaster st JOIN studentPaymentDetail sp ON st.collegeRollno=sp.collegeRollNo WHERE st.collegeRollno='".$collegeRollno."' and sp.admissionToSemester='".$semester."' and session='".$session."' and isnull(sp.Paid,'')='Y';";
	}
}
/* else if($applicationno!=''){
	if($session=='I') {
		$qry	=	"select * from studentmaster WHERE applicationNo='".$applicationno."' and presentsemester='I' and presentsession='".$session."';";
	}
	else {
	    $qry	=	"select * from studentmaster st JOIN studentPaymentDetail sp ON st.collegeRollno=sp.collegeRollNo WHERE applicationNo='".$applicationno."' and semester='".$semester."' and session='".$session."' and isnull(sp.Paid,'')='Y';";
	}
 
} */

$qryresult = $dbConn->query($qry);

if($qryresult) {
 	while($row=$qryresult->fetch(PDO::FETCH_ASSOC))
	{
		$val[] = $row;
	}
 }
 if(count($val)>0)
 {
	 $arr["status"]=1;
		
 }
 else {
		$arr["status"]=0;
		$arr["msg"]="Record not Found";  
	}

echo json_encode($arr);

?>