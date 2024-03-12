<?php
include("../../connection.php");
  
 $record =array();
$searchstr =""; 

	if($_POST["chosession"]!="All" )
		$searchstr=$searchstr . "and spd.session='" . $_POST["chosession"] . "' "; 
  
	if($_POST["chostream"]!="All" )
		$searchstr=$searchstr . "and st.appstream='" . $_POST["chostream"] . "' ";
	
	if($_POST["chosubject"]!="All" )
		$searchstr=$searchstr . "and st.appsubjectcode='" . $_POST["chosubject"] . "' ";
	
	if($_POST["choadmitsem"]!="All" )
		$searchstr=$searchstr . "and spd.admissionToSemester='" . $_POST["choadmitsem"] . "' ";
	 
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
	
  $qry = "select  spd.session as academicsession,st.dob,spd.collegeRollNo,	spd.RollNo,spd.semester,isnull(spd.admissionToSemester,'') as admissionToSemester,
streamDisplay,subjectName , st.name,  isnull(spd.applcntMobNo,'') as applcntMobNo,	isnull(spd.applcntEmail,'') as applcntEmail,ISNULL(spd.onlineTransactionID,'') as onlineTransactionID,isnull(spd.onlineTransactionDate,'') as onlineTransactionDate,isnull(spd.paymentdate,'') as paymentdate,
isnull(fm.FeeDetail,'') as FeeDetail,isnull(fm.remarks,'') as remarks,isnull(fm.FeeAmount,'') as FeeAmount,isnull(spd.onlineTransactionAmount,'') as onlineTransactionAmount,isnull(Paid,'') as Paid  from studentPaymentDetail spd 
JOIN studentmaster st ON st.collegeRollNo=spd.collegeRollNo JOIN College_CourseMaster ccm ON  ccm.stream=st.appstream and ccm.subjectcode=st.appsubjectcode LEFT JOIN College_FeeStructureMaster fm ON  fm.feeCode=spd.FeeCode and fm.sesssionYear=spd.session and fm.Semester=spd.admissionToSemester and fm.feeParticulars='Total' WHERE isnull(spd.studentStatusforPay,0)=1 and isnull(spd.FeeCode,'')='ADMFEE'  ".$searchstr.";";

 
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
