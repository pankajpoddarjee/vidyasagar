<?php
 include("../../../connection_CCF.php");
 //include("../function.php");
 include("../../../configuration_CCF.php");

$cnt = 0;
  
$arr = array();

$course_id = $_POST["course_id"];

// echo "<pre>";
// print_r($_POST);
   
 if(isset($_POST["course_id"])){
	 
    $courseQry = $dbConn->prepare("select * FROM LMS_course_master where course_id=$course_id");
    $courseQry->execute();
    $courseRecord = $courseQry->fetch(PDO::FETCH_ASSOC);

	if($courseRecord) {
       
		$arr["status"]=1;
		$arr["data"]=$courseRecord;	 

	 }
	 else {
			$arr["status"]=0;
			$arr["msg"]="Data Not Found";  
		}
		
 }

echo json_encode($arr);

?>