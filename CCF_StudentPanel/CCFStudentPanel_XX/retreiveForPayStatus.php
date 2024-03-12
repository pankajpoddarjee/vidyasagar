<?php
include("../../connection.php");
include("function.php");
include("../../configuration.php");

  $deptqry = "select streamDisplay,streamType,subjectName, subjectcode from College_CourseMaster Where IsActive=1 ORDER BY  streamType desc,stream asc, subjectName asc;";
 

$deptresult = $dbConn2->query($deptqry);

if($deptresult) {
	while ($deptrow=$deptresult->fetch(PDO::FETCH_ASSOC)){
				 	
					$deptrecord[$deptrow["streamType"]][] = $deptrow["subjectcode"];
					$deptname[$deptrow["subjectcode"]] = $deptrow["subjectName"];
			}
}
$deptresult = NULL;

   $semesterqry = "select distinct semester from studentPaymentDetail WHERE  ltrim(rtrim(session))='".ACADEMIC_SESSION."' and  studentStatus=1;";
 

$semresult = $dbConn2->query($semesterqry);

if($semresult) {
	while ($semrow=$semresult->fetch(PDO::FETCH_ASSOC)){
				 	
					$semrecord[] = $semrow;
				 
			}
}
$semresult = NULL;
$dbConn = NULL;
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

<title>Check Payment Status - <?php echo COLLEGE_NAME;?></title>

<!-- FONT -->
<script type="text/javascript" src="js/jquery-1.5.1.js"></script>
<script type="text/javascript" src="js/formValidation.js"></script>
<script type="text/javascript" src="js/date.js"></script>
<script type="text/javascript">

function verifyInput()
	{
		if($.trim($("#choDept").val())=="")
		{
			alert("Select Department");
			$("#choDept").focus();
			return false;
		}
		if($.trim($("#choSemester").val())=="")
		{
			alert("Select Your Semester");
			$("#choSemester").focus();
			return false;
		}
		if($.trim($("#txtrollno").val())=="")
		{
			alert("Enter your Roll Number");
			$("#txtrollno").focus();
			return false;
		} 
		return true
	}
	
	 
</script>

    <!-- CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Poppins|Roboto" rel="stylesheet">
    <link href="bootstrap/css/animate.css" rel="stylesheet">
    <link href="bootstrap/css/bootsnav.css" rel="stylesheet">
    <link href="bootstrap/css/style.css" rel="stylesheet">
    <link href="bootstrap/css/media_query.css" rel="stylesheet">
    
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<?php include("header.php");?>

<section style="margin-top:25px">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
            
            	<p class="page_header">
                    Check Payment Status - <i class="fa fa-check-circle" style="color:#0C0"></i> | <i class="fa fa-times-circle" style="color:#F00"></i>
                </p>
                
                <div class="signIn_container">
                
                <h2 class="sign_in_heading welcomeUserIcon"><i class="fa fa-keyboard-o"></i> Enter details</h2>
                <FORM name="frm1" id="frm1" action="" method="post" onsubmit="return verifyInput();">
                
                	<div class="row" style="margin-bottom:15px">
            			<div class="col-md-6 col-sm-6">
                        	<strong>Select Department <span style="color:#F00">*</span></strong>
                        </div>
                        <div class="col-md-6 col-sm-6">
                        	<select id="choDept" name="choDept" class="form-control">
                                <option value="">-- Select --</option>
								
								<?php foreach($deptrecord as $deptkey=>$deptval) {?>
								<optgroup label="<?php echo $deptkey;?>">
								<?php foreach($deptrecord[$deptkey] as $subjectval) {?>
                                <option value="<?php echo $subjectval;?>"><?php echo $deptname[$subjectval];?></option>
								<?php }?>
								</optgroup> 
                                <?php }?>
                            </select>
                        </div>
                	</div>
                    
                    <div class="row" style="margin-bottom:15px">
            			<div class="col-md-6 col-sm-6">
                        	<strong>Select Present Semester <span style="color:#F00">*</span></strong>
                        </div>
                        <div class="col-md-6 col-sm-6">
                        	<select id="choSemester" name="choSemester" class="form-control">
                                <option value="">-- Select --</option>
                              <?php foreach($semrecord as $sem) { ?>
                                <option value="<?php echo $sem["semester"];?>">Semester <?php echo $sem["semester"];?></option>
								<?php }?>
                            </select>
                        </div>
                	</div>
                    
                    <div class="row" style="margin-bottom:15px">
            			<div class="col-md-6 col-sm-6">
                        	<strong>Enter Roll No. <span style="color:#F00">*</span></strong>
                        </div>
                        <div class="col-md-6 col-sm-6">
                        	<input size="24" type="text" name="txtrollno" maxlength="20" id="txtrollno" class="form-control" placeholder="EG: B.A/20/0003" style="color:#00F; text-transform:uppercase">
                        </div>
                	</div>
                    
                    <div class="row">
            			<div class=" col-lg-12 col-md-12 col-sm-12">                        	
                            <input name="retrieve" type="Button" title="Click Here to Submit" value="Submit" onClick="importdata()" class="btn btn-lg btn-primary btn-block submit_button">
                            <input id="btnreset" type="reset" title="Click Here to Reset Data" value="Reset" name="btnreset" class="btn btn-lg btn-primary btn-block reset_button">
                        </div>
                	</div>
                
                </FORM>
                </div>
            </div>
        </div>
    </div>
</section>

<form id="nextfrm" name="nextfrm" action="confirmSlip.php" method="post">
<input type="hidden" name="hdnrollno" id="hdnrollno" />
<input type="hidden" id="hdnsemester" name="hdnsemester"  />
<input type="hidden" id="hdndept" name="hdndept"  />
</form>

<?php include("footer.php");?>
 
<script>
function importdata()
{
 
	var parm = '';
	 
		if(!verifyInput())
		{
		return false	
		}
		parm =$("#frm1").serialize();

		$.ajax({
			type:"POST",
			url:"verifyForPayStatus.php",
			dataType:"json",
			data:parm,
			error:function(obj)
			{
				//alert(obj.status);
			},
			success:function(obj)
			{
			  //alert(JSON.stringify(obj))
			
				if(obj.status==0)
				{
					alert(obj.msg);
				}
				else 
				{
					
					
					$("#hdnrollno").val(obj.collegeRollNo);
					$("#hdnsemester").val(obj.semester);
					$("#hdndept").val(obj.dept);
 					$("#nextfrm").submit();
				}
			}	
		});
			 
  }
  

</script> 

 </body>
</html>
