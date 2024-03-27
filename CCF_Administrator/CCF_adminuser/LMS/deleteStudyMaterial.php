<?php
 include("../../../connection_CCF.php");
 //include("../function.php");
 include("../../../configuration_CCF.php");
 include("lmsfunction.php");

$content_id = $_POST["delete_content_id"];
$status = $_POST["new_satus"];
if($status == 'Active'){
    $new_status = '1';
}else{
    $new_status = '0'; 
}
   
 if(isset($content_id ) && $content_id !=''){
    	 
    $qryDelete = $dbConn->prepare('UPDATE LMS_study_content SET is_active = :is_active WHERE content_id = :content_id');

    $qryDelete->execute([
        'content_id' => $content_id,
        'is_active' => $new_status
    ]);
    if($qryDelete){
        $studyMaterialRecord = getStudyMaterialAllData();
        $arr["status"]=1;
		$arr["msg"]="Status updated successfully";	
        $arr["studyMaterialRecord"]=$studyMaterialRecord;
    }else{
        $arr["status"]=0;
        $arr["msg"]="Something Went Wrong";   
    }
		
 }else{
        $arr["status"]=0;
        $arr["msg"]="Something Went Wrong";   
 }

echo json_encode($arr);

?>