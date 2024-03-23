<?php
 include("../../../connection_CCF.php");
 //include("../function.php");
 include("../../../configuration_CCF.php");

$cnt = 0;
  
$arr = array();

$department_id = $_POST["department_id"];

// echo "<pre>";
// print_r($_POST);
   
 if(isset($_POST["department_id"])){
	
    
	$courseQry = $dbConn->prepare("select dept.department_id,dept.department_name,dept.is_active,course.course_name,course.course_id FROM LMS_department_master as dept join LMS_course_master as course on course.course_id = dept.course_id where department_id=$department_id");
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