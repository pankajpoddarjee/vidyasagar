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

$course_id = transformInput($_POST["course_id"]);
$stream_id = transformInput($_POST["stream_id"]);
$department_id = transformInput($_POST["department_id"]);
//$teacher_id = transformInput($_POST["teacher_id"]);
$material_id = transformInput($_POST["material_id"]);
$paper_type_id = transformInput($_POST["paper_type_id"]);
$semester_id = transformInput($_POST["semester_id"]);
$publish_date = $_POST["publish_date"];  

$material_type =  isset($_POST["material_type"])?$_POST["material_type"]:"";
$content_title = isset($_POST["content_title"])?$_POST["content_title"]:"";
if (in_array("video", $material_type)) { 
    $content = $_POST["content"]; 
} 
$success =  false;

//print_r($material_type); 
// print_r($content_title);
// print_r($content);die;
//print_r($_FILES);

if(isset($_POST["content_id"]) && $_POST["content_id"]!=''){
    $study_id = transformInput($_POST["study_id"]);
    $edit_content_title = $_POST["edit_content_title"];
    $edit_video_link = $_POST["edit_video_link"];
    //$edit_document_path = transformInput($_POST["edit_document_path"]);

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
        if(isset($_POST["edit_video_link"]) && $_POST["edit_video_link"]!=''){
            $ContentQryUpdate = $dbConn->prepare('UPDATE LMS_study_content SET title = :title,video_link = :video_link,publish_date = :publish_date WHERE content_id = :content_id');
            $ContentQryUpdate->execute([
                'content_id' => $content_id,
                'title' => $edit_content_title,
                'video_link' => $edit_video_link,
                'publish_date' => $publish_date
            ]);
            if($ContentQryUpdate){
                $success = true;
            }
        }
        if( isset($_FILES['edit_document_path']['name']) && $_FILES['edit_document_path']['name']!=""){
            $_FILES['edit_document_path']['name'];
            $tmpFilePath = $_FILES['edit_document_path']['tmp_name'];
            $newFilePath = "uploads/materials/" . time().'-'.$_FILES['edit_document_path']['name'];

            if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                $ContentQryUpdate = $dbConn->prepare('UPDATE LMS_study_content SET title = :title,document_path = :document_path,publish_date = :publish_date WHERE content_id = :content_id');

                $ContentQryUpdate->execute([
                    'content_id' => $content_id,
                    'title' => $edit_content_title,
                    'document_path' => $newFilePath,
                    'publish_date' => $publish_date
                ]);
                if($ContentQryUpdate){
                    $success = true;
                }
            }
        }else{
            
            $ContentQryUpdate = $dbConn->prepare('UPDATE LMS_study_content SET title = :title,document_path = :document_path WHERE content_id = :content_id');

            $ContentQryUpdate->execute([
                'content_id' => $content_id,
                'title' => $edit_content_title,
                'document_path' => $_POST["pre_doc_val"]
            ]);
            if($ContentQryUpdate){
                $success = true;
            }
        }
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
    if($study_material_id){
        foreach ($material_type as $kay => $material) {
            $content_video = "";
            $content_doc = "";
            
            if($material=="video"){
                //$content_video = $content[$kay];
                $count_video = $count_video + 1;
                $qryInsertContent = $dbConn->prepare('INSERT INTO LMS_study_content (study_id,title,content_type,video_link,publish_date)VALUES (:study_id,:title,:content_type,:video_link,:publish_date)');

                    $qryInsertContent->execute([
                        'study_id' => $study_material_id,
                        'title' => $content_title[$kay],
                        'content_type' => $material,
                        'video_link' => $content[$count_video-1],
                        'publish_date' => $publish_date
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
                    $qryInsertContent = $dbConn->prepare('INSERT INTO LMS_study_content (study_id,title,content_type,document_path,publish_date)VALUES (:study_id,:title,:content_type,:document_path,:publish_date)');

                    $qryInsertContent->execute([
                        'study_id' => $study_material_id,
                        'title' => $content_title[$kay],
                        'content_type' => $material,
                        'document_path' => $newFilePath,
                        'publish_date' => $publish_date
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