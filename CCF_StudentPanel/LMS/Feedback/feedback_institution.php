<?php
include("../../sessionConfig.php");
include("../../../connection_CCF.php");
include("../../function.php");
include("../../../configuration_CCF.php");
include("feedbackfunction.php");
$questions = getFeedbackQuestions('LMS_feedback_college_questions');
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title>LMS - Feedback | College / Institution <?php echo COLLEGE_NAME; ?></title>
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
                            <i class="fa-solid fa-user-graduate"></i> Student Feedback on <span class="text-danger">College / Institution</span>
                        </h5>
                    </div>
                </div>
            </div>
            
            <div class="container mt-3 p-0">
            	<div class="row mb-2">
                    <div class="col-md-12">
                        <form action="" method="post" id="college-feedback-form">
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
                                        <?php 
                                        $i = 1;
                                        if($questions){
                                        foreach ($questions as $key => $question) { ?>
                                            <tr>
                                                <td class="align-middle"><?php echo $i ?>.</td>
                                                <td class="align-middle"><?php echo $question['que']; ?></td>
                                                <td class="align-middle">
                                                    <input type="hidden" name="college_question_id[]" value="<?php echo $question['id'];  ?>" qid="<?php echo $question['id'];  ?>" qtext="<?php echo $question['que'];  ?>">
                                                    <select id="que<?php echo $question['id'];  ?>" name="que<?php echo $question['id'];  ?>" class="custom-select" >
                                                    <option value="" selected>Select</option>
                                                    <option value="5">Very True</option>
                                                    <option value="4">True</option>
                                                    <option value="3">Sometimes True</option>
                                                    <option value="2">Not True</option>
                                                    <option value="1">No at all true</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        <?php $i++; } } ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="text-center mt-3">
                            <input type="hidden" name="presentsemester" value="<?php echo $_SESSION["presentsemester"] ?>">
                            <input type="hidden" name="student_roll_number" value="<?php echo $_SESSION["studcollegeRollNo"] ?>">
                                <a class="btn btn-info" href="javascript:void(0)" id="college-feedback-submit">
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