<?php
 include("../../../connection_CCF.php");
 //include("../function.php");
 include("../../../configuration_CCF.php");

$cnt = 0;
  
$arr = array();

$teacher_id = $_POST["teacher_id"];

// echo "<pre>";
// print_r($_POST);
   
 if(isset($_POST["teacher_id"])){
	
    
	$teacherQry = $dbConn->prepare("select teacher.teacher_id,teacher.course_id,teacher.department_id,teacher.teacher_name,teacher.email,teacher.mobile,teacher.designation,teacher.is_hod,teacher.username,teacher.password,teacher.is_active,course.course_name,dept.department_name FROM LMS_teacher_master as teacher LEFT JOIN LMS_course_master as course on course.course_id = teacher.course_id LEFT JOIN LMS_department_master as dept ON teacher.department_id = dept.department_id where teacher.teacher_id= $teacher_id");
    $teacherQry->execute();
    $teacherRecord = $teacherQry->fetch(PDO::FETCH_ASSOC);

	$course_id = $teacherRecord["course_id"];

	$departmentQry = $dbConn->prepare("select * FROM LMS_department_master where course_id = $course_id");
	$departmentQry->execute();
	$departmentRecord = $departmentQry->fetchAll(PDO::FETCH_ASSOC);

	if($teacherRecord) {
       
		$arr["status"]=1;
		$arr["data"]=$teacherRecord;	 
		$arr["departmentRecord"]=$departmentRecord;	 

	 }
	 else {
			$arr["status"]=0;
			$arr["msg"]="Data Not Found";  
		}
		
 }

echo json_encode($arr);

?>