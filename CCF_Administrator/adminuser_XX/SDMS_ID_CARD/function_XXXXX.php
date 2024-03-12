<?php
include("configuration.php");
 

function subForDisplay($stream, $applsubject)
{
	if($stream=='BA' || $stream=='BSC')
	{
		$appsub = $applsubject." Honours";
	}
	else
	{
	$appsub = $applsubject;
	}
	
	return $appsub;
}

function generateRegistration($appval)
{
	$padding = APPNOPADDING+APPSRLNOPADDING;
	$finalappno =  APPNOPREFIX.str_pad($appval, $padding, 0, STR_PAD_LEFT);
	
	return $finalappno;
}

function generateRefno($refno)
{
	 
	$referenceno = str_pad($refno, 5, 0, STR_PAD_LEFT);
	
	$finalrefno =  REFNOPREFIX.$referenceno;
	
	return $finalrefno;
}
function getRefno($referenceno)
{
	 
	$refeno =  substr($referenceno,7); 
	
	return $refeno;
	
	 
}


function generateApplicationno($srlno,$appval)
{
	$serialno = str_pad($srlno, APPSRLNOPADDING, 0, STR_PAD_LEFT);
	$applicno = str_pad($appval, APPNOPADDING, 0, STR_PAD_LEFT);
	
	$finalapplicationno =  APPNOPREFIX.$serialno.$applicno;
	
	return $finalapplicationno;
}		
	
		
function getAppno($finalappval)
{
	$appno =  substr($finalappval,5); 
	
	return $appno;
}
function streamForDisplay($stream)
{
$appstream = "";
	switch ($stream)
	{
	case "BA":
	  $appstream = "B.A.";
	  break;
	case "BSC":
	  $appstream = "B.Sc.";
	  break;
	
	case "BCOM":
	  $appstream = "B.Com.";
	  break;
	case "BAGEN":
	  $appstream = "B.A.";
	  break;
	case "BAGENGEOG":
	  $appstream = "B.A.";
	  break;
	case "BAGENSANG":
	  $appstream = "B.A.";
	  break;
	case "BAGENEDUG":
	  $appstream = "B.A.";
	  break;
	case "BAGENSANGEDUG":
	  $appstream = "B.A.";
	  break;
	case "BAGENPEDG":
	  $appstream = "B.A.";
	  break;
	case "BSCGENBIO":
	  $appstream = "B.Sc.";
	  break;
	case "BSCGENPURE":
	  $appstream = "B.Sc.";
	  break;
	case "BSCGEN":
	  $appstream = "B.Sc.";
	  break;
	case "BSCGENPEDG":
	  $appstream = "B.Sc.";
	  break;
	case "BSCGENPHSGMTMG":
	  $appstream = "B.Sc.";
	  break;
	case "BSCGENGEOG":
	  $appstream = "B.Sc.";
	  break;
	case "BSCGENGEOGBOTG":
	  $appstream = "B.Sc.";
	  break;
	case "BSCGENBOTG":
	  $appstream = "B.Sc.";
	  break;
	case "BSCGENGEOGPEDG":
	  $appstream = "B.Sc.";
	  break;
	case "BSCGENBOTGPEDG":
	  
	case "BSCGENGEOGPEDG":
	  $appstream = "B.Sc.";
	  break;
	case "BSCGENMTMG":
	  $appstream = "B.Sc.";
	  break;
	case "BCOMGEN":
	  $appstream = "B.Com.";
	  
	}
		
 return $appstream;
}

 														

?>

