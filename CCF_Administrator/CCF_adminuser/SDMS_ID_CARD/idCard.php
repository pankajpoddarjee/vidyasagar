<?php
include("../../../connection_CCF.php");
include("../../function.php");
include("../../../configuration_CCF.php");
 
 $recordarr = array();
 $arr = array();
 
 $printoption = $_POST["hdnprintoption"];
	$session = $_POST["chosession"];
	$semester = $_POST["chosemester"]; 
	
 if($printoption == 'Individual') {
	 
	$collegeRollNo = $_POST["txtCollegeRollNo"];
   
   
	    if($semester=='I') {
	  $query = "select ss.session as idcardsession,appliedsession,st.collegeRollNo,ss.semester as idcardsemester,st.applicationNo, name,appstream,appsubject,appsubjectcode,guardianName,st.applcntMobNo,bloodGroup,
dd,mm,yy, UPPER(localAddr)+', P.O-'+ UPPER(localPO)+', P.S-'+UPPER(localPS)+', City-'+UPPER(localCity)+', Dist-'+UPPER(localDistrict) as presentAddress,
localPin as presentPin, photo from studentmaster st JOIN studentSession ss on ss.collegeRollNo=st.collegeRollno
WHERE st.collegeRollNo='".$collegeRollNo."' and  ss.session='".$session."' and ss.semester='".$semester."';";
		}
		else {
		$query = "select session as idcardsession,appliedsession,st.collegeRollNo,st.applicationNo, name,appstream,sp.admissionToSemester as idcardsemester,appsubject,appsubjectcode,guardianName,st.applcntMobNo,bloodGroup, dd,mm,yy, UPPER(localAddr)+', P.O-'+ UPPER(localPO)+', P.S-'+UPPER(localPS)+', City-'+UPPER(localCity)+', Dist-'+UPPER(localDistrict) as presentAddress, localPin as presentPin, photo from studentmaster st JOIN studentPaymentDetail sp ON st.collegeRollno=sp.collegeRollNo WHERE st.collegeRollno='".$collegeRollNo."' and sp.admissionToSemester='".$semester."' and session='".$session."' and isnull(sp.Paid,'')='Y'  and FeeCode='ADMFEE';";	
		}
		 
 }
 else if($printoption == 'BySubject') {
		
		  $searchstr = " WHERE st.collegeRollno=st.collegeRollno";
  
	   if($_POST["chosubject"]!='All'){
		 $searchstr .= " and st.appsubjectcode='".$_POST["chosubject"]."'";
		 }
		  if($semester=='I') {
			$query = "select ss.session as idcardsession,appliedsession,st.collegeRollNo,ss.semester as idcardsemester,st.applicationNo, name,appstream,appsubject,appsubjectcode,guardianName,st.applcntMobNo,bloodGroup,
dd,mm,yy, UPPER(localAddr)+', P.O-'+ UPPER(localPO)+', P.S-'+UPPER(localPS)+', City-'+UPPER(localCity)+', Dist-'+UPPER(localDistrict) as presentAddress,localPin as presentPin, photo from studentmaster st JOIN studentSession ss on ss.collegeRollNo=st.collegeRollno ".$searchstr." and ss.session='".$session."' and ss.semester='".$semester."' ORDER BY appstream asc,appsubjectcode,st.collegeRollNo asc, photo asc ;";	
		  }
		  else {
			 $query = "select session as idcardsession,appliedsession,st.collegeRollNo,st.applicationNo, name,appstream,sp.admissionToSemester as idcardsemester,appsubject,appsubjectcode,guardianName,st.applcntMobNo,bloodGroup, dd,mm,yy, UPPER(localAddr)+', P.O-'+ UPPER(localPO)+', P.S-'+UPPER(localPS)+', City-'+UPPER(localCity)+', Dist-'+UPPER(localDistrict) as presentAddress, localPin as presentPin, photo from studentmaster st JOIN studentPaymentDetail sp ON st.collegeRollno=sp.collegeRollNo ".$searchstr." and sp.admissionToSemester='".$semester."' and session='".$session."' and isnull(sp.Paid,'')='Y' and FeeCode='ADMFEE' ORDER BY appstream asc,appsubjectcode,collegeRollNo asc, photo asc ;"; 
		  }
 
 }
  // die($query);
	$qryresult = $dbConn->query($query);
	
	if($qryresult) {
		while($row=$qryresult->fetch(PDO::FETCH_ASSOC)){
		 $recordarr[]=$row;
		 }
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print ID Card</title>

<link rel="stylesheet" type="text/css" href="id_css.css?ver=3.0" media="print, screen" />
</head>

<body>
<?php for($i=0; $i<count($recordarr); $i++){?>

<table border="0" cellspacing="0" cellpadding="0" class="tbl" align="center" style="margin:auto">
  <tr class="bg">
    <td colspan="2" style="padding:0" valign="top">
        <table border="0" cellspacing="0" cellpadding="0" align="center">
            <tr style="background:#243b7f; color:#FFF">
            	<td width="42" rowspan="3"><img src="VMC_LOGO.jpg" width="32" /></td>
            	<td width="261" style="text-align:center; text-transform:uppercase; font-size:13px; font-weight:bold; padding:0; margin:0">
            		Vidyasagar Metropolitan College
            	</td>
            </tr>
            <tr style="background:#243b7f; color:#FFF">
            	<td style="text-align:center; font-size:10px; text-transform:uppercase; padding:0">39, Sankar Ghosh Lane, Kolkata - 700006</td>
            </tr>
            <tr style="background:#243b7f; color:#FFF">
            	<td style="text-align:center; font-size:10px; padding:0">Phone: 91 6289197462<!-- / 9433153678 9433236475--></td>
            </tr>
        </table>
    </td>
  </tr>
  <tr>
    <td style="padding:2px 0 0 0" valign="top" align="center">
        <img src="<?php echo BASE_URL;?>/Upload_Images/<?php echo $recordarr[$i]["appliedsession"];?>/Photograph/<?php echo $recordarr[$i]["photo"];?>" width="55" height="65" style="border:1px solid #000" />
        <div style="text-align:center; margin-top:5px">
            <img src="Principal_VMC.png" width="55" /><br />
            <strong><!--TIC--> Principal</strong><br />
            <img src="barcode.php?text=<?php echo $recordarr[$i]["collegeRollNo"];?>" width="55" height="23" style="margin-top:5px" />
        </div>
    </td>
    <td style="padding:3px 0 0 3px" valign="top">
   	  	<!--<div style="text-transform:uppercase; font-weight:bold; text-align:center; color:#c00; font-size:10px"><strong>Student Identification Card - <?php echo CURRENTSESSION;?></strong></div>-->
        <div style="text-transform:uppercase; font-weight:bold; text-align:center; color:#c00; font-size:10px"><strong><?php echo displaySemester($recordarr[$i]["idcardsemester"]);?> Semester (<?php echo $recordarr[$i]["idcardsession"];?>)</strong></div>
        <table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" style="text-align:left">
        <tr>
        <td>Name: <strong><?php echo $recordarr[$i]["name"]?></strong></td>
        </tr>
        <tr>
          <td>Roll No: <strong><?php echo  $recordarr[$i]["collegeRollNo"];?></strong></td>
        </tr>
        <tr>
        <td>Guardian's Name: <strong><?php echo $recordarr[$i]["guardianName"]?></strong></td>
        </tr>
        <tr>
        <td>Contact No.: <strong><?php echo $recordarr[$i]["applcntMobNo"];?></strong></td>
        </tr>
        <tr>
        <td>
        	<!--<table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">
            <tr>
            <td valign="top">Address:</td>
            <td><strong><?php echo $recordarr[$i]["presentAddress"].', '.$recordarr[$i]["presentPin"];?></strong></td>
            </tr>
            </table>-->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">            
            <tr>
            <td>
            <div style="line-height:12px; overflow:hidden; height:50px">
            Address: <strong style="font-size:10px; text-transform:uppercase"><?php echo $recordarr[$i]["presentAddress"].', '.$recordarr[$i]["presentPin"];?></strong></div>
            </td>
            </tr>
            </table>

        </td>
        </tr>
        <tr>
        	<td>
        	<table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">
            <tr>
              <td width="45%">D.O.B.: <strong><?php echo str_pad($recordarr[$i]["dd"], 2, 0, STR_PAD_LEFT).'/'.str_pad($recordarr[$i]["mm"], 2, 0, STR_PAD_LEFT).'/'.$recordarr[$i]["yy"]?></strong></td>
              <td width="55%">Blood Group: <strong style="color:#F00"><?php echo $recordarr[$i]["bloodGroup"];?></strong></td>
            </tr>
            </table>
        </td>
        </tr>
        </table>
    </td>
  </tr>
  <tr class="bg">
  	<td colspan="2">
        <table width="100%" border="0" cellspacing="0" cellpadding="2" style="font-size:9px">
        <tr>
        <td>www.vec.ac.in</td>
    	<td align="right">vidyasagar.metropolitancollege@yahoo.in</td>
        </tr>
        </table>
    </td>
  </tr>
</table>

<?php }?>
</body>
</html>
