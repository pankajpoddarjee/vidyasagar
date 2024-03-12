<?php
include("../../connection_CCF.php");
  
$recordarr = array();
$courseName = $_POST["course"];

  //$recordqry = "SELECT CU_compulsarySubject.* FROM  CU_compulsarySubject WHERE stream in(SELECT sm.mapstream FROM CU_course course JOIN  CU_streamMaster sm ON sm.appstream=course.stream WHERE course.courseName='".$courseName."');";
  
  $recordqry = "select SubjectName_SDMS from CU_Master_Subject_Code_Type 
where SubjectType='AEC' and IsActive=1 order by SubjectName_SDMS;";
  
$recordresult =$dbConn->query($recordqry);

if($recordresult) {
	while ($row=$recordresult->fetch(PDO::FETCH_ASSOC)) {
					$recordarr[] = $row;
			}
}

$recordresult = NULL;
$dbConn = NULL;

echo json_encode($recordarr);
?>
