<?php
include("../../connection_CCF.php");
  
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
	 
 
  $qry = "select ss.session, ss.semester, st.collegeRollno,st.name,isNULL(st.CuFormNo,'') as CuFormNo, isNULL(st.CuRegNo,'') as CuRegNo, isNULL(st.CuRollNo,'') as CuRollNo,st.dob,st.applcntMobNo,st.applcntEmail, streamDisplay,subjectName from studentSession ss JOIN studentmaster st ON st.collegeRollno=ss.collegeRollNo JOIN College_CourseMaster ccm ON  ccm.stream=st.appstream and ccm.subjectcode=st.appsubjectcode  WHERE  isnull(studentActiveStatus,0) =1 and isnull(passOutStatus,0)=0 and isnull(studentStatus,0) =1 ".$searchstr.";";

 
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
