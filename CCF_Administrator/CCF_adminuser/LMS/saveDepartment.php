<?php
 include("../../../connection_CCF.php");
 include("../../function.php");
 include("../../../configuration_CCF.php");
 include("lmsfunction.php");

$course_id = transformInput($_POST["course_id"]);
$department_id = transformInput($_POST["department_id"]);
$department_name = $_POST["department_name"];


    if(isset($_POST["department_id"]) && $_POST["department_id"]!=''){

        $checkDepartmentNameExistQry = $dbConn->prepare("select * FROM LMS_department_master where  course_id=$course_id and department_name='$department_name' and department_id!=$department_id");
        $checkDepartmentNameExistQry->execute();
        $checkDepartmentNameExistRecord = $checkDepartmentNameExistQry->fetch(PDO::FETCH_ASSOC);
        if($checkDepartmentNameExistRecord){
            $arr["status"]=0;
            $arr["msg"]="This department already exist";  
        }else{
            
            $qryUpdate = $dbConn->prepare('UPDATE LMS_department_master SET department_name = :department_name,course_id = :course_id WHERE department_id = :department_id');
        
            $qryUpdate->execute([
                'department_id' => $department_id,
                'course_id' => $course_id,
                'department_name' => $department_name
            ]);
            if($qryUpdate){

                $departmentRecord = getDepartmentAllData();
        
                $arr["status"]=1;
                $arr["msg"]="Successfully Updated";	
                $arr["departmentRecord"]=$departmentRecord;
            }else{
                $arr["status"]=0;
                $arr["msg"]="Something Went Wrong";   
            }
        }
            
     }else{
        //check stream name 
        $checkDepartmentNameExistQry = $dbConn->prepare("select * FROM LMS_department_master where course_id=$course_id and department_name='$department_name'");
        $checkDepartmentNameExistQry->execute();
        $checkDepartmentNameExistRecord = $checkDepartmentNameExistQry->fetch(PDO::FETCH_ASSOC);


        if($checkDepartmentNameExistRecord){
        $courseData = getCourseDetailByID($course_id);
        $arr["status"]=0;
        $arr["msg"]="This department already exist on ".$courseData['course_name'];  
        }else{
    
            $qryInsert = $dbConn->prepare('INSERT INTO LMS_department_master (course_id,department_name)VALUES (:course_id,:department_name)');
        
            $qryInsert->execute([
                'course_id' => $course_id,
                'department_name' => $department_name
            ]);
            if($qryInsert){
                $departmentRecord = getDepartmentAllData();
        
                $arr["status"]=1;
                $arr["msg"]="Successfully Saved";	
                $arr["departmentRecord"]=$departmentRecord;
            }else{
                $arr["status"]=0;
                $arr["msg"]="Something Went Wrong";   
            }
        }
     }

   
 

 function valid_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }



echo json_encode($arr);

?>