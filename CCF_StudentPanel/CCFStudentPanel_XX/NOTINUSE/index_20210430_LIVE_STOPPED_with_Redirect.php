<?php
include("function.php");
include("configuration.php");
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
<meta http-equiv="refresh" content="0; URL='http://vec.collegeadmission.in/Fee_Collection_UG/retreive.php'" />

<title>UG Online Fees Collection - <?php echo COLLEGE_NAME;?></title>

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
                    <i class="fa fa-inr page_headerIcon"></i> Online Fee Payment
                </p>
                
               
                <br><br>
                
                
                	
                    <!--<p style="padding:5px; text-align:center; color:#C00; font-size:16px; font-weight:bold">
                    	B.A. / B.SC. / BBA / B.COM. Online Fees Submission for 2nd Semester<br>
                        will be available<br>
                        from 14<sup>th</sup> February 2019 (11:00 A.M.) to 22<sup>th</sup> February 2019 (03:00 P.M.)
                    </p>-->
                    
                
                
              
            </div>
        </div>
    </div>
</section>

<form id="nextfrm" name="nextfrm" method="post">
<input type="hidden" name="hdnrollno" id="hdnrollno" />
<input type="hidden" id="hdnsemester" name="hdnsemester"  />
<input type="hidden" id="hdndept" name="hdndept"  />
</form>



<br><br>

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
