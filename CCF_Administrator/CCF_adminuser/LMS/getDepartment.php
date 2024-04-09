<?php
 include("../../../connection_CCF.php");
 //include("../function.php");
 include("../../../configuration_CCF.php");

$cnt = 0;
  
$arr = array();

$department_id = $_POST["department_id"];

// echo "<pre>";
// print_r($_POST);
   
 if(isset($_POST["department_id"])){
	
    
	$courseQry = $dbConn->prepare("select * FROM LMS_department_master where department_id=$department_id");
    $courseQry->execute();
    $courseRecord = $courseQry->fetch(PDO::FETCH_ASSOC);

	if($courseRecord) {
       
		$arr["status"]=1;
		$arr["data"]=$courseRecord;	 

	 }
	 else {
			$arr["status"]=0;
			$arr["msg"]="Data Not Found";  
		}
		
 }

echo json_encode($arr);

?>