<?php
include("../../connection_CCF.php");
 
 $gensub=$_POST["gensub"];

$recordarr = array();

$recordqry = "select SubjectCode from CU_Master_Subject_Code_Type 
where SubjectType='MINOR' and IsActive=1 and SubjectName_SDMS='".$gensub."';";

 
$recordresult = $dbConn->query($recordqry);

if($recordresult) {
	while ($row=$recordresult->fetch(PDO::FETCH_ASSOC)) {
					$recordarr[] = $row;
			}
}

$recordresult = NULL;
$dbConn = NULL;

echo json_encode($recordarr);
?>
