<?php
include("sessionConfig.php");
include("../connection_CCF.php");
include("function.php");
include("../configuration_CCF.php");

$collegerollno = $_POST["txtrollno"]; 

include("Query_dashboard.php");

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
<?php include("head_includes.php");?>
</head>
<body>
<?php //if($record["coursesAplliedDetail"]!='Y') {?>
<style type="text/css">	
.footer{background:#039; padding:0; margin:0; width:100%}
@media only screen and (min-width: 1050px) {.footer{position:fixed; bottom:0; padding:0}}
</style>
<?php //}?>
    <?php include("candidate_dashboard_menu.php");?>
    
    <div id="content">
    	<?php include("header.php");?>
        <?php include("candidate_dashboard_menu2.php");?>
        
        <div class="pl-3 pr-3 pt-0">        
            <?php include("emergengy_notice_dashboard.php");?>
            
            <div class="row">
            	<div class="col-md-6 mb-3">
                	<table class="table table-bordered table-striped shadow">
                        <thead>
                            <tr>
                                <th colspan="4" scope="col" class="bg-secondary text-left text-light font-weight-normal"><i class="fa fa-user"></i> Candidate details</th>
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
                
                <div class="col-md-6 mb-3">
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
        </div>
        <?php include("footer.php");?>
    </div>	
    <?php include("footer_includes.php");?>    
</body>
</html> 
<script src="js/dashboard.js"></script> 