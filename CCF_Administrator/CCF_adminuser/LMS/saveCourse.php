<?php
 include("../../../connection_CCF.php");
 include("../../function.php");
 include("../../../configuration_CCF.php");
 include("lmsfunction.php");


$course_id = transformInput($_POST["course_id"]);
$course_name = transformInput($_POST["course_name"]);


    if(isset($_POST["course_id"]) && $_POST["course_id"]!=''){

        $checkCourseQry = $dbConn->prepare("select * FROM LMS_course_master where course_name='$course_name' and course_id!=$course_id");
        $checkCourseQry->execute();
        $checkCourseRecord = $checkCourseQry->fetch(PDO::FETCH_ASSOC);
        if($checkCourseRecord){
            $arr["status"]=0;
            $arr["msg"]="This course already exist";  
        }else{
            
            $qryUpdate = $dbConn->prepare('UPDATE LMS_course_master SET course_name = :course_name WHERE course_id = :course_id');
        
            $qryUpdate->execute([
                'course_id' => $course_id,
                'course_name' => $course_name
            ]);
            if($qryUpdate){
                $courseRecord = getCourseAllData();
        
                $arr["status"]=1;
                $arr["msg"]="Successfully Updated";	
                $arr["courseRecord"]=$courseRecord;
            }else{
                $arr["status"]=0;
                $arr["msg"]="Something Went Wrong";   
            }
        }
            
     }else{

        $checkCourseQry = $dbConn->prepare("select * FROM LMS_course_master where course_name='$course_name'");
        $checkCourseQry->execute();
        $checkCourseRecord = $checkCourseQry->fetch(PDO::FETCH_ASSOC);
        if($checkCourseRecord){
            $arr["status"]=0;
            $arr["msg"]="This course already exist";  
        }else{
    
            $qryInsert = $dbConn->prepare('INSERT INTO LMS_course_master (course_name)VALUES (:course_name)');
        
            $qryInsert->execute([
                'course_name' => $course_name
            ]);
            if($qryInsert){
                $courseRecord = getCourseAllData();
        
                $arr["status"]=1;
                $arr["msg"]="Successfully Saved";	
                $arr["courseRecord"]=$courseRecord;
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