<?php
include("sessionConfig.php");
include("../connection_CCF.php");
include("function.php");
include("../configuration_CCF.php");

$collegerollno = $_POST["txtrollno"];
 
  
  $fetchqry = "SELECT phase,lastDate,phaseStatus,case when phaseStatus='ON' and convert(varchar ,'".date('Y-m-d H:i' )."',120) Between convert(varchar, phaseStatusStartDate, 120) and convert(varchar, phaseStatusLastDate, 120) then 'allow' else 'notallow' end as  retrievestatus,convert(varchar, updateLastdate, 120) as updateLastdate FROM  PhaseStatus  ;";



$fetchresult = $dbConn->query($fetchqry);

if($fetchresult) {
	$fetchrow=$fetchresult->fetch(PDO::FETCH_ASSOC);
}

$fetchresult = NULL; 

$record = array();

  $qry	=	"select applicationNo,name,presentsemester from studentmaster st  where st.collegeRollNo='".$collegerollno."'";
 
 
$qryresult = $dbConn->query($qry);

if($qryresult) {
 	while($row=$qryresult->fetch(PDO::FETCH_ASSOC))
	{
		$record[] = $row;
	}
 }
 
 
 $qryresult = NULL;

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

<title>Candidate Dashboard - <?php echo COLLEGE_NAME;?></title>

<!-- FONT -->
<script type="text/javascript" src="js/jquery-1.5.1.js"></script>
<script type="text/javascript" src="js/formValidation.js"></script>
<script type="text/javascript" src="js/date.js"></script>
 

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

<?php include("topmenu.php");?>
 
<section style="margin-top:25px">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
            
            	<p class="page_header">
                     Candidate Dashboard
                </p>
                <form id="frmnext" name="frmnext" action="" method="post" >
					<input type="hidden" id="txtcollegerollno" name="txtcollegerollno"  value="<?php echo $collegerollno?>"/>
				</form>
                <div class="signIn_container">
                <a href="javascript: void(0);" onclick="gonextfor('paymentDetail')">Payments</a>
                </div>
            </div>
        </div>
    </div>
</section>
 

 

<?php include("footer.php");?>
 
 </body>
  <script src="js/dashboard.js"></script> 
</html>
