<?php
 include("../../../connection_CCF.php");
 //include("../function.php");
 include("../../../configuration_CCF.php");
 include("lmsfunction.php");

$teacher_id = $_POST["delete_teacher_id"];
$status = $_POST["new_satus"];
if($status == 'Active'){
    $new_status = '1';
}else{
    $new_status = '0'; 
}
   
 if(isset($teacher_id ) && $teacher_id !=''){
    	 
    $qryDelete = $dbConn->prepare('UPDATE LMS_teacher_master SET is_active = :is_active WHERE teacher_id = :teacher_id');

    $qryDelete->execute([
        'teacher_id' => $teacher_id,
        'is_active' => $new_status
    ]);
    if($qryDelete){
        //$teacherRecord = getTeacherAllData();
        $arr["status"]=1;
		$arr["msg"]="Status updated successfully";	
        //$arr["teacherRecord"]=$teacherRecord;
    }else{
        $arr["status"]=0;
        $arr["msg"]="Something Went Wrong";   
    }
		
 }else{
        $arr["status"]=0;
        $arr["msg"]="Something Went Wrong";   
 }

echo json_encode($arr);

?>