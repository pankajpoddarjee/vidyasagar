<?php
include("../sessionConfig.php");
include("../../connection_CCF.php");
include("../function.php");
include("../../configuration_CCF.php");

//$collegerollno = $_POST["txtrollno"]; 
$collegerollno = $_SESSION["studcollegeRollNo"];

include("../Query_dashboard.php");

$qryresult = NULL;

$dbConn = NULL;

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title>Candidate Dashboard - <?php echo COLLEGE_NAME; ?></title>
<?php include("../head_includes.php");?>
</head>
<body>
<?php //if($record["coursesAplliedDetail"]!='Y') {?>
<style type="text/css">	
.footer{background:#039; padding:0; margin:0; width:100%}
@media only screen and (min-width: 1050px) {.footer{position:fixed; bottom:0; padding:0}}
</style>
<?php //}?>
    <?php include("lms_dashboard_menu.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("../candidate_dashboard_menu2.php");?>
        
        <div class="pl-3 pr-3 pt-0">        
            <?php include("../emergengy_notice_dashboard.php");?>
            
            <div class="row">
            	<div class="col-md-6 mb-3">
                	<table class="table table-bordered table-striped shadow">
                        <thead>
                            <tr>
                                <th colspan="4" scope="col" class="bg-secondary text-left text-light font-weight-normal"><i class="fa fa-user"></i> LMS Dashboard</th>
                            </tr>
                        </thead>
                       
                    </table>  
                </div>
                
               
            </div>            
        </div>
        <?php include("../footer.php");?>
    </div>	
    <?php include("../footer_includes.php");?>    
</body>
</html> 
<script src="js/dashboard_lms.js"></script> 