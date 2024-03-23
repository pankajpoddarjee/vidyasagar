<?php 
include("config.php");

$streamQry = $dbConn->prepare("select stream.stream_id,stream.stream_name,stream.stream_code,stream.is_active,course.course_name FROM LMS_stream_master as stream join LMS_course_master as course on course.course_id = stream.course_id order by course.course_name desc, stream.stream_name ASC");
$streamQry->execute();
$streamRecord = $streamQry->fetchAll(PDO::FETCH_ASSOC);

$courseQry = $dbConn->prepare("select * FROM LMS_course_master where is_active=1 order by course_name ASC");
$courseQry->execute();
$courseRecord = $courseQry->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | LMS | Stream Master</title>
<?php include("../../head_includes.php");?>
</head>
<body >
    <?php include("headermenu_lms.php");?>
    
    <div id="content">
    	<?php include("../../header.php");?>
        <?php include("../headermenu_top.php");?>
        
        <div class="container-fluid mt-4">
        	
            <div class="row p-0 m-0">
                <div class="col-md-8 border-bottom mb-3 text-left p-0">
                	<h5 class="sub_head">
                        <i class="fa-solid fa-book"></i> Stream <span class="text-danger">Master</span>
                    </h5>
                </div>
                
                <div class="col-md-4 border-bottom hide_border_bottom_mobile mb-3 text-right p-0">
                	<button class="btn btn-outline-danger btn-sm" id="open-add-stream-modal"><i class="fa-solid fa-book"></i> Add Stream</button>
                </div>
            </div>
            
        	<div class="row">
                <div class="col-md-12 text-center">
                    <div class="table-responsive">
                    <table class="table table-bordered nowrap" id="stream-table">
                        <thead>
                        <tr style="background:#f8fafd; color:#758289">
                            <th>Srl.</th>
                            <th>Course Name</th>
                            <th>Stream Name</th>
                            <th>Stream Code</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="stream-table-body">
                        <?php if($streamRecord){
                            $i=1;
                            foreach ($streamRecord as $value) {
                        ?>
                        <tr>
                            <td class="align-middle"><?php echo $i;?></td>
                            <td class="align-middle"><?php echo $value['course_name']; ?></td>
                            <td class="align-middle"><?php echo $value['stream_name']; ?></td>
                            <td class="align-middle"><?php echo $value['stream_code']; ?></td>
                            <td class="align-middle"><?php echo ($value['is_active']==1)?"<i class='fa-regular fa-circle-dot' style='color:#2ec900'></i> Active":"<i class='fa-regular fa-circle-dot' style='color:#c90020'></i> Inactive" ?></td>
                            <td>
                            <button class="btn btn-info open-edit-stream-modal" cid="<?php echo  $value['stream_id'];?>" data-toggle="tooltip" data-placement="top" title="Edit Stream">
                            	<i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button class="open-delete-stream-modal btn btn-<?php echo ($value['is_active']==1)?"success":"danger" ?>" status="<?php echo  $value['is_active'];?>" cid="<?php echo  $value['stream_id'];?>" data-toggle="tooltip" data-placement="top" title="Change Status">
								<i class="fa-solid fa-arrows-rotate"></i>
                            </button>
                            </td>
                        </tr>
                       <?php $i++; } } else{ ?>
                        <tr>
                            <td colspan="5">No Record Found</td>
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
    <div class="modal fade" id="add-edit-stream-modal" tabindex="-1" role="dialog" aria-labelledby="ValidationAlertTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" id="stream-form">
                    <div class="modal-header">
                        <h4 class="modal-title" id="stream-title" style="font-family:Oswald"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">                        
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label for="course_name">Select Course</label>
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
                                    <label for="course_name">Enter Stream Name</label>
                                    <input type="text" class="form-control" id="stream_name" name="stream_name" maxlength="20" autocomplete="off">
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="course_name">Enter Stream Code</label>
                                    <input type="text" class="form-control" id="stream_code" name="stream_code" maxlength="20" autocomplete="off">
                                </div>
                            </div>                                
                        </div>
                        <input type="hidden" id="stream_id" name="stream_id" class="form-control" value="">
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
    <div class="modal fade" id="delete-stream-modal" tabindex="-1" role="dialog" aria-labelledby="ValidationAlertTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" id="delete-stream-form">
                    <div class="modal-header">
                        <h4 class="modal-title" id="stream-title" style="font-family:Oswald"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                       <h5>Are you sure want to <strong id="active-inactive"></strong> this course ?</h5>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="delete_stream_id" name="delete_stream_id">
                        <input type="hidden" id="new_satus" name="new_satus">
                        <button type="button" id="delete-stream" class="btn btn-success btn-sm" data-dismiss="modal">Update</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--MODAL END-->    
	<script> 
        $(document).ready(function() {
            new DataTable('#stream-table', {
                
                layout: {
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                },
                
            });
        } );
        
        // OPEN MODAL FOR INSERT COURSE           
        $( "#open-add-stream-modal" ).on( "click", function() {
            $('#stream-form').trigger("reset");
            $("#stream-title").html("<i class='fa-solid fa-book text-danger'></i> Add Stream");
            $("#stream_name").val("");
            $("#stream_code").val("");
            $("#stream_id").val("");
            $("#course_id").val("");
            $('#add-edit-stream-modal').modal('show');
        } );
        // OPEN MODAL FOR Edit Stream 
        $('body').on('click','.open-edit-stream-modal',function(){
            $('#dvLoading').show();
            var stream_id = $(this).attr("cid");
            $.ajax({
                type:"POST",
                url:"getStream.php",
                dataType:"json",
                data:'stream_id='+stream_id,
                error:function(obj)
                {
                },
                success:function(obj)
                {
                    
                    if(obj.status==1){
                        $("#stream-title").html("<i class='fa-solid fa-book text-danger'></i> Edit Stream"); 
                        $("#stream_name").val(obj.data.stream_name); 
                        $("#stream_code").val(obj.data.stream_code); 
                        $("#stream_id").val(obj.data.stream_id);
                        $("#course_id").val(obj.data.course_id);
                        $('#add-edit-stream-modal').modal('show'); 
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
       // $( "#save-course" ).on( "click", function() { 
            
            if(!$.trim($("#course_id").val()).length) { // zero-length string AFTER a trim
                
                toastAlert({
                type: "error",
                title: "",
                message: "Please Select Course",
                buttonText: ""
                })
                return false;
            }
            if(!$.trim($("#stream_name").val()).length) { // zero-length string AFTER a trim                    
                toastAlert({
                type: "error",
                title: "",
                message: "Please enter Stream Name",
                buttonText: ""
                })
                return false;
            }
            if(!$.trim($("#stream_code").val()).length) { // zero-length string AFTER a trim
                
                toastAlert({
                type: "error",
                title: "",
                message: "Please enter Stream Code",
                buttonText: ""
                })
                return false;
            }
            
            $('#dvLoading').show();
            var data = $("#stream-form").serialize();
            $.ajax({
            type: "post",
            async: false,
            url: "saveStream.php", 
            data: data, 
            dataType: "json",
            
            success: function(data) { 
                
                if(data.status==1)
                { 
                    var html = '';
                    //html += '<table class="table table-bordered " id="stream-table"><tr><th>SL.</th><th>Course Name</th><th>Stream Name</th><th>Stream Code</th><th>Action</th></tr>';
                   
                    for (let i = 0; i < data.streamRecord.length; i++) {
                        var status = (data.streamRecord[i].is_active==1) ? "<i class='fa-regular fa-circle-dot' style='color:#2ec900'></i> Active" : "<i class='fa-regular fa-circle-dot' style='color:#c90020'></i> Inactive";
                        var status_class = (data.streamRecord[i].is_active==1) ? "success" : "danger";
                        html += '<tr><td class="align-middle">'+(i+1)+'</td><td class="align-middle">'+data.streamRecord[i].course_name+'</td><td class="align-middle">'+data.streamRecord[i].stream_name+'</td><td class="align-middle">'+data.streamRecord[i].stream_code+'</td><td class="align-middle">'+status+'</td><td class="align-middle"><button class="btn btn-info open-edit-stream-modal" cid="'+data.streamRecord[i].stream_id+'" data-toggle="tooltip" data-placement="top" title="Edit Stream"><i class="fa-solid fa-pen-to-square"></i></button> <button class="open-delete-stream-modal btn btn-'+status_class+'" status="'+data.streamRecord[i].is_active+'" cid="'+data.streamRecord[i].stream_id+'" data-toggle="tooltip" data-placement="top" title="Change Status"><i class="fa-solid fa-arrows-rotate"></i></button></td></tr>';
                    }
                    
                    //html += '</table>';
                    $('#stream-table-body').html(html);
                    $('#add-edit-stream-modal').modal('hide');
                    $("#stream-title").text("Add Stream"); 
                    $("#stream_name").val("");
                    $("#stream_id").val("");
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
        $('body').on('click','.open-delete-stream-modal',function(){
            var stream_id = $(this).attr("cid");
            var status = $(this).attr("status");
            var custom_status  = status;
            if(status == '1'){
                custom_status = "Inactive";
            }else{
                custom_status = "Active";
            }
            $('#delete_stream_id').val(stream_id);
            $('#active-inactive').text(custom_status);
            $('#new_satus').val(custom_status);
            //$('#delete-stream-modal').modal('show');
            toastAlert({
                type: "question",
                title: "Confirm Title",
                message: "Are you sure want to <strong>"+custom_status+"</strong> this stream ?",
                confirmText: "Yes",
                cancelText: "No"
            }).then((e)=>{
                if ( e == ("Thanks")){
            } else {
                var data = $("#delete-stream-form").serialize();
                $('#dvLoading').show();               
                $.ajax({
                type: "post",
                async: false,
                url: "deleteStream.php", 
                data: data, 
                dataType: "json",
                
                success: function(data) { 
                    
                    if(data.status==1)
                    { 
                        var html = '';
                        //html += '<table class="table table-bordered " id="stream-table"><tr><th>SL.</th><th>Course Name</th><th>Stream Name</th><th>Stream Code</th><th>Action</th></tr>';

                    
                        for (let i = 0; i < data.streamRecord.length; i++) {
                            var status = (data.streamRecord[i].is_active==1) ? "<i class='fa-regular fa-circle-dot' style='color:#2ec900'></i> Active" : "<i class='fa-regular fa-circle-dot' style='color:#c90020'></i> Inactive";
                            var status_class = (data.streamRecord[i].is_active==1) ? "success" : "danger";
                            html += '<tr><td class="align-middle">'+(i+1)+'</td><td class="align-middle">'+data.streamRecord[i].course_name+'</td><td class="align-middle">'+data.streamRecord[i].stream_name+'</td><td class="align-middle">'+data.streamRecord[i].stream_code+'</td><td class="align-middle">'+status+'</td><td class="align-middle"><button class="btn btn-info open-edit-stream-modal" cid="'+data.streamRecord[i].stream_id+'" data-toggle="tooltip" data-placement="top" title="Edit Course"><i class="fa-solid fa-pen-to-square"></i></button>&nbsp;<button class="open-delete-stream-modal btn btn-'+status_class+'" status="'+data.streamRecord[i].is_active+'" cid="'+data.streamRecord[i].stream_id+'" data-toggle="tooltip" data-placement="top" title="Change Status"><i class="fa-solid fa-arrows-rotate"></i></button></td></tr>';
                        }
                        
                        //html += '</table>';
                        $('#stream-table-body').html(html);
                        $('#delete-stream-modal').modal('hide');
                        $("#stream-title").text("Add Stream"); 
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

        // DELETE COURSE SCRIPT
        // $( "#delete-stream" ).on( "click", function() { 
           
        // } );

        $('#stream_name').on('keypress', function (event) {
            var regex = new RegExp("^[a-zA-Z ]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            /* $("#msgcontent").html(event.keyCode");
            $("#ValidationAlert").modal();  */
            if (!regex.test(key)) {
            event.preventDefault();
            return false;
            }
        });
        $('#stream_code').on('keypress', function (event) {
            var regex = new RegExp("^[a-zA-Z0-9 ]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
            event.preventDefault();
            return false;
            }
        });

        
    </script>
</body>
</html>
