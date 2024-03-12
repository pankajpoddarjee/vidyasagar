<?php
include("../../connection_CCF.php");
include("function.php");
include("../../configuration_CCF.php");
 
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
$applcntMobNo = transformInput2($_POST["txtMobileNo"]);
$alternateMobileNo  = transformInput2($_POST["txtotherMobileNo"]);
$hasWhatsAppno  = transformInput2($_POST["hasWhatsAppno"]);
if($hasWhatsAppno=='Yes'){
$WhatsAppno = 	transformInput2($_POST["txtWhatsAppNo"]);
}
else {
$WhatsAppno = 	'';	
}  
$applcntEmail = transformInput2($_POST["txtemailId"]);
			
   $insertquery = "UPDATE studentmaster SET permntAddr='".$permntAddr."',permntPO='".$permntPO."',permntPS='".$permntPS."',permntLocality='".$permntLocality."',permntCity='".$permntCity."',permntDistrict='".$permntDistrict."',permntState='".$permntState."',permntCountry='".$permntCountry."',permntPin='".$permntPin."' ,localAddr='".$localAddr."',localPO='".$localPO."',localPS='".$localPS."',localLocality='".$localLocality."',localCity='".$localCity."',localDistrict='".$localDistrict."',localState='".$localState."',localCountry='".$localCountry."',localPin='".$localPin."',applcntMobNo='".$applcntMobNo."',alternateMobileNo='".$alternateMobileNo."',hasWhatsAppno='".$hasWhatsAppno."',WhatsAppno='".$WhatsAppno."',applcntEmail='".$applcntEmail."'  WHERE collegeRollno='".$collegerollno."';";
  
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
