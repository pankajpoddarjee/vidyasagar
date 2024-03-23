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
$content_id = transformInput($_POST["content_id"]);
$study_id = transformInput($_POST["study_id"]);
$course_id = transformInput($_POST["course_id"]);
$stream_id = transformInput($_POST["stream_id"]);
$department_id = transformInput($_POST["department_id"]);
//$teacher_id = transformInput($_POST["teacher_id"]);
$material_id = transformInput($_POST["material_id"]);
$paper_type_id = transformInput($_POST["paper_type_id"]);
$semester_id = transformInput($_POST["semester_id"]);

$material_type = $_POST["material_type"];
$content_title = $_POST["content_title"];
if (in_array("video", $material_type)) { 
    $content = $_POST["content"]; 
} 
//$content = $_POST["content"];

//print_r($material_type); 
// print_r($content_title);
// print_r($content);die;

if(isset($_POST["content_id"]) && $_POST["content_id"]!=''){
    $edit_content_title = transformInput($_POST["edit_content_title"]);
    $edit_video_link = transformInput($_POST["edit_video_link"]);
    $edit_document_path = transformInput($_POST["edit_document_path"]);

    $qryUpdate = $dbConn->prepare('UPDATE LMS_study_material SET course_id = :course_id,stream_id = :stream_id,department_id = :department_id,material_id = :material_id,paper_type_id = :paper_type_id,semester_id = :semester_id WHERE study_id = :study_id');
        
    $qryUpdate->execute([
        'study_id' => $study_id,
        'course_id' => $course_id,
        'stream_id' => $stream_id,
        'department_id' => $department_id,
        'material_id' => $material_id,
        'paper_type_id' => $paper_type_id,
        'semester_id' => $semester_id
    ]);
    if($qryUpdate){

    }

}
else
{

    $qryInsert = $dbConn->prepare('INSERT INTO LMS_study_material (course_id,stream_id,department_id,material_id,paper_type_id,semester_id)VALUES (:course_id,:stream_id,:department_id,:material_id,:paper_type_id,:semester_id)');

    $qryInsert->execute([
        'course_id' => $course_id,
        'stream_id' => $stream_id,
        'department_id' => $department_id,
        'material_id' => $material_id,
        'paper_type_id' => $paper_type_id,
        'semester_id' => $semester_id
        
    ]);
    $study_material_id = $dbConn->lastInsertId();
    $count_video = 0;
    $count_doc = 0;
    foreach ($material_type as $kay => $material) {
        $content_video = "";
        $content_doc = "";
        
        if($material=="video"){
            //$content_video = $content[$kay];
            $count_video = $count_video + 1;
            $qryInsertContent = $dbConn->prepare('INSERT INTO LMS_study_content (study_id,title,content_type,video_link)VALUES (:study_id,:title,:content_type,:video_link)');

                $qryInsertContent->execute([
                    'study_id' => $study_material_id,
                    'title' => $content_title[$kay],
                    'content_type' => $material,
                    'video_link' => $content[$count_video-1]
                ]);
                if($qryInsertContent){
                    $success = true;
                }
            
        }else{
            //$content_doc = $content[$kay];
            $count_doc = $count_doc + 1;
            $_FILES['content']['name'][$count_doc-1];
            $tmpFilePath = $_FILES['content']['tmp_name'][$count_doc-1];
            $newFilePath = "uploads/materials/" . time().'-'.$_FILES['content']['name'][$count_doc-1];
            if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                $qryInsertContent = $dbConn->prepare('INSERT INTO LMS_study_content (study_id,title,content_type,document_path)VALUES (:study_id,:title,:content_type,:document_path)');

                $qryInsertContent->execute([
                    'study_id' => $study_material_id,
                    'title' => $content_title[$kay],
                    'content_type' => $material,
                    'document_path' => $newFilePath
                ]);
                if($qryInsertContent){
                    $success = true;
                }
            }
        }

        
        
    }
    
}

//die;

        
     
$studyMaterialRecord = getStudyMaterialAllData();
    if($success == true){
        $arr["status"]=1;
        $arr["msg"]="Successfully Saved";
        $arr["studyMaterialRecord"]=$studyMaterialRecord;
    }else{
        $arr["status"]=0;
        $arr["msg"]="Something Went Wrong";   
    }
   
 


echo json_encode($arr);

?>