<?php
ob_start();
include("../../connection.php");
 include("../../configuration.php");

$arr = array();
 
$collrollno = $_POST["collrollno"];



$fetchAllqry	=	"SELECT  count(st.stid) as avail FROM studentmaster st  WHERE collegeRollNo='".$collrollno."';";
	$fetchresult = $dbConn->query($fetchAllqry);
	
	if($fetchresult) {
			while ($fetchrow=$fetchresult->fetch(PDO::FETCH_ASSOC)){
			$record[]=$fetchrow;
			}
		}
		
		$fetchresult = NULL;
		$dbConn= NULL;
		
if($record[0]["avail"]>0) {
		
	$arr["status"] = 1;
	$arr["msg"]="";
 }
else
{
	$arr["status"] = 0;
	$arr["msg"]="Registration No. not found.";
}
	
	

	
	
	echo json_encode($arr);
	
				


?>