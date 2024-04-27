<?php
 include("../../../connection_CCF.php");
 //include("../function.php");
 include("../../../configuration_CCF.php");
 include("lmsfunction.php");

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
$content_deleted_by = $loggedIn_user;
$content_deleted_at = $current_date_time;
$content_deleted_device = $ip;


if(!isset($_POST["action"])){
    $content_id = $_POST["delete_content_id"];
// $status = $_POST["new_satus"];
// if($status == 'Active'){
//     $new_status = '1';
// }else{
//     $new_status = '0'; 
// }
   
 if(isset($content_id ) && $content_id !=''){

    
    	 
    //$qryDelete = $dbConn->prepare('UPDATE LMS_study_content SET is_active = :is_active WHERE content_id = :content_id');
    $studyContentQry = $dbConn->prepare("select document_path FROM LMS_study_content where content_id = $content_id");
    $studyContentQry->execute();
    $studyContentRecord = $studyContentQry->fetch(PDO::FETCH_ASSOC);
    if($studyContentRecord){
        if(isset($studyContentRecord['document_path']) && !empty($studyContentRecord['document_path']) ){
           // unlink($studyContentRecord['document_path']);
           if (file_exists($studyContentRecord['document_path'])) {
                unlink($studyContentRecord['document_path']);
            }
        }
    }
    $qryDelete = $dbConn->prepare('UPDATE LMS_study_content SET is_active = :is_active,deleted_by = :deleted_by,deleted_at = :deleted_at,deleted_device = :deleted_device WHERE content_id = :content_id');
    $qryDelete->execute([
        'content_id' => $content_id,
        'is_active' => 0,
        'deleted_by' => $content_deleted_by,
        'deleted_at' => $content_deleted_at,
        'deleted_device' => $content_deleted_device
    ]);
    //$qryDelete = $dbConn->prepare("DELETE FROM LMS_study_content WHERE content_id = :content_id");

    // $qryDelete->execute([
    //     'content_id' => $content_id
    // ]);
    
    if($qryDelete){
        
        //$studyMaterialRecord = getStudyMaterialAllData();
        $arr["status"]=1;
		$arr["msg"]="Record deleted successfully";	
        //$arr["studyMaterialRecord"]=$studyMaterialRecord;
    }else{
        $arr["status"]=0;
        $arr["msg"]="Something Went Wrong";   
    }
		
 }else{
        $arr["status"]=0;
        $arr["msg"]="Something Went Wrong";   
 }

echo json_encode($arr);
}else{
    $study_id = $_POST["delete_study_id"];
    $all_child_with_parent = $_POST["all_child_with_parent"];

    $studyContentQry = $dbConn->prepare("select document_path FROM LMS_study_content where study_id = $study_id and is_active=1");
    $studyContentQry->execute();
    $studyContentRecord = $studyContentQry->fetchAll(PDO::FETCH_ASSOC);
    if($studyContentRecord){
        foreach ($studyContentRecord as $study) {
            if(isset($study['document_path']) && !empty($study['document_path']) ){

                if (file_exists($study['document_path'])) {
                    unlink($study['document_path']);
                }
            }
        }
    }
    if($all_child_with_parent=='1'){
        $qryDelete = $dbConn->prepare('UPDATE LMS_study_material SET is_active = :is_active,deleted_by = :deleted_by,deleted_at = :deleted_at,deleted_device = :deleted_device WHERE study_id = :study_id ');
        $qryDelete->execute([
            'study_id' => $study_id,
            'is_active' => 0,
            'deleted_by' => $content_deleted_by,
            'deleted_at' => $content_deleted_at,
            'deleted_device' => $content_deleted_device
        ]);
    }
    $qryDelete = $dbConn->prepare('UPDATE LMS_study_content SET is_active = :is_active,deleted_by = :deleted_by,deleted_at = :deleted_at,deleted_device = :deleted_device WHERE study_id = :study_id and is_active = :condition');
    $qryDelete->execute([
        'study_id' => $study_id,
        'is_active' => 0,
        'deleted_by' => $content_deleted_by,
        'deleted_at' => $content_deleted_at,
        'deleted_device' => $content_deleted_device,
        'condition' => 1,
    ]);

    if($qryDelete){
        
        //$studyMaterialRecord = getStudyMaterialAllData();
        $arr["status"]=1;
		$arr["msg"]="All record deleted successfully";	
        //$arr["studyMaterialRecord"]=$studyMaterialRecord;
    }else{
        $arr["status"]=0;
        $arr["msg"]="Something Went Wrong";   
    }
    echo json_encode($arr);
}


?>