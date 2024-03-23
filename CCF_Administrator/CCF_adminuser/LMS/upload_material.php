<?php 
include("config.php");
include("lmsfunction.php");
$contentQry = $dbConn->prepare("select sc.content_id,sc.title,sc.content_type,sc.video_link,sc.document_path,sc.is_active,cm.course_name,stream.stream_name,dm.department_name,mm.material_name,ptm.paper_type_name,sm.semester_id FROM LMS_study_content as sc left join LMS_study_material as sm on sm.study_id = sc.study_id left join LMS_course_master as cm on sm.course_id = cm.course_id left join LMS_stream_master as stream on stream.stream_id = sm.stream_id
left join LMS_department_master as dm on dm.department_id = sm.department_id
left join LMS_material_master as mm on mm.material_id = sm.material_id
left join LMS_paper_type_master as ptm on ptm.paper_type_id = sm.paper_type_id
order by sc.content_id desc");
$contentQry->execute();
$contentRecord = $contentQry->fetchAll(PDO::FETCH_ASSOC);

$courseRecord = getCourseAllData();
$materialRecord = getMaterialAllData();
$paperTypeRecord = getPaperTypeAllData();
$semesterRecord = geAllSemester();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> |  List of Student Report</title>
<?php include("../../head_includes.php");?>
</head>
<body >
    <?php include("headermenu_lms.php");?>
    
    <div id="content">
    	<?php include("../../header.php");?>
        <?php include("../headermenu_top.php");?>
        
        <div class="container-fluid mt-4">
        	<div class="row ">
            	
            <div class="col-md-12 border-bottom mb-3 pb-2">
                <div class="row">
                    <div class="col-md-9">
                        <h5 class="text-danger ">
                            <i class="fa fa-bar-chart"></i> Study Material
                        </h5>
                    </div>
                    <div class="col-md-4 border-bottom hide_border_bottom_mobile mb-3 text-right p-0">
                        <button class="btn btn-outline-danger btn-sm" id="open-add-material-modal"><i class="fa-solid fa-user-graduate"></i> Add Material</button>
                    </div>
                </div>
                
            </div>

                <div class="col-md-12 text-center">                    
                    <div class="table-responsive" id="course-table">
                    <table class="table table-bordered " >
                        <tr>
                            <th>SL.</th>
                            <th>Course Name</th>
                            <th>Stream Name</th>
                            <th>Department Name</th>
                            <th>Material Type</th>
                            <th>Paper Type</th>
                            <th>Semester</th>
                            <th>Title</th>
                            <th>Content Type</th>
                            <th>URL</th>
                            <th>Action</th>
                        </tr>
                        <tbody id="material-table-body">
                        <?php if($contentRecord){
                            $i=1;
                            foreach ($contentRecord as $value) {
                        ?>
                        
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $value['course_name']; ?></td>  
                            <td><?php echo $value['stream_name']; ?></td> 
                            <td><?php echo $value['department_name']; ?></td> 
                            <td><?php echo $value['material_name']; ?></td>     
                            <td><?php echo $value['paper_type_name']; ?></td>     
                            <td><?php echo $value['semester_id']; ?></td> 
                            <td><?php echo $value['title']; ?></td> 
                            <td><?php echo $value['content_type']; ?></td>  
                            <?php if($value['content_type'] == 'video') { ?>
                            <td><a href="<?php echo $value['video_link']; ?>" target="_blank"><?php echo $value['video_link']; ?></a></td>   
                            <?php } else { ?>
                            <td><a href="<?php echo $value['document_path']; ?>" target="_blank"><?php echo $value['document_path']; ?></a></td>   
                            <?php } ?>
                                         
                            <td><button class="open-edit-material-modal "  cid="<?php echo  $value['content_id'];?>">Edit</button>&nbsp;<button class="open-delete-material-modal btn btn-<?php echo ($value['is_active']==1)?"success":"danger" ?>" status="<?php echo  $value['is_active'];?>" cid="<?php echo  $value['content_id'];?>" ><?php echo ($value['is_active']==1)?"Active":"Inactive" ?></button></td>
                        </tr>
                        <?php $i++; } } else{ ?>
                        <tr>
                            <td colspan="11">No Record Found</td>
                            
                        </tr>
                       <?php } ?>
                       </tbody>
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
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" id="material-form"  enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="material-title">Add Material</h5>
                    </div>
                    <div class="modal-body text-center">

                        <label for="course">Course Name</label>
                        <select name="course_id" id="course_id" class="form-control">
                            <option value="">Select Course</option>
                            <?php if($courseRecord){
                                foreach ($courseRecord as $course) { ?>
                                    <option value="<?php echo $course['course_id']; ?>"><?php echo $course['course_name']; ?></option>
                            <?php  } } ?>
                        </select>

                        <label for="course">Stream Name</label>
                        <select name="stream_id" id="stream_id" class="form-control">
                            <option value="">Select Stream</option>
                        </select>
                        
                        <label for="course">Department Name</label>
                        <select name="department_id" id="department_id" class="form-control">
                            <option value="">Select Department</option>
                        </select>

                        <label for="course">Material Type</label>
                        <select name="material_id" id="material_id" class="form-control">
                            <option value="">Select Material Type</option>
                            <?php if($materialRecord){
                                foreach ($materialRecord as $material) { ?>
                                    <option value="<?php echo $material['material_id']; ?>"><?php echo $material['material_name']; ?></option>
                            <?php  } } ?>
                        </select>

                        <label for="course">Paper Type</label>
                        <select name="paper_type_id" id="paper_type_id" class="form-control">
                            <option value="">Select Paper Type</option>
                            <?php if($paperTypeRecord){
                                foreach ($paperTypeRecord as $paper) { ?>
                                    <option value="<?php echo $paper['paper_type_id']; ?>"><?php echo $paper['paper_type_name']; ?></option>
                            <?php  } } ?>
                        </select>


                        <label for="course">Semester</label>
                        <select name="semester_id" id="semester_id" class="form-control">
                            <option value="">Select Semester</option>
                            <?php if($semesterRecord){
                                foreach ($semesterRecord as $key => $semester) { ?>
                                    <option value="<?php echo $key; ?>"><?php echo $semester; ?></option>
                            <?php  } } ?>
                        </select>

                        <div id="edit-content" style="display:none">
                        <label for="username">Title</label>
                        <input type="text" class="form-control" id="edit_content_title" name="edit_content_title" minlength="" maxlength="100" data-trigger="focus" placeholder="Enter Title" autocomplete="off">

                        <label for="username" id="content_of_material_font">Video</label>
                        <input type="text" class="form-control" id="edit_video_link" name="edit_video_link" minlength="" maxlength="" data-trigger="focus" placeholder="Enter Video Link" autocomplete="off" style="display:none">

                        
                        <input type="file" class="form-control" id="edit_document_path" name="edit_document_path"  autocomplete="off" style="display:none">
                        </div>
                        <div id="material-table">
                        <table class="table table-bordered mt-4" >
                            <tr>
                            <th>Content Type</th>
                            <th>Content Title</th>
                            <th>File</th>
                            <th>Action</th>
                            </tr>
                            <tbody id="myTable">
                            <tr id="row0">
                                <td id="td-material_type0">
                                <select name="material_type[]" mid="0"  id="material_type0" class="form-control upload-type" onchange="changeInput(this,'0')">
                                    <option value="">Select</option>
                                    <option value="doc">Document</option>
                                    <option value="video">Video</option>
                                </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        
                        <p class="text-right">
                            <a class="btn btn-info" href="javascript:void(0)" id="addRow"><i class="fa-solid fa-circle-plus"></i> Add New Row</a>
                        </p>
                        </div>
                    </div>
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
    <div class="modal fade" id="delete-stream-modal" tabindex="-1" role="dialog" aria-labelledby="ValidationAlertTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" id="delete-department-form">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="department-title">Update Course Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                       <h5>Are you sure want to <strong id="active-inactive"></strong> this department ?</h5>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="delete_department_id" name="delete_department_id">
                        <input type="hidden" id="new_satus" name="new_satus">
                        <button type="button" id="delete-stream" class="btn btn-success btn-sm" data-dismiss="modal">Update</button>
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
