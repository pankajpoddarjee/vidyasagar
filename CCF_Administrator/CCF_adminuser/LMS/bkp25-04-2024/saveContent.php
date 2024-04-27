<?php
 include("../../../connection_CCF.php");
 include("../../function.php");
 include("../../../configuration_CCF.php");
 include("lmsfunction.php");

//  echo "<pre>";
//  print_r($_POST); 
//  print_r($_FILES); 
//  echo $_POST["course_id"];
//  echo $_FILES['content']['name'][0];
//  echo $_FILES['content']['tmp_name'][0];
//  die;
function getIpAddress(){
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
session_start();
$ip = getIpAddress(); 
$current_date_time = date('Y-m-d H:i:s');
$loggedIn_user = $_SESSION['userid'];
$content_id = transformInput($_POST["content_id"]);

$course_id = transformInput($_POST["course_id"]);
$stream_id = implode(",",$_POST["stream_id"]);
$department_id = transformInput($_POST["department_id"]);
$created_by_user = !empty($_POST["created_by_user"])? $_POST["created_by_user"]:$_SESSION['usertype'];
$teacher_id = !empty($_POST["teacher_id"])? $_POST["teacher_id"]:$_SESSION['userid'];
// $created_by_user_edit = isset($_SESSION['usertype'])?$_SESSION['usertype']:"";
// $created_by_edit = isset($_SESSION['userid'])?$_SESSION['userid']:"";
$subject_id = transformInput($_POST["subject_id"]);

$material_id = transformInput($_POST["material_id"]);
$paper_type_id = transformInput($_POST["paper_type_id"]);
$semester_id = implode(",",$_POST["semester_id"]);
//$publish_date = $_POST["publish_date"];  

$material_type =  isset($_POST["material_type"])?$_POST["material_type"]:"";
$content_title = isset($_POST["content_title"])?$_POST["content_title"]:"";
$content_publish_date = isset($_POST["content_publish_date"])?$_POST["content_publish_date"]:"";
if (in_array("video", $material_type)) { 
    $content = $_POST["content"]; 
} 
//echo $created_by_user;
//echo $created_by; die;
//print_r($_POST);
//echo $semester_id;
//echo $stream_id;
$success =  false;

//print_r($material_type); 
// print_r($content_title);
// print_r($content);die;
//print_r($_FILES);

if(isset($_POST["content_id"]) && $_POST["content_id"]!=''){

//  echo "<pre>";
//  print_r($material_type); 
//   print_r($_POST["check"]); 
//   print_r($_FILES); 
//  print_r($content);die;

 $check = $_POST["check"]; 


    $count_video = 0;
    $count_doc = 0;
    if($_POST["study_id"]){
        $study_material_id = $_POST["study_id"];

        $materialQry = $dbConn->prepare("select * FROM LMS_study_material where study_id = $study_material_id");
        $materialQry->execute();
        $materialRecord = $materialQry->fetchAll(PDO::FETCH_ASSOC);
        $is_material_table_updated = false;
        if($materialRecord){
            foreach ($materialRecord as $value) {
                if($value['course_id'] != $_POST["course_id"]){
                    $is_material_table_updated = true;
                }
                if($value['stream_id'] != $stream_id){
                    $is_material_table_updated = true;
                }
                if($value['department_id'] != $_POST["department_id"]){
                    $is_material_table_updated = true;
                }
                if($value['material_id'] != $_POST["material_id"]){
                    $is_material_table_updated = true;
                }
                if($value['subject_id'] != $_POST["subject_id"]){
                    $is_material_table_updated = true;
                }
                if($value['paper_type_id'] != $_POST["paper_type_id"]){
                    $is_material_table_updated = true;
                }
                if($value['semester_id'] != $semester_id){
                    $is_material_table_updated = true;
                }
            }
        }
        if($is_material_table_updated){
            $material_updated_by = $loggedIn_user;
            $material_updated_at = $current_date_time;
            $material_updated_device = $ip;
        }else{
            $material_updated_by = !empty($_POST["m_updated_by"])?$_POST["m_updated_by"]:NULL;
            $material_updated_at = !empty($_POST["m_updated_at"])?$_POST["m_updated_at"]:NULL;
            $material_updated_device = !empty($_POST["m_updated_device"])?$_POST["m_updated_device"]:NULL;
        }
        $qryUpdate = $dbConn->prepare('UPDATE LMS_study_material SET course_id = :course_id,stream_id = :stream_id,department_id = :department_id,material_id = :material_id,paper_type_id = :paper_type_id,semester_id = :semester_id,subject_id = :subject_id,updated_by = :updated_by,updated_at = :updated_at,updated_device = :updated_device WHERE study_id = :study_id');

        $qryUpdate->execute([
            'study_id' => $study_material_id,
            'course_id' => $course_id,
            'stream_id' => $stream_id,
            'department_id' => $department_id,
            'material_id' => $material_id,
            'paper_type_id' => $paper_type_id,
            'subject_id' => $subject_id,
            'semester_id' => $semester_id,
            'updated_by' => $material_updated_by,
            'updated_at' => $material_updated_at,
            'updated_device' => $material_updated_device
            
        ]);

        foreach ($material_type as $kay => $material) {
            $content_video = "";
            $content_doc = "";
            
            if($material=="video"){
                if($check[$kay] == 'on' || empty($check[$kay])){
                    $content_created_by = $loggedIn_user;
                    $content_created_at = $current_date_time;
                    $content_created_device = $ip;
                    $count_video = $count_video + 1;
                    $qryInsertContent = $dbConn->prepare('INSERT INTO LMS_study_content (study_id,title,content_type,video_link,publish_date,teacher_id,created_by_user,created_by,created_at,created_device)VALUES (:study_id,:title,:content_type,:video_link,:publish_date,:teacher_id,:created_by_user,:created_by,:created_at,:created_device)');

                    $qryInsertContent->execute([
                        'study_id' => $study_material_id,
                        'title' => $content_title[$kay],
                        'content_type' => $material,
                        'video_link' => $content[$count_video-1],
                        'publish_date' => $content_publish_date[$kay],
                        'teacher_id' => $teacher_id,
                        'created_by_user' => $created_by_user,
                        'created_by' => $content_created_by,
                        'created_at' => $content_created_at,
                        'created_device' => $content_created_device
                    ]);
                    if($qryInsertContent){
                        $success = true;
                    }
                }else{
                    $content_updated_by = $loggedIn_user;
                    $content_updated_at = $current_date_time;
                    $content_updated_device = $ip;
                    $count_video = $count_video + 1;
                    $c_id = $check[$kay];
                    if(!empty($c_id)){
                        $contentQry = $dbConn->prepare("select * FROM LMS_study_content where content_id = $c_id");
                        $contentQry->execute();
                        $contentRecord = $contentQry->fetch(PDO::FETCH_ASSOC);
                        if(!empty($contentRecord['document_path'])){
                            unlink($contentRecord['document_path']);
                        }
                    }
                    
                    $qryUpdateVideo = $dbConn->prepare('UPDATE LMS_study_content SET document_path = :document_path,video_link = :video_link WHERE content_id = :content_id');

                    $qryUpdateVideo->execute([
                        'content_id' => $c_id,
                        'document_path' => NULL,
                        'video_link' => NULL
                    ]);
                    $ContentQryUpdate = $dbConn->prepare('UPDATE LMS_study_content SET title = :title,content_type = :content_type,video_link = :video_link,publish_date = :publish_date,teacher_id = :teacher_id,created_by_user = :created_by_user,updated_by = :updated_by,updated_at = :updated_at,updated_device = :updated_device WHERE content_id = :content_id');
                    $ContentQryUpdate->execute([
                        'content_id' => $check[$kay],
                        'title' => $content_title[$kay],
                        'content_type' => $material,
                        'video_link' => $content[$count_video-1],
                        'publish_date' => $content_publish_date[$kay],
                        'teacher_id' => $teacher_id,
                        'created_by_user' => $created_by_user,
                        'updated_by' => $content_updated_by,
                        'updated_at' => $content_updated_at,
                        'updated_device' => $content_updated_device
                    ]);
                    if($ContentQryUpdate){
                        $success = true;
                    }
                }
                
                
            }else{
                if($check[$kay] == 'on' || empty($check[$kay])){
                    $content_created_by = $loggedIn_user;
                    $content_created_at = $current_date_time;
                    $content_created_device = $ip;
                    $material_name = getMaterialNameById($material_id);
                    $count_doc = $count_doc + 1;
                    $_FILES['content']['name'][$count_doc-1];

                    $tmpFilePath = $_FILES['content']['tmp_name'][$count_doc-1];
                    $newFilePath = "uploads/materials/$material_name/" .$study_material_id.'-'.$content_created_by.'-'. microtime().'-'.$_FILES['content']['name'][$count_doc-1];
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                        $qryInsertContent = $dbConn->prepare('INSERT INTO LMS_study_content (study_id,title,content_type,document_path,publish_date,teacher_id,created_by_user,created_by,created_at,created_device)VALUES (:study_id,:title,:content_type,:document_path,:publish_date,:teacher_id,:created_by_user,:created_by,:created_at,:created_device)');

                        $qryInsertContent->execute([
                            'study_id' => $study_material_id,
                            'title' => $content_title[$kay],
                            'content_type' => $material,
                            'document_path' => $newFilePath,
                            'publish_date' => $content_publish_date[$kay],
                            'teacher_id' => $teacher_id,
                            'created_by_user' => $created_by_user,
                            'created_by' => $content_created_by,
                            'created_at' => $content_created_at,
                            'created_device' => $content_created_device
                        ]);
                        if($qryInsertContent){
                            $success = true;
                        }
                    }
                }else{
                    $content_updated_by = $loggedIn_user;
                    $content_updated_at = $current_date_time;
                    $content_updated_device = $ip;
                    $c_id = $check[$kay];
                    $material_name = getMaterialNameById($material_id);
                    $count_doc = $count_doc + 1;
                    $_FILES['content']['name'][$count_doc-1];
                    if(!empty($_FILES['content']['name'][$count_doc-1])){
                        $tmpFilePath = $_FILES['content']['tmp_name'][$count_doc-1];
                        $newFilePath = "uploads/materials/$material_name/" .$study_material_id.'-'.$content_updated_by.'-'. microtime().'-'.$_FILES['content']['name'][$count_doc-1];
                        if(move_uploaded_file($tmpFilePath, $newFilePath)) {

                            $contentQry = $dbConn->prepare("select * FROM LMS_study_content where content_id = $c_id");
                            $contentQry->execute();
                            $contentRecord = $contentQry->fetch(PDO::FETCH_ASSOC);
                            if(!empty($contentRecord['document_path'])){
                                unlink($contentRecord['document_path']);
                            }

                            $qryUpdateDocument = $dbConn->prepare('UPDATE LMS_study_content SET document_path = :document_path,video_link = :video_link WHERE content_id = :content_id');

                            $qryUpdateDocument->execute([
                                'content_id' => $c_id,
                                'document_path' => NULL,
                                'video_link' => NULL
                            ]);

                            $qryUpdateContent = $dbConn->prepare('UPDATE LMS_study_content SET title = :title,content_type = :content_type,document_path = :document_path,publish_date = :publish_date,teacher_id = :teacher_id,created_by_user = :created_by_user,updated_by = :updated_by,updated_at = :updated_at,updated_device = :updated_device WHERE content_id = :content_id');

                            $qryUpdateContent->execute([
                                'content_id' => $c_id,
                                'title' => $content_title[$kay],
                                'content_type' => $material,
                                'document_path' => $newFilePath,
                                'publish_date' => $content_publish_date[$kay],
                                'teacher_id' => $teacher_id,
                                'created_by_user' => $created_by_user,
                                'updated_by' => $content_updated_by,
                                'updated_at' => $content_updated_at,
                                'updated_device' => $content_updated_device
                            ]);
                            if($qryUpdateContent){
                                $success = true;
                            }
                        }
                    }else{
                        $qryUpdateContent = $dbConn->prepare('UPDATE LMS_study_content SET title = :title,content_type = :content_type,document_path = :document_path,publish_date = :publish_date,teacher_id = :teacher_id,created_by_user = :created_by_user,updated_by = :updated_by,updated_at = :updated_at,updated_device = :updated_device WHERE content_id = :content_id');

                        $qryUpdateContent->execute([
                            'content_id' => $c_id,
                            'title' => $content_title[$kay],
                            'content_type' => $material,
                            'document_path' => $_POST["content_doc".$kay],
                            'publish_date' => $content_publish_date[$kay],
                            'teacher_id' => $teacher_id,
                            'created_by_user' => $created_by_user,
                            'updated_by' => $content_updated_by,
                            'updated_at' => $content_updated_at,
                            'updated_device' => $content_updated_device
                        ]);
                        if($qryUpdateContent){
                            $success = true;
                        }
                    }
                    
                }
                
            }

            
            
        }
    }else{
        $arr["status"]=0;
        $arr["msg"]="study material not inserted";   
    }
//die;
}
else
{


        $material_created_by = $loggedIn_user;
        $material_created_at = $current_date_time;
        $material_created_device = $ip;

        $content_created_by = $loggedIn_user;
        $content_created_at = $current_date_time;
        $content_created_device = $ip;
        
    

        $qryInsert = $dbConn->prepare('INSERT INTO LMS_study_material (course_id,stream_id,department_id,material_id,paper_type_id,semester_id,subject_id,created_by,created_at,created_device)VALUES (:course_id,:stream_id,:department_id,:material_id,:paper_type_id,:semester_id,:subject_id,:created_by,:created_at,:created_device)');

        $qryInsert->execute([
        'course_id' => $course_id,
        'stream_id' => $stream_id,
        'department_id' => $department_id,
        'material_id' => $material_id,
        'paper_type_id' => $paper_type_id,
        'subject_id' => $subject_id,
        'semester_id' => $semester_id,
        'created_by' => $material_created_by,
        'created_at' => $material_created_at,
        'created_device' => $material_created_device
        
        ]);
        $study_material_id = $dbConn->lastInsertId();
        $count_video = 0;
        $count_doc = 0;
        if($study_material_id){
            foreach ($material_type as $kay => $material) {
                $content_video = "";
                $content_doc = "";
                
                if($material=="video"){
                    //$content_video = $content[$kay];
                    $count_video = $count_video + 1;
                    $qryInsertContent = $dbConn->prepare('INSERT INTO LMS_study_content (study_id,title,content_type,video_link,publish_date,teacher_id,created_by_user,created_by,created_at,created_device)VALUES (:study_id,:title,:content_type,:video_link,:publish_date,:teacher_id,:created_by_user,:created_by,:created_at,:created_device)');

                        $qryInsertContent->execute([
                            'study_id' => $study_material_id,
                            'title' => $content_title[$kay],
                            'content_type' => $material,
                            'video_link' => $content[$count_video-1],
                            'publish_date' => $content_publish_date[$kay],
                            'teacher_id' => $teacher_id,
                            'created_by_user' => $created_by_user,
                            'created_by' => $content_created_by,
                            'created_at' => $content_created_at,
                            'created_device' => $content_created_device
                        ]);
                        if($qryInsertContent){
                            $success = true;
                        }
                    
                }else{
                    //$content_doc = $content[$kay];
                    $material_name = getMaterialNameById($material_id);
                    $count_doc = $count_doc + 1;
                    $_FILES['content']['name'][$count_doc-1];

                    $tmpFilePath = $_FILES['content']['tmp_name'][$count_doc-1];
                    $newFilePath = "uploads/materials/$material_name/" .$study_material_id.'-'.$content_created_by.'-'. microtime().'-'.$_FILES['content']['name'][$count_doc-1];
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                        $qryInsertContent = $dbConn->prepare('INSERT INTO LMS_study_content (study_id,title,content_type,document_path,publish_date,teacher_id,created_by_user,created_by,created_at,created_device)VALUES (:study_id,:title,:content_type,:document_path,:publish_date,:teacher_id,:created_by_user,:created_by,:created_at,:created_device)');

                        $qryInsertContent->execute([
                            'study_id' => $study_material_id,
                            'title' => $content_title[$kay],
                            'content_type' => $material,
                            'document_path' => $newFilePath,
                            'publish_date' => $content_publish_date[$kay],
                            'teacher_id' => $teacher_id,
                            'created_by_user' => $created_by_user,
                            'created_by' => $content_created_by,
                            'created_at' => $content_created_at,
                            'created_device' => $content_created_device
                        ]);
                        if($qryInsertContent){
                            $success = true;
                        }
                    }
                }

                
                
            }
        }else{
            $arr["status"]=0;
            $arr["msg"]="study material not inserted";   
        }
    
}

//die;

        
     
//$studyMaterialRecord = getStudyMaterialAllData();
    if($success == true){
        $arr["status"]=1;
        $arr["msg"]="Successfully Saved";
        //$arr["studyMaterialRecord"]=$studyMaterialRecord;
    }else{
        $arr["status"]=0;
        $arr["msg"]="Something Went Wrong";   
    }
   
 


echo json_encode($arr);

?>