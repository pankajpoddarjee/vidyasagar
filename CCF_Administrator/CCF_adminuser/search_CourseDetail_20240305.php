<?php
include("../../connection_CCF.php");
  
 $record =array();
$searchstr ="";  
  
	  if($_POST["choapplySession"]!="All" )
		$searchstr=$searchstr . " and st.appliedsession='" . $_POST["choapplySession"] . "' ";
	
	if($_POST["chopresentSession"]!="All" )
		$searchstr=$searchstr . " and st.presentsession='" . $_POST["chopresentSession"] . "' ";
	
	if($_POST["chopresentSem"]!="All" )
		$searchstr=$searchstr . " and st.presentsemester='" . $_POST["chopresentSem"] . "' ";
	 
		  $searchstr=$searchstr . " and st.appstream='".$_POST["chostream"]."' ";
	
	if($_POST["chosubject"]!="All" )
		$searchstr=$searchstr . " and st.appsubjectcode='" . $_POST["chosubject"] . "' ";  
 

$headqry = "select stream,semester,ltrim(rtrim(CoreCourse1)) as CoreCourse1,ltrim(rtrim(CoreCourse2)) CoreCourse2, 	ltrim(rtrim(CoreCourse3)) as CoreCourse3,	ltrim(rtrim(generalCourse)) as generalCourse,ltrim(rtrim(LCC)) as LCC,ltrim(rtrim(DSE1)) as DSE1,	ltrim(rtrim(DSE2)) as DSE2,	ltrim(rtrim(DSE3)) as DSE3,ltrim(rtrim(AECC)) as AECC,	ltrim(rtrim(SEC)) as SEC from Master_SemesterCourse WHERE stream='".$_POST["chostream"]."';";
 
$headresult = $dbConn->query($headqry);

if($headresult) {
	while ($headrow=$headresult->fetch(PDO::FETCH_ASSOC)) {
	$headrecord[$headrow["semester"]][] =$headrow; 
	}
}

$studqry = "select appliedsession,st.collegeRollno,presentsession,presentsemester,applicationNo,name,isNULL(st.CuFormNo,'') as CuFormNo, isNULL(st.CuRegNo,'') as CuRegNo, isNULL(st.CuRollNo,'') as CuRollNo,appstream,appsubject  from studentmaster st   WHERE ISNULL(studentActiveStatus,0)=1 ".$searchstr."  ORDER BY appliedsession,presentsession, presentsemester;";
 
$studresult = $dbConn->query($studqry);

if($studresult) {
	while ($studrow=$studresult->fetch(PDO::FETCH_ASSOC)) {
	$studrecord[] =$studrow; 
	}
}

$courseqry = "select  st.collegeRollno, 
cd.semester,cd.CoreCourse1,cd.CoreCourse2,cd.CoreCourse3,cd.generalCourse,cd.LCC,cd.DSE1,cd.DSE2, cd.DSE3,cd.AECC,cd.SEC from studentmaster st LEFT JOIN studentSemesterCourse cd ON cd.collegeRollno=st.collegeRollno WHERE ISNULL(studentActiveStatus,0)=1 ".$searchstr." ;";
 
$courseresult = $dbConn->query($courseqry);

if($courseresult) {
	while ($courserow=$courseresult->fetch(PDO::FETCH_ASSOC)) {
	$courserecord[$courserow["collegeRollno"]][$courserow["semester"]]  =$courserow;  
	}
}
 
 $semarr = array('I','II','III','IV','V','VI');

 //print_r($courserecord);
 
 $str ="";
 
	$str .="<table class='table table-bordered table-hover'>";
	$str .="<thead>";
	$str .="<tr class='bg-light text-nowrap'>";
	$str .="<td>Sl. No.</td>";
	$str .= "<td>College Roll No</td>";
	$str .= "<td>CU Form No</td>";
	$str .= "<td>CU Reg No</td>";
	$str .= "<td>CU Roll No</td>";
	$str .="<td>Applied Session</td>";
	$str .="<td>Present Semester</td>";
	$str .="<td>Name</td>";
	$str .="<td>Stream</td>";
	$str .="<td>Subject</td>";
	
	foreach($semarr as $sem) {
		foreach($headrecord[$sem] as $headrec) {
		$str .="<td>Semester</td>";
		if($headrec["CoreCourse1"]!='') { $str .="<td>".$headrec["CoreCourse1"]."</td>"; }
		if($headrec["CoreCourse2"]!='') { $str .="<td>".$headrec["CoreCourse2"]."</td>"; }
		if($headrec["CoreCourse3"]!='') { $str .="<td>".$headrec["CoreCourse3"]."</td>"; }
		if($headrec["generalCourse"]!='') { $str .="<td>".$headrec["generalCourse"]."</td>"; }
		if(trim($headrec["LCC"])!='') { $str .="<td>".$headrec["LCC"]."</td>"; }
		if($headrec["DSE1"]!='') { $str .="<td>".$headrec["DSE1"]."</td>"; }
		if($headrec["DSE2"]!='') { $str .="<td>".$headrec["DSE2"]."</td>"; }
		if(trim($headrec["DSE3"])!='') { $str .="<td>".$headrec["DSE3"]."</td>"; }
		if($headrec["AECC"]!='') { $str .="<td>".$headrec["AECC"]."</td>"; }
		if($headrec["SEC"]!='') { $str .="<td>".$headrec["SEC"]."</td>"; }
		} 	
	}
	$i=0;
	foreach($studrecord as $studrec) {
		$i=$i+1;
	$str .="</tr>";
	$str .="</thead>";
	$str .="<tr class='bg-light text-nowrap'>";
	$str .="<td>".$i."</td>";
	$str .="<td>".$studrec["collegeRollno"]."</td>";
	$str .="<td>".$studrec["CuFormNo"]."</td>";
	$str .="<td>".$studrec["CuRegNo"]."</td>";
	$str .="<td>".$studrec["CuRollNo"]."</td>";
	$str .="<td>".$studrec["appliedsession"]."</td>";
	$str .="<td>".$studrec["presentsemester"]."</td>";
	$str .="<td>".$studrec["name"]."</td>";
	$str .="<td>".$studrec["appstream"]."</td>";
	$str .="<td>".$studrec["appsubject"]."</td>";
	foreach($semarr as $sem) {
		foreach($headrecord[$sem] as $headrec) {
		$str .="<td>".$sem."</td>";			
		if($headrec["CoreCourse1"]!='') {$str .="<td>".$courserecord[$studrec["collegeRollno"]][$sem]["CoreCourse1"]."</td>"; }
		if($headrec["CoreCourse2"]!='') { $str .="<td>".$courserecord[$studrec["collegeRollno"]][$sem]["CoreCourse2"]."</td>"; }
		if($headrec["CoreCourse3"]!='') { $str .="<td>".$courserecord[$studrec["collegeRollno"]][$sem]["CoreCourse3"]."</td>"; }
		if($headrec["generalCourse"]!='') { $str .="<td>".$courserecord[$studrec["collegeRollno"]][$sem]["generalCourse"]."</td>"; }
		if(trim($headrec["LCC"])!='') { $str .="<td>".$courserecord[$studrec["collegeRollno"]][$sem]["LCC"]."</td>"; }
		if($headrec["DSE1"]!='') { $str .="<td>".$courserecord[$studrec["collegeRollno"]][$sem]["DSE1"]."</td>"; }
		if($headrec["DSE2"]!='') { $str .="<td>".$courserecord[$studrec["collegeRollno"]][$sem]["DSE2"]."</td>"; }
		if(trim($headrec["DSE3"])!='') { $str .="<td>".$courserecord[$studrec["collegeRollno"]][$sem]["DSE3"]."</td>"; }
		if($headrec["AECC"]!='') { $str .="<td>".$courserecord[$studrec["collegeRollno"]][$sem]["AECC"]."</td>"; }
		if($headrec["SEC"]!='') { $str .="<td>".$courserecord[$studrec["collegeRollno"]][$sem]["SEC"]."</td>"; }
		} 	
	}
	
	$str .="</tr>";
	}
	
	$str .="<table>";
 
 
$headresult = NULL;
$courseresult = NULL;
$dbConn = NULL;

$arr = array();

$arr["str"]=$str;
$arr["reccount"] = count($studrecord);

echo json_encode($arr) ;


?>
