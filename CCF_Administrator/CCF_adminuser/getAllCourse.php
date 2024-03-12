<?php
include("../../connection_CCF.php");
  
$recordarr = array();
$section = $_POST["section"];
 $recordqry = "select distinct stream,streamType from College_CourseMaster c  where section='".$section."' and  isnull(IsActive,0)=1;";
 
$recordresult = $dbConn->query($recordqry);

if($recordresult) {
	while ($row=$recordresult->fetch(PDO::FETCH_ASSOC)) {
					$recordarr[] = $row;
			}
}

$recordresult= NULL;
$dbConn = NULL;


echo json_encode($recordarr);
?>
