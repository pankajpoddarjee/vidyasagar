<?php
include("../../sessionConfig.php");
include("../../../connection.php");
include("../../function.php");
include("../../../configuration.php");
  
$studrecord  = array();
 $collegerollno = $_POST["hdnrollno"];
 $semester =$_POST["hdnsemester"];
 $payDetailid = $_POST["hdnpaydetailid"];
//$rollno = $_POST["hdnrollno"];

include("../Query_dashboard.php");

$fetchqry = "SELECT phase,lastDate,phaseStatus,case when phaseStatus='ON' and convert(varchar ,'".date('Y-m-d H:i' )."',120) Between convert(varchar, phaseStatusStartDate, 120) and convert(varchar, phaseStatusLastDate, 120) then 'allow' else 'notallow' end as  retrievestatus,convert(varchar, updateLastdate, 120) as updateLastdate FROM  PhaseStatus  ;";



$fetchresult = $dbConn2->query($fetchqry);

if($fetchresult) {
	$fetchrow=$fetchresult->fetch(PDO::FETCH_ASSOC);
} 

   $qry	=	"select st.name,st.collegeRollNo,st.applcntMobNo,st.applcntEmail,spd.RollNo,spd.semester,ccm.stream,ccm.streamDisplay,ccm.streamType,ccm.subjectName,ccm.subjectcode,isnull(spd.Paid,'') as Paid,spd.statuscode from studentPaymentDetail spd JOIN studentmaster st ON st.collegeRollno=spd.collegeRollNo JOIN College_CourseMaster ccm ON ccm.subjectcode=st.appsubjectcode where spd.id=".$payDetailid." and studentStatusforPay=1;";
   
   //ltrim(rtrim(session))='".ACADEMIC_SESSION."'   and semester='".$semester."' and spd.collegeRollNo='".$rollno."' ;";
   
 
$qryresult = $dbConn2->query($qry);

if($qryresult) {
 	while($row=$qryresult->fetch(PDO::FETCH_ASSOC))
	{
		$studrecord[] = $row;
	}
 }

 if($studrecord[0]["Paid"]=='Y' && $studrecord[0]["statuscode"]=='0300') {
		header("location: ../retreive.php"); 
		} 

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title>Payment Detail - <?php echo COLLEGE_NAME; ?></title>
<?php include("../head_includes.php");?>
</head>
<body>
 
    <?php include("../candidate_dashboard_menu.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("../candidate_dashboard_menu2.php");?>
        
        <div class="pl-3 pr-3 pt-0">        
            <?php include("../emergengy_notice_dashboard.php");?>
            
            

<?php if($fetchrow["retrievestatus"]=='allow') {?>
<section style="margin-top:25px">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
            
            	<p class="page_header font-weight-bold">
                    <i class="fa fa-inr"></i> Payment details
                </p>
                <link rel="stylesheet" type="text/css" href="bootstrap/css/table_style.css">
                <div class="PaymentDetail_container">
                	<div class="row">
            			<div class="col-lg-12">
                        	<table width="100%" border="0" bordercolor="#666666" cellspacing="0" cellpadding="5" style="border-collapse:collapse; font-size:12px; text-align: left; line-height: 18px; font-family:Poppins" class="tabl">
                                <tbody>
                                   
                                    <tr>
                                      <td colspan="4" class="TD1" style="text-align:center; color:#03F; font-weight:bold">Student Detail</td>
                                    </tr>
                                    <tr>
                                      <td class="TD1">Student Name</td>
                                      <td class="TD2"><?php echo $studrecord[0]["name"];?></td>
                                    </tr>
                                    <tr class="TR">
                                        <td class="TD1">College Roll No.</td>
                                        <td class="TD2"><?php echo $studrecord[0]["collegeRollNo"];?></td>
                                    </tr>                                    
                                    <tr>
                                      <td class="TD1">Stream</td>
                                      <td class="TD2"><?php echo $studrecord[0]["streamDisplay"];?></td>
                                    </tr>
                                    <tr>
                                      <td class="TD1">Course Type</td>
                                      <td class="TD2"><?php echo $studrecord[0]["streamType"];?></td>
                                    </tr>
                                    <tr>
                                      <td class="TD1">Department</td>
                                      <td class="TD2"><?php echo $studrecord[0]["subjectName"];?></td>
                                    </tr>
                                    <tr>
                                      <td class="TD1">Present Semester</td>
                                      <td class="TD2"><?php echo $studrecord[0]["semester"];?></td>
                                    </tr>                                    
                                </tbody>
                            </table>
                             
                            
                            <form name="frmnext1" id="frmnext1" action="payforAdmission.php"  method="post">
							<input type="hidden" id="hdnpaydetailid" name="hdnpaydetailid" value="<?php echo $payDetailid;?>"/>
                            <input type="hidden" id="hdndept" name="hdndept" value="<?php echo $dept;?>"/>
							<input type="hidden" id="hdnsemester" name="hdnsemester" value="<?php echo $semester;?>"/>                           
                            <input type="hidden" id="hdnrollno" name="hdnrollno" value="<?php echo $studrecord[0]["RollNo"];?>" />    
							<input type="hidden" id="hdncollegerollno" name="hdncollegerollno" value="<?php echo $studrecord[0]["collegeRollNo"];?>" /> 							
                            
                            <table width="100%" border="0" bordercolor="#666666" cellspacing="0" cellpadding="5" style="border-collapse:collapse; font-size:12px; text-align: left; line-height: 18px; font-family:Poppins; margin-top:5px" class="tabl">
                                <tbody>
                                	<tr>
                                      <td class="TD1" colspan="2" style="text-align:center; color:#03F; font-weight:bold">
                                      	Applicant Additional Information
                                      </td>
                                    </tr>
									<tr>
                                      <td class="TD1">To be Admitted Semester <span style="color:#F00">*</span></td>
                                      <td class="TD2">
									  <?php 
									  $functionname ="";
									  
										if($studrecord[0]["stream"]!='BCOM' && $studrecord[0]["stream"]!='BCOMGEN') { 
										$functionname =" onchange='getOtherSubforsemester(this.value)'";
										}
									  ?>
									  <select id="choAdmitedSemester" name="choAdmitedSemester" class="form-control" <?php echo $functionname;?>>
										<option value="">-- Select --</option>
                                        <!--<option value="I">Semester 1</option>-->
										<option value="III">Semester 3</option>
										<option value="V">Semester 5</option>
                                        
                                        <!--<option value="II">Semester 2</option>
                                        <option value="IV">Semester 4</option>
                                        <option value="VI">Semester 6</option>-->
									  </select>
									  </td>
                                    </tr>
									<tr><td colspan="2">
									<div id="othersubjectinfo" style="display: none"></div> 
									</td></tr>
                                    <tr>
                                      <td class="TD1">Enter Applicant Mobile No. <span style="color:#F00">*</span></td>
                                      <td class="TD2"><input class="form-control" type="text" name="txtmobile" id="txtmobile" placeholder="Applicant Mobile No." value="<?php echo $studrecord[0]["applcntMobNo"];?>" maxlength="10"  onkeypress="inputNumber(event,this.value,false);"></td>
                                    </tr>
                                    <tr class="TR">
                                        <td class="TD1">Enter Applicant Email Id <span style="color:#F00">*</span></td>
                                        <td class="TD2"><input class="form-control" type="text" name="txtemail" id="txtemail" value="<?php echo $studrecord[0]["applcntEmail"];?>" placeholder="Applicant Email Id" maxlength="45"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <p style="text-align:center; margin-top:15px"><input type="button" name="btnnext" value="Next" onclick="saveInfo()"  class="btn btn-danger"></p>
                            </form>
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
<!--<style type="text/css">
.pay_fee_button{cursor:pointer; font-size:13px; padding:15px 25px; background:#06C; color:#fff; text-transform:uppercase; border-radius:5px; border:none; font-weight:bold}
.pay_fee_button:hover{background:#06F}
@font-face {
    font-family: oldenglish;
    src: url(bootstrap/fonts/OLDENGL.TTF);
}
</style>-->
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
            
        </div>
        <?php include("../footer.php");?>
    </div>	
    <?php include("../footer_includes.php");?>    
</body>
</html> 
<script src="../js/dashboard.js"></script>
<script src="../js/payment.js"></script>
