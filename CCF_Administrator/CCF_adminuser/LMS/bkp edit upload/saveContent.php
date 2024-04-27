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

// if(isset($_POST["content_id"]) && $_POST["content_id"]!=''){
//     $study_id = transformInput($_POST["study_id"]);
//     $edit_content_title = $_POST["edit_content_title"];
//     $edit_video_link = $_POST["edit_video_link"];
//     //$edit_document_path = transformInput($_POST["edit_document_path"]);

//     $qryUpdate = $dbConn->prepare('UPDATE LMS_study_material SET course_id = :course_id,stream_id = :stream_id,department_id = :department_id,material_id = :material_id,paper_type_id = :paper_type_id,semester_id = :semester_id,subject_id = :subject_id WHERE study_id = :study_id');
        
//     $qryUpdate->execute([  
//         'study_id' => $study_id,
//         'course_id' => $course_id,
//         'stream_id' => $stream_id,
//         'department_id' => $department_id,
//         'material_id' => $material_id,
//         'paper_type_id' => $paper_type_id,
//         'subject_id' => $subject_id,
//         'semester_id' => $semester_id
//     ]);
//     if($qryUpdate){
//         if(isset($_POST["edit_video_link"]) && $_POST["edit_video_link"]!=''){
//             $ContentQryUpdate = $dbConn->prepare('UPDATE LMS_study_content SET title = :title,video_link = :video_link,publish_date = :publish_date,created_by = :created_by,created_by_user = :created_by_user WHERE content_id = :content_id');
//             $ContentQryUpdate->execute([
//                 'content_id' => $content_id,
//                 'title' => $edit_content_title,
//                 'video_link' => $edit_video_link,
//                 'publish_date' => $publish_date,
//                 'created_by' => $created_by,
//                 'created_by_user' => $created_by_user
//             ]);
//             if($ContentQryUpdate){
//                 $success = true;
//             }
//         }

//         $material_name = getMaterialNameById($material_id);
//         if( isset($_FILES['edit_document_path']['name']) && $_FILES['edit_document_path']['name']!=""){
//             $_FILES['edit_document_path']['name'];
//             $tmpFilePath = $_FILES['edit_document_path']['tmp_name'];
//             $newFilePath = "uploads/materials/$material_name/" .$study_id.'-'.$created_by.'-'. microtime().'-'.$_FILES['edit_document_path']['name'];

//             if(move_uploaded_file($tmpFilePath, $newFilePath)) {
//                 $ContentQryUpdate = $dbConn->prepare('UPDATE LMS_study_content SET title = :title,document_path = :document_path,publish_date = :publish_date,created_by = :created_by,created_by_user = :created_by_user WHERE content_id = :content_id');

//                 $ContentQryUpdate->execute([
//                     'content_id' => $content_id,
//                     'title' => $edit_content_title,
//                     'document_path' => $newFilePath,
//                     'publish_date' => $publish_date,
//                     'created_by' => $created_by,
//                     'created_by_user' => $created_by_user
//                 ]);
//                 if($ContentQryUpdate){
//                     unlink($_POST["pre_doc_val"]);
//                     $success = true;
//                 }
//             }
//         }else{
            
//             $ContentQryUpdate = $dbConn->prepare('UPDATE LMS_study_content SET title = :title,document_path = :document_path WHERE content_id = :content_id');

//             $ContentQryUpdate->execute([
//                 'content_id' => $content_id,
//                 'title' => $edit_content_title,
//                 'document_path' => $_POST["pre_doc_val"]
//             ]);
//             if($ContentQryUpdate){
//                 $success = true;
//             }
//         }
//     }

// }
// else
// {

    if(isset($_POST["study_id"]) && $_POST["study_id"]!=''){
        $study_id = $_POST["study_id"];
        // $contentQry = $dbConn->prepare("select * FROM LMS_study_content where study_id = $study_id");
        // $contentQry->execute();
        // $contentRecord = $contentQry->fetchAll(PDO::FETCH_ASSOC);
        // if($contentRecord){
        //     foreach ($contentRecord as $value) {
        //        if(isset($value['document_path'])){
        //         //unlink($value['document_path']);
        //        }
        //     }
        // }

        $materialQry = $dbConn->prepare("select * FROM LMS_study_material where study_id = $study_id");
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

        $qryContentDelete = $dbConn->prepare("DELETE FROM LMS_study_content WHERE study_id = :study_id");
        $qryContentDelete->execute([
            'study_id' => $study_id
        ]);
        $qryStudyDelete = $dbConn->prepare("DELETE FROM LMS_study_material WHERE study_id = :study_id");
        $qryStudyDelete->execute([
            'study_id' => $study_id
        ]);
        
        
        //echo $is_material_table_updated;
        $material_created_by = isset($_POST["m_created_by"])?$_POST["m_created_by"]:0;
        $material_created_at = isset($_POST["m_created_at"])?$_POST["m_created_at"]:"";
        $material_created_device = isset($_POST["m_created_device"])?$_POST["m_created_device"]:"";
        if($is_material_table_updated){
            $material_updated_by = $loggedIn_user;
            $material_updated_at = $current_date_time;
            $material_updated_device = $ip;
        }else{
            $material_updated_by = !empty($_POST["m_updated_by"])?$_POST["m_updated_by"]:NULL;
            $material_updated_at = !empty($_POST["m_updated_at"])?$_POST["m_updated_at"]:NULL;
            $material_updated_device = !empty($_POST["m_updated_device"])?$_POST["m_updated_device"]:NULL;
        }

        $content_created_by = isset($_POST["m_created_by"])?$_POST["m_created_by"]:0;
        $content_created_at = isset($_POST["m_created_at"])?$_POST["m_created_at"]:"";
        $content_created_device = isset($_POST["m_created_device"])?$_POST["m_created_device"]:"";
        $content_updated_by = $loggedIn_user;
        $content_updated_at = $current_date_time;
        $content_updated_device = $ip;
        
    }else{
        $material_created_by = $loggedIn_user;
        $material_created_at = $current_date_time;
        $material_created_device = $ip;
        $material_updated_by = NULL;
        $material_updated_at = NULL;
        $material_updated_device = NULL;

        $content_created_by = $loggedIn_user;
        $content_created_at = $current_date_time;
        $content_created_device = $ip;
        $content_updated_by = NULL;
        $content_updated_at = NULL;
        $content_updated_device = NULL;
    }

    $qryInsert = $dbConn->prepare('INSERT INTO LMS_study_material (course_id,stream_id,department_id,material_id,paper_type_id,semester_id,subject_id,created_by,created_at,created_device,updated_by,updated_at,updated_device)VALUES (:course_id,:stream_id,:department_id,:material_id,:paper_type_id,:semester_id,:subject_id,:created_by,:created_at,:created_device,:updated_by,:updated_at,:updated_device)');

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
        'created_device' => $material_created_device,
        'updated_by' => $material_updated_by,
        'updated_at' => $material_updated_at,
        'updated_device' => $material_updated_device
        
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
                $qryInsertContent = $dbConn->prepare('INSERT INTO LMS_study_content (study_id,title,content_type,video_link,publish_date,teacher_id,created_by_user,created_by,created_at,created_device,updated_by,updated_at,updated_device)VALUES (:study_id,:title,:content_type,:video_link,:publish_date,:teacher_id,:created_by_user,:created_by,:created_at,:created_device,:updated_by,:updated_at,:updated_device)');

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
                        'created_device' => $content_created_device,
                        'updated_by' => $content_updated_by,
                        'updated_at' => $content_updated_at,
                        'updated_device' => $content_updated_device
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
                    $qryInsertContent = $dbConn->prepare('INSERT INTO LMS_study_content (study_id,title,content_type,document_path,publish_date,teacher_id,created_by_user,created_by,created_at,created_device,updated_by,updated_at,updated_device)VALUES (:study_id,:title,:content_type,:document_path,:publish_date,:teacher_id,:created_by_user,:created_by,:created_at,:created_device,:updated_by,:updated_at,:updated_device)');

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
                        'created_device' => $content_created_device,
                        'updated_by' => $content_updated_by,
                        'updated_at' => $content_updated_at,
                        'updated_device' => $content_updated_device
                    ]);
                    if($qryInsertContent){
                        $success = true;
                    }
                }else{
                    $qryInsertContent = $dbConn->prepare('INSERT INTO LMS_study_content (study_id,title,content_type,document_path,publish_date,teacher_id,created_by_user,created_by,created_at,created_device,updated_by,updated_at,updated_device)VALUES (:study_id,:title,:content_type,:document_path,:publish_date,:teacher_id,:created_by_user,:created_by,:created_at,:created_device,:updated_by,:updated_at,:updated_device)');

                    $qryInsertContent->execute([
                        'study_id' => $study_material_id,
                        'title' => $content_title[$kay],
                        'content_type' => $material,
                        'document_path' => $_POST["content_doc".$kay],
                        'publish_date' => $content_publish_date[$kay],
                        'teacher_id' => $teacher_id,
                        'created_by_user' => $created_by_user,
                        'created_by' => $content_created_by,
                        'created_at' => $content_created_at,
                        'created_device' => $content_created_device,
                        'updated_by' => $content_updated_by,
                        'updated_at' => $content_updated_at,
                        'updated_device' => $content_updated_device
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
    
//}

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