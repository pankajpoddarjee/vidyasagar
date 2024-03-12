<?php
include("../../connection.php");
  
 $record =array();
$searchstr =""; 

	if($_POST["chosession"]!="All" )
		$searchstr=$searchstr . "and spd.session='" . $_POST["chosession"] . "' "; 
  
	if($_POST["chostream"]!="All" ){
		$coursestr .=" and stream='".$_POST["chostream"]."'";
		$searchstr=$searchstr . "and st.appstream='" . $_POST["chostream"] . "' ";
	}
	else {
		$stream=" WHERE stream=stream";
	}
	if($_POST["chosubject"]!="All" ) {
		$searchstr=$searchstr . "and st.appsubjectcode='" . $_POST["chosubject"] . "' ";
		$coursestr=$coursestr . "and st.appsubjectcode='" . $_POST["chosubject"] . "' ";
	}
	
	if($_POST["chofeeType"]!="All" )
		$searchstr=$searchstr . "and fm.FeeDetail='" . $_POST["chofeeType"] . "' ";
	 
	if($_POST["choPaidstatus"]!="All" ){
		if($_POST["choPaidstatus"]=="Y" ) 
			$searchstr=$searchstr . "and isnull(spd.Paid,'') ='Y' ";
		else
			$searchstr=$searchstr . "and isnull(spd.Paid,'') !='Y' ";
	}
	
	
	if($_POST["txtPaymentDateFrom"]!='')
	{
	$searchstr .= " and  convert(date, spd.paymentDate ,103)>=convert(date,'".$_POST["txtPaymentDateFrom"]."',103)"  ;
	}
	if($_POST["txtPaymentDateTo"]!='')
	{
	$searchstr .= " and  convert(date, spd.paymentDate ,103)<=convert(date,'".$_POST["txtPaymentDateTo"]."',103)"  ;
	}
	
  $qry = "select  distinct spd.session as academicsession,st.collegeRollno,st.dob, spd.collegeRollNo,	spd.RollNo,spd.semester, streamDisplay,subjectName , st.name,  isNULL(st.CuFormNo,'') as CuFormNo, isNULL(st.CuRegNo,'') as CuRegNo, isNULL(st.CuRollNo,'') as CuRollNo, isnull(spd.applcntMobNo,'') as applcntMobNo,	isnull(spd.applcntEmail,'') as applcntEmail,ISNULL(spd.onlineTransactionID,'') as onlineTransactionID,isnull(spd.onlineTransactionDate,'') as onlineTransactionDate,isnull(spd.paymentdate,'') as paymentdate,isnull(fm.FeeDetail,'') as FeeDetail,isnull(fm.remarks,'') as remarks,isnull(fm.FeeAmount,'') as FeeAmount,isnull(spd.onlineTransactionAmount,'') as onlineTransactionAmount,isnull(Paid,'') as Paid  from studentPaymentDetail spd JOIN studentmaster st ON st.collegeRollNo=spd.collegeRollNo JOIN College_CourseMaster ccm ON ccm.stream=st.appstream and  ccm.subjectcode=st.appsubjectcode JOIN College_FeeStructureMaster fm ON fm.feeCode=spd.FeeCode and fm.sesssionYear=spd.session and fm.Semester=spd.semester and  fm.feeParticulars='Total' and spd.FeeCode<>'ADMFEE' WHERE isnull(spd.studentStatusforPay,0)=1 ".$searchstr.";";

 
$result = $dbConn->query($qry);

if($result) {
	while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
	$record[] =$row; 
	}
}
$headqry = "select stream,semester,ltrim(rtrim(CoreCourse1)) as CoreCourse1,ltrim(rtrim(CoreCourse2)) CoreCourse2, 	ltrim(rtrim(CoreCourse3)) as CoreCourse3,	ltrim(rtrim(generalCourse)) as generalCourse,ltrim(rtrim(LCC)) as LCC,ltrim(rtrim(DSE1)) as DSE1,	ltrim(rtrim(DSE2)) as DSE2,	ltrim(rtrim(DSE3)) as DSE3,ltrim(rtrim(AECC)) as AECC,	ltrim(rtrim(SEC)) as SEC from Master_SemesterCourse WHERE stream='".$_POST["chostream"]."';";
 
$headresult = $dbConn->query($headqry);

if($headresult) {
	while ($headrow=$headresult->fetch(PDO::FETCH_ASSOC)) {
	$headrecord[$headrow["semester"]][] =$headrow; 
	}
}

$studqry = "select appliedsession,st.collegeRollno,presentsession,presentsemester,applicationNo,name,appstream,appsubject  from studentmaster st   WHERE ISNULL(studentActiveStatus,0)=1  ".$coursestr."   ORDER BY appliedsession,presentsession, presentsemester;";
 
$studresult = $dbConn->query($studqry);

if($studresult) {
	while ($studrow=$studresult->fetch(PDO::FETCH_ASSOC)) {
	$studrecord[] =$studrow; 
	}
}

$courseqry = "select  st.collegeRollno, 
cd.semester,cd.CoreCourse1,cd.CoreCourse2,cd.CoreCourse3,cd.generalCourse,cd.LCC,cd.DSE1,cd.DSE2, cd.DSE3,cd.AECC,cd.SEC from studentmaster st LEFT JOIN studentSemesterCourse cd ON cd.collegeRollno=st.collegeRollno WHERE ISNULL(studentActiveStatus,0)=1 ".$coursestr." ;";
 
$courseresult = $dbConn->query($courseqry);

if($courseresult) {
	while ($courserow=$courseresult->fetch(PDO::FETCH_ASSOC)) {
	$courserecord[$courserow["collegeRollno"]][$courserow["semester"]]  =$courserow;  
	}
}
 
 $semarr = array('I','II','III','IV','V','VI');

$str= "";
				$str .= "<table class='table table-bordered table-hover'>";
				$str .= "<thead>";
				$str .= "<tr class='bg-light text-nowrap'>";
				$str .= "<td>Sl. No.</td>";
				$str .= "<td>College Roll No</td>";
				$str .= "<td>CU Form No</td>";
				$str .= "<td>CU Reg No</td>";
				$str .= "<td>CU Roll No</td>";
				$str .= "<td>Academic Session</td>";
				$str .= "<td>Semester</td>";
				$str .= "<td>Name</td>";				
				$str .= "<td>Date of Birth</td>";				  
				$str .= "<td>Stream</td>";
				$str .= "<td>Subject</td>";
				$str .= "<td>Fee Detail</td>";
				$str .= "<td>Mobile</td>";
				$str .= "<td>Email</td>";
				$str .= "<td>Fee Amount</td>";
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
				 
				$str .= "<td>Paid Amount</td>";
				$str .= "<td>Transaction Id</td>";
				$str .= "<td>Transaction Date</td>";
				$str .= "<td>Payment Date</td>";
				$str .= "<td>Paid Status</td>";
				$str .= "</tr>";
				$str .= "</thead>";
				
				for($i=0; $i<count($record); $i++){	
				$str .= "<tbody id='myTable'>";
				$str .= "<tr class='text-nowrap'>";
				$str .= "<td>".(i+1)."</td>";
				$str .= "<td>".$record[$i]["collegeRollNo"]."</td>";
				$str .= "<td>".$record[$i]["CuFormNo"]."</td>";
				$str .= "<td>".$record[$i]["CuRegNo"]."</td>";
				$str .= "<td>".$record[$i]["CuRollNo"]."</td>";
				$str .= "<td>".$record[$i]["academicsession"]."</td>";
				$str .= "<td>".$record[$i]["semester"]."</td>";
				$str .= "<td>".$record[$i]["name"]."</td>";
				$str .= "<td>".$record[$i]["dob"]."</td>";
				 
				$str .= "<td>".$record[$i]["streamDisplay"]."</td>";
				$str .= "<td>".$record[$i]["subjectName"]."</td>";
				$str .= "<td>".$record[$i]["FeeDetail"]."</td>";
				$str .= "<td>".$record[$i]["applcntMobNo"]."</td>";
				$str .= "<td>".$record[$i]["applcntEmail"]."</td>";
				$str .= "<td>".$record[$i]["FeeAmount"]."</td>";
				
				foreach($semarr as $sem) {
					foreach($headrecord[$sem] as $headrec) {
					$str .="<td>".$sem."</td>";			
					if($headrec["CoreCourse1"]!='') {$str .="<td>".$courserecord[$record[$i]["collegeRollno"]][$sem]["CoreCourse1"]."</td>"; }
					if($headrec["CoreCourse2"]!='') { $str .="<td>".$courserecord[$record[$i]["collegeRollno"]][$sem]["CoreCourse2"]."</td>"; }
					if($headrec["CoreCourse3"]!='') { $str .="<td>".$courserecord[$record[$i]["collegeRollno"]][$sem]["CoreCourse3"]."</td>"; }
					if($headrec["generalCourse"]!='') { $str .="<td>".$courserecord[$record[$i]["collegeRollno"]][$sem]["generalCourse"]."</td>"; }
					if(trim($headrec["LCC"])!='') { $str .="<td>".$courserecord[$record[$i]["collegeRollno"]][$sem]["LCC"]."</td>"; }
					if($headrec["DSE1"]!='') { $str .="<td>".$courserecord[$record[$i]["collegeRollno"]][$sem]["DSE1"]."</td>"; }
					if($headrec["DSE2"]!='') { $str .="<td>".$courserecord[$record[$i]["collegeRollno"]][$sem]["DSE2"]."</td>"; }
					if(trim($headrec["DSE3"])!='') { $str .="<td>".$courserecord[$record[$i]["collegeRollno"]][$sem]["DSE3"]."</td>"; }
					if($headrec["AECC"]!='') { $str .="<td>".$courserecord[$record[$i]["collegeRollno"]][$sem]["AECC"]."</td>"; }
					if($headrec["SEC"]!='') { $str .="<td>".$courserecord[$record[$i]["collegeRollno"]][$sem]["SEC"]."</td>"; }
					} 	
				}
				
				$str .= "<td>".$record[$i]["onlineTransactionAmount"]."</td>";
				$str .= "<td>".$record[$i]["onlineTransactionID"]."</td>";
				$str .= "<td>".$record[$i]["onlineTransactionDate"]."</td>";
				$str .= "<td>".$record[$i]["paymentdate"]."</td>";
				$str .= "<td>".$record[$i]["Paid"]."</td>";
				$str .= "</tr>";
				$str .= "</tbody>";
				}
				$str .= "</table>";


$arr["recordcnt"]  = count($record);
	$arr["record"]	 = $record;


$headresult = NULL;
$courseresult = NULL;
$dbConn = NULL;

$arr = array();

$arr["str"]=$str;
$arr["reccount"] = count($record);

echo json_encode($arr);


?>
