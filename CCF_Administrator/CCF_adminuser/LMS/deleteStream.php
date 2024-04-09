<?php
 include("../../../connection_CCF.php");
 //include("../function.php");
 include("../../../configuration_CCF.php");
 include("lmsfunction.php");


$stream_id = $_POST["delete_stream_id"];
$status = $_POST["new_satus"];
if($status == 'Active'){
    $new_status = '1';
}else{
    $new_status = '0'; 
}
   
 if(isset($stream_id ) && $stream_id !=''){
    	 
    $qryDelete = $dbConn->prepare('UPDATE LMS_stream_master SET is_active = :is_active WHERE stream_id = :stream_id');

    $qryDelete->execute([
        'stream_id' => $stream_id,
        'is_active' => $new_status
    ]);
    if($qryDelete){
        //$streamRecord = getStreamAllData();

        $arr["status"]=1;
		$arr["msg"]="Status updated successfully";	
        //$arr["streamRecord"]=$streamRecord;
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