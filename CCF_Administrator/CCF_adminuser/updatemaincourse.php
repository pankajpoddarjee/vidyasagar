<?php
include("../../connection_CCF.php");
 
$arr = array();
  
$collegerollno =$_POST["hdncollegerollno"];
$presentstream =$_POST["hdnpresentstream"];
$presentsubject =$_POST["hdnpresentsubject"];
$section =$_POST["cboappsection"];
$stream =$_POST["cboappstream"];
$coursecode =$_POST["coursecode"];
$subject =$_POST["cboappsubject"];
$subjectcode =$_POST["txtappsubjectcode"];
$rollno_prefix =$_POST["txtCollrollno_prefix"]; 
$rollno_srlno =$_POST["txtCollrollno_srlno"]; 
$checkarr = array();

$newrollno = $rollno_prefix.str_pad($rollno_srlno, 4, 0, STR_PAD_LEFT);

 if($presentstream==$stream && $presentsubject==$subject) {
	$arr['status'] =0;
	$arr['msg']= "No changes found.";	 
 }
 
 else {
	  $checkqry ="select count(stid) as availcnt from studentmaster WHERE collegeRollno='".$newrollno."';" ;
 
	$checkresult = $dbConn->query($checkqry);

	if($checkresult) {
		while ($checkrow=$checkresult->fetch(PDO::FETCH_ASSOC)) {
						$checkarr = $checkrow;
				}
	} 
 
	 
if($checkarr["availcnt"]==0) {
// $finalqry ="";	
	  
 $finalqry = "EXEC dbo.update_maincourse '".$collegerollno."','".$rollno_prefix."','".$rollno_srlno."','".$section."','".$stream."','".$subject."','".$subjectcode."';";
  
$recordresult = $dbConn->query($finalqry);

if($recordresult) {
	$arr['status'] =1;
	$arr['msg']= "Successfully Updated.";
	$arr['newrollno']= $newrollno;
}
else
{
	$arr['status'] =0;
	$arr['msg']= "Try again.";
}
}
else {
	$arr['status'] =0;
	$arr['msg']= "College Roll no already exist.";
	}
 }

 
 $recordresult =  NULL;
$dbConn=  NULL;

echo json_encode($arr);
?>
