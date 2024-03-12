<?php
include("sessionConfig.php");
include("../connection_CCF.php");
include("function.php");
include("../configuration_CCF.php");

$collegerollno = $_POST["txtcollegerollno"];
 
  
  $fetchqry = "SELECT phase,lastDate,phaseStatus,case when phaseStatus='ON' and convert(varchar ,'".date('Y-m-d H:i' )."',120) Between convert(varchar, phaseStatusStartDate, 120) and convert(varchar, phaseStatusLastDate, 120) then 'allow' else 'notallow' end as  retrievestatus,convert(varchar, updateLastdate, 120) as updateLastdate FROM  PhaseStatus  ;";



$fetchresult = $dbConn->query($fetchqry);

if($fetchresult) {
	$fetchrow=$fetchresult->fetch(PDO::FETCH_ASSOC);
}

$fetchresult = NULL; 

$record = array();

include("Query_dashboard.php");
 
 $payrecord =array();
 
   $payqry	=	"select distinct spd.*,fs.FeeDetail,FeeAmount from studentPaymentDetail spd LEFT JOIN College_FeeStructureMaster fs ON fs.feeCode=spd.FeeCode and spd.session=fs.sesssionYear  and fs.Semester=CASE WHEN fs.FeeCode='ADMFEE' THEN spd.admissionToSemester  ELSE   spd.semester END   and feeGroup='Total' where collegeRollNo='".$collegerollno."' and studentStatusforPay=1 ORDER BY spd.id desc;";
	
	 
 
$payqryresult = $dbConn->query($payqry);

if($payqryresult) {
 	while($payrow=$payqryresult->fetch(PDO::FETCH_ASSOC))
	{
		$payrecord[] = $payrow;
	}
 }
 
$payqryresult = NULL;

$dbConn = NULL;

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title>Payment Detail - <?php echo COLLEGE_NAME; ?></title>
<?php include("head_includes.php");?>
</head>
<body>
 
<style type="text/css">	
.footer{background:#039; padding:0; margin:0; width:100%}
@media only screen and (min-width: 1050px) {.footer{position:fixed; bottom:0; padding:0}}
</style>
 
    <?php include("candidate_dashboard_menu.php");?>
    
    <div id="content">
    	<?php include("header.php");?>
        <?php include("candidate_dashboard_menu2.php");?>
        
        <div class="pl-3 pr-3 pt-0">        
            <?php include("emergengy_notice_dashboard.php");?>
            
             <?php  if($fetchrow["retrievestatus"]=='allow') { ?>   	 
				 <div class="table-responsive">
                 	<table class="table table-bordered table-hover text-nowrap font-weight-normal text-center"> 
                     <thead> 
                     <tr class="bg-light">
                     <td>Serial No.</td>
                     <td>Print</td>
                     <td>Paid Status</td>
                     <td>Session</td>
                     <td>Semester</td>
                     <td>To be Admitted Semester</td>
                     <td>Fee Detail</td>
                     <td>Fee Amount</td>
                     <td>Payment Date</td>
                     <td>Trans. Id</td>
                     <td>Trans. Amount</td>
                     <td>Mobile No</td> 
                     <td>Email</td>
                     </tr>
                     </thead>
                     <tbody>
                    <?php
                         $i=0;
                         foreach($payrecord as $paydetail) {
                         $i=$i+1;
                        ?>
                    <tr>
                    <td><?php echo $i;?> </td>
                    <td>
                     <?php if($paydetail["Paid"]=='Y') { ?>
                        <a href="javascript:void(0)" onclick="goforConfirmReciept(<?php echo $paydetail['id'];?>);"><i class="fa fa-print" title="Print Receipt"></i></a> 
                     <?php } ?>
                     <?php if($paydetail["Paid"]!='Y' && $paydetail["session"]==ACADEMIC_SESSION) { 
                                 
                     ?>
                        <a class="btn btn-danger" href="javascript:void(0)" onclick="goforPayment('<?php echo $paydetail["FeeCode"];?>',<?php echo $paydetail['id'];?>);">Pay</a> 
                     <?php  
                        }
                     ?>
                     </td>
                     <td><?php echo ($paydetail["Paid"]=='Y'?'<span class="text-success"><i class="fa fa-check-circle-o"></i> Paid</span>': '<span class="text-danger"><i class="fa fa-times-circle-o"></i> Not Paid</span>');?></td>
                     <td><?php echo $paydetail["session"];?></td> 
                     <td><?php echo $paydetail["semester"];?></td>
                     <td><?php echo $paydetail["admissionToSemester"];?></td>
                     <td><?php echo $paydetail["FeeDetail"];?></td>
                     <td><?php echo $paydetail["FeeAmount"];?></td>
                     <td><?php echo ($paydetail["Paid"]=='Y'?$paydetail["paymentdate"]:'');?></td>
                     <td><?php echo ($paydetail["Paid"]=='Y'?$paydetail["onlineTransactionID"]:'');?></td>
                     <td><?php echo ($paydetail["Paid"]=='Y'?$paydetail["onlineTransactionAmount"]:'');?></td>
                     <td><?php echo $paydetail["applcntMobNo"];?></td> 
                     <td><?php echo $paydetail["applcntEmail"];?></td>
                     
                     </tr>
                     
                    <?php  } ?>
                    </tbody>
                    </table>
                 </div>
				<form id="payconfirmfrm" name="payconfirmfrm" action="print_paymentreciept.php" method="post" target="_blank">
				<input type="hidden" id="txtpaydetailid" name="txtpaydetailid"  />
				</form>
				
                <form id="nextfrm" name="nextfrm" action="" method="post">
				<input type="hidden" id="hdnpaydetailid" name="hdnpaydetailid"   />
				<input type="hidden" name="hdnsemester" id="hdnsemester" value="<?php echo $record["presentsemester"];?>" />
				<input type="hidden" id="hdnrollno" name="hdnrollno"  value="<?php echo $collegerollno?>"/>
				</form> 
				
			 <?php } else {?>
             
                <div class="row" style="margin-top:18vh">
                    <div class="col-md-12 text-center font-weight-bold">
                        <i class="fa fa-exclamation-triangle text-danger" style="font-size:40px"></i><br>
                        Fee Payment link is presently not active.
                    </div>
                </div>
                    
			 <?php }?>              
        </div>
        <?php include("footer.php");?>
    </div>	
    <?php include("footer_includes.php");?>    
</body>
</html> 
<script src="js/dashboard.js"></script> 
<script src="js/payment.js"></script> 
