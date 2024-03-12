<?php
include("../../connection_CCF.php");
include("../../function.php");

  
$recordarr = array();
$stream = $_POST["stream"];
$section =$_POST["section"];

$recordqry = "SELECT distinct subjectcode,subjectName FROM College_CourseMaster where stream='".$stream."' and section='".$section."' and isnull(IsActive,0)=1;";


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
