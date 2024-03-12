<?php
include("../../connection_CCF.php");

$recordarr = array();

$recordqry = "select SubjectName_SDMS as SDMSsubject from CU_Master_Subject_Code_Type 
where SubjectType='MINOR' and IsActive=1 ORDER BY SubjectName_SDMS";
$recordresult = $dbConn->query($recordqry);

if($recordresult) {
	while ($row=$recordresult->fetch(PDO::FETCH_ASSOC)) {
					$recordarr[] = $row;
			}
}

$recordresult = NULL;
$dbConn= NULL;

echo json_encode($recordarr);
?>
