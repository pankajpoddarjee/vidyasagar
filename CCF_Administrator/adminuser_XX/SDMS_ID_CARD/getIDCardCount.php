<?php
 include("../../../connection.php");
include("../../../function.php");


$cnt = 0;

$session = $_POST["session"];
$semester = $_POST["semester"]; 
  $searchstr = " WHERE st.collegeRollno=st.collegeRollno";
  
   if($_POST["subject"]!='All'){
	 $searchstr .= " and st.appsubjectcode='".$_POST["subject"]."'";
	 }
	
  if($semester=='I') {
	  $query	=	" select count(st.collegeRollno) as cnt from studentmaster st JOIN studentSession ss on ss.collegeRollNo=st.collegeRollno ".$searchstr."  and ss.semester='I' and  ss.session='".$session."';";
  }
  else {
	    $query	=	"select count(st.collegeRollno) as cnt from studentmaster st JOIN studentPaymentDetail sp ON st.collegeRollno=sp.collegeRollNo ".$searchstr." and sp.admissionToSemester='".$semester."' and session='".$session."' and isnull(sp.Paid,'')='Y'  and FeeCode='ADMFEE';";
  }
  
  //echo $query;
 
$qryresult = $dbConn->query($query);
	
	if($qryresult) {
		 $row= $qryresult->fetch(PDO::FETCH_ASSOC);
 	}
$cnt =$row["cnt"];

echo json_encode($cnt);

?>