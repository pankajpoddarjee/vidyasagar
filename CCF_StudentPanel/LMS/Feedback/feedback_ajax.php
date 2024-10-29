<?php
include("../../../connection_CCF.php");

//echo "<pre>";
//print_r($_POST);

if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action'] == 'get_teacher'){
    $department_id = $_POST['department_id'];
    $arr = [];
    global $dbConn;
    
    $teacherSql = "";
    $teacherSql .= "select * FROM LMS_teacher_master where department_id = $department_id";
    $teacherSql .= " order by teacher_name asc";
	$teacherQry = $dbConn->prepare($teacherSql);
    $teacherQry->execute();
    $teacherRecord = $teacherQry->fetchAll(PDO::FETCH_ASSOC);
    if($teacherRecord) {
		$arr["status"]=1;
		$arr["teacherRecord"]=$teacherRecord;
	}else {
        $arr["status"]=0;
        $arr["msg"]="Data Not Found";  
	}
    echo json_encode($arr);

}

// Feedback Teacher
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action'] == 'submit_teacher_feedback'){
    $arr=[];
    $is_feedback_exist = false;
    $student_roll_number = $_POST['student_roll_number'];
    $presentsemester = $_POST['presentsemester'];
    $librarySql = "";
    $librarySql .= "select COUNT('teacher_feedback_id') AS total FROM LMS_feedback_teacher where student_roll_number = '".$student_roll_number."' and semester = '".$presentsemester."'";
    //echo $librarySql;
	$libraryQry = $dbConn->prepare($librarySql);
    $libraryQry->execute();
    $libraryRecord = $libraryQry->fetch(PDO::FETCH_ASSOC);
    
    if($libraryRecord) {
        if($libraryRecord['total'] > 0){
            $is_feedback_exist = true;
        }		
	}

    if(!$is_feedback_exist){
        $questions = $_POST['teacher_question_id'];
        $status = false;
        foreach ($questions as $value) {
            $feedback = "que".$value;
            $qryInsert = $dbConn->prepare('INSERT INTO LMS_feedback_teacher (teacher_question_id,feedback,student_roll_number,semester,teacher_id)VALUES (:teacher_question_id,:feedback,:student_roll_number,:semester,:teacher_id)');
            
            $qryInsert->execute([
                'teacher_question_id' => isset($value)? $value:'',
                'feedback' => isset($_POST[$feedback])? $_POST[$feedback]:'',
                'student_roll_number' => isset($_POST['student_roll_number'])? $_POST['student_roll_number']:'',
                'teacher_id' => isset($_POST['teacher_id'])? $_POST['teacher_id']:'',
                'semester' => isset($_POST['presentsemester'])? $_POST['presentsemester']:''
                
            ]);
            if($qryInsert){
                $status = true;
            }
        }
        if($status){
            //$teacherRecord = getTeacherAllData();

            $arr["status"]=1;
            $arr["msg"]="Your Feedback Successfully Saved";	
            //$arr["teacherRecord"]=$teacherRecord;
        }else{
            $arr["status"]=0;
            $arr["msg"]="Something Went Wrong";   
        }
        echo json_encode($arr);
    }else{
        $arr["status"]=0;
        $arr["msg"]="You have already placed the feedback"; 
        echo json_encode($arr);  
    }
    
}
// Feedback College
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action'] == 'submit_college_feedback'){
    $arr=[];
    $is_feedback_exist = false;
    $student_roll_number = $_POST['student_roll_number'];
    $presentsemester = $_POST['presentsemester'];
    $librarySql = "";
    $librarySql .= "select COUNT('college_feedback_id') AS total FROM LMS_feedback_college where student_roll_number = '".$student_roll_number."' and semester = '".$presentsemester."'";
    //echo $librarySql;
	$libraryQry = $dbConn->prepare($librarySql);
    $libraryQry->execute();
    $libraryRecord = $libraryQry->fetch(PDO::FETCH_ASSOC);
    
    if($libraryRecord) {
        if($libraryRecord['total'] > 0){
            $is_feedback_exist = true;
        }		
	}

    if(!$is_feedback_exist){
        $questions = $_POST['college_question_id'];
        $status = false;
        foreach ($questions as $value) {
            $feedback = "que".$value;
            $qryInsert = $dbConn->prepare('INSERT INTO LMS_feedback_college (college_question_id,feedback,student_roll_number,semester)VALUES (:college_question_id,:feedback,:student_roll_number,:semester)');
            
            $qryInsert->execute([
                'college_question_id' => isset($value)? $value:'',
                'feedback' => isset($_POST[$feedback])? $_POST[$feedback]:'',
                'student_roll_number' => isset($_POST['student_roll_number'])? $_POST['student_roll_number']:'',
                'semester' => isset($_POST['presentsemester'])? $_POST['presentsemester']:''
                
            ]);
            if($qryInsert){
                $status = true;
            }
        }
        if($status){
            //$teacherRecord = getTeacherAllData();

            $arr["status"]=1;
            $arr["msg"]="Your Feedback Successfully Saved";	
            //$arr["teacherRecord"]=$teacherRecord;
        }else{
            $arr["status"]=0;
            $arr["msg"]="Something Went Wrong";   
        }
        echo json_encode($arr);
    }else{
        $arr["status"]=0;
        $arr["msg"]="You have already placed the feedback"; 
        echo json_encode($arr);  
    }
    
}
// Feedback Library
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action'] == 'submit_library_feedback'){
    $arr=[];
    $is_feedback_exist = false;
    $student_roll_number = $_POST['student_roll_number'];
    $presentsemester = $_POST['presentsemester'];
    $librarySql = "";
    $librarySql .= "select COUNT('library_feedback_id') AS total FROM LMS_feedback_library where student_roll_number = '".$student_roll_number."' and semester = '".$presentsemester."'";
    //echo $librarySql;
	$libraryQry = $dbConn->prepare($librarySql);
    $libraryQry->execute();
    $libraryRecord = $libraryQry->fetch(PDO::FETCH_ASSOC);
    
    if($libraryRecord) {
        if($libraryRecord['total'] > 0){
            $is_feedback_exist = true;
        }		
	}

    if(!$is_feedback_exist){
        $questions = $_POST['library_question_id'];
        $status = false;
        foreach ($questions as $value) {
            $feedback = "que".$value;
            $qryInsert = $dbConn->prepare('INSERT INTO LMS_feedback_library (library_question_id,feedback,student_roll_number,semester)VALUES (:library_question_id,:feedback,:student_roll_number,:semester)');
            
            $qryInsert->execute([
                'library_question_id' => isset($value)? $value:'',
                'feedback' => isset($_POST[$feedback])? $_POST[$feedback]:'',
                'student_roll_number' => isset($_POST['student_roll_number'])? $_POST['student_roll_number']:'',
                'semester' => isset($_POST['presentsemester'])? $_POST['presentsemester']:''
                
            ]);
            if($qryInsert){
                $status = true;
            }
        }
        if($status){
            //$teacherRecord = getTeacherAllData();

            $arr["status"]=1;
            $arr["msg"]="Your Feedback Successfully Saved";	
            //$arr["teacherRecord"]=$teacherRecord;
        }else{
            $arr["status"]=0;
            $arr["msg"]="Something Went Wrong";   
        }
        echo json_encode($arr);
    }else{
        $arr["status"]=0;
        $arr["msg"]="You have already placed the feedback"; 
        echo json_encode($arr);  
    }
    
}
// Feedback Subject
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action'] == 'submit_subject_feedback'){
    $arr=[];
    $is_feedback_exist = false;
    $student_roll_number = $_POST['student_roll_number'];
    $presentsemester = $_POST['presentsemester'];
    $librarySql = "";
    $librarySql .= "select COUNT('subject_feedback_id') AS total FROM LMS_feedback_subject where student_roll_number = '".$student_roll_number."' and semester = '".$presentsemester."'";
    //echo $librarySql;
	$libraryQry = $dbConn->prepare($librarySql);
    $libraryQry->execute();
    $libraryRecord = $libraryQry->fetch(PDO::FETCH_ASSOC);
    
    if($libraryRecord) {
        if($libraryRecord['total'] > 0){
            $is_feedback_exist = true;
        }		
	}

    if(!$is_feedback_exist){
        $qryInsert = $dbConn->prepare('INSERT INTO LMS_feedback_subject (introduce_new_suject,subject_id,introduce_new_cop,cop_id,student_roll_number,semester)VALUES (:introduce_new_suject,:subject_id,:introduce_new_cop,:cop_id,:student_roll_number,:semester)');
        
        $qryInsert->execute([
            'introduce_new_suject' => isset($_POST['introduce_new_suject'])? $_POST['introduce_new_suject']:'',
            'subject_id' => isset($_POST['subject_id'])? $_POST['subject_id']:'',
            'introduce_new_cop' => isset($_POST['introduce_new_cop'])? $_POST['introduce_new_cop']:'',
            'cop_id' => isset($_POST['cop_id'])? $_POST['cop_id']:'',
            'student_roll_number' => isset($_POST['student_roll_number'])? $_POST['student_roll_number']:'',
            'semester' => isset($_POST['presentsemester'])? $_POST['presentsemester']:''
            
        ]);
           
        
        if($qryInsert){
            //$teacherRecord = getTeacherAllData();

            $arr["status"]=1;
            $arr["msg"]="Your Feedback Successfully Saved";	
            //$arr["teacherRecord"]=$teacherRecord;
        }else{
            $arr["status"]=0;
            $arr["msg"]="Something Went Wrong";   
        }
        echo json_encode($arr);
    }else{
        $arr["status"]=0;
        $arr["msg"]="You have already placed the feedback"; 
        echo json_encode($arr);  
    }
    
}

?>