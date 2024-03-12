<?php
session_start();
 $_SESSION =array();
include("../connection.php");
include("function.php");
include("../configuration.php");
 

  $deptqry = "select streamDisplay,streamType,subjectName, subjectcode from College_CourseMaster Where IsActive=1 ORDER BY  streamType desc,stream asc, subjectName asc;";
 

$deptresult = $dbConn->query($deptqry);

if($deptresult) {
	while ($deptrow=$deptresult->fetch(PDO::FETCH_ASSOC)){
				 	
					$deptrecord[$deptrow["streamType"]][] = $deptrow["subjectcode"];
					$deptname[$deptrow["subjectcode"]] = $deptrow["subjectName"];
			}
}


$deptresult = NULL;

   $semesterqry = "select distinct presentsemester as semester from studentmaster WHERE   ISNULL(studentActiveStatus,0)=1;";
 

$semresult = $dbConn->query($semesterqry);

if($semresult) {
	while ($semrow=$semresult->fetch(PDO::FETCH_ASSOC)){
				 	
					$semrecord[] = $semrow;
				 
			}
}

$semresult = NULL;
$dbConn = NULL;


?>
<!DOCTYPE HTML>
 <html class="no-js" lang="de">  
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
		/* if($.trim($("#choSemester").val())=="")
		{
			alert("Select Your Semester");
			$("#choSemester").focus();
			return false;
		} */
		if($.trim($("#txtrollno").val())=="")
		{
			alert("Enter your Roll Number");
			$("#txtrollno").focus();
			return false;
		} 
		
		if($.trim($("#choDOBdd").val())=="" || $.trim($("#choDOBmm").val())=="" || $.trim($("#choDOByy").val())=="")
		{
			alert("Enter Date of Birth.");
			$("#choDOBdd").focus();
			return false;
			 
		}
		try
		{	
			Date.validateDay(parseInt($("#choDOBdd").val()),parseInt($("#choDOByy").val()),parseInt($("#choDOBmm").val())-1)
		}
		catch(e)
		{
			alert("Invalid Date of Birth.");
			$("#choDOBdd").focus();
			return false;
			 
		}
		return true
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

<?php include("header.php");?>
 
<section style="margin-top:25px">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
            
            	<p class="page_header">
                    <i class="fa fa-inr page_headerIcon"></i> Candidate Login
                </p>
                
                <div class="signIn_container">
                
                <h2 class="sign_in_heading welcomeUserIcon"><i class="fa fa-keyboard-o"></i> Enter details</h2>
                <FORM name="frmlogin" id="frmlogin" action="dashboard.php" method="post" onsubmit="return verifyInput();">
                
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
                    
                    <!--<div class="row" style="margin-bottom:15px">
            			<div class="col-md-6 col-sm-6">
                        	<strong>Select Present Semester <span style="color:#F00">*</span></strong>
                        </div>
                        <div class="col-md-6 col-sm-6">
                        	<select id="choSemester" name="choSemester" class="form-control">
                                <option value="">-- Select --</option>
								<?php //foreach($semrecord as $sem) { ?>
                                <option value="<?php //echo $sem["semester"];?>">Semester <?php //echo $sem["semester"];?></option>
								<?php //}?>
                            </select>
                        </div>
                	</div> -->
                    
                    <div class="row" style="margin-bottom:15px">
            			<div class="col-md-6 col-sm-6">
                        	<strong>Enter Roll No. <span style="color:#F00">*</span></strong>
                        </div>
                        <div class="col-md-6 col-sm-6">
                        	<input size="24" type="text" name="txtrollno" maxlength="20" id="txtrollno" class="form-control" placeholder="EG: B.A/20/0003" style="color:#00F; text-transform:uppercase">
                        </div>
                	</div>
					
					<div class="row" style="margin-bottom:15px">
            			<div class="col-md-6 col-sm-6">
                        	<strong>Date of Birth  <span style="color:#F00">*</span></strong>
                        </div>
						<div class="col-md-6 col-sm-6">
                                        <select id="choDOBdd" name="choDOBdd"  class="form-control">
                                            <option value="" selected>DD</option>
                                            <?php for($i=1; $i<=31; $i++) {?>
                                            <option value="<?php echo $i?>"><?php echo str_pad($i, 2, 0, STR_PAD_LEFT); ?></option>
                                            <?php }?>
                                        </select>
                                        <select id="choDOBmm" name="choDOBmm"  class="form-control">
                                            <option value="" selected>MM</option>
                                            <option value="1">Jan</option>
                                            <option value="2">Feb</option>
                                            <option value="3">Mar</option>
                                            <option value="4">Apr</option>
                                            <option value="5">May</option>
                                            <option value="6">Jun</option>
                                            <option value="7">Jul</option>
                                            <option value="8">Aug</option>
                                            <option value="9">Sep</option>
                                            <option value="10">Oct</option>
                                            <option value="11">Nov</option>
                                            <option value="12">Dec</option>
                                        </select>
                                        <select  id="choDOByy" name="choDOByy" class="form-control">
                                            <option value="" selected>YYYY</option>
											<?php
                                            for($i=DOBYEARFROM; $i<=DOBYEARTO; $i++){
                                            ?>
                                            <option value="<?php echo $i;?>" ><?php echo $i;?></option>
                                            <?php
                                            }
                                            ?>	
                                        </select>
                        
                	</div>
                    </div>
					
                    <div class="row">
            			<div class=" col-lg-12 col-md-12 col-sm-12">                        	
                            <input name="retrieve" type="Button" title="Click Here to Submit" value="Submit" onClick="importdata()" style="cursor:pointer; height: 32px; width: 100px;">
                            <input id="btnreset" type="reset" title="Click Here to Reset Data" value="Reset" name="btnreset" style="cursor:pointer; height: 32px; width: 100px;">
                        </div>
                	</div>
                    
                    <div class="row" style="margin-top:10px">
            			<div class=" col-lg-12 col-md-12 col-sm-12">                        	
                            <a href="retreiveForPayStatus.php" type="button" class="btn btn-block" style="background:#333; width: 200px; color:#FFF">Already Paid ? Click here to Retrieve</a>
                        </div>
                	</div>
                    
                    <div class="row" style="margin-top:10px">
            			<div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom:5px">                        	
                            <a href="Notice/BA(H)_General_Subject_for_SEM_II_2020_21.pdf" class="btn btn-danger btn-block" style=" width: 200px; " target="_blank">
                            	General Subjects BA Hons Sem II
                            </a>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">                        	
                            <a href="Notice/BSC(H)_General_Subject_for_SEM_II_2020_21.pdf" class="btn btn-danger btn-block"  style=" width: 200px; " target="_blank">
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
   
<?php include("footer.php");?>

<script>
function importdata()
{
 
	var parm = '';
	 
		if(!verifyInput())
		{
		return false	
		}
		parm =$("#frmlogin").serialize();

		$.ajax({
			type:"POST",
			url:"verifyForLogin.php",
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
					$("#frmlogin").submit();
				}
			}	
		});
			 
  }
  

</script>
 

 </body>
</html>
