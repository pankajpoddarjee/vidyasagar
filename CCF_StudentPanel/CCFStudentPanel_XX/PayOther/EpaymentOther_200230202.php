<?php
include("../sessionConfig.php");
include("../../connection.php");
include("../function.php");
include("../../configuration.php");
 
$statusarr = array();

$logString="";

  $rollno =  $_POST["hdnrollno"] ;
  $dept = $_POST["hdndept"];
  $semester = $_POST["hdnsemester"];
$payDetailid = $_POST["hdnpaydetailid"];

$fetchqry = "SELECT phase,lastDate,phaseStatus,case when phaseStatus='ON' and convert(varchar ,'".date('Y-m-d H:i' )."',120) Between convert(varchar, phaseStatusStartDate, 120) and convert(varchar, phaseStatusLastDate, 120) then 'allow' else 'notallow' end as  retrievestatus,convert(varchar, updateLastdate, 120) as updateLastdate FROM  PhaseStatus  ;";



$fetchresult = $dbConn->query($fetchqry);

if($fetchresult) {
	$fetchrow=$fetchresult->fetch(PDO::FETCH_ASSOC);
} 
  if($fetchrow["retrievestatus"]=='allow') { 

 $qry	=	"select st.name,spd.*,  ccm.subjectcode as department  from studentPaymentDetail spd JOIN studentmaster st ON st.collegeRollno=spd.collegeRollNo  JOIN College_CourseMaster ccm ON ccm.subjectcode=st.appsubjectcode where spd.id=".$payDetailid."  and studentStatusforPay=1;";
 
$qryresult = $dbConn->query($qry);

if($qryresult) {
 	while($row=$qryresult->fetch(PDO::FETCH_ASSOC))
	{
		$studrecord[] = $row;
	}
 }

 $feeqry ="select * from College_FeeStructureMaster where  sesssionYear='".$studrecord[0]["session"]."' and feeCode='".$studrecord[0]["FeeCode"]."' and semester='".$studrecord[0]["semester"]."' and feeGroup='Total';";

  
$feeresult = $dbConn->query($feeqry);

if($feeresult) {
	while ($feerow=$feeresult->fetch(PDO::FETCH_ASSOC)) {
					$feerecord[] = $feerow;
				 
			}
}

 

  $str =BILLERID.'|'.$rollno.'|'.$studrecord[0]["id"].'|'.$feerecord[0]["FeeAmount"].'|NA|NA|NA|INR|NA|R|'.SECURITYID.'|NA|NA|F|'.$studrecord[0]["name"].'|'.$studrecord[0]["department"].'|'.$studrecord[0]["FeeCode"].'|NA|'.$studrecord[0]["session"].'|'.$semester.'|'.$studrecord[0]["id"].'|'.BASE_URL_STUDENT.'/PayOther/Otherpaymentsuccess.php';
   

 
 
//$str =$_POST["txtbilldeskulr"];
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
<?php include("../head_includes.php");?>
<div class="row" style="margin-top:18vh">
    <div class="col-md-12 text-center font-weight-bold">
        <i class="fa fa-exclamation-triangle text-danger" style="font-size:40px"></i><br>
        Fee Payment link is presently not active.
    </div>
</div>
<?php include("../footer_includes.php");?>
	<?php }?>
 