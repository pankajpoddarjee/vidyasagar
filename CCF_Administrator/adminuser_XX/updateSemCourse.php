<?php
include("../../connection.php");

$arr = array();
 
$collegerollno =$_POST["hdncollegerollno"];
$coursecode =$_POST["hdncourseCode"];

$GESem1 = '';
$GESem2 = '';
$GESem3 = '';
$GESem4 = '';
 

if($_POST["hdncourseCode"]=='08' || $_POST["hdncourseCode"]=='09' 
|| $_POST["hdncourseCode"]=='10' || $_POST["hdncourseCode"]=='14' || $_POST["hdncourseCode"]=='15' || $_POST["hdncourseCode"]=='16'  ) {
	$GESem1 = $_POST["cboGESem1subject"]; 
	$GESem2 = $_POST["cboGESem2subject"]; 
	$GESem3 = $_POST["cboGESem3subject"]; 
	$GESem4 = $_POST["cboGESem4subject"]; 
	 
	$semupdtqry = "EXEC dbo.SP_insert_Semesterdetail_Hons_rollno '".$collegerollno."','".$GESem1."','".$GESem2."','".$GESem3."','".$GESem4."';";
	
	
}

if($_POST["hdncourseCode"]=='11' ) {
	
	$semupdtqry = "EXEC dbo.SP_insert_Semesterdetail_BAGen_rollno '".$collegerollno."';";
	
}

if($_POST["hdncourseCode"]=='12' ) {
	
	$semupdtqry = "EXEC dbo.SP_insert_Semesterdetail_BScGen_rollno '".$collegerollno."';";
	
}
 
 
$recordresult = $dbConn->query($semupdtqry);

if($recordresult) {
	$arr['status'] =1;
	$arr['msg']= "Successfully Updated.";
}
else
{
	$arr['status'] =0;
	$arr['msg']= "Try again.";
}
 
 
 $recordresult =  NULL;
$dbConn=  NULL;

echo json_encode($arr);
?>
