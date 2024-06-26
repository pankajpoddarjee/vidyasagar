<?php 
include("config.php");
include("lmsfunction.php");
// $is_hod = isset($_SESSION['is_hod'])?$_SESSION['is_hod']:"";
// $department_id = isset($_SESSION['department_id'])?$_SESSION['department_id']:"";
// $departmentSql = "";
// $departmentSql .= "select * FROM LMS_department_master where is_active=1";
// if($is_hod == 1 || (($_SESSION['usertype'] == 'teacher' && $_SESSION['is_hod'] == 0))){ 
//     $departmentSql .= " and department_id = $department_id";
// }
// $departmentQry = $dbConn->prepare($departmentSql);
// $departmentQry->execute();

// $teacherSql = "";
// $teacherSql .= "select teacher.teacher_id,teacher.teacher_name,teacher.email,teacher.mobile,teacher.designation,teacher.is_hod,teacher.is_active,course.course_name,dept.department_name FROM LMS_teacher_master as teacher LEFT JOIN LMS_course_master as course on course.course_id = teacher.course_id LEFT JOIN LMS_department_master as dept ON teacher.department_id = dept.department_id";

// if($is_hod == 1){
//     $teacherSql .= " where teacher.department_id = $department_id";
// }
// $teacherSql .= " order by course.course_name desc, dept.department_name ASC, teacher.teacher_name ASC";
// $teacherQry = $dbConn->prepare($teacherSql);
// $teacherQry->execute();
// $teacherRecord = $teacherQry->fetchAll(PDO::FETCH_ASSOC);
$courseRecord = getCourseAllData();
$departmentRecord = getDepartmentAllData();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | LMS | Teacher Master</title>
<?php include("../../head_includes.php");?>
</head>
<body>
    <?php include("headermenu_lms.php");?>
    
    <div id="content">
    	<?php include("../../header.php");?>
        <?php include("../headermenu_top.php");?>
        
        <div class="container-fluid mt-4">
        	<div class="row p-0 m-0">
                <div class="col-md-8 border-bottom mb-3 text-left p-0">
                	<h5 class="sub_head">
                        <i class="fa-solid fa-user-graduate"></i> Teacher <span class="text-danger">Master</span>
                    </h5>
                </div>
                
                <div class="col-md-4 border-bottom hide_border_bottom_mobile mb-3 text-right p-0">
                	<button class="btn btn-outline-danger btn-sm" id="open-add-teacher-modal"><i class="fa-solid fa-user-graduate"></i> Add Teacher</button>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 text-center">                    
                    <div class="table-responsive">
                    <table class="table table-bordered" id="teacher-table">
                        <thead>
                        <tr style="background:#f8fafd; color:#758289">
                            <th class="align-middle">Srl.</th>
                            <th class="align-middle">Teacher Name</th>
                            <th class="align-middle">Dept. Name</th>
                            <th class="align-middle">Course Name</th>
                            <th class="align-middle">Email</th>
                            <th class="align-middle">Mobile</th>
                            <th class="align-middle">Status</th>
                            <th class="align-middle text-nowrap">Action</th>
                        </tr>
                        </thead>
                    </table>                
                    </div>
                </div>
            </div>
        </div>
        <?php include("../../footer.php");?>
    </div>	
    <?php include("../../footer_includes.php");?>   
    <!--MODAL START STREAM MASTER-->
    <div class="modal fade" id="add-edit-teacher-modal" tabindex="-1" role="dialog" aria-labelledby="ValidationAlertTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" id="teacher-form">
                    <div class="modal-header">
                        <h4 class="modal-title" id="teacher-title" style="font-family:Oswald"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="course_id">Select Course</label>
                                    <select class="form-control" name="course_id" id="course_id">
                                        <option value="">Select</option>
                                        <?php if($courseRecord){
                                            foreach ($courseRecord as $course) { ?>
                                            <option value="<?php echo $course['course_id']; ?>"><?php echo $course['course_name']; ?></option>
                                        <?php  } } ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="department_id">Select Department</label>
                                    <select class="form-control" name="department_id" id="department_id">
                                    <option value="">Select</option>
                                    <?php if($departmentRecord){
                                        foreach ($departmentRecord as $department) { ?>
                                        <option value="<?php echo $department['department_id']; ?>"><?php echo $department['department_name']; ?></option>
                                    <?php  } } ?>
                                    
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label for="teacher_name">Teacher Name</label>
                                    <input type="text" class="form-control" id="teacher_name" name="teacher_name" maxlength="100" data-trigger="focus" placeholder="Enter Teacher Name" autocomplete="off">
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="email">Email Id.</label>
                                    <input type="text" class="form-control" id="email" name="email" maxlength="100" data-trigger="focus" placeholder="Enter Teacher Email" autocomplete="off">
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="mobile">Mobile No.</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" maxlength="10" data-trigger="focus" onKeyPress="inputNumber(event,this.value,false);" inputmode="numeric" placeholder="Enter Teacher Mobile No." autocomplete="off">
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="designation">Designation</label>
                                    <input type="text" class="form-control" id="designation" name="designation" maxlength="60" data-trigger="focus" placeholder="Enter Teacher Designation" autocomplete="off">
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="is_hod">Is HOD ?</label>
                                    <select class="form-control" name="is_hod" id="is_hod">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" minlength="6" maxlength="15" data-trigger="focus" placeholder="Enter Username" autocomplete="off">
                                    <span id="username_err" class="form-text mt-1"></span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group mb-2">
                                    	<input type="password" class="form-control" id="password" name="password" minlength="6" maxlength="15" data-trigger="focus" placeholder="Enter Password" autocomplete="off">
                                        <div class="input-group-append">
                                        	<span class="input-group-text">
                                            	<a href="javascript:void(0)" class="text-dark" data-toggle="tooltip" data-placement="top" title="Show / Hide Password">
                                                	<i id="pass-status" class="fa fa-eye" aria-hidden="true" onClick="viewPassword()"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <script>
								function viewPassword()
									{
									  var passwordInput = document.getElementById('password');
									  var passStatus = document.getElementById('pass-status');
									 
									  if (passwordInput.type == 'password'){
										passwordInput.type='text';
										passStatus.className='fa fa-eye-slash';
										
									  }
									  else{
										passwordInput.type='password';
										passStatus.className='fa fa-eye';
									  }
									}
								</script>
                                
                            </div>
                            <input type="hidden" id="teacher_id" name="teacher_id" class="form-control" value="">                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="save-teacher" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--MODAL END--> 

    <!--MODAL START DELETE COURSE MASTER-->
    <div class="modal fade" id="delete-teacher-modal" tabindex="-1" role="dialog" aria-labelledby="ValidationAlertTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" id="delete-teacher-form">
                    <div class="modal-header">
                        <h4 class="modal-title" id="teacher-title" style="font-family:Oswald"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                       <h5>Are you sure want to <strong id="active-inactive"></strong> this department ?</h5>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="delete_teacher_id" name="delete_teacher_id">
                        <input type="hidden" id="new_satus" name="new_satus">
                        <button type="button" id="delete-stream" class="btn btn-success btn-sm" data-dismiss="modal">Update</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--MODAL END-->     
   <script src="teacher.js"></script>


</body>
</html>
