<?php
include("../../connection.php");

$recordarr = array();

$recordqry = "SELECT * FROM CU_subject where generalSubjectCode<>'';";
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
