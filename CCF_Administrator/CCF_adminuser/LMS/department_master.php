<?php 
include("config.php");
include("lmsfunction.php");
$departmentRecord = getDepartmentAllData();
$subjectRecord = getSubjectAllData();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | LMS | Department Master</title>
<?php include("../../head_includes.php");?>
<!-- <script src="js/multiselect/jquery.multiselect.js"></script>
<link rel="stylesheet" href="js/multiselect/jquery.multiselect.css"> -->

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
                        <i class="fa-solid fa-users"></i> Department <span class="text-danger">Master</span>
                    </h5>
                </div>
                
                <div class="col-md-4 border-bottom hide_border_bottom_mobile mb-3 text-right p-0">
                	<button class="btn btn-outline-danger btn-sm" id="open-add-department-modal"><i class="fa-solid fa-users"></i> Add Department</button>
                </div>
            </div>
        
        	<div class="row">
                <div class="col-md-12 text-center">                    
                    <div class="table-responsive">
                    <table class="table table-bordered nowrap" id="department-table">
                        <thead>
                        <tr style="background:#f8fafd; color:#758289">
                            <th>Srl.</th>
                            <th>Department Name</th>
                            <th>Status</th>
                            <th>Action</th>
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
    <!--MODAL START DEPARTMENT MASTER-->
    <div class="modal fade" id="add-edit-department-modal" tabindex="-1" role="dialog" aria-labelledby="ValidationAlertTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" id="department-form">
                    <div class="modal-header">
                        <h4 class="modal-title" id="department-title" style="font-family:Oswald"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label for="course_name">Enter Department Name</label>
                                    <input type="text" class="form-control" id="department_name" name="department_name" maxlength="60" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="department_id" name="department_id" class="form-control" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="save-department" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--MODAL END--> 

    <!--MODAL START DELETE DEPARTMENT MASTER-->
    <div class="modal fade" id="delete-department-modal" tabindex="-1" role="dialog" aria-labelledby="ValidationAlertTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" id="delete-department-form">
                    <div class="modal-header">
                        <h4 class="modal-title" id="department-title" style="font-family:Oswald"></h4>
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

    <!--MODAL ASSOCIATE SUBJECT -->
    <div class="modal fade" id="add-subject-modal" tabindex="-1" role="dialog" aria-labelledby="ValidationAlertTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" id="associate-subject-form">
                    <div class="modal-header">
                        <h4 class="modal-title" style="font-family:Oswald">Assign for <span class="text-primary" id="assign-for-subject"></span></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label for="course_name">Seletct Subject Name</label>
                                    <select class="form-control" name="subject_id[]" id="subject_id" multiple>
                                    
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="updateDepartment" value="updateDepartment">
                        <input type="hidden" name="department_id_for_subject" id="department_id_for_subject">
                        <button type="button" id="add-subject" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--MODAL END--> 

	<script> 
    
    $(document).ready(function() {
        //Initialize table
        var dataRecords = $('#department-table').DataTable({
            "lengthChange": false,
            "processing":true,
            "serverSide":true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',			
            "order":[],
            "ajax":{
                url:"list_ajax_action.php",
                type:"POST",
                data:{action:'listRecordsDepartment'},
                dataType:"json"
            },
            "columnDefs":[
                {
                    "targets":[0,1],
                    "orderable":false,
                },
            ],
            "pageLength": 10
            // "paging": true,
            // "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            
        });	

        // OPEN MODAL FOR INSERT COURSE           
        $( "#open-add-department-modal" ).on( "click", function() {
            $('#department-form').trigger("reset");
            $("#department-title").html("<i class='fa-solid fa-users text-danger'></i> Add Department");
            $("#department_name").val("");
            $("#stream_code").val("");
            $("#department_id").val("");
            $('#add-edit-department-modal').modal('show');
           
        } );

        // OPEN MODAL FOR edit Department 
        $('body').on('click','.open-edit-department-modal',function(){
            $('#dvLoading').show();
            var department_id = $(this).attr("cid");
            $.ajax({
                type:"POST",
                url:"getDepartment.php",
                dataType:"json",
                data:'department_id='+department_id,
                error:function(obj)
                {
                },
                success:function(obj)
                {
                    
                    if(obj.status==1){
                        $("#department-title").html("<i class='fa-solid fa-users text-danger'></i> Edit Department"); 
                        $("#department_name").val(obj.data.department_name); 
                        $("#department_id").val(obj.data.department_id);
                        $('#add-edit-department-modal').modal('show'); 
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
        $('body').on('click','#save-department',function(){

            if(!$.trim($("#department_name").val()).length) { // zero-length string AFTER a trim                    
                toastAlert({
                type: "error",
                title: "",
                message: "Please enter Department Name",
                buttonText: ""
                })
                return false;
            }
            
            $('#dvLoading').show();
            var data = $("#department-form").serialize();
            $.ajax({
            type: "post",
            async: false,
            url: "saveDepartment.php", 
            data: data, 
            dataType: "json",
            
            success: function(data) { 
                
                if(data.status==1)
                { 
                    //var html = '';
                    //html += '<table class="table table-bordered " id="department-table"><tr><th>SL.</th><th>Course Name</th><th>Department Name</th><th>Action</th></tr>';
                   
                    // for (let i = 0; i < data.departmentRecord.length; i++) {
                    //     var status = (data.departmentRecord[i].is_active==1) ? "<i class='fa-regular fa-circle-dot' style='color:#2ec900'></i> Active" : "<i class='fa-regular fa-circle-dot' style='color:#c90020'></i> Inactive";
                    //     var status_class = (data.departmentRecord[i].is_active==1) ? "success" : "danger";
                    //     html += '<tr><td class="align-middle">'+(i+1)+'</td><td class="align-middle">'+data.departmentRecord[i].course_name+'</td><td class="align-middle">'+data.departmentRecord[i].department_name+'</td><td class="align-middle">'+status+'</td><td class="align-middle"><button class="btn btn-info open-edit-department-modal" cid="'+data.departmentRecord[i].department_id+'" data-toggle="tooltip" data-placement="top" title="Edit Department"><i class="fa-solid fa-pen-to-square"></i></button> <button class="open-delete-department-modal btn btn-'+status_class+'" status="'+data.departmentRecord[i].is_active+'" cid="'+data.departmentRecord[i].department_id+'" data-toggle="tooltip" data-placement="top" title="Change Status"><i class="fa-solid fa-arrows-rotate"></i></button></td></tr>';
                    // }
                    
                    //html += '</table>';
                    dataRecords.ajax.reload();
                   // $('#department-table-body').html(html);
                    $('#add-edit-department-modal').modal('hide');
                    $("#department_name").val("");
                    $("#department_id").val("");
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
        $('body').on('click','.open-delete-department-modal',function(){
            var department_id = $(this).attr("cid");
            var status = $(this).attr("status");
            var custom_status  = status;
            if(status == '1'){
                custom_status = "Inactive";
            }else{
                custom_status = "Active";
            }
            $('#delete_department_id').val(department_id);
            $('#active-inactive').text(custom_status);
            $('#new_satus').val(custom_status);
           // $('#delete-department-modal').modal('show');
           toastAlert({
                type: "question",
                title: "Confirm Title",
                message: "Are you sure want to <strong>"+custom_status+"</strong> this department ?",
                confirmText: "Yes",
                cancelText: "No"
            }).then((e)=>{
                if ( e == ("Thanks")){
            } else {
                var data = $("#delete-department-form").serialize();
                $('#dvLoading').show();               
                $.ajax({
                type: "post",
                async: false,
                url: "deleteDepartment.php", 
                data: data, 
                dataType: "json",
                
                success: function(data) { 
                    
                    if(data.status==1)
                    { 
                       // var html = '';
                        //html += '<table class="table table-bordered " id="department-table"><tr><th>SL.</th><th>Course Name</th><th>Department Name</th><th>Action</th></tr>';
                    
                        // for (let i = 0; i < data.departmentRecord.length; i++) {
                        //     var status = (data.departmentRecord[i].is_active==1) ? "<i class='fa-regular fa-circle-dot' style='color:#2ec900'></i> Active" : "<i class='fa-regular fa-circle-dot' style='color:#c90020'></i> Inactive";
                        //     var status_class = (data.departmentRecord[i].is_active==1) ? "success" : "danger";
                        //     html += '<tr><td class="align-middle">'+(i+1)+'</td><td class="align-middle">'+data.departmentRecord[i].course_name+'</td><td class="align-middle">'+data.departmentRecord[i].department_name+'</td><td class="align-middle">'+status+'</td><td class="align-middle"><button class="btn btn-info open-edit-department-modal" cid="'+data.departmentRecord[i].department_id+'" data-toggle="tooltip" data-placement="top" title="Edit Department"><i class="fa-solid fa-pen-to-square"></i></button> <button class="open-delete-department-modal btn btn-'+status_class+'" status="'+data.departmentRecord[i].is_active+'" cid="'+data.departmentRecord[i].department_id+'" data-toggle="tooltip" data-placement="top" title="Change Status"><i class="fa-solid fa-arrows-rotate"></i></button></td></tr>';
                        // }
                        
                        //html += '</table>';
                        dataRecords.ajax.reload();
                        //$('#department-table-body').html(html);
                        $('#delete-department-modal').modal('hide');
                        $("#department-title").text("Add Department"); 

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
        });

    });
    
    // OPEN MODAL FOR ASSIGN SUBJECT TO DEPARTMENT 
    $('body').on('click','.open-assign-subject-modal',function(){
        $('#subject_id').html("");
        $('#subject_id').val("");
            $('#dvLoading').show();
            var department_id = $(this).attr("cid");
            var department_name_title = $(this).attr("dname");
			//console.log(department_name);
            var data = {action:'getAllSubject'};
            //alert(department_id);
            $.ajax({
                type:"POST",
                url:"getAllSubject.php",
                dataType:"json",
                data:data,
                error:function(data)
                {
                },
                success:function(data)
                {
                   
                    if(data.status==1){
                        var subject_selected = '';
                        html = '';
                        
                        for (let i = 0; i < data.subjectRecord.length; i++) {
                            //console.log(data.subjectRecord[i].department_id);
                            if(data.subjectRecord[i].department_id == department_id) {
                                subject_selected = "selected";
                            } else {
                                subject_selected = "";
                            } 
                            var department_name = '';
                            var subject_type = '';
                            if(data.subjectRecord[i].department_name){
                                department_name = ' ('+data.subjectRecord[i].department_name+')';
                            }
                            if(data.subjectRecord[i].SubjectType){
                                subject_type = '<span class="text-danger"> ('+data.subjectRecord[i].SubjectType+')</span>';
                            }
                            html += '<option value="' + data.subjectRecord[i].subject_id + '" '+subject_selected+'>' + data.subjectRecord[i].SubjectName_SDMS + subject_type + department_name +'</option>';
                        }

                        $('#subject_id').html(html);
                        $("#subject_id").multiselect('reload');
                        $('#subject_id').multiselect({
                            reload : true,
                            columns: 1,
                            texts: {
                                placeholder: 'Select Subject',
                                search     : 'Search Subject'
                            },
                            search: true,
                            selectAll: true
                        });
                        $('#department_id_for_subject').val(department_id);
                        $('#assign-for-subject').text(department_name_title);
                        $('#add-subject-modal').modal('show'); 
                    }
                    else
                    {
                        toastAlert({
                        type: "error",
                        title: "",
                        message: data.msg,
                        buttonText: ""
                        })
                        
                    }
                },
                complete: function(){
                    $('#dvLoading').hide();
                }	
                
            });
        }); 
        
        // UPDATE SUBJECT SCRIPT
        $('body').on('click','#add-subject',function(){

            if(!$.trim($("#subject_id").val()).length) { // zero-length string AFTER a trim                    
                toastAlert({
                type: "error",
                title: "",
                message: "Please Select Subject Name",
                buttonText: ""
                })
                return false;
            }

            $('#dvLoading').show();
            var data = $("#associate-subject-form").serialize();
            $.ajax({
            type: "post",
            async: false,
            url: "getAllSubject.php", 
            data: data, 
            dataType: "json",

            success: function(data) { 
                
                if(data.status==1)
                { 
                    $('#add-subject-modal').modal('hide');
                    $("#department_id_for_subject").val("");
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
        
        
        

        // DELETE COURSE SCRIPT
        // $( "#delete-stream" ).on( "click", function() { 
            
        // } );
        $('#department_name').on('keypress', function (event) {
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
</body>
</html>
