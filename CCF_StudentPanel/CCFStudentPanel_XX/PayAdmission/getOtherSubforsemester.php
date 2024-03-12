<?php
include("../../../connection.php");
include("../../../configuration.php");
  

  $collegerollno =  $_POST["collegerollno"];
  $tobeAdmitSem =   $_POST["tobeAdmitSem"];
  
  $header = array();
  
    $headerqry  ="select   msc.CoreCourse1,	msc.CoreCourse2,msc.CoreCourse3,	msc.generalCourse,msc.LCC,msc.DSE1,msc.DSE2,msc.DSE3,msc.AECC,msc.SEC from studentSemesterCourse ssc JOIN Master_SemesterCourse msc ON msc.stream=ssc.stream and msc.semester=ssc.semester where ssc.semester='".$tobeAdmitSem."' and collegeRollno='".$collegerollno."';";
 
 $headerresult = $dbConn2->query($headerqry);

	if($headerresult) {
		while ($headerrow=$headerresult->fetch(PDO::FETCH_ASSOC)){
						
						$header = $headerrow;				 
				}
	}
	
	 
	$record =array(); 		

  $recordqry  ="select  collegeRollno,semester,stream,subject,subjectcode,	isnull(CoreCourse1,'') as CoreCourse1,	isnull(CoreCourse2,'') CoreCourse2,	isnull(CoreCourse3,'') as CoreCourse3,	isnull(generalCourse,'') as generalCourse,isnull(LCC,'') as LCC,isnull(DSE1,'') as DSE1,isnull(DSE2,'') as DSE2, isnull(DSE3,'') as DSE3,isnull(AECC,'') as AECC,isnull(SEC,'') as SEC from studentSemesterCourse where semester='".$tobeAdmitSem."' and collegeRollno='".$collegerollno."'";
 
	$result = $dbConn2->query($recordqry);

	if($result) {
		while ($row=$result->fetch(PDO::FETCH_ASSOC)){
						
						$record[]  = $row;				 
				}
	}

	$headerresult =NULL;
	$result =NULL;
	
	
	
	
	$secArr =  array();
	$tempsecArr =array();
	
	    if($record[0]["stream"]=='BAGEN' && $tobeAdmitSem=='III'){
		$tempsecArr = array($record[0]["CoreCourse1"],$record[0]["CoreCourse2"]);	
		
		
		$secArr =  array_values(array_intersect($tempsecArr,$BAGENarrlistSem3)) ;	
		}  
	  else if($record[0]["stream"]=='BSCGEN'){
		if($tobeAdmitSem=='III'){
		$tempsecArr = array($record[0]["CoreCourse1"],$record[0]["CoreCourse2"],$record[0]["CoreCourse3"]);	
		$secArr =  array_values(array_intersect($tempsecArr,$BSCGENarrlistSem3)) ;			
		}
		else if ($tobeAdmitSem=='V') {
		  $SECqry = "SELECT CoreCourse1,CoreCourse2,CoreCourse3,SEC FROM studentSemesterCourse WHERE collegeRollno='".$collegerollno."' and semester='III';";	
		$SECresult = $dbConn2->query($SECqry);

		if($SECresult) {
			$SECrow[]=$SECresult->fetch(PDO::FETCH_ASSOC);			
			  			 
					
		}
		
		 	
		$allsecArr = array($SECrow[0]["CoreCourse1"],$SECrow[0]["CoreCourse2"],$SECrow[0]["CoreCourse3"]);

		 $secArr = array_values(array_diff($allsecArr,array($SECrow[0]["SEC"])));
		}
	}
	
	/* echo "<pre>";
	print_r($header);
	
	print_r($record);
	print_r($secArr);
		
	exit; */
     
	$dbConn2 =NULL; 
	 
	$str="";
	
	$str .= '<p class="font-weight-bold mt-1 text-danger">Semester Course Details</p>';
	$str .= '<table class="table table-bordered table-hover font-weight-normal text-center">';
	$str .= '<thead>';
	$str .= '<tr class="bg-light font-weight-bold text-nowrap align-middle">';
	$str .= '<td class="align-middle">Semester</td>';
	 foreach($header as $headkey=>$headerval){
		 if(trim($header[$headkey])!='') {
		$str .= '<td class="align-middle">'.$header[$headkey].'</td>';
		 }
	 }
	$str .= '</tr>';
	$str .= '<tr class="text-nowrap">';
	$str .= '<td class="align-middle">'.$tobeAdmitSem.'</td>';
	
	 foreach($header as $headkey=>$headerval){
	if(trim($header[$headkey])!=''){
	if($headkey!='SEC'){	
		$str .= '<td class="align-middle">'.$record[0][$headkey].'</td>';
	} 
	 if($headkey=='SEC'){	
		$str .= '<td class="align-middle">';
	if(count($secArr)>0) {
		$str .= '<select id="choSEC" name="choSEC" class="form-control">';
		$str .= '<option value="">Select</option>';
			for($i=0; $i<count($secArr); $i++) {
				 $str .= '<option value="'.$secArr[$i].'" '.($secArr[$i]==$record[0]["SEC"]? "Selected":"").'>'.$secArr[$i].'</option>';
				 
			}
	}
	else {
	$str .=	$record[0]["SEC"];
	}
		$str .= '</select>';
		$str .= '</td>';
		}
	}
	 }	
 	$str .= '</tr>'	;
	$str .= '</table>';		
	
	 
	
echo $str;


?>
