<?php
session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp


//header('Content-type: application/json; charset=utf-8');

header("Content-type: text/javascript");
include("../connection_CCF.php");


//include("../configuration_CCF.php"); 
//include("../function.php");

//$uid=0;
//$user = "";
$msg="";
$finalarr=array();
$record=array();

$courseType = $_POST["courseType"];

if($courseType == 'teacher'){

$strsql="select teacher_id,teacher_name,department_id,course_id,mobile,email,username,password,isnull(designation,'') as designation,is_hod,is_active from  [LMS_teacher_master] where username='".$_POST["username"]."'  COLLATE SQL_Latin1_General_CP1_CS_AS  and password='" .$_POST["password"]."'  COLLATE SQL_Latin1_General_CP1_CS_AS   and is_active=1 ";
    
 
	$qryresult = $dbConn->query($strsql);
	
	if($qryresult) {
		while($row=$qryresult->fetch(PDO::FETCH_ASSOC)) {
			$record[] = $row;
		}
	}
	
	$qryresult = NULL;

	if(count($record)>0)
	{
		$status = 1;
		$msg = "";
		$_SESSION['loggedin'] = true;
		$_SESSION['userid'] =$record[0]["teacher_id"];
		$_SESSION['user'] = $record[0]["teacher_name"];
		$_SESSION['is_hod'] = $record[0]["is_hod"];
		$_SESSION['designation'] = $record[0]["designation"];
		$_SESSION['usertype'] = "teacher";
		$_SESSION['department_id'] = $record[0]["department_id"];
	 
	}
	else{
			$status = 0;
			$msg="User name Or Password does not match. Please Try again";
	}
	$finalarr["status"]=$status;
	$finalarr["msg"]=$msg;
	$finalarr["actionurl"]= "CCF_adminuser/LMS/dashboard.php";

}else{


	$strsql="select id,name,designation,mobile,email,UserName,Password,usertype,isnull(typeid,'') as typeid,activestatus from  [useradmin] where UserName='".$_POST["username"]."'  COLLATE SQL_Latin1_General_CP1_CS_AS  and Password='" .$_POST["password"]."'  COLLATE SQL_Latin1_General_CP1_CS_AS   and activestatus=1 ";
    
 
	$qryresult = $dbConn->query($strsql);
	
	if($qryresult) {
		while($row=$qryresult->fetch(PDO::FETCH_ASSOC)) {
			$record[] = $row;
		}
	}
	
	$qryresult = NULL;
	
	if(count($record)>0)
	{
		$status = 1;
		$msg = "";
		$_SESSION['loggedin'] = true;
		$_SESSION['userid'] =$record[0]["id"];
		$_SESSION['user'] = $record[0]["name"];
		$_SESSION['usertypeid'] = $record[0]["typeid"];
		$_SESSION['usertype'] = $record[0]["usertype"];
		$_SESSION['is_hod'] = 0;
		//$_SESSION['department_id'] = 0;
		
	 
	}
	else{
			$status = 0;
			$msg="User name Or Password does not match. Please Try again";
	}
	
	$finalarr["status"]=$status;
	$finalarr["msg"]=$msg;
	/* if(trim($record[0]["name"])=='' || trim($record[0]["designation"])=='' || trim($record[0]["mobile"])=='' || trim($record[0]["email"])==''){
	$finalarr["actionurl"]= "userInfo.php";	
	}
	else { */
	 if($courseType=='CBCS'){
		 if($record[0]["usertype"]=='SYSTEMCREATOR' || $record[0]["usertype"]=='SUPERADMIN' || $record[0]["usertype"]=='ADMIN')
			$finalarr["actionurl"]= "adminuser/dashboard.php";
		else if($record[0]["usertype"]=='DEPARTMENTUSER')
			$finalarr["actionurl"]= "departmentuser/dashboard.php";
	 }
	 else if($courseType=='CCF'){
		if($record[0]["usertype"]=='SYSTEMCREATOR' || $record[0]["usertype"]=='SUPERADMIN' || $record[0]["usertype"]=='ADMIN')
		$finalarr["actionurl"]= "CCF_adminuser/dashboard.php";
		else if($record[0]["usertype"]=='DEPARTMENTUSER')
		$finalarr["actionurl"]= "CCF_departmentuser/dashboard.php"; 
	 }
	 
	/* else
	$finalarr["actionurl"]= "Type2/controlpanel.php"; */
	//}

}
  


 
echo json_encode($finalarr);

?>