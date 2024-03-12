<?php
include("../../connection_CCF.php");

 
$recordarr = array();
$strsearch ="";
if(isset($_POST["subjectType"])) {
	$strsearch = " and SubjectType= '".$_POST["subjectType"]."'";
}

   $recordqry = "SELECT SubjectName_SDMS as SDMSsubject FROM CU_Master_Subject_Code_Type where  IsActive=IsActive ".$strsearch." ORDER BY SubjectType desc,SubjectName asc;";
 

$recordresult = $dbConn->query($recordqry);

if($recordresult) {
	while ($row=$recordresult->fetch(PDO::FETCH_ASSOC)) {
					$recordarr[] = $row;
			}
}

$recordresult = NULL;
$dbConn  = NULL;


echo json_encode($recordarr);
?>
