<?php
include("../..connection.php");
 
 $honsub=$_POST["honsub"];

$recordarr = array();

$recordqry = "SELECT distinct subjectcode FROM College_CourseMaster where subjectName='".$honsub."';";
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
