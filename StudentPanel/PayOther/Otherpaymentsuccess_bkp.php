<?php
include("../../connection.php");
include("../function.php");
include("../../configuration.php");
 
 

         $msg=$_POST['msg'];
		 
	  
	 
 //VIDYAEVECO|BA190005|VHMP9870224691|NA|1500.00|HMP|NA|NA|INR|DIRECT|NA|NA|22.50|30-03-2021 15:56:35|0399|NA|SUPRATIM MANDAL|English|ADMFEE|II|2020-2021|NA|NA|NA|Canceled By User|1671EE6E0F01D966ADD6635FC84CA07B3523C9C26F99EB86040294D222FE1766
 
 
   
$isValid=1;
$shapp=0;
$statusCode="";


if($msg!="")

{
$splitdata = explode('|', $msg);

$common_string= CHECKSUMKEY;  // checksum key provided by BillDesk

$code = substr(strrchr($msg, "|"), 1); //Last check sum value

$string_new=str_replace("|".$code,"",$msg);//string replace : with empy space

$checksum = strtoupper(hash_hmac('sha256',$string_new,$common_string, false));// calculated  check sum


$statusCode= $splitdata[14];
$statusdescription=  $splitdata[24];
$transactionno = $splitdata[2];
$transAmount = $splitdata[4];
$transactionDate= $splitdata[13];
$rollno =  $splitdata[1] ;
$semesterval =  $splitdata[19] ;
$dept =  $splitdata[17] ;
$FeeCode = $splitdata[18];
$academicsesssion =  $splitdata[20] ;
$presentsemester =  $splitdata[21] ;
$paydetailid =  $splitdata[22] ;

$sqlUpdate= "";

if($checksum==$code) // success trans condition
{
// Here success txn data base save code
$isValid=1;
	if($splitdata[14]=="0300") {
		$sqlUpdate="update studentPaymentDetail set statuscode='".$statusCode."', onlineTransactionID = '".$transactionno."' , statusdescription='".$statusdescription."',onlineTransactionDate = '".$transactionDate."' ,onlineTransactionAmount = '".$transAmount."',paymentdate='".date('d-m-Y')."',Paid='Y' where id=".$paydetailid.";";
		
		$sqlUpdate .="INSERT INTO transaction_history (".$paydetailid.",FeeCode,rollno,onlineTransactionID, onlineTransactionDate,paymentdate,statuscode,statusdescription,onlineTransactionAmount,Paidstatus) VALUES('".$FeeCode."','".$rollno."','".$transactionno."','".$transactionDate."', '".date('d-m-Y')."','".$statusCode."','".$statusdescription."','".$transAmount."','Y');";
	}
	else {
		$sqlUpdate="update studentPaymentDetail set statuscode='".$statusCode."', onlineTransactionID = '".$transactionno."' , statusdescription='".$statusdescription."',onlineTransactionDate = '".$transactionDate."' ,onlineTransactionAmount = '".$transAmount."'  where id=".$paydetailid.";";
		
		$sqlUpdate .="INSERT INTO transaction_history (payDetailId,FeeCode,rollno,onlineTransactionID, onlineTransactionDate, statuscode,statusdescription,onlineTransactionAmount,Paidstatus) VALUES(".$paydetailid.",'".$FeeCode."','".$rollno."','".$transactionno."','".$transactionDate."', '".$statusCode."','".$statusdescription."','".$transAmount."','');";
	
	}
	
	  //die($sqlUpdate);
	 
$qryresult = $dbConn->query($sqlUpdate);

}
 else {
	$isValid=0;
}

}	

	 
 $studrecord  = array();

 
 
  $qry	=	"select spd.RollNo,onlineTransactionID,onlineTransactionDate, statusdescription,onlineTransactionAmount,st.name,st.collegeRollNo,  semester,admissionToSemester,spd.applcntMobNo,spd.applcntEmail,spd.semester,admissionToSemester,ccm.subjectName as department,isnull(spd.Paid,'') as Paid,spd.statuscode from studentPaymentDetail spd JOIN studentmaster st ON st.collegeRollno=spd.collegeRollNo JOIN College_CourseMaster ccm ON ccm.subjectcode=st.appsubjectcode where  spd.id=".$paydetailid."  ;";
 
 
$qryresult1 = $dbConn->query($qry);

if($qryresult1) {
 	while($row=$qryresult1->fetch(PDO::FETCH_ASSOC))
	{
		$studrecord[] = $row;
	}
 }
  
$onlineTransactionDate=$studrecord[0]["onlineTransactionDate"];
$onlineTransactionID =$studrecord[0]["onlineTransactionID"];
$statuscode = $studrecord[0]["statuscode"];
$paidstatus  =$studrecord[0]["Paid"];
$transactionamount = $studrecord[0]["onlineTransactionAmount"];
 
  
$semester = $studrecord[0]["admissionToSemester"];
  
 
	
?>

<form id="frmprint" name="frmprint" action="../print_paymentreciept.php" method="post">
	<input type="hidden" id="txtrollno" name="txtrollno" value="<?php echo $rollno;?>" />
	<input type="hidden" id="txtpaydetailid" name="txtpaydetailid" value="<?php echo $paydetailid;?>" />
	 
</form>

<script src="<?php echo BASE_URL_HOME;?>/bootstrap/js/jquery3.4.1.min.js"></script>
<script>


 $("#frmprint").submit();

</script>




