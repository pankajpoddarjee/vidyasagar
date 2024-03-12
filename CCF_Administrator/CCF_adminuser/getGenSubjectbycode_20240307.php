<?php
include("../../connection_CCF.php");
 
 $gensub=$_POST["gensub"];

$recordarr = array();

$recordqry = "SELECT generalSubjectCode FROM CU_subject where subject='".$gensub."' and  generalSubjectCode<>'';";
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
