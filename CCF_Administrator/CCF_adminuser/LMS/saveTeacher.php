<?php
 include("../../../connection_CCF.php");
 include("../../function.php");
 include("../../../configuration_CCF.php");
 include("lmsfunction.php");

$course_id = transformInput($_POST["course_id"]);
$department_id = transformInput($_POST["department_id"]);
$teacher_id = transformInput($_POST["teacher_id"]);
$teacher_name = $_POST["teacher_name"];
$email = $_POST["email"];
$mobile = transformInput($_POST["mobile"]);
$designation = $_POST["designation"];
$is_hod = $_POST["is_hod"];
$username = isset($_POST["username"])?$_POST["username"]:"";
$password = $_POST["password"];



    if(isset($_POST["teacher_id"]) && $_POST["teacher_id"]!=''){

        // $checkTeacherNameExistQry = $dbConn->prepare("select * FROM LMS_teacher_master where  course_id=$course_id and department_id=$department_id and teacher_name='$teacher_name' and teacher_id!=$teacher_id");
        // $checkTeacherNameExistQry->execute();
        // $checkTeacherNameExistRecord = $checkTeacherNameExistQry->fetch(PDO::FETCH_ASSOC);

        $checkTeacherUserNameExistQry = $dbConn->prepare("select * FROM LMS_teacher_master where   username='$username' and teacher_id!=$teacher_id");
        $checkTeacherUserNameExistQry->execute();
        $checkTeacherUserNameExistRecord = $checkTeacherUserNameExistQry->fetch(PDO::FETCH_ASSOC);
        if($checkTeacherUserNameExistRecord){
            $arr["status"]=0;
            $arr["msg"]="This username already exist";  
        }else{
            
            $qryUpdate = $dbConn->prepare('UPDATE LMS_teacher_master SET teacher_name = :teacher_name,course_id = :course_id,department_id = :department_id,email = :email,mobile = :mobile,designation = :designation,is_hod = :is_hod,password = :password WHERE teacher_id = :teacher_id');
        
            $qryUpdate->execute([
                'teacher_id' => $teacher_id,
                'course_id' => $course_id,
                'department_id' => $department_id,
                'teacher_name' => $teacher_name,
                'email' => $email,
                'mobile' => $mobile,
                'designation' => $designation,
                'is_hod' => $is_hod,
                'password' => $password
            ]);
            if($qryUpdate){

                $teacherRecord = getTeacherAllData();
        
                $arr["status"]=1;
                $arr["msg"]="Successfully Updated";	
                $arr["teacherRecord"]=$teacherRecord;
            }else{
                $arr["status"]=0;
                $arr["msg"]="Something Went Wrong";   
            }
        }
            
     }else{
        //check stream name 
        $checkTeacherUserNameExistQry = $dbConn->prepare("select * FROM LMS_teacher_master where  username='$username'");
        $checkTeacherUserNameExistQry->execute();
        $checkTeacherUserNameExistRecord = $checkTeacherUserNameExistQry->fetch(PDO::FETCH_ASSOC);

        if($checkTeacherUserNameExistRecord){
        $courseData = getCourseDetailByID($course_id);
        $arr["status"]=0;
        $arr["msg"]="This username already exist on ";  
        }else{
    
            $qryInsert = $dbConn->prepare('INSERT INTO LMS_teacher_master (course_id,department_id,teacher_name,email,mobile,designation,is_hod,username,password)VALUES (:course_id,:department_id,:teacher_name,:email,:mobile,:designation,:is_hod,:username,:password)');
        
            $qryInsert->execute([
                'course_id' => $course_id,
                'department_id' => $department_id,
                'teacher_name' => $teacher_name,
                'email' => $email,
                'mobile' => $mobile,
                'designation' => $designation,
                'is_hod' => $is_hod,
                'username' => $username,
                'password' => $password
                
            ]);
            if($qryInsert){
                $teacherRecord = getTeacherAllData();
        
                $arr["status"]=1;
                $arr["msg"]="Successfully Saved";	
                $arr["teacherRecord"]=$teacherRecord;
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