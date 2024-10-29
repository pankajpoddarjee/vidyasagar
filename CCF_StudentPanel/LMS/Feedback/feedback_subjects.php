<?php
include("../../sessionConfig.php");
include("../../../connection_CCF.php");
include("../../function.php");
include("../../../configuration_CCF.php");
include("feedbackfunction.php");
$subjects = getFeedbackSubjectCOP('subject');
$cops = getFeedbackSubjectCOP('cop');
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title>LMS - Feedback | New Subjects <?php echo COLLEGE_NAME; ?></title>
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
                            <i class="fa-solid fa-user-graduate"></i> Student Feedback on <span class="text-danger">New Subjects</span>
                        </h5>
                    </div>
                </div>
            </div>
            
            <div class="container mt-3 p-0">
            	<div class="row mb-2">
                    <div class="col-md-12">
                        <form action="" method="post" id="subject-feedback-form">
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
                                            <td class="align-middle">The college should introduce more new subjects (offered by the university)?</td>
                                            <td class="align-middle">
                                                <select id="introduce_new_suject" name="introduce_new_suject" class="custom-select" onchange="getsubject()">
                                                    <option value="" selected>Select</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr style="display:none" id="tr-subject_id">
                                            <td class="align-middle text-danger">1A.</td>
                                            <td class="align-middle text-danger">Which new subject from university curriculum the college should introduce?</td>
                                            <td class="align-middle">
                                                <select id="subject_id" name="subject_id" class="custom-select">
                                                    <option value="" selected>Select</option>
                                                    <?php if($subjects){
                                                    foreach ($subjects as $subject) { ?>
                                                    <option value="<?php echo $subject['id']; ?>"><?php echo $subject['name']; ?></option>
                                                    <?php  } } ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">2.</td>
                                            <td class="align-middle">The college should introduce more career oriented programmes?</td>
                                            <td class="align-middle">
                                                <select id="introduce_new_cop" name="introduce_new_cop" class="custom-select" onchange="getcop()">
                                                    <option value="" selected>Select</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr style="display:none" id="tr-cop_id">
                                            <td class="align-middle text-danger">2A.</td>
                                            <td class="align-middle text-danger">Which career oriented programmes do you think that the college should introduce?</td>
                                            <td class="align-middle">
                                                <select id="cop_id" name="cop_id" class="custom-select">
                                                    <option value="" selected>Select</option>
                                                    <?php if($cops){
                                                    foreach ($cops as $cop) { ?>
                                                    <option value="<?php echo $cop['id']; ?>"><?php echo $cop['name']; ?></option>
                                                    <?php  } } ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="text-center mt-3">
                                <input type="hidden" name="presentsemester" value="<?php echo $_SESSION["presentsemester"] ?>">
                                <input type="hidden" name="student_roll_number" value="<?php echo $_SESSION["studcollegeRollNo"] ?>">
                                <a class="btn btn-info" href="javascript:void(0)" id="subject-feedback-submit">
                                    <i class="fa-solid fa-clipboard-check"></i> Submit Feedback
                                </a>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>            
                    
        </div>
        <?php include("../../footer.php");?>
    </div>	
    <?php include("../../footer_includes.php");?>    
    <script src="../js/feedback_lms.js"></script>   
</body>
</html>