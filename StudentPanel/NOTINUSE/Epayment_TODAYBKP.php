<?php
ob_start();
include("connection.php");
include("function.php");
include("configuration.php");
 
$statusarr = array();

$logString="";
$sqldb=mssql_select_db($dbname,$sqlconnect) or die("Couldn't open database");

  $rollno =  $_POST["hdnrollno"] ;
  $dept = $_POST["hdndept"];
  $semester = $_POST["hdnsemester"];


$fetchqry = "SELECT phase,lastDate,phaseStatus,case when phaseStatus='ON' and convert(varchar ,'".date('Y-m-d H:i' )."',120) Between convert(varchar, phaseStatusStartDate, 120) and convert(varchar, phaseStatusLastDate, 120) then 'allow' else 'notallow' end as  retrievestatus,convert(varchar, updateLastdate, 120) as updateLastdate FROM  PhaseStatus  ;";



$fetchresult = mssql_query($fetchqry);

if($fetchresult) {
	$fetchrow=mssql_fetch_array($fetchresult,$type);
} 
  if($fetchrow["retrievestatus"]=='allow') { 

$qry	=	"select * from studentmaster where ltrim(rtrim(session))='".ACADEMIC_SESSION."' and department='".$dept."' and semester='".$semester."' and RollNo='".$rollno."' and  studentStatus=1;";
 
$qryresult = mssql_query($qry);

if($qryresult) {
 	while($row=mssql_fetch_array($qryresult,$type))
	{
		$studrecord[] = $row;
	}
 }

$feeqry =" select * from FeeStructure where FeeCode='".$studrecord[0]["FeeCode"]."' and semester='".$studrecord[0]["admissionToSemester"]."';";

  
$feeresult = mssql_query($feeqry);

if($feeresult) {
	while ($feerow=mssql_fetch_array($feeresult,$type)) {
					$feerecord[] = $feerow;
					//$feesarr[] =  $feerow["FeeAmount"];
			}
}

 

$str =BILLERID.'|'.$rollno.'|NA|'.$feerecord[0]["FeeAmount"].'|NA|NA|NA|INR|NA|R|'.SECURITYID.'|NA|NA|F|'.$studrecord[0]["name"].'|'.$studrecord[0]["department"].'|'.$studrecord[0]["FeeCode"].'|'.$studrecord[0]["admissionToSemester"].'|'.ACADEMIC_SESSION.'|NA|NA|'.BASE_URL.'/paymentsuccess.php';

$checksum = hash_hmac('sha256',$str,CHECKSUMKEY, false); 
$checksum = strtoupper($checksum);


  $finalurl="https://pgi.billdesk.com/pgidsk/PGIMerchantPayment?msg=".$str."|".$checksum;
 
?>

<form name="frmbilldesk" action="" method="">

</form>
<script type="text/javascript">

 document.frmbilldesk.action="<?php echo $finalurl;?>"
 document.frmbilldesk.method="post"
document.frmbilldesk.submit()
</script>
<?php }  else {?>
<div style="text-align:center; padding:75px 0; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#FF0000; text-transform:uppercase; line-height:30px; background:#FFFFFF">
	 <img src="alert.gif" /><br />
	Fee Payment Link is Presently Not Active.
	</div>
	<?php }?>
