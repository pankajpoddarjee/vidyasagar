<?php 
include("config.php");
include("lmsfunction.php");
// $contentQry = $dbConn->prepare("select sc.content_id,sc.title,sc.content_type,sc.video_link,sc.document_path,sc.is_active,cm.course_name,stream.stream_name,dm.department_name,mm.material_name,ptm.paper_type_name,sm.semester_id FROM LMS_study_content as sc left join LMS_study_material as sm on sm.study_id = sc.study_id left join LMS_course_master as cm on sm.course_id = cm.course_id left join LMS_stream_master as stream on stream.stream_id = sm.stream_id
// left join LMS_department_master as dm on dm.department_id = sm.department_id
// left join LMS_material_master as mm on mm.material_id = sm.material_id
// left join LMS_paper_type_master as ptm on ptm.paper_type_id = sm.paper_type_id
// order by sc.content_id desc");
// $contentQry->execute();
// $contentRecord = $contentQry->fetchAll(PDO::FETCH_ASSOC);

$courseRecord = getCourseAllData();
$materialRecord = getMaterialAllData();
$paperTypeRecord = getPaperTypeAllData();
$semesterRecord = geAllSemester();
$departmentRecord = getDepartmentAllData();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> | Upload Material</title>
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
                        <i class="fa-solid fa-file-arrow-up"></i> Upload <span class="text-danger">Material</span>
                    </h5>
                </div>
                
                <div class="col-md-4 border-bottom hide_border_bottom_mobile mb-3 text-right p-0">
                	<button class="btn btn-outline-danger btn-sm" id="open-add-material-modal"><i class="fa-solid fa-file-arrow-up"></i> Upload Material</button>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 text-center">                    
                    <div class="table-responsive">
                    <table class="table table-bordered" id="study-material-table">
                        <thead>
                            <tr style="background:#f8fafd; color:#758289">
                                <th class="align-middle">Srl.</th>
                                <th class="align-middle">Course</th>
                                <th class="align-middle">Stream</th>
                                <th class="align-middle">Department</th>
                                <th class="align-middle text-nowrap">Material Type</th>
                                <th class="align-middle text-nowrap">Paper Type</th>
                                <th class="align-middle">Semester</th>
                                <th class="align-middle">Title</th>
                                <th class="align-middle">Link</th>
                                <th class="align-middle">Action</th>
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
    <div class="modal fade" id="add-material-modal" tabindex="-1" role="dialog" aria-labelledby="ValidationAlertTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form method="post" id="material-form"  enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="material-title" style="font-family:Oswald"></h4>
                    </div>
                    <div class="modal-body">
                    
                    	<div class="row">
                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label for="department_id">Select Department</label>
                                    <select class="form-control" name="department_id" id="department_id" onchange="getSubject()">
                                        <option value="">Select</option>
                                        <?php if($departmentRecord){
                                        foreach ($departmentRecord as $department) { ?>
                                        <option value="<?php echo $department['department_id']; ?>"><?php echo $department['department_name']; ?></option>
                                        <?php  } } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label for="material_id">Select Material Type</label>
                                    <select class="form-control" name="material_id" id="material_id">
                                        <option value="">Select</option>
                                        <?php if($materialRecord){
											foreach ($materialRecord as $material) { ?>
												<option value="<?php echo $material['material_id']; ?>"><?php echo $material['material_name']; ?></option>
										<?php  } } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label for="paper_type_id">Select Paper Type</label>
                                    <select class="form-control" name="paper_type_id" id="paper_type_id" onChange="getSubject()">
                                        <option value="">Select</option>
                                        <?php if($paperTypeRecord){
											foreach ($paperTypeRecord as $paper) { ?>
												<option value="<?php echo $paper['paper_type_id']; ?>"><?php echo $paper['subpaper_type']; ?></option>
										<?php  } } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 mb-2" id="subject_id_div" style="display:none">
                                <div class="form-group">
                                    <label for="paper_type_id">Select Subject</label>
                                    <select class="form-control" name="subject_id" id="subject_id">
                                        
                                    </select>
                                </div>
                            </div>

                        	<div class="col-md-4 mb-2">
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
                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label for="stream_id">Select Stream</label>
                                    <select class="form-control multiple-select1" multiple="multiple" name="stream_id[]" id="stream_id">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label for="semester_id">Select Semester</label>
                                    <select class="form-control multiple-select1" multiple="multiple" name="semester_id[]" id="semester_id">
                                        <option value="">Select</option>
                                        <?php if($semesterRecord){
											foreach ($semesterRecord as $semester) { ?>
												<option value="<?php echo $semester; ?>"><?php echo $semester; ?></option>
										<?php  } } ?>
                                    </select>
                                </div>
                            </div> 
                            
                            <!-- <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label for="semester_id">Publish Date</label>
                                    <input type="date" id="publish_date" name="publish_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>  -->
                        </div>
                        
                        <!-- <div class="row" id="edit-content" style="display:none">
                        	<div class="col-md-12 mb-2">
                            	<div class="form-group">
                                    <input type="hidden" id="is_edit_mode" name="is_edit_mode" value="">
                                    <label for="edit_content_title">Content Title</label>
                                    <input type="text" class="form-control" id="edit_content_title" name="edit_content_title" minlength="1" maxlength="100" data-trigger="focus" placeholder="Enter Title" autocomplete="off">
                                </div>
                            </div>
                            
                            <div class="col-md-12 mb-2">
                            	<div class="form-group">
                                    <input type="hidden" id="pre_doc_val" name="pre_doc_val">
                                    <label for="edit_video_link" id="content_of_material_font">Video Link</label>
                                    <input type="text" class="form-control" id="edit_video_link" name="edit_video_link" minlength="" maxlength="" data-trigger="focus" placeholder="Enter Video Link" autocomplete="off" style="display:none">
                                </div>
                                <input type="file" class="form-control" id="edit_document_path" name="edit_document_path" multiple style="display:none">
                            </div>
                        </div>                         -->
                        
                        <div class="table-responsive" id="material-table">
                        <table class="table table-bordered text-nowrap" id="teacher-table">
                        	<thead>
                                <tr style="background:#f8fafd; color:#758289">
                                    <th class="align-middle">Content Type</th>
                                    <th class="align-middle">Content Title</th>
                                    <th class="align-middle">File/Link</th>
                                    <th class="align-middle">Publish Date</th>
                                    <th class="align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <tr id="row0">
                                    <td class="align-middle text-nowrap" id="td-material_type0">
                                        <select name="material_type[]" mid="0"  id="material_type0" class="form-control upload-type" onchange="changeInput(this,'0')">
                                            <option value="">Select</option>
                                            <option value="doc">Document</option>
                                            <option value="video">Video</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                        <p class="text-right mt-2" id="add-row-div">
                            <a class="btn btn-dark btn-sm" href="javascript:void(0)" id="addRow"><i class="fa-solid fa-circle-plus"></i> Add New Row</a>
                        </p>
                    </div>
                    <input type="hidden" id="is_edit_mode" name="is_edit_mode" value="">
                    <input type="hidden" id="study_id" name="study_id" class="form-control" value="">
                    <input type="hidden" id="content_id" name="content_id" class="form-control" value="">
                    <div class="modal-footer">
                        <button type="button" id="save-study-material" class="btn btn-success btn-sm" >Save</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--MODAL END--> 

    <!--MODAL START DELETE COURSE MASTER-->
    <div class="modal fade" id="delete-material-modal" tabindex="-1" role="dialog" aria-labelledby="ValidationAlertTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" id="delete-study-material-form">
                    <div class="modal-header">
                        <h4 class="modal-title" id="material-title" style="font-family:Oswald"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                       <h5>Are you sure want to <strong id="active-inactive"></strong> this study material ?</h5>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="delete_content_id" name="delete_content_id">
                        <input type="hidden" id="new_satus" name="new_satus">
                        <button type="button" id="delete-material" class="btn btn-success btn-sm" data-dismiss="modal">Update</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--MODAL END--> 
       <script src="upload_material.js"></script>
</body>
</html>
