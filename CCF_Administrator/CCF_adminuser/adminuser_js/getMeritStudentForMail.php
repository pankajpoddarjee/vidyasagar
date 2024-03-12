<?php
include("../../connection.php");
include("../function.php");
include("../../configuration.php");

$cnt = 0;

$sqldb=mssql_select_db($dbname,$sqlconnect) or die("Couldn't open database");

 	
$record = array();

// $fetchqry = "SELECT phase,lastDate,phaseStatus,case when phaseStatus='ON' and convert(varchar ,'".date('Y-m-d H:i' )."',120) < convert(varchar, phaseStatusStartDate, 120) then 'allow' else 'notallow' end as  MLprintstatus,convert(varchar, updateLastdate, 120) as updateLastdate FROM MeritListPhase  ;";
 
   $fetchqry = "SELECT phase,lastDate,phaseStatus,case when phaseStatus='ON'  and convert(varchar ,'".date('Y-m-d H:i' )."',120) <= convert(varchar, phaseStatusLastDate, 120) then 'allow' else 'notallow' end as  MLprintstatus,convert(varchar, updateLastdate, 120) as updateLastdate FROM MeritListPhase  ;";

 
$fetchresult = mssql_query($fetchqry);

if($fetchresult) {
	$fetchrow=mssql_fetch_array($fetchresult,$type);
}

    if($fetchrow["MLprintstatus"]=='allow') { 

 $fetchallqry = "SELECT distinct mlr.applicationNo, name,applcntMobNo,applcntEmail,ap.appstream,ap.appsubjectcode ,
ap.appsubject,caste, stateofdomicile,isnull(GeneralRank,'') as GeneralRank,ISNULL(SCRank,'') as SCRank,
ISNULL(STRank,'') AS STRank,ISNULL(OBCARank,'') AS OBCARank,ISNULL(OBCBRank,'') AS OBCBRank,ISNULL(PHRank,'') 
AS PHRank,ISNULL(PH_GENRank,'') AS PH_GENRank,ISNULL(PH_SCRank,'') AS PH_SCRank,
ISNULL(PH_STRank,'') AS PH_STRank,ISNULL(PH_OBCARank,'') AS PH_OBCARank,ISNULL(PH_OBCBRank,'') AS PH_OBCBRank 
from MeritListValidity mlv 
JOIN MeritListRank mlr ON mlv.appphase=mlr.phase and mlv.appsection=mlr.section and 
mlv.appstream=mlr.stream and mlv.appsubjectcode=mlr.subjectcode 
 JOIN appmaster ap ON ap.applicationNo=mlr.applicationNo 
 JOIN studentmaster st on st.stid=ap.appno
 LEFT JOIN MeritListBankPayment mlp ON mlp.applicationNo=mlr.applicationNo
WHERE isnull(mlp.alloted,'')<>'Y' and ((mlr.GeneralRank between mlv.GeneralRankFrom and mlv.GeneralRankTo ) or 
(mlr.SCRank between mlv.SCRankFrom and mlv.SCRankTo ) or  
(mlr.STRank between mlv.STRankFrom and mlv.STRankTo ) or 
(mlr.OBCARank between mlv.OBCARankFrom and mlv.OBCARankTo ) or 
(mlr.OBCBRank between mlv.OBCBRankFrom and mlv.OBCBRankTo ) or 
(mlr.PH_GENRank between mlv.PH_GENRankFrom and mlv.PH_GENRankTo ) or 
(mlr.PH_STRank between mlv.PH_STRankfrom and mlv.PH_STRankTo ) or 
(mlr.PH_SCRank between mlv.PH_SCRankfrom and mlv.PH_SCRankTo ) or 
(mlr.PH_OBCARank between mlv.PH_OBCARankfrom and mlv.PH_OBCARankTo ) or 
(mlr.PH_OBCBRank between mlv.PH_OBCBRankfrom and mlv.PH_OBCBRankTo ) )";


		if($_POST["chophase"]!="All" ){
 		$fetchallqry=$fetchallqry. "  and mlr.phase='".$_POST["chophase"]."' ";
 		}
		if($_POST["chosection"]!="All" ){
 		$fetchallqry=$fetchallqry. "  and mlr.section='".$_POST["chosection"]."' ";
 		}

		if($_POST["chostream"]!="All" ){
 		$fetchallqry=$fetchallqry. "  and mlr.stream='".$_POST["chostream"]."' ";
 		}	
		if($_POST["chosubject"]!="All" ){
 		$fetchallqry=$fetchallqry . "  and mlr.subjectcode='".$_POST["chosubject"]."' ";
 		}	

	  if($_POST["choCategory"]!="All" ){
 		$fetchallqry=$fetchallqry . " and caste='".$_POST["choCategory"]."' ";
 	}		
		// die($fetchallqry);
		
			$qryresult = mssql_query($fetchallqry);
	
if($qryresult) {
	while($row=mssql_fetch_array($qryresult,$type)) {
				$record[] = $row;
			}
}

$fromDate = $_POST["fromDate"];
$toDate  = $_POST["toDate"];

	echo	$mailsentcntQry = "SELECT mlr.applicationNo,case WHEN convert(varchar, sendingDate ,103)>=convert(varchar, '".$fromDate."',103) and convert(varchar, sendingDate ,103)<=convert(varchar, '".$toDate."',103) then count(msl.applicationNo) else SUM(0) end as sentmailcount from MeritListValidity mlv JOIN MeritListRank mlr LEFT JOIN MailSendlist msl ON msl.applicationNo=mlr.applicationNo ON mlv.appstream=mlr.stream and mlv.appsubjectcode=mlr.subjectcode  JOIN studentmaster st on st.stid=mlr.appno  JOIN appmaster ap ON ap.applicationNo=mlr.applicationNo  group by mlr.applicationNo,sendingDate ORDER BY mlr.applicationNo; ";
		
		$mailsentresult = mssql_query($mailsentcntQry);
	
if($mailsentresult) {
	while($mailsentrow=mssql_fetch_array($mailsentresult,$type)) {
				$mailsentrecord[$mailsentrow["applicationNo"]] = $mailsentrow["sentmailcount"];
			}
}

		 $status = 1;


			$str.='<div style="font-family:Abel, sans-serif; font-size:25px; color:#cc0000; padding:0 0 7px 0; margin:25px 0 10px 0;text-align:center">';
			$str.='Total Application(s): '.count($record);
			$str.='</div>';

			$str.='<div style="font-family:Abel, sans-serif; font-size:25px; color:#cc0000; padding:0 0 7px 0; margin:25px 0 10px 0;text-align:center">';
				$str .= "<input type='checkbox'  name='chkAll' onclick='checkall(this)' />Select All ";			
				$str.='</div>';
			$str.='<table class="table-striped" width="100%" border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="7" align="center" style="text-align: center; font-size:14px; border-collapse:collapse; font-weight:normal">';
			$str.='<tr style="text-align:center; text-transform:uppercase; font-family:Abel, sans-serif; font-size:16px; background:#e1e1e1; color:#cc0000">';
			$str .= "<td>&nbsp;</td>";
			$str.='<td>Sr. No.</td>';
			$str.='<td>Application No.</td>';
			$str.='<td>Name</td>';
			$str.='<td>Applied Category</td>'; 
			$str.='<td>Domicile</td>';
			$str.='<td>Shift</td>';
			$str.='<td>Honours</td>';
			$str.='<td>Stream</td>';
			$str.='<td>Email</td>';
			$str.='<td>Mobile</td>';
			$str.='<td>Mail sent count</td>';
			$str.='<td>&nbsp;</td>';
/*			$str.='<td>General Rank</td>';
			$str.='<td>SC Rank</td>';
			$str.='<td>ST Rank</td>';
			$str.='<td>OBC-A Rank</td>';
			$str.='<td>OBC-B Rank</td>';*/
// ================   PH STARTS =================
/*			$str.='<td>PH Rank</td>';
			$str.='<td>PH (General) Rank</td>';
			$str.='<td>PH (SC) Rank</td>';
			$str.='<td>PH (ST) Rank</td>';
			$str.='<td>PH (OBC-A) Rank</td>';
			$str.='<td>PH (OBC-B) Rank</td>';*/
// ================   PH ENDS =================

			$str.='</tr>';
            
			for ($i=0;$i< count($record); $i++){
			if($mailsentrecord[$record[$i]["applicationNo"]]>0)
			$trcolor = "#00CCCC";
			else
			$trcolor =  "";
 			$str.='<tr style="background-color:'.$trcolor.'">';
			$str .= "<td><input type='checkbox' name='chkApplication' class='chksendMail' value=".$record[$i]["applicationNo"]." /></td>";
			$str.='<td>'.($i+1).'</td>';
			$str.='<td>'.$record[$i]["applicationNo"].'</td>';
			$str.='<td>'.$record[$i]["name"].'</td>';
			$str.='<td>'.$record[$i]["caste"].'</td>';
			$str.='<td>'.$record[$i]["stateofdomicile"].'</td>';
			$str.='<td>'.$record[$i]["appsubject"].'</td>';
			$str.='<td>'.$record[$i]["appsubject"].'</td>';
			$str.='<td>'.$record[$i]["appstream"].'</td>';
			$str.='<td>'.$record[$i]["applcntEmail"].'</td>';
			$str.='<td>'.$record[$i]["applcntMobNo"].'</td>';
			/*$str.='<td>'.$record[$i]["GeneralRank"].'</td>';
			$str.='<td>'.$record[$i]["SCRank"].'</td>';
			$str.='<td>'.$record[$i]["STRank"].'</td>';
			$str.='<td>'.$record[$i]["OBCARank"].'</td>';
			$str.='<td>'.$record[$i]["OBCBRank"].'</td>';*/
// ================   PH STARTS =================
			/*$str.='<td>'.$record[$i]["PHRank"].'</td>';
			$str.='<td>'.$record[$i]["PH_GENRank"].'</td>';
			$str.='<td>'.$record[$i]["PH_SCRank"].'</td>';
			$str.='<td>'.$record[$i]["PH_STRank"].'</td>';
			$str.='<td>'.$record[$i]["PH_OBCARank"].'</td>';
			$str.='<td>'.$record[$i]["PH_OBCBRank"].'</td>';*/
// ================   PH ENDS =================
			$str.='<td>'.$mailsentrecord[$record[$i]["applicationNo"]].'</td>';
			$functioname = "sendMailtoIndividual('".$record[$i]["applicationNo"]."')";
			
			$str.='<td><input type="button" id="btnsendmail_'.$i.'" name="btnsendmail_'.$i.'" onclick='.$functioname.' value="Send Mail" /> </td>';
			$str.='</tr>';
			} 
			$str.='</table>';
 
		}
		else
		{
		$status = 0;
		$str = "The Pay Admission Fee / Print Admission Challan Link is presently Not Active.<br />This link will be Active Only During the Time Stipulated in The Admission Schedule.<br />Please visit later.<br />";
		}
		$arr["str"]=$str;
		$arr["status"]=$status;
echo json_encode($arr);


?>