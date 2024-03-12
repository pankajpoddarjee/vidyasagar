<?php
include("../../connection_CCF.php");
  
$recordarr = array();
$arr = array();
  $collegeroll = $_POST["hdncollegerollno"];
  $presentstream =$_POST["hdnpresentstream"];
$presentsubject =$_POST["hdnpresentsubject"];
  // $appsection = $_POST["cboappsection"];
   $appstream =$_POST["cboappstream"];
  $appsubject =$_POST["cboappsubject"];
   $appsubjectcode =$_POST["txtappsubjectcode"];
   
   if($presentstream==$appstream && $presentsubject==$appsubject) {
	$arr['status'] =0;
	$arr['msg']= "No changes found.";	 
 }
 else{     
 $recordqry = "EXEC dbo.generate_collegerollno '".$collegeroll."','".$appstream."','".$appsubjectcode."';";
 
$recordresult = $dbConn->query($recordqry);

if($recordresult) {
	while ($row=$recordresult->fetch(PDO::FETCH_ASSOC)) {
					$recordarr = $row;
			}
}
	$arr['status'] =1;
	$arr['newrollno']= $recordarr["newcollegeRollno"];	 
	$arr['newrollnoprefix']= $recordarr["rollprefix"];	 
	$arr['newrollnoSrlno']= $recordarr["rollserial"];	 
 
 }
$recordresult = NULL;
$dbConn = NULL;

echo json_encode($arr);
?>
