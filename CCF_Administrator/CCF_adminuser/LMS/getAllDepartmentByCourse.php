<?php
 include("../../../connection_CCF.php");
 include("../../function.php");
 include("../../../configuration_CCF.php");
 include("lmsfunction.php");
 session_start();

 $course_id = transformInput($_POST["course_id"]);
 $is_hod = isset($_SESSION['is_hod'])?$_SESSION['is_hod']:"";
 $department_id = isset($_SESSION['department_id'])?$_SESSION['department_id']:"";

 $departmentSql = "";
 $departmentSql .= "select * FROM LMS_department_master where course_id = $course_id and is_active=1";

   if($is_hod == 1 || (($_SESSION['usertype'] == 'teacher' && $_SESSION['is_hod'] == 0))){ 
      $departmentSql .= " and department_id = $department_id";
   }
 $departmentQry = $dbConn->prepare($departmentSql);
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