<?php 
include("config.php");
 
$record =array();
 
$collegerollno = $_POST["txtRollnoforsearch"];
 
  $qry =	"select applicationNo,appliedsession,name,st.collegeRollNo,presentsemester,dob,sex,PH,	caste,	stateofdomicile,scstStateOther,applcntMobNo,alternateMobileNo,hasWhatsAppno,WhatsAppno,	applcntEmail,fathername,motherName,appstream,appsubject,isnull(CuRegNo,'') as CuRegNo,isnull(CuRollNo,'') as CuRollNo,aadharNo,ccm.streamDisplay, ccm.streamType,ccm.subjectName,isnull(photo,'') as photo, isnull(signature,'') as signature  from studentmaster st JOIN College_CourseMaster ccm ON ccm.subjectcode=st.appsubjectcode  where st.collegeRollNo='".$collegerollno."'";
 
$qryresult = $dbConn->query($qry);

if($qryresult) {
 	while($row=$qryresult->fetch(PDO::FETCH_ASSOC))
	{
		foreach ($row as $colNum=>$value ){
					$record[$colNum] = trim($value);
				}
	}
 }


$qryresult = NULL;
$dbConn = NULL;
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> | Student Detail</title>
<?php include("../head_includes.php");?>
</head>
<body>
    <?php include("headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("headermenu_top.php");?>        
        
        <div class="container mt-4">
        	<div class="row m-auto">
            	<div class="col-md-12">
                    <h5 class="text-danger border-bottom mb-3 pb-2">
                    	<i class="fa fa-street-view"></i> Student Detail
                    </h5>
                </div>
            	<div class="col-md-2 mb-3">
                    <table class="table table-borderless">                       
                        <tbody>
                            <tr>
                                <td class="text-center">
								<?php if($record["photo"]!='') {?>
                                	<img src="<?php echo BASE_URL;?>/Upload_Images/<?php echo $record["appliedsession"];?>/Photograph/<?php echo $record["photo"];?>" width="95" height="110" class="mb-2 border p-1">
								<?php }?>
								<?php if($record["signature"]!='') {?>
                                    <br><img src="<?php echo BASE_URL;?>/Upload_Images/<?php echo $record["appliedsession"];?>/Signature/<?php echo $record["signature"];?>" width="120" height="30" class="mb-2 border p-1">
								<?php }?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
            	<div class="col-md-5 mb-3">
                	<table class="table table-bordered table-striped shadow">
                        <thead>
                            <tr>
                                <th colspan="4" scope="col" class="bg-secondary text-left text-light font-weight-normal"><i class="fa fa-user"></i> Student details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td colspan="3"><?php echo $record["name"];?></td>
                            </tr>
							<tr>
                                <td>Date of Birth</td>
                                <td colspan="3"><?php echo $record["dob"];?></td>
                            </tr>
                            <tr>
                                <td>Category</td>
                                <td colspan="3"><?php echo $record["caste"];?> | <?php echo preg_replace('/\bOther State\b/', $record["scstStateOther"], $record["stateofdomicile"]);?></td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-wheelchair"></i> PWD</td>
                                <td colspan="3"><?php echo ($record["PH"]==1?'Yes':'No');?></td>
                                 
                            </tr>
                            <tr>
                                <td>Aadhaar No.</td>
                                <td colspan="3"><?php echo $record["aadharNo"];?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="col-md-5 mb-3">
                	<table class="table table-bordered table-striped shadow">
                        <thead>
                            <tr>
                                <th colspan="4" scope="col" class="bg-secondary text-left text-light font-weight-normal"><i class="fa fa-graduation-cap"></i> Academic details</th>
                            </tr>
                        </thead>
                        <tbody>
							<tr>
                                <td>Present Semester</td>
                                <td colspan="3"><?php echo $record["presentsemester"];?></td>
                            </tr>
							<tr>
                                <td>Subject</td>
                                <td colspan="3"><?php echo $record["streamDisplay"];?> | <?php echo $record["subjectName"];?></td>
                            </tr>
							<tr>
                                <td>Roll No.</td>
                                <td colspan="3"><?php echo $collegerollno;?></td>
                            </tr>
                            <tr>
                                <td>CU Reg. No.</td>
                                <td colspan="3"><?php echo $record["CuRegNo"];?></td>
                            </tr>
                            <tr>
                                <td>CU Roll No.</td>
                                <td colspan="3"><?php echo $record["CuRollNo"];?></td>
                            </tr>
                        </tbody>
                    </table>  
                </div>
            </div>
            
            <div class="row m-auto text-center justify-content-center">
            <style>
			.round_box {display:inline-block;width:150px;height:150px; padding:38px 20px}
			</style>
            	<div class="col-md-12 mb-3">
                	<hr>
                </div>
				<div class="col-md-3 col-6 mb-5">
                	<div class="text-center rounded-circle round_box shadow bg-success">
                    	<div class="mt-2 text-uppercase text-center">
						<form id="frmview" name="frmview" action="studentInfo.php" method="post">
						<input type="hidden" id="txtStudentRollno" name="txtStudentRollno" class="form-control" maxlength="10" value="<?php echo $collegerollno;?>" />
						</form>
                        	<a class="text-white text-center" href="javascript:void(0)" onclick="javascript: $('#frmview').submit();">
                            	<i class="fa fa-user" style="font-size:28px"></i><br>Student Detail
                            </a>
                        </div>
                    </div>
                </div> 
            	<div class="col-md-3 col-6 mb-5">
                	<div class="text-center rounded-circle round_box shadow bg-info">
                    	<div class="mt-2 text-uppercase text-center">
						<form id="frmcourseview" name="frmcourseview" action="ViewCourse.php" method="post" target="_blank">
						<input type="hidden" id="txtRollnoforcourse" name="txtRollnoforcourse" class="form-control" maxlength="10" value="<?php echo $collegerollno;?>" />
						</form>
                        	<a class="text-white text-center" href="javascript:void(0)" onclick="javascript: $('#frmcourseview').submit();">
                            	<i class="fa fa-leanpub" style="font-size:28px"></i><br>Course Detail
                            </a>
                        </div>
                    </div>
                </div>
			  
                <div class="col-md-3 col-6 mb-3">
                	<div class="text-center rounded-circle round_box shadow bg-danger"  target="_blank">
                    	<div class="mt-2 text-uppercase text-center">
						
						<form id="frmpayment" name="frmpayment" action="ViewPayment.php" method="post">
                        	<input type="hidden" id="txtcollegeRollnoforPay" name="txtcollegeRollnoforPay" value="<?php echo $collegerollno?>" />
                        </form>
                        	<a class="text-white" href="javascript:void(0)" onclick="javascript: $('#frmpayment').submit();">
                            	<i class="fa fa-inr" style="font-size:28px"></i><br>Payment Detail
                            </a>
                        </div>
                    </div>
                </div>
				 
            </div>
        </div>
   
        <?php include("../footer.php");?>
    </div>	
    <?php include("../footer_includes.php");?>    
</body>
</html>
<script>
function goforAppPayslip(baseurl,paythrough){
	var actionurl="";
	 
	 if(paythrough=='AXIS') {
		actionurl=baseurl+"/Payment_Axis/print_application_slip.php"; 
	 }
	 else if(paythrough=='BILL DESK') {
		actionurl= baseurl+"/Payment_Billdesk/print_application_slip.php"; 
	 }
	 else if(paythrough=='HDFC') {
		actionurl= baseurl+"/Payment_HDFC/print_application_slip.php" ;
	 }
	 else {
		$("#msgcontent").html("There is some problem.");
		$("#ValidationAlert").modal(); 
		return false;
	 }
	 
	 $('#frmprintpayslip').attr('action', actionurl);
    $("#frmprintpayslip").submit(); 
	  
 }
 </script>
