<?php
 include("../../../connection_CCF.php");
 //include("../function.php");
 include("../../../configuration_CCF.php");

$cnt = 0;
  
$arr = array();

$stream_id = $_POST["stream_id"];

// echo "<pre>";
// print_r($_POST);
   
 if(isset($_POST["stream_id"])){
	
    
	$courseQry = $dbConn->prepare("select stream.stream_id,stream.stream_name,stream.stream_code,stream.is_active,course.course_name,course.course_id FROM LMS_stream_master as stream join LMS_course_master as course on course.course_id = stream.course_id where stream_id=$stream_id");
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