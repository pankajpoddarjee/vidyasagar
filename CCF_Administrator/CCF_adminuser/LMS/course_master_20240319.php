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
                            <i class="fa fa-bar-chart"></i> Course Master
                        </h5>
                    </div>
                    <div class="col-md-3 text-right">
                    <button class="btn btn-outline-danger" id="open-add-course-modal">Add Course</button>
                    </div>
                </div>
                
            </div>

                <div class="col-md-12 text-center">                    
                    <div class="table-responsive" >
                    <table class="table table-bordered " id="table-for-filter">
                        <tr>
                            <th>SL.</th>
                            <th>Course Name</th>
                            <th>Action</th>
                        </tr>
                        <tbody id="course-table">
                        <?php if($courseRecord){
                            $i=1;
                            foreach ($courseRecord as $value) {
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $value['course_name']; ?></td>                            
                            <td><button class="open-edit-course-modal "  cid="<?php echo  $value['course_id'];?>">Edit</button>&nbsp;
                            <button class="open-delete-course-modal btn btn-<?php echo ($value['is_active']==1)?"success":"danger" ?>" status="<?php echo  $value['is_active'];?>" cid="<?php echo  $value['course_id'];?>" ><?php echo ($value['is_active']==1)?"Active":"Inactive" ?></button></td>
                        </tr>
                       <?php $i++; } } else{ ?>
                        <tr>
                            <td colspan="3">No Record Found</td>
                            
                        </tr>
                       <?php } ?>
                       <tbody>
                    </table>
                
                    </div>                    
					
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
                        <button type="button" id="save-course" class="btn btn-success btn-sm" >Save</button>
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
                   
                    toastAlert({
                    type: "error",
                    title: "",
                    message: "Please enter course name",
                    buttonText: ""
                    })
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
                        //html += '<table class="table table-bordered " id="table-for-filter"><tr><th>SL.</th><th>Course Name</th><th>Action</th></tr>';

                       
                        for (let i = 0; i < data.courseRecord.length; i++) {
                            var status = (data.courseRecord[i].is_active==1) ? "Active" : "Inactive";
                            var status_class = (data.courseRecord[i].is_active==1) ? "success" : "danger";
                            html += '<tr><td>'+(i+1)+'</td><td>'+data.courseRecord[i].course_name+'</td><td><button class="open-edit-course-modal" cid="'+data.courseRecord[i].course_id+'">Edit</button>&nbsp;<button class="open-delete-course-modal btn btn-'+status_class+'" status="'+data.courseRecord[i].is_active+'" cid="'+data.courseRecord[i].course_id+'" >'+status+'</button></td></tr>';
                        }
                        
                        html += '</table>';
                        $('#course-table').html(html);
                        $('#add-edit-course-modal').modal('hide');
                        //$('#successAlert').modal('show');
                        //$('#successMsgcontent').text(data.msg);
                        $("#course-title").text("Add Course"); 
                        $("#course_name").val("");
                        $("#course_id").val("");

                        var table_filter_Props = {
                            col_0: "select",
                            col_1: "select",
                            col_2: "select",
                            col_3: "select",
                            col_4: "select",
                            col_5: "select",
                            col_6: "select",
                            col_7: "select",
                            col_8: "select",
                            col_9: "select",
                            col_10: "select",
                            col_11: "select",
                            col_12: "select",
                            col_13: "select",
                            col_14: "select",
                            col_15: "select",
                            col_16: "select",
                            display_all_text: "All",
                            sort_select: true
                        };
                        setFilterGrid("table-for-filter", table_filter_Props);
                        toastAlert({
                        type: "success",
                        title: "",
                        message: data.msg,
                        buttonText: ""
                        })
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
                //$('#delete-course-modal').modal('show');

                toastAlert({
                    type: "question",
                    title: "Confirm Title",
                    message: "Are you sure want to <strong>"+custom_status+"</strong> this course ?",
                    confirmText: "Okay",
                    cancelText: "Cancel"
                }).then((e)=>{
                    if ( e == ("Thanks")){
                } else {
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
                            //html += '<table class="table table-bordered " id="table-for-filter"><tr><th>SL.</th><th>Course Name</th><th>Action</th></tr>';

                        
                            for (let i = 0; i < data.courseRecord.length; i++) {
                                var status = (data.courseRecord[i].is_active==1) ? "Active" : "Inactive";
                                var status_class = (data.courseRecord[i].is_active==1) ? "success" : "danger";
                                html += '<tr><td>'+(i+1)+'</td><td>'+data.courseRecord[i].course_name+'</td><td><button class="open-edit-course-modal" cid="'+data.courseRecord[i].course_id+'">Edit</button>&nbsp;<button class="open-delete-course-modal btn btn-'+status_class+'" status="'+data.courseRecord[i].is_active+'" cid="'+data.courseRecord[i].course_id+'" >'+status+'</button></td></tr>';
                            }
                            
                            html += '</table>';
                            $('#course-table').html(html);
                            $('#delete-course-modal').modal('hide');
                            $("#course-title").text("Add Course"); 
                        // $('#successAlert').modal('show');
                        // $('#successMsgcontent').text(data.msg);
                        toastAlert({
                            type: "success",
                            title: "",
                            message: data.msg,
                            buttonText: ""
                            })
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
                }
                })
            } );

            // DELETE COURSE SCRIPT
            // $( "#delete-course" ).on( "click", function() { 
                
                
            // } );


            
        </script>
       <?php include_once("modals.php");?>
</body>
</html>
