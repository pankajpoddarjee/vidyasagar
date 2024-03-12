<?php
 include("../connection_CCF.php");
include("function.php");
include("../configuration_CCF.php");
$cnt = 0;
 
$arr = array();
$val = array();

 $dept =$_POST["choDept"];
$semester =$_POST["choSemester"];
$rollno = trim($_POST["txtrollno"]);
 
    $qry	=	"select spd.RollNo,spd.semester,ccm.subjectcode,isnull(spd.Paid,'') as Paid,spd.statuscode from studentPaymentDetail spd JOIN studentmaster st ON st.collegeRollno=spd.collegeRollNo JOIN College_CourseMaster ccm ON ccm.subjectcode=st.appsubjectcode where  ltrim(rtrim(session))='".ACADEMIC_SESSION."' and   ccm.subjectcode='".$dept."'  and semester='".$semester."' and spd.collegeRollNo='".$rollno."' and studentStatus=1;";
 
 
$qryresult = $dbConn->query($qry);

if($qryresult) {
 	while($row=$qryresult->fetch(PDO::FETCH_ASSOC))
	{
		$val[] = $row;
	}
 }
 $qryresult = NULL;
 
 if(count($val)>0)
 {
	 $arr["status"]=1;
		$arr["collegeRollNo"] =$val[0]["RollNo"];
		$arr["semester"] =$val[0]["semester"];
		$arr["dept"] =$val[0]["subjectcode"];
		if($val[0]["Paid"]=='Y' && $val[0]["statuscode"]=='0300') {
		$arr["url"]="confirmSlip.php"; 
		}
		else
		{
		//$arr["url"]="feeforpayment.php";  
		$arr["url"]="infoforpayment.php";  
		}
 }
 else {
		$arr["status"]=0;
		$arr["msg"]="Record not Found";  
	}

echo json_encode($arr);

?>