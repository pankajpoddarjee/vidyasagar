<?php 
include("config.php");

$courseQry = $dbConn->prepare("select * FROM LMS_course_master order by is_active desc, course_name desc");
$courseQry->execute();
$courseRecord = $courseQry->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | LMS | Course Master Creation</title>
<?php include("../../head_includes.php");?>
</head>
<body>
    <?php include("headermenu_lms.php");?>
    
    <div id="content">
    	<?php include("../../header.php");?>
        <?php include("../headermenu_top.php");?>
        
        <div class="container-fluid mt-4">
        	<!--<h5 class="border-bottom pb-1 sub_head">
                <i class="fa-solid fa-book-open"></i> Course <span class="text-danger">Master</span>
            </h5>-->
            <div class="row p-0 m-0">
                <div class="col-md-8 border-bottom mb-3 text-left p-0">
                	<h5 class="sub_head">
                        <i class="fa-solid fa-book-open"></i> Course <span class="text-danger">Master</span>
                    </h5>
                </div>
                
                <div class="col-md-4 border-bottom hide_border_bottom_mobile mb-3 text-right p-0">
                	<button class="btn btn-outline-danger" id="open-add-course-modal"><i class="fa-solid fa-file-circle-plus"></i> Add Course</button>
                </div>
            </div>
            
            <div class="row">
                <!--<div class="col-md-12 mb-3 text-right">
                	<button class="btn btn-outline-danger" id="open-add-course-modal"><i class="fa-solid fa-file-circle-plus"></i> Add Course</button>
                </div>-->
                
                <div class="col-md-12 text-center">                	
                    <div class="table-responsive">
                    <!--<table class="table table-bordered" id="table-for-filter">-->
                    
                   
                    
                    <table class="table table-bordered display nowrap" id="course-table">
                        <thead>
                            <tr style="background:#f8fafd; color:#758289; font-weight:normal; text-transform:uppercase">
                                <th>Srl.</th>
                                <th>Course Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="course-table-body">
                        <?php if($courseRecord){
                            $i=1;
                            foreach ($courseRecord as $value) {
                        ?>
                        <tr>
                            <td class="align-middle"><?php echo $i;?></td>
                            <td class="align-middle"><?php echo $value['course_name']; ?></td>
                            <td class="align-middle"><?php echo ($value['is_active']==1)?"<i class='fa-regular fa-circle-dot' style='color:#2ec900'></i> Active":"<i class='fa-regular fa-circle-dot' style='color:#c90020'></i> Inactive" ?></td>
                            <td class="align-middle text-nowrap">
                            <button class="btn btn-info open-edit-course-modal" cid="<?php echo $value['course_id'];?>" data-toggle="tooltip" data-placement="top" title="Edit Course">
                            	<i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            
                            <button class="open-delete-course-modal btn btn-<?php echo ($value['is_active']==1)?"success":"danger" ?>" status="<?php echo  $value['is_active'];?>" cid="<?php echo  $value['course_id'];?>" data-toggle="tooltip" data-placement="top" title="Change Status">
								<i class="fa-solid fa-arrows-rotate"></i>
								<?php /*?><?php echo ($value['is_active']==1)?"Active":"Inactive" ?><?php */?>
                            </button>
                            </td>
                        </tr>
                       <?php $i++; } } else{ ?>
                        <tr>
                            <td class="align-middle" colspan="4">No Record Found</td>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">
    
    
    <!--<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>-->
    <script type="text/javascript" src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>
        <script>
            $(document).ready(function() {
                //$('#course-table').DataTable();
                new DataTable('#course-table', {
                    
                    layout: {
                        dom: 'lBfrtip', 
                        
                        bottomStart: {
                            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                        },
                            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                       
                        
                    }
                });
            } );
            
        </script>
    
        <script> 
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
                            // $("#msgcontent").html(obj.msg);
                            // $("#ValidationAlert").modal();
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
                        var html = '';
                        //html += '<table class="table table-bordered " id="table-for-filter"><tr><th>SL.</th><th>Course Name</th><th>Action</th></tr>';

                        for (let i = 0; i < data.courseRecord.length; i++) {
                            var status = (data.courseRecord[i].is_active==1) ? "<i class='fa-regular fa-circle-dot' style='color:#2ec900'></i> Active" : "<i class='fa-regular fa-circle-dot' style='color:#c90020'></i> Inactive";
                            var status_class = (data.courseRecord[i].is_active==1) ? "success" : "danger";
                            html += '<tr><td class="align-middle">'+(i+1)+'</td><td class="align-middle">'+data.courseRecord[i].course_name+'</td><td class="align-middle">'+status+'</td><td class="align-middle"><button class="btn btn-info open-edit-course-modal" cid="'+data.courseRecord[i].course_id+'" data-toggle="tooltip" data-placement="top" title="Edit Course"><i class="fa-solid fa-pen-to-square"></i></button> <button class="open-delete-course-modal btn btn-'+status_class+'" status="'+data.courseRecord[i].is_active+'" cid="'+data.courseRecord[i].course_id+'" data-toggle="tooltip" data-placement="top" title="Change Status"><i class="fa-solid fa-arrows-rotate"></i></button></td></tr>';
                        }
                        
                        //html += '</table>';
                        $('#course-table-body').html(html);
                        $('#add-edit-course-modal').modal('hide');
                        //$('#successAlert').modal('show');
                        //$('#successMsgcontent').text(data.msg);
                        $("#course-title").text("Add Course"); 
                        $("#course_name").val("");
                        $("#course_id").val("");
						//$('#course-table').DataTable().ajax.reload();
                       // var table=('#course-table').DataTable();
                       // table.draw();

                        //$("#course-table").DataTable();
                        
                        $('#course-table').DataTable({ 
                            //"destroy": true, //use for reinitialize datatable
                            searching: true,
                            retrieve: true,
                            layout: {
                                topStart: {
                                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                                }
                            }
                        });
                        
                        // $('#course-table input').unbind().bind('keyup', function () {
                        //     table.search(this.value).draw();
                        // });

                        // if ($.fn.DataTable.isDataTable("#course-table")) {
                        // $('#course-table').DataTable().clear().destroy();
                        // }

                        $('#course-table-body').html(html);

                        
                        toastAlert({
                        type: "success",
                        title: "",
                        message: data.msg,
                        buttonText: ""
                        })
                    }
                    else
                    {
                        // $("#msgcontent").html(data.msg);
                        // $("#ValidationAlert").modal();
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
                //$('#delete-course-modal').modal('show');

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
                            // $("#msgcontent").html(data.msg);
                            // $("#ValidationAlert").modal();
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

            $('#course_name').on('keypress', function (event) {
                var regex = new RegExp("^[a-zA-Z ]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                /* $("#msgcontent").html(event.keyCode");
                $("#ValidationAlert").modal();  */
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });
            
        </script>
       <?php include_once("modals.php");?>
</body>
</html>
