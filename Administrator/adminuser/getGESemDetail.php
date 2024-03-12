<?php
include("../../connection.php");
  
$SEMrecord  = array();
 
 $collegerollno =  $_POST["collegeRollno"];
  
 $qry = "select semester,generalCourse,dbo.getSubjectCode(generalCourse) as generalCourseCode
  from studentSemesterCourse where collegeRollno='".$collegerollno."' ;";

 
$qryresult =$dbConn->query($qry);

if($qryresult) {
	while ($row=$qryresult->fetch(PDO::FETCH_ASSOC)) {
					$SEMrecord[$row["semester"]] = $row;
			}
}
 
$qryresult = NULL;
$dbConn = NULL;

echo json_encode($SEMrecord);
?>
