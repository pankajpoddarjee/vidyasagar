<?php
include("connection.php");
include("function.php");
include("configuration.php");

$sqldb=mssql_select_db($dbname,$sqlconnect) or die("Couldn't open database");

  $fetchqry = "SELECT phase,lastDate,phaseStatus,case when phaseStatus='ON' and convert(varchar ,'".date('Y-m-d H:i' )."',120) Between convert(varchar, phaseStatusStartDate, 120) and convert(varchar, phaseStatusLastDate, 120) then 'allow' else 'notallow' end as  retrievestatus,convert(varchar, updateLastdate, 120) as updateLastdate FROM  PhaseStatus  ;";



$fetchresult = mssql_query($fetchqry);

if($fetchresult) {
	$fetchrow=mssql_fetch_array($fetchresult,$type);
}

  $deptqry = "select stream,CourseType, subject from subjectmaster Where activestatus=1 ORDER BY CourseType asc,stream asc, subject asc;";
 

$deptresult = mssql_query($deptqry);

if($deptresult) {
	while ($deptrow=mssql_fetch_array($deptresult,$type )){
				 	
					$deptrecord[$deptrow["stream"].' '.$deptrow["CourseType"]][] = $deptrow["subject"];
				 
			}
}


  $semesterqry = "select distinct semester from studentmaster WHERE  ltrim(rtrim(session))='".ACADEMIC_SESSION."' and  studentStatus=1;";
 

$semresult = mssql_query($semesterqry);

if($semresult) {
	while ($semrow=mssql_fetch_array($semresult,$type )){
				 	
					$semrecord[] = $semrow;
				 
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

<title>Online Fees Collection for UG Courses - <?php echo COLLEGE_NAME;?></title>

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
<?php if($fetchrow["retrievestatus"]=='allow') {?>
<section style="margin-top:25px">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
            
            	<p class="page_header">
                    <i class="fa fa-inr page_headerIcon"></i> UG Online Fee Payment
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
                                <option value="<?php echo $subjectval;?>"><?php echo $subjectval;?></option>
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
                    
                    <div class="row" style="margin-top:10px">
            			<div class=" col-lg-12 col-md-12 col-sm-12">                        	
                            <a href="retreiveForPayStatus.php" type="button" class="btn btn-block" style="background:#333; color:#FFF">Already Paid ? Click here to Retrieve</a>
                        </div>
                	</div>
                    
                    <div class="row" style="margin-top:10px">
            			<div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom:5px">                        	
                            <a href="Notice/BA(H)_General_Subject_for_SEM_II_2020_21.pdf" class="btn btn-danger btn-block" target="_blank">
                            	General Subjects BA Hons Sem II
                            </a>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">                        	
                            <a href="Notice/BSC(H)_General_Subject_for_SEM_II_2020_21.pdf" class="btn btn-danger btn-block" target="_blank">
                            	General Subjects BSC Hons Sem II
                            </a>
                        </div>
                	</div>
                
                </FORM>
                </div>
            </div>
        </div>
    </div>
</section>
 <?php } else {?>
	<div style="text-align:center; padding:75px 0; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#FF0000; text-transform:uppercase; line-height:30px; background:#FFFFFF">
	 <img src="alert.gif" /><br />
	Fee Payment Link is Presently Not Active.
	</div>
	<?php }?>
           

<form id="nextfrm" name="nextfrm" method="post">
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
			url:"verifyForRetreive.php",
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
					
					$("#nextfrm").attr('action',obj.url)
					$("#nextfrm").submit();
				}
			}	
		});
			 
  }
  

</script>
 

 </body>
</html>
