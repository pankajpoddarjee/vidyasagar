<?php
 include("../../../connection_CCF.php");
 include("../../function.php");
 include("../../../configuration_CCF.php");
 include("lmsfunction.php");

 $paper_type_id = transformInput($_POST["paper_type_id"]);
 $course_id = transformInput($_POST["course_id"]);

 $paperTypeQry = $dbConn->prepare("select * FROM LMS_paper_type_master where paper_type_id = $paper_type_id");
 $paperTypeQry->execute();
 $paperTypeRecord = $paperTypeQry->fetch(PDO::FETCH_ASSOC);

 if($paperTypeRecord){
   //$paper_duration =  explode(',',$paperTypeRecord['duration']);
   $paper_duration =  $paperTypeRecord['duration'];
 }
//print_r($paper_duration);
 $streamtQry = $dbConn->prepare("select * FROM LMS_stream_master where course_id = $course_id and duration IN (".$paper_duration.") and is_active=1");
 $streamtQry->execute();
 $streamRecord = $streamtQry->fetchAll(PDO::FETCH_ASSOC);

 if($streamRecord){
    $arr["status"]=1;
    $arr["streamRecord"]=$streamRecord;
 }else{
    $arr["status"]=0;
    $arr["msg"]="No course found";	
 }
 echo json_encode($arr);

 ?>