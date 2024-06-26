<?php 
include("config.php");

$courseQry = $dbConn->prepare("select * FROM LMS_course_master order by course_name ASC");
$courseQry->execute();
$courseRecord = $courseQry->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> |  List of Student Report</title>
<?php include("../../head_includes.php");?>
<style type="text/css">
.bg{background:#F5F7FA;}
.TF{background: rgb(205,0,122);
background: linear-gradient(130deg, rgba(205,0,122,0.5120259831460674) 0%, rgba(9,9,121,0.5682057584269663) 39%, rgba(0,212,255,0.1637113764044944) 100%);}
</style>
</head>
<body>
    <?php include("headermenu_lms.php");?>
    
    <div id="content" class="bg">
    	<?php include("../../header.php");?>
        <?php include("../headermenu_top.php");?>
        
        <div class="container">
        	<div class="row">
            	<div class="col-md-4 mb-3">
                	
                </div>
                
            	<div class="col-md-4 mb-3">
                	<div class="row">
                    	<div class="col-md-6">
                        	<div class="TF">
                                869<br>
                                Teacher Feedback
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                        	869<br>
                            Teacher Feedback
                        </div>
                    </div>
                </div>
                
            	<div class="col-md-4 mb-3">
                	
                </div>
            </div>
        </div>
        
        <?php include("../../footer.php");?>
    </div>	
    <?php include("../../footer_includes.php");?>   
    <!--MODAL START COURSE MASTER-->
    <div class="modal fade" id="add-edit-course-modal" tabindex="-1" role="dialog" aria-labelledby="ValidationAlertTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" id="course-form">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="course-title">Add Course</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <label for="course">Course Name</label>
                        <input type="text" id="course_name" name="course_name" class="form-control">
                        <input type="hidden" id="course_id" name="course_id" class="form-control" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="save-course" class="btn btn-success btn-sm" data-dismiss="modal">Save</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--MODAL END--> 

    <!--MODAL START DELETE COURSE MASTER-->
    <div class="modal fade" id="delete-course-modal" tabindex="-1" role="dialog" aria-labelledby="ValidationAlertTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" id="delete-course-form">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="course-title">Update Course Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                       <h5>Are you sure want to <strong id="active-inactive"></strong> this course ?</h5>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="delete_course_id" name="delete_course_id">
                        <input type="hidden" id="new_satus" name="new_satus">
                        <button type="button" id="delete-course" class="btn btn-success btn-sm" data-dismiss="modal">Update</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--MODAL END--> 

        <script> 
            // OPEN MODAL FOR INSERT COURSE           
            $( "#open-add-course-modal" ).on( "click", function() {
                $("#course-title").text("Add Course");
                $("#course_name").val("");
                $("#course_id").val("");
                $('#add-edit-course-modal').modal('show');
            } );
            // OPEN MODAL FOR EDIT COURSE 
            $('body').on('click','.open-edit-course-modal',function(){
                $('#dvLoading').show();
                var course_id = $(this).attr("cid");
                $.ajax({
                    type:"POST",
                    url:"getCourse.php",
                    dataType:"json",
                    data:'course_id='+course_id,
                    error:function(obj)
                    {
                    },
                    success:function(obj)
                    {
                        
                        if(obj.status==1){
                            $("#course-title").text("Edit Course"); 
                            $("#course_name").val(obj.data.course_name); 
                            $("#course_id").val(obj.data.course_id);
                            $('#add-edit-course-modal').modal('show'); 
                        }
                        else
                        {
                            $("#msgcontent").html(obj.msg);
                            $("#ValidationAlert").modal();
                            
                        }
                    },
                    complete: function(){
                        $('#dvLoading').hide();
                    }	
                    
                });
            });
            // INSERT AND UPDATE SCRIPT
            $('body').on('click','#save-course',function(){
           // $( "#save-course" ).on( "click", function() { 
                
                
                if(!$.trim($("#course_name").val()).length) { // zero-length string AFTER a trim
                    $('#add-edit-course-modal').modal('hide');
                    $("#msgcontent").html("Please enter course name");
                    $('#ValidationAlert').modal('show');
                    return false;
                }
                $('#dvLoading').show();
                var data = $("#course-form").serialize();
                $.ajax({
				type: "post",
				async: false,
				url: "saveCourse.php", 
				data: data, 
				dataType: "json",
				
				success: function(data) { 
                    
                    if(data.status==1)
                    { 
                        var html = '';
                        html += '<table class="table table-bordered " id="course-table"><tr><th>SL.</th><th>Course Name</th><th>Action</th></tr>';

                       
                        for (let i = 0; i < data.courseRecord.length; i++) {
                            var status = (data.courseRecord[i].is_active==1) ? "Active" : "Inactive";
                            var status_class = (data.courseRecord[i].is_active==1) ? "success" : "danger";
                            html += '<tr><td>'+(i+1)+'</td><td>'+data.courseRecord[i].course_name+'</td><td><button class="open-edit-course-modal" cid="'+data.courseRecord[i].course_id+'">Edit</button>&nbsp;<button class="open-delete-course-modal btn btn-'+status_class+'" status="'+data.courseRecord[i].is_active+'" cid="'+data.courseRecord[i].course_id+'" >'+status+'</button></td></tr>';
                        }
                        
                        html += '</table>';
                        $('#course-table').html(html);
                        $('#add-edit-course-modal').modal('hide');
                        $('#successAlert').modal('show');
                        $('#successMsgcontent').text(data.msg);
                        $("#course-title").text("Add Course"); 
                        $("#course_name").val("");
                        $("#course_id").val("");
                    }
                    else
                    {
                        $("#msgcontent").html(data.msg);
                        $("#ValidationAlert").modal();
                        return false;
                    }
					
				},
                complete: function(){
                    $('#dvLoading').hide();
                }
				});
            } );
            // OPEN MODAL FOR DELETE COURSE  
            $('body').on('click','.open-delete-course-modal',function(){
                var course_id = $(this).attr("cid");
                var status = $(this).attr("status");
                var custom_status  = status;
                if(status == '1'){
                    custom_status = "Inactive";
                }else{
                    custom_status = "Active";
                }
                $('#delete_course_id').val(course_id);
                $('#active-inactive').text(custom_status);
                $('#new_satus').val(custom_status);
                $('#delete-course-modal').modal('show');
            } );

            // DELETE COURSE SCRIPT
            $( "#delete-course" ).on( "click", function() { 
                var data = $("#delete-course-form").serialize();
                $('#dvLoading').show();               
                $.ajax({
				type: "post",
				async: false,
				url: "deleteCourse.php", 
				data: data, 
				dataType: "json",
				
				success: function(data) { 
                    
                    if(data.status==1)
                    { 
                        var html = '';
                        html += '<table class="table table-bordered " id="course-table"><tr><th>SL.</th><th>Course Name</th><th>Action</th></tr>';

                       
                        for (let i = 0; i < data.courseRecord.length; i++) {
                            var status = (data.courseRecord[i].is_active==1) ? "Active" : "Inactive";
                            var status_class = (data.courseRecord[i].is_active==1) ? "success" : "danger";
                            html += '<tr><td>'+(i+1)+'</td><td>'+data.courseRecord[i].course_name+'</td><td><button class="open-edit-course-modal" cid="'+data.courseRecord[i].course_id+'">Edit</button>&nbsp;<button class="open-delete-course-modal btn btn-'+status_class+'" status="'+data.courseRecord[i].is_active+'" cid="'+data.courseRecord[i].course_id+'" >'+status+'</button></td></tr>';
                        }
                        
                            html += '</table>';
                        $('#course-table').html(html);
                        $('#delete-course-modal').modal('hide');
                        $("#course-title").text("Add Course"); 
                        $('#successAlert').modal('show');
                        $('#successMsgcontent').text(data.msg);
                    }
                    else
                    {
                        $("#msgcontent").html(data.msg);
                        $("#ValidationAlert").modal();
                        return false;
                    }
					
				},
                complete: function(){
                    $('#dvLoading').hide();
                }
				});
            } );


            
        </script>
       <?php include_once("modals.php");?>
</body>
</html>
