<?php
include("../../connection_CCF.php");

$recordarr = array();
$LCC = $_POST["LCC"];
   
$recordqry = "SELECT LCCCode FROM CU_LCCDetail Where LCCSDMS='".$LCC."';";
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
