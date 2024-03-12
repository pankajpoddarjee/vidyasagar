<?php
 include("../../../connection.php");
 include("../../function.php");
 include("../../../configuration.php");

$cnt = 0;
  
$arr = array();
$val = array();
 
 
$paydetailid = $_POST["hdnpaydetailid"];
$mobileno = $_POST["txtmobile"];
$email = $_POST["txtemail"];

  
 $qry	= "UPDATE studentPaymentDetail SET  applcntMobNo='".$mobileno."', applcntEmail='".$email."' where id=".$paydetailid.";"; 
  
 $qryresult = $dbConn2->query($qry);

	if($qryresult) {
		 $arr["status"]=1;
		$arr["msg"]="";	 
	 }
	 else {
			$arr["status"]=0;
			$arr["msg"]="Try Again.";  
		}

echo json_encode($arr);

?>