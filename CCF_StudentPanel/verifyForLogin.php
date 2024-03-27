<?php
session_start();
include("../connection_CCF.php");
include("function.php");
include("../configuration_CCF.php");
$cnt = 0;
 
$arr = array();
$record = array();
$courseType =$_POST["chocourseType"];
$dept =$_POST["choDept"];

$rollno = trim($_POST["txtrollno"]);
$DOBdd	 = $_POST["choDOBdd"];
$DOBmm  = $_POST["choDOBmm"];
$DOByy  = $_POST["choDOByy"];


 $qry	=	"select st.applicationNo,st.name,ISNULL(st.passOutStatus,'') as passOutStatus,st.collegeRollNo, ccm.stream, ccm.subjectNameDisplay from studentmaster st
JOIN College_CourseMaster ccm ON ccm.subjectcode=st.appsubjectcode where   ccm.subjectcode='".$dept."' and st.collegeRollNo='".$rollno."' and st.dd=".$DOBdd." and st.mm=".$DOBmm." and st.yy=".$DOByy." and ISNULL(st.studentActiveStatus,0)=1;";
 
/*if($courseType=='CBCS'){
$qryresult = $dbConn->query($qry);
}
else if($courseType=='CCF'){
$qryresult = $dbConn->query($qry);	
}*/

$qryresult = $dbConn->query($qry);

if($qryresult) {
 	while($row=$qryresult->fetch(PDO::FETCH_ASSOC))
	{
		$record[] = $row;
	}
 }
 $qryresult = NULL;
 
 if(count($record)>0 && $record[0]["passOutStatus"]=='')
 {
	 $_SESSION["candidateloggedin"]=1;
	 $_SESSION["studentname"]=$record[0]["name"];
	 $_SESSION["student_stream"]=$record[0]["stream"];
	 $_SESSION["student_subject"]=$record[0]["subjectNameDisplay"];
	 $_SESSION["studcollegeRollNo"]=$record[0]["collegeRollNo"];
	 $arr["status"]=1;
	 $arr["msg"]=""; 
	 /*if($courseType=='CBCS'){
		$arr["actionUrl"]="dashboard.php";
	 }
	 else if($courseType=='CCF'){
		$arr["actionUrl"]="CCFStudentPanel/dashboard.php"; 
	 }*/
     $arr["actionUrl"]="dashboard.php";

 }
 if(count($record)>0 && $record[0]["passOutStatus"]=='Y'){
	 $arr["status"]=1;
	 $arr["msg"]="You are already passed out."; 
 }
 else if(count($record)==0) {
		$arr["status"]=0;
		$arr["msg"]="Record not Found";  
}

echo json_encode($arr);

?>