<?php
include("../../connection.php");
  
 $record =array();
$searchstr ="";  
  
	if($_POST["choapplySession"]!="All" )
		$searchstr=$searchstr . " and st.appliedsession='" . $_POST["choapplySession"] . "' ";
  
	if($_POST["chopresentSession"]!="All" )
		$searchstr=$searchstr . "and ss.session='" . $_POST["chopresentSession"] . "' ";
	
	if($_POST["chosemester"]!="All" )
		$searchstr=$searchstr . "and ss.semester='" . $_POST["chosemester"] . "' ";
	
	if($_POST["chostream"]!="All" )
		$searchstr=$searchstr . "and st.appstream='" . $_POST["chostream"] . "' ";
	
	if($_POST["chosubject"]!="All" )
		$searchstr=$searchstr . "and st.appsubjectcode='" . $_POST["chosubject"] . "' ";
	
	 if($_POST["chogender"]!="All" )
		$searchstr=$searchstr . "and st.sex='" . $_POST["chogender"] . "' ";
	
	if($_POST["choDomicile"]!="All" )
		$searchstr=$searchstr . "and st.stateofdomicile='" . $_POST["choDomicile"] . "' ";
	
	if($_POST["chocategory"]!="All" )
		$searchstr=$searchstr . "and st.caste='" . $_POST["chocategory"] . "' ";
	
	if($_POST["chominority"]!="All" )
		$searchstr=$searchstr . "and st.minoritygrp='" . $_POST["chominority"] . "' ";
	
	if($_POST["choAPLBPL"]!="All" )
		$searchstr=$searchstr . "and st.minoritygrp='" . $_POST["choAPLBPL"] . "' ";
 
  $qry = "select ss.session, ss.semester, st.collegeRollno,st.name,st.dob,st.applcntMobNo,st.applcntEmail, streamDisplay,subjectName,sex,religion,otherReligion, isNULL(st.CuRegNo,'') as CuRegNo, isNULL(st.CuRollNo,'') as CuRollNo,stateofdomicile,scstStateOther, caste,minoritygrp,APLBPL from studentSession ss JOIN studentmaster st ON st.collegeRollno=ss.collegeRollNo JOIN College_CourseMaster ccm ON  ccm.stream=st.appstream and ccm.subjectcode=st.appsubjectcode  WHERE  isnull(studentActiveStatus,0) =1 and isnull(passOutStatus,0)=0 and isnull(studentStatus,0) =1 ".$searchstr.";";

 
$result = $dbConn->query($qry);

if($result) {
	while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
	$record[] =$row; 
	}
}
 $arr["recordcnt"]  = count($record);
 $arr["record"]	 = $record;


$result = NULL;
$dbConn = NULL;


echo json_encode($arr);


?>
