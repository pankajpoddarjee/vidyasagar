<?php
 include("../../../connection_CCF.php");
 include("../../function.php");
 include("../../../configuration_CCF.php");
 include("lmsfunction.php");

$course_id = transformInput($_POST["course_id"]);
$stream_id = transformInput($_POST["stream_id"]);
$stream_name = $_POST["stream_name"];
$stream_code = transformInput($_POST["stream_code"]);


    if(isset($_POST["stream_id"]) && $_POST["stream_id"]!=''){

        $checkStreamNameExistQry = $dbConn->prepare("select * FROM LMS_stream_master where  course_id=$course_id and (stream_name='$stream_name' OR stream_code='$stream_code') and stream_id!=$stream_id");
        $checkStreamNameExistQry->execute();
        $checkStreamNameExistRecord = $checkStreamNameExistQry->fetch(PDO::FETCH_ASSOC);
        if($checkStreamNameExistRecord){
            $arr["status"]=0;
            $arr["msg"]="This stream already exist";  
        }else{
            
            $qryUpdate = $dbConn->prepare('UPDATE LMS_stream_master SET stream_name = :stream_name,stream_code = :stream_code,course_id = :course_id WHERE stream_id = :stream_id');
        
            $qryUpdate->execute([
                'stream_id' => $stream_id,
                'course_id' => $course_id,
                'stream_name' => $stream_name,
                'stream_code' => $stream_code
            ]);
            if($qryUpdate){
                
                //$streamRecord = getStreamAllData();
                $arr["status"]=1;
                $arr["msg"]="Successfully Updated";	
                //$arr["streamRecord"]=$streamRecord;
            }else{
                $arr["status"]=0;
                $arr["msg"]="Something Went Wrong";   
            }
        }
            
     }else{
        //check stream name 
        $checkStreamNameExistQry = $dbConn->prepare("select * FROM LMS_stream_master where course_id=$course_id and (stream_name='$stream_name' OR stream_code='$stream_code')");
        $checkStreamNameExistQry->execute();
        $checkStreamNameExistRecord = $checkStreamNameExistQry->fetch(PDO::FETCH_ASSOC);


        if($checkStreamNameExistRecord){
        $courseData = getCourseDetailByID($course_id);
        $arr["status"]=0;
        $arr["msg"]="This stream already exist on ".$courseData['course_name'];  
        }else{
    
            $qryInsert = $dbConn->prepare('INSERT INTO LMS_stream_master (course_id,stream_name,stream_code)VALUES (:course_id,:stream_name,:stream_code)');
        
            $qryInsert->execute([
                'course_id' => $course_id,
                'stream_name' => $stream_name,
                'stream_code' => $stream_code
            ]);
            if($qryInsert){
                //$streamRecord = getStreamAllData();
        
                $arr["status"]=1;
                $arr["msg"]="Successfully Saved";	
                //$arr["streamRecord"]=$streamRecord;
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