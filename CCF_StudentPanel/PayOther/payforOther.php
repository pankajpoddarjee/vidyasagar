<?php
include("../sessionConfig.php");
include("../../connection_CCF.php");
include("../function.php");
include("../../configuration_CCF.php");
 
$studrecord  = array();

$collegerollno = $_POST["hdncollegerollno"];

$dept =$_POST["hdndept"];
$semester =$_POST["hdnsemester"];
 
$rollno = $_POST["hdnrollno"];
$payDetailid = $_POST["hdnpaydetailid"];

include("../Query_dashboard.php");

$fetchqry = "SELECT phase,lastDate,phaseStatus,case when phaseStatus='ON' and convert(varchar ,'".date('Y-m-d H:i' )."',120) Between convert(varchar, phaseStatusStartDate, 120) and convert(varchar, phaseStatusLastDate, 120) then 'allow' else 'notallow' end as  retrievestatus,convert(varchar, updateLastdate, 120) as updateLastdate FROM  PhaseStatus  ;";
 

$fetchresult = $dbConn->query($fetchqry);

if($fetchresult) {
	$fetchrow=$fetchresult->fetch(PDO::FETCH_ASSOC);
} 

  $qry	=	"select spd.*,  ccm.subjectName as department  from studentPaymentDetail spd JOIN studentmaster st ON st.collegeRollno=spd.collegeRollNo  JOIN College_CourseMaster ccm ON ccm.subjectcode=st.appsubjectcode where spd.id=".$payDetailid." and studentStatusforPay=1;";
  
//$qry	=	"select * from studentmaster where RollNo='".$rollno."';";

  //die($qry);
  
$qryresult = $dbConn->query($qry);

if($qryresult) {
 	while($row=$qryresult->fetch(PDO::FETCH_ASSOC))
	{
		$studrecord[] = $row;
	}
 }

$feerecord = array();
$totalfee = 0;

   $feeqry =" select * from College_FeeStructureMaster where  sesssionYear='".$studrecord[0]["session"]."' and feeCode='".$studrecord[0]["FeeCode"]."' and Semester='".$studrecord[0]["semester"]."';";

 
$feeresult = $dbConn->query($feeqry);

if($feeresult) {
	while ($feerow=$feeresult->fetch(PDO::FETCH_ASSOC)) {
		
					if($feerow["feeGroup"]!='Total') {
					$feerecord[] = $feerow;
					}
					if($feerow["feeGroup"]=='Total') {
					$totalfee  = $feerow["FeeAmount"];
					}
					//$feerecord[] = $feerow;
					//$feesarr[] =  $feerow["FeeAmount"];
			}
}

 if($studrecord[0]["Paid"]=='Y' && $studrecord[0]["statuscode"]=='0300') {
		header("location: retreive.php"); 
		} 


?>
<<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title>Payment Detail - <?php echo COLLEGE_NAME; ?></title>
<?php include("../head_includes.php");?>
<script language="javascript">

function gotoBillDesk()
{
	document.frmbilldesk.method="post";
	document.frmbilldesk.submit();
}

function printSlip()
{
	document.getElementById("btnPrint").style.visibility="hidden";
	window.print();
	document.getElementById("btnPrint").style.visibility="visible";
 }

</script>
</head>
 
<body>
 
    <?php include("../candidate_dashboard_menu.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("../candidate_dashboard_menu2.php");?>
        
        <div class="pl-3 pr-3 pt-0">        
            <?php include("../emergengy_notice_dashboard.php");?>
            
           <!-- <div class="row">
            	<div class="col-md-6 mb-3">-->
			<?php if($fetchrow["retrievestatus"]=='allow') {?>
			<section style="margin-top:25px">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-sm-12">
						
							<p class="page_header font-weight-bold">
                                <i class="fa fa-inr"></i> Payment details
                            </p>
							
							<div class="PaymentDetail_container">
								<div class="row">
									<div class="col-lg-12">
										<table width="100%" border="0" bordercolor="#666666" cellspacing="0" cellpadding="5" style="border-collapse:collapse; font-size:13px; text-align: left; line-height: 18px; font-family:Poppins" class="tabl">
											<tbody>
												<!--<tr>
												  <td colspan="4" class="TD2" style="text-align:center">Fee Detail: <span style="color:#c00"><?php echo $studrecord[0]["FeeDetail"];?></span></td>
												</tr>-->
												<tr>
												  <td class="TD1">Student Name</td>
												  <td class="TD2"><?php echo $record["name"];?></td>
												</tr>
												<tr class="TR">
													<td class="TD1">College Roll No.</td>
													<td class="TD2"><?php echo $studrecord[0]["collegeRollNo"];?></td>
												</tr>                                    
												<tr>
												  <td class="TD1">Stream</td>
												  <td class="TD2"><?php echo $record["streamDisplay"];?></td>
												</tr>
												<tr>
												  <td class="TD1">Course Type</td>
												  <td class="TD2"><?php echo $record["streamType"];?></td>
												</tr>
												<tr>
												  <td class="TD1">Department</td>
												  <td class="TD2"><?php echo $studrecord[0]["department"];?></td>
												</tr>
												<tr>
												  <td class="TD1">Present Semester</td>
												  <td class="TD2"><?php echo $studrecord[0]["semester"];?></td>
												</tr>                                    
												    
												<tr>
												  <td class="TD1">Mobile</td>
												  <td class="TD2"><span style="color:#c00"><?php echo $studrecord[0]["applcntMobNo"];?></span></td>
												</tr>
												<tr>
												  <td class="TD1">E-mail</td>
												  <td class="TD2"><span style="color:#c00"><?php echo $studrecord[0]["applcntEmail"];?></span></td>
												</tr>
											</tbody>
										</table>
										
										<div class="table-responsive" style="margin-top:15px">
											<p style="text-align:center; margin-bottom:5px; font-size:14px; font-weight:bold; color:#03F">
												Fees Detail
											</p>
                                            
											<table class="table table-bordered table-condensed fee_details" style="border-collapse:collapse; font-size:13px; text-align: left; line-height: 18px; font-family:Poppins">
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
										
										<table width="100%" border="0" bordercolor="#666666" cellspacing="0" cellpadding="5" style="border-collapse:collapse; font-size:13px; text-align: left; line-height: 18px" class="tabl">
											<tbody>
												<tr>
												  <td class="TD1">Total Amount Payable</td>
												  <td class="TD2"><i class="fa fa-inr"></i> <strong style="color:#c00"><?php  echo moneyFormatIndia($totalfee);?></strong> <span class="brake1"> </span>(<?php echo amountinword($totalfee);?>)</td>
												</tr>
											</tbody>
										</table>
										<?php if($totalfee>0) { ?>
										<div style="margin:15px auto 0 auto; text-align:center">
										<form name="frmbilldesk" id="frmbilldesk" action="EpaymentOther.php"  method="post"> 
										<input type="hidden" id="hdnpaydetailid" name="hdnpaydetailid" value="<?php echo $payDetailid;?>"/>
										<input type="hidden" id="hdnrollno" name="hdnrollno" value="<?php echo $rollno;?>" />
										<input type="hidden" id="hdndept" name="hdndept" value="<?php echo $dept;?>"/>
										<input type="hidden" id="hdnsemester" name="hdnsemester" value="<?php echo $semester;?>"/> 
										<input type="hidden" name="txtbilldeskulr" id="txtbilldeskulr" width="100%"
										value="<?php echo BILLERID;?>|<?php echo $rollno;?>|NA|<?php echo $totalfee;?>|NA|NA|NA|INR|NA|R|<?php echo SECURITYID;?>|NA|NA|F|<?php echo $studrecord[0]["name"] ?>|<?php echo $studrecord[0]["department"];?>|<?php echo $studrecord[0]["feeCode"];?>|<?php echo $studrecord[0]["admissionToSemester"];?>|<?php echo ACADEMIC_SESSION;?>|<?php echo $semester;?>|NA|<?php echo BASE_URL_STUDENT;?>/paymentsuccess.php" />
										<input type="button" name="btnsubmit" value="Click here to Pay your Fee" title="Click here to Pay your Fee" onclick="javascript:gotoBillDesk()" class="btn btn-danger">							
										
											 <br><br>
									</form> 
										
											 
										</div>
										<?php }?>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php } else {?>
				<div class="row" style="margin-top:18vh">
                    <div class="col-md-12 text-center font-weight-bold">
                        <i class="fa fa-exclamation-triangle text-danger" style="font-size:40px"></i><br>
                        Fee Payment link is presently not active.
                    </div>
                </div>
				<?php }?>
<!--</div>
            </div>  -->           
        </div>
        <?php include("../footer.php");?>
    </div>	
    <?php include("../footer_includes.php");?>    
</body>
</html> 
<script src="../js/dashboard.js"></script> 