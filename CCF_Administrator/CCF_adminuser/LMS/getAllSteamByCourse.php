<?php
 include("../../../connection_CCF.php");
 include("../../function.php");
 include("../../../configuration_CCF.php");
 include("lmsfunction.php");

 $course_id = transformInput($_POST["course_id"]);

 $streamtQry = $dbConn->prepare("select * FROM LMS_stream_master where course_id = $course_id and is_active=1");
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