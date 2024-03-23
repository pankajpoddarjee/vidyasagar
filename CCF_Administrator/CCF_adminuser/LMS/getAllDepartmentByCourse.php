<?php
 include("../../../connection_CCF.php");
 include("../../function.php");
 include("../../../configuration_CCF.php");
 include("lmsfunction.php");

 $course_id = transformInput($_POST["course_id"]);

 $departmentQry = $dbConn->prepare("select * FROM LMS_department_master where course_id = $course_id and is_active=1");
 $departmentQry->execute();
 $departmentRecord = $departmentQry->fetchAll(PDO::FETCH_ASSOC);

 if($departmentRecord){
    $arr["status"]=1;
    $arr["msg"]="Successfully Saved";	
    $arr["departmentRecord"]=$departmentRecord;
 }else{
    $arr["status"]=0;
    $arr["msg"]="No course found";	
 }
 echo json_encode($arr);

 ?>