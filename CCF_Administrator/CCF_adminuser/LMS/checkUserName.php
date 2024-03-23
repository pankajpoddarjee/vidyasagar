<?php
 include("../../../connection_CCF.php");
 //include("../function.php");
 include("../../../configuration_CCF.php");


$arr = array();

if (isset($_POST['username_check'])) {
	$username = $_POST['username'];
	$teacherQry = $dbConn->prepare("SELECT * FROM LMS_teacher_master WHERE username='$username'");
    $teacherQry->execute();
    $teacherRecord = $teacherQry->fetchAll(PDO::FETCH_ASSOC);
	//$sql = "SELECT * FROM LMS_teacher_master WHERE username='$username'";
	//$results = mysqli_query($db, $sql);
	if (count($teacherRecord) > 0) {
	  	$arr["status"]=0;
		$arr["msg"]="taken"; 
	}else{
	  	$arr["status"]=1;
		$arr["msg"]="not_taken";  
	}
}

echo json_encode($arr);

?>