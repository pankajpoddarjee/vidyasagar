<?php
include("../../connection.php");
include("function.php");
include("../../configuration.php");
 
 $collegerollno = $_POST["collegerollno"];

$permntAddr = transformInput2($_POST["txtpermntAddr"]);  
$permntPO =  transformInput2($_POST["txtpermntPO"]);
$permntPS = transformInput2($_POST["txtpermntPS"]);
$permntLocality = transformInput2($_POST["chopermntLocality"]);
$permntCity = transformInput2($_POST["txtpermntCity"]);
$permntDistrict = transformInput2($_POST["txtpermntDistrict"]);
 
$permntState = transformInput2($_POST["chopermntState"]);
$permntCountry = transformInput2($_POST["chopermntCountry"]);
$permntPin = transformInput2($_POST["txtpermntPin"]);

$localAddr = transformInput2($_POST["txtlocalAddr"]);  
$localPO =  transformInput2($_POST["txtlocalPO"]);
$localPS = transformInput2($_POST["txtlocalPS"]);
$localLocality = transformInput2($_POST["cholocalLocality"]);	
$localCity = transformInput2($_POST["txtlocalCity"]);
$localDistrict = transformInput2($_POST["txtlocalDistrict"]);
 
$localState = transformInput2($_POST["cholocalState"]);
$localCountry = transformInput2($_POST["cholocalCountry"]);
$localPin = transformInput2($_POST["txtlocalPin"]);
  
			
   $insertquery = "UPDATE studentmaster SET permntAddr='".$permntAddr."',permntPO='".$permntPO."',permntPS='".$permntPS."',permntLocality='".$permntLocality."',permntCity='".$permntCity."',permntDistrict='".$permntDistrict."',permntState='".$permntState."',permntCountry='".$permntCountry."',permntPin='".$permntPin."' ,localAddr='".$localAddr."',localPO='".$localPO."',localPS='".$localPS."',localLocality='".$localLocality."',localCity='".$localCity."',localDistrict='".$localDistrict."',localState='".$localState."',localCountry='".$localCountry."',localPin='".$localPin."'  WHERE collegeRollno='".$collegerollno."';";
  
$resultset = $dbConn->query($insertquery);
if($resultset) {
	$arr["status"] =1;
	$arr["msg"] = "Contact detail successfully saved.";
	$arr["collegerollno"] = $collegerollno ;
	}
else
{
$arr["status"] =0;
$arr["msg"] ="Try Again";
}

 			
			
			
echo json_encode($arr);


?>
