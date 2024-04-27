<?php
include("../../sessionConfig.php");
include("../../../connection_CCF.php");
include("../../function.php");
include("../../../configuration_CCF.php");
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title>LMS - Feedback | Library <?php echo COLLEGE_NAME; ?></title>
<?php include("../../head_includes.php");?>
<style type="text/css">
table tbody tr:hover{background:rgba(153,153,0,0.1) !important; transition:all 350ms; color:#F36 !important}
</style>
</head>
<body>

    <?php include("feedback_dashboard_menu.php");?>
    
    <div id="content">
    	<?php include("../../header.php");?>
        <?php include("../../candidate_dashboard_menu2.php");?>
        
        <div class="pl-3 pr-3 pt-0">
            <?php include("../../emergengy_notice_dashboard.php");?>
            
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-12 border-bottom mb-3 text-left p-0">
                        <h5 class="sub_head">
                            <i class="fa-solid fa-user-graduate"></i> Student Feedback on <span class="text-danger">Library</span>
                        </h5>
                    </div>
                </div>
            </div>
            
            <div class="container mt-3 p-0">
            	<div class="row mb-2">
                    <div class="col-md-12">
                    	<div class="table-responsive">                        	
                            <table class="table table-bordered table-hover">
                                <thead class="bg-light font-weight-bold">
                                    <tr>
                                        <td class="align-middle">Srl.</td>
                                        <td class="align-middle">Feedback Matter</td>
                                        <td class="align-middle">Feedback Value</td>
                                    </tr>
                                </thead>
                                <tbody style="font-family:Viga; font-size:14px">
                                    <tr>
                                        <td class="align-middle">1.</td>
                                        <td class="align-middle">Sufficient reading materials are available in the Library</td>
                                        <td class="align-middle">
                                            <select id="XXXXXXXXX" name="XXXXXXXXX" class="custom-select">
                                                <option value="" selected>Select</option>
                                                <option value="Totally Agree">Totally Agree</option>
                                                <option value="Sometimes Agree">Sometimes Agree</option>
                                                <option value="Cannot Say">Cannot Say</option>
                                                <option value="Disagree">Disagree</option>
                                                <option value="Totally Disagree">Totally Disagree</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">2.</td>
                                        <td class="align-middle">Library orientation programme is very helpful and informative</td>
                                        <td class="align-middle">
                                            <select id="XXXXXXXXX" name="XXXXXXXXX" class="custom-select">
                                                <option value="" selected>Select</option>
                                                <option value="Totally Agree">Totally Agree</option>
                                                <option value="Sometimes Agree">Sometimes Agree</option>
                                                <option value="Cannot Say">Cannot Say</option>
                                                <option value="Disagree">Disagree</option>
                                                <option value="Totally Disagree">Totally Disagree</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">3.</td>
                                        <td class="align-middle">Library rules are properly explained</td>
                                        <td class="align-middle">
                                            <select id="XXXXXXXXX" name="XXXXXXXXX" class="custom-select">
                                                <option value="" selected>Select</option>
                                                <option value="Totally Agree">Totally Agree</option>
                                                <option value="Sometimes Agree">Sometimes Agree</option>
                                                <option value="Cannot Say">Cannot Say</option>
                                                <option value="Disagree">Disagree</option>
                                                <option value="Totally Disagree">Totally Disagree</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">4.</td>
                                        <td class="align-middle">Book drop Box service is very useful and new to us</td>
                                        <td class="align-middle">
                                            <select id="XXXXXXXXX" name="XXXXXXXXX" class="custom-select">
                                                <option value="" selected>Select</option>
                                                <option value="Totally Agree">Totally Agree</option>
                                                <option value="Sometimes Agree">Sometimes Agree</option>
                                                <option value="Cannot Say">Cannot Say</option>
                                                <option value="Disagree">Disagree</option>
                                                <option value="Totally Disagree">Totally Disagree</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">5.</td>
                                        <td class="align-middle">One touch Library access mobile app is very useful and helpful Library service</td>
                                        <td class="align-middle">
                                            <select id="XXXXXXXXX" name="XXXXXXXXX" class="custom-select">
                                                <option value="" selected>Select</option>
                                                <option value="Totally Agree">Totally Agree</option>
                                                <option value="Sometimes Agree">Sometimes Agree</option>
                                                <option value="Cannot Say">Cannot Say</option>
                                                <option value="Disagree">Disagree</option>
                                                <option value="Totally Disagree">Totally Disagree</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">6.</td>
                                        <td class="align-middle">Place Hold Book Reservation in OPAC is very helpful service</td>
                                        <td class="align-middle">
                                            <select id="XXXXXXXXX" name="XXXXXXXXX" class="custom-select">
                                                <option value="" selected>Select</option>
                                                <option value="Totally Agree">Totally Agree</option>
                                                <option value="Sometimes Agree">Sometimes Agree</option>
                                                <option value="Cannot Say">Cannot Say</option>
                                                <option value="Disagree">Disagree</option>
                                                <option value="Totally Disagree">Totally Disagree</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">7.</td>
                                        <td class="align-middle">Overdue SMS is good technique to avoid fine</td>
                                        <td class="align-middle">
                                            <select id="XXXXXXXXX" name="XXXXXXXXX" class="custom-select">
                                                <option value="" selected>Select</option>
                                                <option value="Totally Agree">Totally Agree</option>
                                                <option value="Sometimes Agree">Sometimes Agree</option>
                                                <option value="Cannot Say">Cannot Say</option>
                                                <option value="Disagree">Disagree</option>
                                                <option value="Totally Disagree">Totally Disagree</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">8.</td>
                                        <td class="align-middle">Library staff are very co-operative</td>
                                        <td class="align-middle">
                                            <select id="XXXXXXXXX" name="XXXXXXXXX" class="custom-select">
                                                <option value="" selected>Select</option>
                                                <option value="Totally Agree">Totally Agree</option>
                                                <option value="Sometimes Agree">Sometimes Agree</option>
                                                <option value="Cannot Say">Cannot Say</option>
                                                <option value="Disagree">Disagree</option>
                                                <option value="Totally Disagree">Totally Disagree</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">9.</td>
                                        <td class="align-middle">Repository is useful to get old questions and syllabus</td>
                                        <td class="align-middle">
                                            <select id="XXXXXXXXX" name="XXXXXXXXX" class="custom-select">
                                                <option value="" selected>Select</option>
                                                <option value="Totally Agree">Totally Agree</option>
                                                <option value="Sometimes Agree">Sometimes Agree</option>
                                                <option value="Cannot Say">Cannot Say</option>
                                                <option value="Disagree">Disagree</option>
                                                <option value="Totally Disagree">Totally Disagree</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">10.</td>
                                        <td class="align-middle">E-resources from NLIST and NDL are very much helpful</td>
                                        <td class="align-middle">
                                            <select id="XXXXXXXXX" name="XXXXXXXXX" class="custom-select">
                                                <option value="" selected>Select</option>
                                                <option value="Totally Agree">Totally Agree</option>
                                                <option value="Sometimes Agree">Sometimes Agree</option>
                                                <option value="Cannot Say">Cannot Say</option>
                                                <option value="Disagree">Disagree</option>
                                                <option value="Totally Disagree">Totally Disagree</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="text-center mt-3">
                        	<a class="btn btn-info" href="javascript:void(0)">
                                <i class="fa-solid fa-clipboard-check"></i> Submit Feedback
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>            
                    
        </div>
        <?php include("../../footer.php");?>
    </div>	
    <?php include("../../footer_includes.php");?>    
</body>
</html>