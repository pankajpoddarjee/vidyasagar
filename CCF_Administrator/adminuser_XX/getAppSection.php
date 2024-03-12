<?php
include("../../connection.php");
  
$recordarr = array();
 
$recordqry = "SELECT distinct section FROM College_CourseMaster where isnull(IsActive,0)=1;";
 
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
