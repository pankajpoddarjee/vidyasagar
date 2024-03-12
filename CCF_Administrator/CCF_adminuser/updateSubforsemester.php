<?php
 include("../../connection_CCF.php");
 //include("../function.php");
 include("../../configuration_CCF.php");

$cnt = 0;
  
$arr = array();
$val = array();

$semester = $_POST["courseSemforChange"];
$collegerollno = $_POST["collrollno"];
   
 if(isset($_POST["choSEC"])){
	 
  $qry = "EXEC [dbo].[update_courseSemester] '".$_POST["choSEC"]."','".$semester."','".$collegerollno."';";
	
	 
 $qryresult = $dbConn->query($qry);

	if($qryresult) {
		 $arr["status"]=1;
		$arr["msg"]="Successfully Saved";	 
	 }
	 else {
			$arr["status"]=0;
			$arr["msg"]="Try again.";  
		}
		
 }

echo json_encode($arr);

?>