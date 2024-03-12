<?php
include("../../connection_CCF.php");
include("function.php");
include("../../configuration_CCF.php");
 
 $collegerollno = $_POST["collegerollno"];

$minoritygrp = transformInput2($_POST["chominoritygrp"]);
$motherTongue = transformInput2($_POST["chomotherTongue"]);
$firstGenrLearner = transformInput2($_POST["chofirstGenrLearner"]);
$hasCuRegNo = transformInput2($_POST["chohasCuRegNo"]);
//$CuRegNo = transformInput2($_POST["txtCuRegNo"]);
if($_POST["hdngender"]=='Female')
{
$hasKanyashree = $_POST["chohasKanyashree"];
$kanyashreeID = $_POST["txtKanyashreeID"];
}
else {
$hasKanyashree = '';
$kanyashreeID = '';
}	

$isApplySportsQuota = transformInput2($_POST["choSportsQuota"]);
$sportlevel = transformInput2($_POST["chosportlevel"]);
//$isapplyAddonCourse = transformInput2($_POST["choapplyAddonCourse"]);
//$AddonCourses = $_POST["AddonCourses"];
$extraActivity =$_POST["willtojoin"];
 //$isHostelReq = transformInput2($_POST["choHostelReq"]); 
			
 $insertquery = "UPDATE studentmaster SET minoritygrp='".$minoritygrp."',motherTongue='".$motherTongue."',firstGenrLearner='".$firstGenrLearner."',hasCuRegNo='".$hasCuRegNo."',hasKanyashree='".$hasKanyashree."',kanyashreeID='".$kanyashreeID."',isApplySportsQuota='".$isApplySportsQuota."' ,sportlevel='".$sportlevel."' , extraActivity='".$extraActivity."' WHERE collegeRollno='".$collegerollno."';";    
 
$resultset = $dbConn->query($insertquery);
 
if($resultset) {
	$arr["status"] =1;
	$arr["msg"] = "Other personal detail saved successfully." ;
	$arr["collegerollno"] = $collegerollno ;
	}
else
{
$arr["status"] =0;
$arr["msg"] ="Try Again";
}

 $resultset =  NULL;			
			
			
echo json_encode($arr);


?>
