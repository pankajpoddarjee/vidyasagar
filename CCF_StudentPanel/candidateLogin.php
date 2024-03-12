<?php
session_start();
$_SESSION =array();
include("../connection_CCF.php");
include("function.php");
include("../configuration_CCF.php");
 
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
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | <?php echo SOFTWARE_NAMECODE; ?></title>
<?php include("head_includes.php");?>
<script type="text/javascript" src="js/date.js"></script>
<script type="text/javascript">
function verifyInput()
	{
		if($.trim($("#chocourseType").val())=="")
		{
			alert("Select Your Course Type.");
			$("#chocourseType").focus();
			return false;
		}  
		if($.trim($("#choDept").val())=="")
		{
			alert("Select Department");
			$("#choDept").focus();
			return false;
		}
		
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

</head>
<body class="parallax1">
	<?php include("header.php");?>
    <?php include("../menu.php");?>
    
<style type="text/css">	
/*.parallax1{position:relative;opacity:1;background-position:center;background-size:cover;background-repeat:no-repeat;background-attachment:fixed;}
.parallax1{background-image:url(../images/bg.jpg);min-height:82vh !important;}*/
.footer{background:#039; padding:0; margin:0; width:100%}
@media only screen and (min-width: 1050px) {.footer{position:fixed; bottom:0; padding:0}}
</style>
        
    <section style="margin:30px 0 0 0">
        <div class="container">
        	<div class="row">
            	<div class="col-md-12">
                	<h3 class="border-bottom"><i class="fa fa-user"></i> Student Login</h3>
                </div>
            </div>
            
            <FORM name="frmlogin" id="frmlogin" action="" method="post" onsubmit="return verifyInput();">
                <div class="row justify-content-center mt-4">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 mb-3">
                                <strong>Select Course Type <span style="color:#F00">*</span></strong>
                            </div>
                            <div class="col-md-8 col-sm-6 mb-3">
                                 <select id="chocourseType" name="chocourseType" class="form-control form-control-lg">
									<option value="">Select</option>
									<!--<option value="CBCS">CBCS</option>-->
									<option value="CCF">CCF</option>
								</select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-6 mb-3">
                                <strong>Select Department <span style="color:#F00">*</span></strong>
                            </div>
                            <div class="col-md-8 col-sm-6 mb-3">
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
                        <!--<div class="row">
                            <div class="col-md-4 col-sm-6 mb-3">
                                <strong>Select Present Semester <span style="color:#F00">*</span></strong>
                            </div>
                            <div class="col-md-8 col-sm-6 mb-3">
                                <select id="choSemester" name="choSemester" class="form-control">
                                    <option value="">-- Select --</option>
                                    <?php foreach($semrecord as $sem) { ?>
                                    <option value="<?php echo $sem["semester"];?>">Semester <?php echo $sem["semester"];?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-md-4 col-sm-6 mb-3">
                                <strong>Enter Roll No. <span style="color:#F00">*</span></strong>
                            </div>
                            <div class="col-md-8 col-sm-6 mb-3">
                                <input size="24" type="text" name="txtrollno" maxlength="20" id="txtrollno" class="form-control" placeholder="EG: B.A/20/0003" style="color:#00F; text-transform:uppercase">
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-4 col-sm-6 mb-3">
                                <strong>Date of Birth <span style="color:#F00">*</span></strong>
                            </div>
                            <div class="col-md-8 col-sm-6 mb-3">
                                <div class="input-group mb-3">
                                    <select id="choDOBdd" name="choDOBdd" class="custom-select">
                                        <option value="" selected>DD</option>
                                        <?php for($i=1; $i<=31; $i++) {?>
                                        <option value="<?php echo str_pad($i, 2, 0, STR_PAD_LEFT); ?>" ><?php echo str_pad($i, 2, 0, STR_PAD_LEFT); ?></option>
                                        <?php }?>
                                    </select>
                                    <select id="choDOBmm" name="choDOBmm"  class="custom-select">
                                        <option value="" selected>MM</option>
                                        <option value="01">Jan</option>
                                        <option value="02">Feb</option>
                                        <option value="03">Mar</option>
                                        <option value="04">Apr</option>
                                        <option value="05">May</option>
                                        <option value="06">Jun</option>
                                        <option value="07">Jul</option>
                                        <option value="08">Aug</option>
                                        <option value="09">Sep</option>
                                        <option value="10">Oct</option>
                                        <option value="11">Nov</option>
                                        <option value="12">Dec</option>
                                    </select>
                                    <select  id="choDOByy" name="choDOByy"  class="custom-select">
                                        <option value="" selected>YYYY</option>
                                        <?php for($d=DOBYEARFROM; $d<=DOBYEARTO; $d++) {?>
                                        <option value="<?php echo $d;?>"><?php echo $d;?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                            
                <div class="row justify-content-center mt-3">
                    <div class="col-md-12 text-center">                        	
                        <button class="btn btn-success" name="retrieve" type="Button" onClick="importdata()"><i class="fa fa-sign-in"></i> Sign-In</button>
                        <button class="btn btn-danger" id="btnreset" type="reset" name="btnreset"><i class="fa fa-times-circle-o"></i> Reset</button>
                    </div>
                </div>
                            
            </FORM>
        </div>
    </section>
	 
	<?php include("footer.php");?>
    <?php include("footer_includes.php");?>
</body>
</html>
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
				$("#frmlogin").attr('action',obj.actionUrl);
				$("#frmlogin").submit();
			}
		}	
	});
		 
}
</script>