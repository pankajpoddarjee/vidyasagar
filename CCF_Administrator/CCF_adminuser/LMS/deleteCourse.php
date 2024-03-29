<?php
 include("../../../connection_CCF.php");
 //include("../function.php");
 include("../../../configuration_CCF.php");
 include("lmsfunction.php");


$course_id = $_POST["delete_course_id"];
$status = $_POST["new_satus"];
if($status == 'Active'){
    $new_status = '1';
}else{
    $new_status = '0'; 
}
   
 if(isset($course_id ) && $course_id !=''){
    	 
    $qryDelete = $dbConn->prepare('UPDATE LMS_course_master SET is_active = :is_active WHERE course_id = :course_id');

    $qryDelete->execute([
        'course_id' => $course_id,
        'is_active' => $new_status
    ]);
    if($qryDelete){
        $courseQry = $dbConn->prepare("select * FROM LMS_course_master order by is_active desc, course_name desc");
        $courseQry->execute();
        $courseRecord = $courseQry->fetchAll(PDO::FETCH_ASSOC);

        $arr["status"]=1;
		$arr["msg"]="Status updated successfully";	
        $arr["courseRecord"]=$courseRecord;
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