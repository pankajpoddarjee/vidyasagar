<?php
 function transformInput($val)
{
	$finalval	=	trim($val);
	
	//$finalval 		=	ereg_replace("[ \t]+", " ", $finalval);
	$finalval		=	str_replace("\r\n","",$finalval);
	$finalval		=	str_replace("\n","",$finalval);
	$finalval 		= 	str_replace("'", "''",$finalval);
	$finalval 		= 	stripslashes($finalval);
	 $finalval = strtoupper($finalval);
	
	return $finalval;

}	

function transformInput2($val)
{
	$finalval	=	trim($val);
	
	//$finalval 		=	ereg_replace("[ \t]+", " ", $finalval);
	$finalval		=	str_replace("\r\n","",$finalval);
	$finalval		=	str_replace("\n","",$finalval);
	$finalval 		= 	str_replace("'", "''",$finalval);
	$finalval 		= 	stripslashes($finalval);
	//$finalval = strtoupper($finalval);
	
	return $finalval;

}			
function generateRegistration($appval)
{
	$padding = APPNOPADDING+APPSRLNOPADDING;
	$finalappno =  APPNOPREFIX.str_pad($appval, $padding, 0, STR_PAD_LEFT);
	
	return $finalappno;
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
	$appno =  substr($finalappval,7); 
	
	return $appno;
}
function categparm($category)
{
	 $pramcateg = "";
	if($category!='GENERAL') { $pramcateg = "SCSTOBC";}
	else
	 { $pramcateg = "GENERAL";}
	return  $pramcateg;
	
}

 
 function getRelatedelective($subject)
{
$linkstr='';
$electsubxml = simplexml_load_file('../xml/RelatedSubForElective.xml');
$relatedelectivnames = $electsubxml->xpath('/subjects/subject[@name="'.$subject.'"]/relatedsub');
return $relatedelectivnames;
}



function getSubject_XXX($sestionval,$stream,$codevalue)
{
$subjectxml = simplexml_load_file('../xml/collegedata.xml');
$subjectname = $subjectxml->xpath('/sections/section[@id="'.$sestionval.'"]/stream[@id="'.$stream.'"]/subject[@id="'.$codevalue.'"]');
return $subjectname[0]["name"];
}


 
 function getAllStream($section) {
$linkstr='';
$streamarr = array();
$subnames = array();
$subxml = simplexml_load_file('../xml/collegedata.xml');
$subnames = $subxml->xpath('/sections/section[@id="'.$section.'"]/stream');
/* for($i=0; $i<count($subnames); $i++) {
		$streamarr[] = $subnames;
	} */
return $subnames ;
}
 
function getAllSubject($sestionval,$stream) 
{
$linkstr='';
$subjectarr = array();
$subarr = array();
$subjcodearr  = array();
$subjnamearr = array();
$subxml = simplexml_load_file('../xml/collegedata.xml');
$subjectarr[] = $subxml->xpath('/sections/section[@id="'.$sestionval.'"]/stream[@id="'.$stream.'"]/subject');

	/* for($i=0; $i<count($subjectarr[0]); $i++) {
		$subjcodearr[] = $subjectarr[0][$i]["id"];
		$subjnamearr[] = $subjectarr[0][$i]["name"];
	}
		array_push($subarr,array_values(array_unique($subjcodearr)),array_values(array_unique($subjnamearr))); */
return $subjectarr ;

}
function  displayStreamName($stream)
{
$appstream = "";
	switch ($stream)
	{
	case "BA":
	  $appstream = "B.A Honours";
	  break;
	case "BSC":
	  $appstream = "B.Sc. Honours";
	  break;
	case "BBA":
	  $appstream = "B.B.A.";
	  break;
	case "BAM":
	  $appstream = "B.A. Major";
	  break;
	case "BCOM":
	  $appstream = "B.Com. Honours";
	  break;
	case "BAGEN":
	  $appstream = "B.A. General";
	  break;
	 
	case "BSCGEN":
	  $appstream = "B.Sc. General";
	  break;
	  
	case "BCOMGEN":
	  $appstream = "B.Com. General";
	  
	}
		
 return $appstream;
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
	  case "BBA":
	  $appstream = "B.B.A.";
	  break;
	case "BAM":
	  $appstream = "B.A. Major";
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

function subForDisplay($stream,$applsubject)
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


function  displaySemester($sem)
{
$semName = "";
	switch ($sem)
	{
	case "I":
	  $semName = "1st";
	  break;
	case "II":
	  $semName = "2nd";
	  break;
	case "III":
	  $semName = "3rd";
	  break;
	case "IV":
	  $semName = "4th";
	  break;
	case "V":
	  $semName = "5th";
	  break;
	case "VI":
	  $semName = "6th";
	  break;
	   
	}
		
 return $semName;
} 
 
function amountinword($amount) {
$number = $amount;
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? '' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  return "Rupees ".$result . " " . $points . " Only";
  }	
  
  
function moneyFormatIndia($num){

$explrestunits = "" ;
$num=preg_replace('/,+/', '', $num);
$words = explode(".", $num);
$des="00";
if(count($words)<=2){
    $num=$words[0];
    if(count($words)>=2){$des=$words[1];}
    if(strlen($des)<2){$des="$des0";}else{$des=substr($des,0,2);}
}
if(strlen($num)>3){
    $lastthree = substr($num, strlen($num)-3, strlen($num));
    $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
    $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
    $expunit = str_split($restunits, 2);
    for($i=0; $i<sizeof($expunit); $i++){
        // creates each of the 2's group and adds a comma to the end
        if($i==0)
        {
            $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
        }else{
            $explrestunits .= $expunit[$i].",";
        }
    }
    $thecash = $explrestunits.$lastthree;
} else {
    $thecash = $num;
}
//return "$thecash.$des"; // writes the final format where $currency is the currency symbol.
return "$thecash"; // writes the final format where $currency is the currency symbol.
}

?>

