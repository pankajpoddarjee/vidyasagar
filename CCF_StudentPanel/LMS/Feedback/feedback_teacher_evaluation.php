<?php
include("../../sessionConfig.php");
include("../../../connection_CCF.php");
include("../../function.php");
include("../../../configuration_CCF.php");
include("feedbackfunction.php");
$departmentRecord = getDepartmentAllData();
$questions = getFeedbackQuestions('LMS_feedback_teacher_questions');
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title>LMS - Feedback | Teacher Evaluation <?php echo COLLEGE_NAME; ?></title>
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
                            <i class="fa-solid fa-user-graduate"></i> Student Feedback on <span class="text-danger">Teacher Evaluation</span>
                        </h5>
                    </div>
                </div>
            </div>
            
            <div class="container mt-3 p-0">
            	<div class="row justify-content-center mb-2">
                    <div class="col-md-5">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Select Department <span class="text-danger">*</span></span>
                            </div>
                            <select id="department_id" name="department_id" onchange="getTeacher()" class="custom-select">
                                <option value="" selected>Select</option>
                                <?php if($departmentRecord){
                                foreach ($departmentRecord as $department) { ?>
                                <option value="<?php echo $department['department_id']; ?>"><?php echo $department['department_name']; ?></option>
                                <?php  } } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-5">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Select Teacher <span class="text-danger">*</span></span>
                            </div>
                            <select id="teacher_id" name="teacher_id" class="custom-select">
                                <option value="" selected>Select</option>
                                <option value="">Selected Dept. Teacher Names</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container mt-3 p-0">
            	<div class="row mb-2">
                    <div class="col-md-12">
                        <form id="teacher-feedback-form" action="" method="post" action="">
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
                                                <input type="hidden" name="teacher_question_id[]" value="<?php echo $question['id'];  ?>" qid="<?php echo $question['id'];  ?>" qtext="<?php echo $question['que'];  ?>">
                                                <select id="que<?php echo $question['id'];  ?>" name="que<?php echo $question['id'];  ?>" class="custom-select" >
                                                <option value="" selected>Select</option>
                                                <option value="5">Excellent</option>
                                                <option value="4">Very Good</option>
                                                <option value="3">Good</option>
                                                <option value="2">Average</option>
                                                <option value="1">Below Average</option>
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
                        	<a class="btn btn-info" href="javascript:void(0)" id="teacher-feedback-submit">
                                <i class="fa-solid fa-clipboard-check"></i> Submit Feedback
                            </a>
                            <!-- <input class="btn btn-info" type="submit" value="Submit Feedback"> -->
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