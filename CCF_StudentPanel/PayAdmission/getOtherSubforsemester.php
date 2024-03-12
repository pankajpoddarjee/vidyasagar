<?php
include("../../connection_CCF.php");
include("../../configuration_CCF.php");
  
$arr =array();
  $collegerollno =  $_POST["collegerollno"];
  $tobeAdmitSem =   $_POST["tobeAdmitSem"];
  
  $header = array();
  
    $headerqry  ="select   msc.CoreCourse1,	msc.CoreCourse2,msc.CoreCourse3,msc.CoreCourse4,	isnull(msc.minorCourse1,'') as minorCourse1,isnull(msc.minorCourse2,'') as minorCourse2, isnull(msc.IDC,'') as IDC,isnull(msc.AECC,'') as AECC,isnull(msc.SEC,'') as SEC,isnull(msc.CVAC1,'') as CVAC1, isnull(msc.CVAC2,'') as CVAC2,isnull(msc.Internship,'') as Internship from studentSemesterCourse ssc JOIN Master_SemesterCourse msc ON msc.stream=ssc.stream and msc.semester=ssc.semester where ssc.semester='".$tobeAdmitSem."' and collegeRollno='".$collegerollno."';";
 
 $headerresult = $dbConn->query($headerqry);

	if($headerresult) {
		while ($headerrow=$headerresult->fetch(PDO::FETCH_ASSOC)){
						 
						$header = $headerrow;				 
				}
	}
	
	 
	$record =array(); 		

  $recordqry  ="select collegeRollno,semester,appliedsession,stream,	subject,subjectcode,	isnull(CoreCourse1,'') as CoreCourse1,	isnull(CoreCourse2,'') CoreCourse2,	isnull(CoreCourse3,'') as CoreCourse3,isnull(CoreCourse4,'') as CoreCourse4,	isnull(minorCourse1,'') as minorCourse1,isnull(minorCourse2,'') as minorCourse2,isnull(IDC,'') as IDC,isnull(AECC,'') as AECC,isnull(SEC,'') as SEC,isnull(CVAC1,'') as CVAC1, isnull(CVAC2,'') as CVAC2,isnull(Internship,'') as Internship, isnull(Dissertation,'') as Dissertation, isnull(ResearchWork,'') as ResearchWork  from studentSemesterCourse where semester='".$tobeAdmitSem."' and collegeRollno='".$collegerollno."'";
 
	$result = $dbConn->query($recordqry);

	if($result) {
		while ($row=$result->fetch(PDO::FETCH_ASSOC)){
						
						$record[]  = $row;				 
				}
	}

	$headerresult =NULL;
	$result =NULL;
	
	 $internqry  ="SELECT  count(semester) as TakeInternship
  FROM studentSemesterCourse  where  collegeRollno='".$collegerollno."' and isnull(Internship,'')='Yes'";
  
  $internresult = $dbConn->query($internqry);

	if($internresult) {
		 $internrec= $internresult->fetch(PDO::FETCH_ASSOC);
		}
	 
	 
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
		$SECresult = $dbConn->query($SECqry);

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
     
	$dbConn =NULL; 
	 
	$str="";
	
	$str .= '<p class="font-weight-bold mt-1 text-danger">Semester Course Details</p>';
	$str .= '<table class="table table-bordered table-hover font-weight-normal text-center">';
	$str .= '<thead>';
	$str .= '<tr class="bg-light font-weight-bold text-nowrap align-middle">';
	$str .= '<td class="align-middle">Semester</td>';
	 foreach($header as $headkey=>$headerval){
		 if(trim($header[$headkey])!='' && $headkey!='Internship') {
			 
		$str .= '<td class="align-middle">'.$header[$headkey].'</td>';
		 }
	 }
	$str .= '</tr>';
	$str .= '<tr class="text-nowrap">';
	$str .= '<td class="align-middle">'.$tobeAdmitSem.'</td>';
	
	 foreach($header as $headkey=>$headerval){
	if(trim($header[$headkey])!=''  && $headkey!='Internship'){
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
	
	 
	$arr["str"]=$str;
	
	
	$arr["TakeInternship"]=$internrec["TakeInternship"]; 
	
	  if($header["Internship"]!='')
	$arr["reqInternship"]=1;
	else 
	$arr["reqInternship"]=0; 

echo json_encode($arr);


?>
