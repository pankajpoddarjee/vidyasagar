<?php
include("../../connection_CCF.php");

$recordarr = array();
$course = $_POST["course"];

$recordqry = "SELECT * FROM CU_course where stream='".$course."';";


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
