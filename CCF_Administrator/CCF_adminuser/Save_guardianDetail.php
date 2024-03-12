<?php
include("../../connection_CCF.php");
include("function.php");
include("../../configuration_CCF.php");
 
 $collegerollno = $_POST["collegerollno"];

$fathername = transformInput2($_POST["txtfathername"]);
$fatherQalif = transformInput2($_POST["chofatherQalif"]);
$fatherOccup = transformInput2($_POST["chofatherOccup"]);
$fatherMobNo = transformInput2($_POST["txtfatherMobNo"]);
$motherName = transformInput2($_POST["txtmotherName"]);
$motherQalif = transformInput2($_POST["chomotherQalif"]);
$motherOccup = transformInput2($_POST["chomotherOccup"]);
$motherMobNo = transformInput2($_POST["txtmotherMobNo"]);
$applcntRlyStation = transformInput2($_POST["txtapplcntRlyStation"]);
$familyMemCnt = transformInput2($_POST["chofamilyMemCnt"]);
$guardianName = transformInput2($_POST["txtguardianName"]);
$relation = transformInput2($_POST["txtrelation"]);
$guardianOccup = transformInput2($_POST["choguardianOccup"]);
$guardianMobNo = transformInput2($_POST["txtguardianMobNo"]);
 
 
			
 $insertquery = "UPDATE studentmaster SET fathername='".$fathername."',fatherQalif='".$fatherQalif."',fatherOccup='".$fatherOccup."',fatherMobNo='".$fatherMobNo."',motherName='".$motherName."',motherQalif='".$motherQalif."',motherOccup='".$motherOccup."',motherMobNo='".$motherMobNo."',applcntRlyStation='".$applcntRlyStation."',familyMemCnt=".$familyMemCnt.",guardianName='".$guardianName."',relation='".$relation."',guardianOccup='".$guardianOccup."',guardianMobNo='".$guardianMobNo."'  WHERE collegeRollno='".$collegerollno."';";
 
$resultset = $dbConn->query($insertquery);
	if($resultset) {
	$arr["status"] =1;
	$arr["msg"] = "Guardian detail saved successfully." ;
	$arr["collegerollno"] = $collegerollno ;
	}
	else
	{
	$arr["status"] =0;
	$arr["msg"] ="Try Again";
	}

 			
$resultset = NULL;			
			
echo json_encode($arr);


?>
