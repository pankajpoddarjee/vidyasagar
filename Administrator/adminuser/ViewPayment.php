<?php 
include("config.php");

$collegerollno = $_POST["txtcollegeRollnoforPay"];
 
  $qry =	"select applicationNo,name,st.collegeRollNo,presentsemester,dob,sex,PH,	caste,	stateofdomicile,scstStateOther,applcntMobNo,alternateMobileNo,hasWhatsAppno,WhatsAppno,	applcntEmail,fathername,motherName,appstream,appsubject,isnull(CuRegNo,'') as CuRegNo,isnull(CuRollNo,'') as CuRollNo,aadharNo,ccm.streamDisplay, ccm.streamType,ccm.subjectName,isnull(photo,'') as photo, isnull(signature,'') as signature  from studentmaster st JOIN College_CourseMaster ccm ON ccm.subjectcode=st.appsubjectcode  where st.collegeRollNo='".$collegerollno."'";
 
$qryresult = $dbConn->query($qry);

if($qryresult) {
 	while($row=$qryresult->fetch(PDO::FETCH_ASSOC))
	{
		foreach ($row as $colNum=>$value ){
					$record[$colNum] = trim($value);
				}
	}
 }

 
 $payrecord = array();
 
    $payqry	=	"select distinct spd.*, fs.FeeDetail,FeeAmount from studentPaymentDetail spd LEFT JOIN College_FeeStructureMaster fs ON fs.feeCode=spd.FeeCode and spd.session=fs.sesssionYear  and fs.Semester=CASE WHEN fs.FeeCode='ADMFEE' THEN spd.admissionToSemester  ELSE   spd.semester END and feeGroup='Total' where collegeRollNo='".$collegerollno."' and studentStatusforPay=1 ORDER BY spd.id desc;";
	
 
 
$payqryresult = $dbConn->query($payqry);

if($payqryresult) {
 	while($payrow=$payqryresult->fetch(PDO::FETCH_ASSOC))
	{
		$payrecord[] = $payrow;
	}
 }
   
$payqryresult =NULL;
$dbConn = NULL;

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> | View Payment Details</title>
<?php include("../head_includes.php");?>
<style type="text/css">	
.footer{background:#039; padding:0; margin:0; width:100%}
@media only screen and (min-width: 1050px) {.footer{position:fixed; bottom:0; padding:0}}
</style>
</head>
<body>
    <?php include("headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("headermenu_top.php");?>
        
        <div class="container-fluid">
        	<div class="row justify-content-center">
            	<div class="col-md-12">
                    <h5 class="text-danger border-bottom mb-3 pb-2">
                    	<i class="fa fa-inr"></i> View Payment Details
                    </h5>
                </div>
				<div class="col-md-8">
                   <table class="table table-bordered table-striped shadow">                         
                        <thead>
                            <tr>
                                <th colspan="2" scope="col" class="bg-secondary text-left text-light font-weight-normal"><i class="fa fa-user"></i> Student Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td><?php echo $record["name"];?></td>
                            </tr>
							<tr>
                                <td>College Roll No.</td>
                                <td><?php echo $record["collegeRollNo"];?></td>
                            </tr>
							<tr>
                                <td>Subject</td>
                                <td colspan="3"><?php echo $record["streamDisplay"];?> | <?php echo $record["subjectName"];?></td>
                            </tr>
						</tbody>
					</table>
                </div>
            </div>
        </div>
        
        <div class="container-fluid mt-4">
        	<div class="row">                
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-nowrap text-center" border="1" bordercolor="#333">
                            <thead> 
                                <tr class="bg-light font-weight-bold text-nowrap align-middle">
                                    <td>Srl.</td>
                                    <td>Print</td>
                                    <td>Paid Status</td>
                                    <td>Session</td>
                                    <td>Semester</td> 
                                    <td>To be Admitted Semester</td>
                                    <td>Fee Detail</td>
                                    <td>Fee Amount</td>
                                    <td>Payment Date</td>
                                    <td>Trans. Id</td>
                                    <td>Tran. Amount</td>
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
                                    <a class="btn btn-sm btn-info" href="javascript:void(0)" onclick="goforConfirmReciept(<?php echo $paydetail['id'];?>);"><i class="fa fa-file-text-o"></i> Reciept</a> 
                                    <?php } ?>                                
                                    </td>
                                    <td><?php echo ($paydetail["Paid"]=='Y'?'<i class="fa fa-check-circle-o text-success"></i> Paid': '<i class="fa fa-times-circle-o text-danger"></i> Not Paid');?></td>
                                    <td><?php echo $paydetail["session"]?></td> 
                                    <td><?php echo $paydetail["semester"]?></td>
                                    <td><?php echo $paydetail["admissionToSemester"]?></td>
                                    <td><?php echo $paydetail["FeeDetail"];?></td>
                                    <td><i class="fa fa-inr"></i> <?php echo $paydetail["FeeAmount"];?></td>
                                    <td><?php echo ($paydetail["Paid"]=='Y'?$paydetail["paymentdate"]:'');?></td>
                                    <td><?php echo ($paydetail["Paid"]=='Y'?$paydetail["onlineTransactionID"]:'');?></td>
                                    <td><i class="fa fa-inr"></i> <?php echo ($paydetail["Paid"]=='Y'?$paydetail["onlineTransactionAmount"]:'NIL');?></td>
                                    <td><?php echo $paydetail["applcntMobNo"];?></td>
                                    <td><?php echo $paydetail["applcntEmail"];?></td>
                                </tr>
                            </tbody>
                            <?php  } ?>
                        </table>
                    </div>
                </div>
                
				<form id="payconfirmfrm" name="payconfirmfrm" action="<?php echo BASE_URL_STUDENT;?>/print_paymentreciept.php" method="post" target="_blank">
				<input type="hidden" id="txtpaydetailid" name="txtpaydetailid">
				</form>
            </div>
            
        	<div class="row mt-4">                
                <div class="col-md-12 text-center">
                    <form id="frmback" name="frmback" action="search_candidate_details.php" method="post">
                    	<input type="hidden" id="txtRollnoforsearch" name="txtRollnoforsearch" class="form-control" maxlength="10" value="<?php echo $collegerollno;?>">
                    </form>                
                    <a class="btn btn-dark btn-sm" href="javascript:void(0)" onclick="javascript: $('#frmback').submit();">
                    	<i class="fa fa-arrow-circle-o-left"></i> Go Back
                    </a>
                </div>
            </div>
        </div>		 
        
    	<!--MODAL START-->
        <div class="modal fade" id="ValidationAlert" tabindex="-1" role="dialog" aria-labelledby="ValidationAlertTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="ShowValidationAlert"><?php echo MODAL_VALIDATION_TEXT;?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-left" id="msgcontent">
                    	
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--MODAL END-->
        <?php include("../footer.php");?>
    </div>	
    <?php include("../footer_includes.php");?>    
</body>
</html>
<script src="adminuser_js/admin_search.js"></script>