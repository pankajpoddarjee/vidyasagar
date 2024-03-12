<?php
include("../connection.php");
include("function.php");
include("../configuration.php");
  
//$rollno =  $_POST["txtrollno"] ;
$paydetailid=   $_POST["txtpaydetailid"] ;
/* $dept =  $_POST["txtdept"] ;
$semesterval =  $_POST["txtadmitsem"] ;
$FeeCode = $_POST["txtfeeCode"]; */

 
 $studrecord  = array();


  $qry="select spd.RollNo,st.name,FeeCode,onlineTransactionID,onlineTransactionDate, statusdescription,onlineTransactionAmount,st.name,st.collegeRollNo,ccm.streamDisplay as Stream, ccm.streamType,semester,admissionToSemester,spd.session,BankRefno,spd.applcntMobNo,spd.applcntEmail,spd.semester,admissionToSemester,ccm.subjectName as department,isnull(spd.Paid,'') as Paid,spd.statuscode from studentPaymentDetail spd JOIN studentmaster st ON st.collegeRollno=spd.collegeRollNo JOIN College_CourseMaster ccm ON ccm.stream=st.appstream and ccm.subjectcode=st.appsubjectcode where  spd.id=".$paydetailid." ;";
  
   //die($qry);
 
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
$BankRefno = $studrecord[0]["BankRefno"];
$paidstatus  =$studrecord[0]["Paid"];
$transactionamount = $studrecord[0]["onlineTransactionAmount"];
$department = $studrecord[0]["department"];
$FeeCode = $studrecord[0]["FeeCode"];

$feerecord = array();

 if($FeeCode=='ADMFEE') {
	$feeqry =" select * from College_FeeStructureMaster where sesssionYear='".$studrecord[0]["session"]."' and feeCode='".$FeeCode."' and Semester='".$studrecord[0]["admissionToSemester"]."' ;";
 }
 else {
	$feeqry =" select * from College_FeeStructureMaster where sesssionYear='".$studrecord[0]["session"]."' and feeCode='".$FeeCode."' and Semester='".$studrecord[0]["semester"]."' ;"; 
 }
 
  

 $feeresult = $dbConn->query($feeqry);

if($feeresult) {
	while ($feerow=$feeresult->fetch(PDO::FETCH_ASSOC)) {
					if($feerow["feeGroup"]!='Total') {
					$feerecord[] = $feerow;
					}
					if($feerow["feeGroup"]=='Total') {
					$totalfee  = $feerow["FeeAmount"];
					}
					 
			}
		}

 	

	
?>

<!DOCTYPE HTML>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="de">  <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="keywords" content="">

<title>Fee Receipt</title>
<script type="text/javascript" src="js/jquery-1.5.1.js"></script>
<script language="javascript">

function printSlip()
{
	document.getElementById("btnPrint").style.visibility="hidden";
	window.print();
	document.getElementById("btnPrint").style.visibility="visible";
 }

</script>

    <!-- CSS -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Poppins|Roboto" rel="stylesheet">
    <link href="../bootstrap/css/animate.css" rel="stylesheet">
    <link href="../bootstrap/css/bootsnav.css" rel="stylesheet">
    <link href="../bootstrap/css/style.css" rel="stylesheet">
    <link href="../bootstrap/css/media_query.css" rel="stylesheet">
    
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<center>
<section style="margin-top:25px">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <link rel="stylesheet" type="text/css" href="../bootstrap/css/table_style.css">
                <div class="confirmSlip_container">
                	<div class="row" style="margin-bottom:12px">
                    	<div class="col-lg-12">
                        	<p style="text-align:center; margin:0">
                            	<img src="<?php echo BASE_URL; ?>/<?php echo COLLEGE_LOGO;?>" alt="Logo" width="55">
                            </p>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                        	<p style="text-align:center; margin:0 0 0 0; font-family:Poppins; font-size:24px; color:#000">
                            	<?php  echo COLLEGE_NAME;?>
                            </p>
                        </div>
                    </div>
                    
                	<div class="row">
            			<div class="col-lg-12">
                            <table width="100%" border="0" bordercolor="#666666" cellspacing="0" cellpadding="5" style="border-collapse:collapse; font-size:12px; text-align: left; line-height: 18px; font-family:Poppins" class="tabl">
                                <tbody>
                                	<!--<tr>
                                      <td colspan="4" class="TD2" style="text-align:center">Fee Detail: <span style="color:#c00"><?php //echo $studrecord[0]["FeeDetail"];?></span></td>
                                    </tr> -->
                                    <tr>
                                      <td class="TD1">Student Name</td>
                                      <td class="TD2"><?php echo $studrecord[0]["name"];?></td>
                                      <td class="TD1">College Roll No.</td>
                                      <td class="TD2"><?php echo $studrecord[0]["collegeRollNo"];?></td>
                                    </tr>
                                    <tr>
                                      <td class="TD1">Stream</td>
                                      <td class="TD2"><?php echo $studrecord[0]["Stream"];?></td>
                                      <td class="TD1">Course Type</td>
                                      <td class="TD2"><?php echo $studrecord[0]["streamType"];?></td>
                                    </tr>
                                    <tr>
                                      <td class="TD1">Department</td>
                                      <td class="TD2"><?php echo $studrecord[0]["department"];?></td>
                                      <td class="TD1">Present Semester</td>
                                      <td class="TD2"><?php echo $studrecord[0]["semester"];?></td>
                                    </tr>
									<?php if($FeeCode=='ADMFEE') { ?>
                                    <tr>
                                      <td class="TD1">To be Admitted Semester</td>
                                      <td colspan="3" class="TD2"><?php echo $studrecord[0]["admissionToSemester"];?></td>
                                    </tr>
									<?php } ?>
                                    <tr>
                                      <td class="TD1">Mobile</td>
                                      <td colspan="3" class="TD2"><?php echo $studrecord[0]["applcntMobNo"];?></td>
                                    </tr>
                                    <tr>
                                      <td class="TD1">E-mail</td>
                                      <td colspan="3" class="TD2"><?php echo $studrecord[0]["applcntEmail"];?></td>
                                    </tr>
                                    <?php if($statuscode==0300 || $paidstatus=='Y') {?>
                                    <tr>
                                      <td class="TD1">Payment Status</td>
                                      <td colspan="3" class="TD2"><i class="fa fa-check-circle" style="color:#0C0; font-size:18px; vertical-align:bottom"></i> <span id="spnstat" style="font-weight:500">Payment Successfully Received</span></td>
                                    </tr>
                                    <?php } else {?>
                                    <tr>
                                      <td class="TD1">Payment Status</td>
                                      <td colspan="3" class="TD2"><i class="fa fa-times-circle" style="color:#F00; font-size:18px; vertical-align:bottom"></i> <span id="spnstat" style="font-weight:500">Payment Not Received</span></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                            <?php if($statuscode==0300 || $paidstatus=='Y') {?>
                            
                            <table width="100%" border="0" bordercolor="#666666" cellspacing="0" cellpadding="5" style="border-collapse:collapse; font-size:12px; text-align: left; line-height: 18px;font-family:Poppins; margin-top:10px" class="tabl">
                                <tbody>
                                    <tr>
                                      <td class="TD1">Transaction Date</td>
                                      <td class="TD2"><?php  $date = new DateTime($onlineTransactionDate);
                echo $date->format('d-m-Y');?></td>
                                      <td class="TD1">Transaction ID</td>
                                      <td class="TD2"><?php echo $onlineTransactionID;?></td>
                                    </tr>
                                    <tr>
                                      <td class="TD1">Bank Reference No.</td>
                                      <td class="TD2"><?php echo $BankRefno;?></td>
                                      <td class="TD1">Transaction Amount (<i class="fa fa-inr"></i>)</td>
                                      <td class="TD2"> <?php echo moneyFormatIndia($transactionamount)."/-"?></td>
                                    </tr>
                                </tbody>
                            </table>
  
                            <div class="table-responsive" style="margin-top:15px">
                            	<p style="text-align:center; margin-bottom:0; font-size:14px; font-weight:bold; color:#03F">
                                	Fees Detail
                                </p>
                                <table class="table table-bordered table-condensed fee_details">
                                    <tr style="text-align:center; font-weight:bold">
                                        <td width="9%">Srl.</td>
                                        <td width="73%">Description</td>
                                        <td width="18%">Amount (<i class="fa fa-inr"></i>)</td>
                                    </tr>
                                    <?php for($i=0; $i<count($feerecord); $i++){?>
                                    <tr>
                                        <td style="text-align:center"><?php echo $feerecord[$i]["serialNo"];?></td>
                                        <td style="padding-left:10px"><?php echo $feerecord[$i]["feeParticulars"];?></td>
                                        <td style="text-align:center"><?php 
                                        if($feerecord[$i]["FeeAmount"]==0)
                                        echo "NIL";
                                        else
                                        echo moneyFormatIndia($feerecord[$i]["FeeAmount"]);?>
                                        </td>
                                    </tr>
                               		<?php }?> 
                                </table>
                            </div>
                            
                            <table width="100%" border="0" bordercolor="#666666" cellspacing="0" cellpadding="5" style="border-collapse:collapse; font-size:12px; text-align: left; line-height: 18px; margin-bottom:10px" class="tabl">
                            	<tbody>
                                    <tr>
                                      <td class="TD1">Total Fee Amount</td>
                                      <td class="TD2"><i class="fa fa-inr"></i> <strong style="color:#c00"><?php echo moneyFormatIndia($totalfee);?></strong> <span class="brake1"><br></span>(<?php echo amountinword($totalfee);?>)</td>
                                    </tr>
                                </tbody>
                            </table>
                            
                           <?php }?>
                             
                             <div style="margin:5px auto 10px auto; text-align:center">
                             	<input type="button" id="btnPrint"  title="Print" value="Print" onClick="printSlip();" class="btn btn-primary" />
                             </div>
							 
							 <div style="margin:0 auto 10px auto; text-align:center">
								<form id="frmdashboard" name="frmdashboard"  action="dashboard.php" method="post">
								<input type="hidden" id="txtrollno" name="txtrollno" value="<?php echo $studrecord[0]["collegeRollNo"];?>" />
								
                             	<input type="button" id="Dashboard"  title="back" value="Back to Dashboard" onClick="javascript: $('#frmdashboard').submit();" class="btn btn-primary" />
								</form>
                             </div>
                        </div>
                	</div>
                </div>
            </div>
        </div>
    </div>
</section>

</center>
</body>
</html>




