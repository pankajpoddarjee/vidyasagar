<?php
include "config.php";
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT; ?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | LMS | Course Master</title>
<?php include "../../head_includes.php"; ?>
</head>
<body>
    <?php include "headermenu_lms.php"; ?>
    
    <div id="content">
    	<?php include "../../header.php"; ?>
        <?php include "../headermenu_top.php"; ?>
        
        <div class="container-fluid mt-4">
            <div class="row p-0 m-0">
                <div class="col-md-8 border-bottom mb-3 text-left p-0">
                	<h5 class="sub_head">
                        <i class="fa-solid fa-book-open"></i> Course <span class="text-danger">Master</span>
                    </h5>
                </div>
                
                <div class="col-md-4 border-bottom hide_border_bottom_mobile mb-3 text-right p-0">
                	<button class="btn btn-outline-danger btn-sm" id="open-add-course-modal"><i class="fa-solid fa-file-circle-plus"></i> Add Course</button>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="table-responsive">
                    <table class="table table-bordered nowrap" id="course-table">
                        <thead>
                            <tr style="background:#f8fafd; color:#758289">
                                <th>Srl.</th>
                                <th>Course Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                       
                    </table>
                    </div>                    
					
                </div>
            </div>
        </div>
        <?php include "../../footer.php"; ?>
    </div>	
    <?php include "../../footer_includes.php"; ?>   
    <!--MODAL START COURSE MASTER-->
    <div class="modal fade" id="add-edit-course-modal" tabindex="-1" role="dialog" aria-labelledby="ValidationAlertTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" id="course-form">
                    <div class="modal-header p-2">
                        <h4 class="modal-title" id="course-title" style="font-family:Oswald"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="course">Course Name</label>
                            <input type="text" class="form-control" id="course_name" name="course_name" placeholder="Enter Course Name" autocomplete="off">
                            <input type="hidden" id="course_id" name="course_id" class="form-control" value="">
                            <!--<small id="emailHelp" class="form-text text-muted">..</small>-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="save-course" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
	
    $(document).ready(function() {
        //Initialize table
        var dataRecords = $('#course-table').DataTable({
            //"lengthChange": false,
            //"searching":false,
            //"processing":true,
            "serverSide":true,
            //'processing': true,
            'serverMethod': 'post',		
            "order":[],
            "ajax":{
                url:"list_ajax_action.php",
                type:"POST",
                data:{action:'listRecordsCourse'},
                dataType:"json"
            },
            "columnDefs":[
                {
                    "targets":[0],
                    "orderable":false,
                },
            ],
            "pageLength": 10,
            "paging": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            
        });	

        // OPEN MODAL FOR INSERT COURSE           
        $( "#open-add-course-modal" ).on( "click", function() {
            $('#course-form').trigger("reset");
            $("#course-title").html("<i class='fa-solid fa-file-circle-plus text-danger'></i> Add Course");
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
                        $("#course-title").html("<i class='fa-solid fa-pen-to-square text-danger'></i> Edit Course"); 
                        $("#course_name").val(obj.data.course_name); 
                        $("#course_id").val(obj.data.course_id);
                        $('#add-edit-course-modal').modal('show'); 
                    }
                    else
                    {
                        toastAlert({
                        type: "error",
                        title: "",
                        message: obj.msg,
                        buttonText: ""
                        })
                        
                    }
                },
                complete: function(){
                    $('#dvLoading').hide();
                }	
                
            });
        });
        
        // INSERT AND UPDATE SCRIPT
        $('body').on('click','#save-course',function(){
            if(!$.trim($("#course_name").val()).length) { // zero-length string AFTER a trim
            
                toastAlert({
                type: "error",
                title: "",
                message: "Please enter Course Name",
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
                   // var html = '';
                    //html += '<table class="table table-bordered " id="table-for-filter"><tr><th>SL.</th><th>Course Name</th><th>Action</th></tr>';

                    // for (let i = 0; i < data.courseRecord.length; i++) {
                    //     var status = (data.courseRecord[i].is_active==1) ? "<i class='fa-regular fa-circle-dot' style='color:#2ec900'></i> Active" : "<i class='fa-regular fa-circle-dot' style='color:#c90020'></i> Inactive";
                    //     var status_class = (data.courseRecord[i].is_active==1) ? "success" : "danger";
                    //     html += '<tr><td class="align-middle">'+(i+1)+'</td><td class="align-middle">'+data.courseRecord[i].course_name+'</td><td class="align-middle">'+status+'</td><td class="align-middle"><button class="btn btn-info open-edit-course-modal" cid="'+data.courseRecord[i].course_id+'" data-toggle="tooltip" data-placement="top" title="Edit Course"><i class="fa-solid fa-pen-to-square"></i></button> <button class="open-delete-course-modal btn btn-'+status_class+'" status="'+data.courseRecord[i].is_active+'" cid="'+data.courseRecord[i].course_id+'" data-toggle="tooltip" data-placement="top" title="Change Status"><i class="fa-solid fa-arrows-rotate"></i></button></td></tr>';
                    // }
                    
                    //html += '</table>';
                    // $('#course-table-body').html(html);
                    dataRecords.ajax.reload();
                    $('#add-edit-course-modal').modal('hide');
                    //$('#successAlert').modal('show');
                    //$('#successMsgcontent').text(data.msg);
                    $("#course-title").text("Add Course"); 
                    $("#course_name").val("");
                    $("#course_id").val("");
                
                    toastAlert({
                    type: "success",
                    title: "",
                    message: data.msg,
                    buttonText: ""
                    })
                }
                else
                {
                    toastAlert({
                    type: "error",
                    title: "",
                    message: data.msg,
                    buttonText: ""
                    })
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

            toastAlert({
                type: "question",
                title: "Confirm Title",
                message: "Are you sure want to <strong>"+custom_status+"</strong> this course?",
                confirmText: "Yes",
                cancelText: "No"
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
                            var status = (data.courseRecord[i].is_active==1) ? "<i class='fa-regular fa-circle-dot' style='color:#2ec900'></i> Active" : "<i class='fa-regular fa-circle-dot' style='color:#c90020'></i> Inactive";
                            var status_class = (data.courseRecord[i].is_active==1) ? "success" : "danger";
                            html += '<tr><td>'+(i+1)+'</td><td>'+data.courseRecord[i].course_name+'</td><td class="align-middle">'+status+'</td><td><button class="btn btn-info open-edit-course-modal" cid="'+data.courseRecord[i].course_id+'" data-toggle="tooltip" data-placement="top" title="Edit Course"><i class="fa-solid fa-pen-to-square"></i></button> <button class="open-delete-course-modal btn btn-'+status_class+'" status="'+data.courseRecord[i].is_active+'" cid="'+data.courseRecord[i].course_id+'" data-toggle="tooltip" data-placement="top" title="Change Status"><i class="fa-solid fa-arrows-rotate"></i></button></td></tr>';
                        }
                        
                        //html += '</table>';
                        //$('#course-table-body').html(html);
                        dataRecords.ajax.reload();
                        $('#delete-course-modal').modal('hide');
                        $("#course-title").text("Add Course"); 
                        
                    toastAlert({
                        type: "success",
                        title: "",
                        message: data.msg,
                        buttonText: ""
                        })
                    }
                    else
                    {
                        toastAlert({
                        type: "error",
                        title: "",
                        message: data.msg,
                        buttonText: ""
                        })
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

    } );  //document ready close brecket
		
        
        
        
        

        $('#course_name').on('keypress', function (event) {
            var regex = new RegExp("^[a-zA-Z ]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });
        
    </script>
</body>
</html>
