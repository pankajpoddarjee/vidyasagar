<?php
session_start();
 include("../connection.php");
include("function.php");
include("../configuration.php");
$cnt = 0;
 
$arr = array();
$record = array();

 $dept =$_POST["choDept"];
//$semester =$_POST["choSemester"];
$rollno = trim($_POST["txtrollno"]);
 $DOBdd	 = $_POST["choDOBdd"];
$DOBmm  = $_POST["choDOBmm"];
$DOByy  = $_POST["choDOByy"];


    $qry	=	"select applicationNo,name,ISNULL(passOutStatus,'') as passOutStatus,collegeRollNo from studentmaster st
JOIN College_CourseMaster ccm ON ccm.subjectcode=st.appsubjectcode where   ccm.subjectcode='".$dept."' and st.collegeRollNo='".$rollno."' and dd='".$DOBdd."' and mm='".$DOBmm."' and yy='".$DOByy."' and ISNULL(studentActiveStatus,0)=1;";
 
 
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
	  $_SESSION["studcollegeRollNo"]=$record[0]["collegeRollNo"];
	 $arr["status"]=1;
	 $arr["msg"]="";
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