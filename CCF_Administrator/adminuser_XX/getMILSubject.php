<?php
include("../../connection.php");
  
$recordarr = array();
$MIL = $_POST["MIL"];
$courseCode = $_POST["coursecode"];
 
  $recordqry = "SELECT  CU_compulsarySubject.* FROM  CU_compulsarySubject join CU_streamMaster sm ON sm.mapstream= CU_compulsarySubject.stream JOIN CU_course course ON course.stream=sm.appstream where  compulsarySubject='".$MIL."' and course.courseCode='".$courseCode."';";

$recordresult = $dbConn->query($recordqry);

if($recordresult) {
	while ($row=$recordresult->fetch(PDO::FETCH_ASSOC)) {
					$recordarr[] = $row;
			}
}

$recordresult= NULL;
$dbConn = NULL;

echo json_encode($recordarr);
?>
