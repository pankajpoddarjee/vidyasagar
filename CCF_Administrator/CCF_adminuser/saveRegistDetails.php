<?php
include("../../connection_CCF.php");
include("function.php");
include("../../configuration_CCF.php"); 
 

$collegerollno = $_POST["collegerollno"];
 $name=transformInput2($_POST["txtName"]);
$dd = transformInput2($_POST["choDOBdd"]);
$mm = transformInput2($_POST["choDOBmm"]);
$yy = transformInput2($_POST["choDOByy"]);
$dob = $dd.'/'.$mm.'/'.$yy;
$sex = transformInput2($_POST["choGender"]);
$bloodGroup = transformInput2($_POST["choBloodgrp"]);

$aadharNo = transformInput2($_POST["txtAadharNo"]);
 $caste = transformInput2($_POST["choCategory"]);

$stateofdomicile = transformInput2($_POST["choDomicile"]);
$scstStateOther = transformInput2($_POST["txtotherDomicile"]);
 $PH = transformInput2($_POST["choDisability"]);
$disabilitytype = transformInput2($_POST["chodisabilitytype"]);
$disabilityPercentage = transformInput2($_POST["txtdisabilitypercent"]); 
$married = transformInput2($_POST["choMarriedStatus"]);
 

$religion = transformInput2($_POST["choReligion"]);

$otherReligion = transformInput2($_POST["txtotherReligion"]);

$APLBPL = transformInput2($_POST["choWhetherBPL"]);
$bplno = transformInput2($_POST["txtBPLNo"]);
if($_POST["choCategory"]=='General' && $_POST["choDomicile"]=='West Bengal'){
$EWS =  $_POST["choWhetherEWS"];
}
else {
$EWS =  '';
}
$CURegNo =$_POST["txtCURegNo"];
$CURollNo =$_POST["txtCURollNo"];
$annualIncome = transformInput2($_POST["txtannualFamilyIncome"]);
 
		 
	 $insertquery = "UPDATE studentmaster SET name='".$name."', dd='".$dd."',mm='".$mm."',yy='".$yy."',dob='".$dob."',sex='".$sex."',bloodGroup='".$bloodGroup."' ,aadharNo='".$aadharNo."',caste='".$caste."',stateofdomicile='".$stateofdomicile."',scstStateOther='".$scstStateOther."' , married='". $married."', religion='".$religion."',otherReligion='".$otherReligion."',APLBPL='".$APLBPL."',bplno='".$bplno."',EWS='".$EWS."',annualIncome='".$annualIncome."',PH='".$PH."',disabilitytype='".$disabilitytype."',disabilityPercentage='".$disabilityPercentage."',CURegNo='".$CURegNo."',CURollNo='".$CURollNo."'  WHERE collegeRollno='".$collegerollno."';";
	
	  
		 

$resultset = $dbConn->query($insertquery);
if($resultset) {
	$arr["status"] =1;
	$arr["msg"] = "Registration detail saved successfully." ;
	$arr["collegerollno"] = $collegerollno ;
	}
else
{
$arr["status"] =0;
 $arr["msg"] ="Try Again";

}

 
$resultset  = NULL;
$dbConn  = NULL;
			
echo json_encode($arr);


?>
