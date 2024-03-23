<?php
 include("../../../connection_CCF.php");
 //include("../function.php");
 include("../../../configuration_CCF.php");
 include("lmsfunction.php");

$department_id = $_POST["delete_department_id"];
$status = $_POST["new_satus"];
if($status == 'Active'){
    $new_status = '1';
}else{
    $new_status = '0'; 
}
   
 if(isset($department_id ) && $department_id !=''){
    	 
    $qryDelete = $dbConn->prepare('UPDATE LMS_department_master SET is_active = :is_active WHERE department_id = :department_id');

    $qryDelete->execute([
        'department_id' => $department_id,
        'is_active' => $new_status
    ]);
    if($qryDelete){
        $departmentRecord = getDepartmentAllData();
        $arr["status"]=1;
		$arr["msg"]="Status updated successfully";	
        $arr["departmentRecord"]=$departmentRecord;
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