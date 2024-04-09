$(document).ready(function() {
    //Initialize table
    var dataRecords = $('#teacher-table').DataTable({
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
            data:{action:'listRecordsTeacher'},
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
    $("#open-add-teacher-modal").on("click", function () {
        $('#teacher-form').trigger("reset");
        $("#teacher-title").html("<i class='fa-solid fa-user-graduate text-danger'></i> Add Teacher");
        $("#teacher_name").val("");
        $("#teacher_id").val("");
        //$("#department_id").val("");
        $("#course_id").val("");
        $("#username").removeAttr("disabled");
        resetCheckUserNameMsg();
        $('#add-edit-teacher-modal').modal('show');
    });

    // OPEN MODAL FOR edit Teacher 
    $('body').on('click', '.open-edit-teacher-modal', function () {
        $('#dvLoading').show();
        resetCheckUserNameMsg();
        //$('#course_id').trigger('change');
        var teacher_id = $(this).attr("cid");
        $.ajax({
            type: "POST",
            url: "getTeacher.php",
            dataType: "json",
            data: 'teacher_id=' + teacher_id,
            error: function (obj) {
            },
            success: function (obj) {

                if (obj.status == 1) {
                    // var html = '';
                    // for (let i = 0; i < obj.departmentRecord.length; i++) {
                    //     html += '<option value="' + obj.departmentRecord[i].department_id + '">' + obj.departmentRecord[i].department_name + '</option>';
                    // }
                    // $('#department_id').html(html);

                    $("#teacher-title").html("<i class='fa-solid fa-user-graduate text-danger'></i> Edit Teacher");
                    $("#teacher_name").val(obj.data.teacher_name);
                    $("#teacher_id").val(obj.data.teacher_id);
                    $("#department_id").val(obj.data.department_id);
                    $("#course_id").val(obj.data.course_id);
                    $("#email").val(obj.data.email);
                    $("#mobile").val(obj.data.mobile);
                    $("#designation").val(obj.data.designation);
                    $("#is_hod").val(obj.data.is_hod);
                    $("#username").val(obj.data.username);
                    $("#username").attr("disabled", 'disabled');
                    $("#password").val(obj.data.password);
                    $('#add-edit-teacher-modal').modal('show');

                }
                else {
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
            complete: function () {
                $('#dvLoading').hide();
            }

        });
    });

    // INSERT AND UPDATE SCRIPT
    $('body').on('click', '#save-teacher', function () {
        if (!verifyInput()) {
            return false;
        }

        $('#dvLoading').show();
        var data = $("#teacher-form").serialize();
        $.ajax({
            type: "post",
            async: false,
            url: "saveTeacher.php",
            data: data,
            dataType: "json",

            success: function (data) {

                if (data.status == 1) {
                   // var html = '';
                    //html += '<table class="table table-bordered " id="teacher-table"><tr><th>SL.</th> <th>Course Name</th> <th>Dept. Name</th> <th>Teacher Name</th> <th>Email</th> <th>Mobile</th> <th>Role</th> <th>Action</th></tr>';

                    // for (let i = 0; i < data.teacherRecord.length; i++) {
                    //     var status = (data.teacherRecord[i].is_active == 1) ? "<i class='fa-regular fa-circle-dot' style='color:#2ec900'></i> Active" : "<i class='fa-regular fa-circle-dot' style='color:#c90020'></i> Inactive";
                    //     var status_class = (data.teacherRecord[i].is_active == 1) ? "success" : "danger";
                    //     var is_hod = (data.teacherRecord[i].is_hod == 1) ? "<i class='fa-solid fa-user-graduate' data-toggle='tooltip' data-placement='top' title='(HOD)'></i>" : "";
                    //     html += '<tr><td class="align-middle">' + (i + 1) + '</td><td class="align-middle text-left text-nowrap"><a class="d-flex align-items-center avatar_link" href="javascript:void(0)"><div class="flex-shrink-0"><div class="avatar avatar-initials avatar-circle"><span class="text-uppercase">'+data.teacherRecord[i].teacher_name.charAt(0)+'</span></div></div><div class="flex-grow-1 ml-2"><span class="text-inherit mb-0">' + data.teacherRecord[i].teacher_name + '<sup> '+ is_hod +'</sup></span></div></a></td><td class="align-middle">' + data.teacherRecord[i].course_name + '</td><td class="align-middle">' + data.teacherRecord[i].department_name + '</td><td class="align-middle">' + data.teacherRecord[i].email + '</td><td class="align-middle">' + data.teacherRecord[i].mobile + '</td><td class="align-middle">'+status+'</td><td class="align-middle text-nowrap"><button class="btn btn-info open-edit-teacher-modal" cid="' + data.teacherRecord[i].teacher_id + '" data-toggle="tooltip" data-placement="top" title="Edit Teacher"><i class="fa-solid fa-pen-to-square"></i></button>&nbsp;<button class="open-delete-teacher-modal btn btn-' + status_class + '" status="' + data.teacherRecord[i].is_active + '" cid="' + data.teacherRecord[i].teacher_id + '" data-toggle="tooltip" data-placement="top" title="Change Status"><i class="fa-solid fa-arrows-rotate"></i></button></td></tr>';
                    // }

                    //html += '</table>';
                    dataRecords.ajax.reload();
                    //$('#teacher-table-body').html(html);
                    $('#add-edit-teacher-modal').modal('hide');
                    $("#teacher-title").text("Add Teacher");
                    $("#teacher_name").val("");
                    $("#teacher_id").val("");
                    $('#teacher-form')[0].reset();
                   // $('#department_id').html("");

                    toastAlert({
                        type: "success",
                        title: "",
                        message: data.msg,
                        buttonText: ""
                    })
                }
                else {
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
            complete: function () {
                $('#dvLoading').hide();
            }
        });
    });


    // OPEN MODAL FOR DELETE COURSE  
    $('body').on('click', '.open-delete-teacher-modal', function () {
        var teacher_id = $(this).attr("cid");
        var status = $(this).attr("status");
        var custom_status = status;
        if (status == '1') {
            custom_status = "Inactive";
        } else {
            custom_status = "Active";
        }
        $('#delete_teacher_id').val(teacher_id);
        $('#active-inactive').text(custom_status);
        $('#new_satus').val(custom_status);
        //$('#delete-teacher-modal').modal('show');
        
        toastAlert({
            type: "question",
            title: "Confirm Title",
            message: "Are you sure want to <strong>" + custom_status + "</strong> this teacher ?",
            confirmText: "Yes",
            cancelText: "No"
        }).then((e) => {
            if (e == ("Thanks")) {
            } else {
                var data = $("#delete-teacher-form").serialize();
                $('#dvLoading').show();
                $.ajax({
                    type: "post",
                    async: false,
                    url: "deleteTeacher.php",
                    data: data,
                    dataType: "json",

                    success: function (data) {

                        if (data.status == 1) {
                           // var html = '';
                            //html += '<table class="table table-bordered " id="teacher-table"><tr><th>SL.</th> <th>Course Name</th> <th>Dept. Name</th> <th>Teacher Name</th> <th>Email</th> <th>Mobile</th> <th>Role</th> <th>Action</th></tr>';


                        //     for (let i = 0; i < data.teacherRecord.length; i++) {
                        //         var status = (data.teacherRecord[i].is_active == 1) ? "<i class='fa-regular fa-circle-dot' style='color:#2ec900'></i> Active" : "<i class='fa-regular fa-circle-dot' style='color:#c90020'></i> Inactive";
                        // var status_class = (data.teacherRecord[i].is_active == 1) ? "success" : "danger";
                        // var is_hod = (data.teacherRecord[i].is_hod == 1) ? "<i class='fa-solid fa-user-graduate' data-toggle='tooltip' data-placement='top' title='(HOD)'></i>" : "";
                        //         html += '<tr><td class="align-middle">' + (i + 1) + '</td><td class="align-middle text-left text-nowrap"><a class="d-flex align-items-center avatar_link" href="javascript:void(0)"><div class="flex-shrink-0"><div class="avatar avatar-initials avatar-circle"><span class="text-uppercase">'+data.teacherRecord[i].teacher_name.charAt(0)+'</span></div></div><div class="flex-grow-1 ml-2"><span class="text-inherit mb-0">' + data.teacherRecord[i].teacher_name + '<sup> '+ is_hod +'</sup></span></div></a></td><td class="align-middle">' + data.teacherRecord[i].course_name + '</td><td class="align-middle">' + data.teacherRecord[i].department_name + '</td><td class="align-middle">' + data.teacherRecord[i].email + '</td><td class="align-middle">' + data.teacherRecord[i].mobile + '</td><td class="align-middle">'+status+'</td><td class="align-middle text-nowrap"><button class="btn btn-info open-edit-teacher-modal" cid="' + data.teacherRecord[i].teacher_id + '" data-toggle="tooltip" data-placement="top" title="Edit Teacher"><i class="fa-solid fa-pen-to-square"></i></button>&nbsp;<button class="open-delete-teacher-modal btn btn-' + status_class + '" status="' + data.teacherRecord[i].is_active + '" cid="' + data.teacherRecord[i].teacher_id + '" data-toggle="tooltip" data-placement="top" title="Change Status"><i class="fa-solid fa-arrows-rotate"></i></button></td></tr>';
                        //     }

                            //html += '</table>';
                            dataRecords.ajax.reload();
                           // $('#teacher-table-body').html(html);
                            $('#delete-teacher-modal').modal('hide');
                            $("#teacher-title").text("Add Teacher");
                            toastAlert({
                                type: "success",
                                title: "",
                                message: data.msg,
                                buttonText: ""
                            })
                        }
                        else {
                            toastAlert({
                            type: "error",
                            title: "",
                            message: data.msg,
                            buttonText: ""
                            })
                            return false;
                        }

                    },
                    complete: function () {
                        $('#dvLoading').hide();
                    }
                });
            }
        })
    });

    function resetCheckUserNameMsg() {
        $('#username_err').text('');
    }
    
    function verifyInput() {
        if (!$.trim($("#course_id").val()).length) { // zero-length string AFTER a trim
            $("#course_id").focus();
            toastAlert({
                type: "error",
                title: "",
                message: "Please select Course",
                buttonText: ""
            })
            return false;
        }
        if (!$.trim($("#department_id").val()).length) { // zero-length string AFTER a trim
            $("#department_id").focus();
            toastAlert({
                type: "error",
                title: "",
                message: "Please select Department",
                buttonText: ""
            })
            return false;
        }
        if (!$.trim($("#teacher_name").val()).length) { // zero-length string AFTER a trim
            $("#teacher_name").focus();
            toastAlert({
                type: "error",
                title: "",
                message: "Please enter Teacher Name",
                buttonText: ""
            })
            return false;
        }
    
        if ($.trim($("#email").val()) == "") {
            $("#email").focus();
            toastAlert({
                type: "error",
                title: "",
                message: "Please enter Teacher Email Id.",
                buttonText: ""
            })
            return false;
        }
        else {
    
            var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
            if (!filter.test($.trim($("#email").val()))) {
                $("#email").focus();
                toastAlert({
                    type: "error",
                    title: "",
                    message: "Please enter a valid Email Id.",
                    buttonText: ""
                })
                return false;
            }
        }
        if ($.trim($("#mobile").val()) == "") { // zero-length string AFTER a trim
            $("#mobile").focus();
            toastAlert({
                type: "error",
                title: "",
                message: "Please enter Teacher Mobile Number",
                buttonText: ""
            })
            return false;
        }
    
        if ($.trim($("#mobile").val()) != "") {
            var mobno = $("#mobile").val().replaceAll(/\s/g, '');
            if (mobno.length != 10) {
    
                $("#mobile").focus();
                toastAlert({
                    type: "error",
                    title: "",
                    message: "Please enter a valid Mobile Number",
                    buttonText: ""
                })
                return false;
            }
    
        }
    
        if ($.trim($("#username").val()) == "") {
            $("#username").focus();
            toastAlert({
                type: "error",
                title: "",
                message: "Enter Login Username",
                buttonText: ""
            })
            return false;
        }
        else if ($.trim($("#username").val()).length < 6) {
            $("#username").focus();
            toastAlert({
                type: "error",
                title: "",
                message: "Username length must be of 6-15 characters",
                buttonText: ""
            })
            return false;
        }
    
    
        if ($.trim($("#password").val()) == "") {
            $("#password").focus();
            toastAlert({
                type: "error",
                title: "",
                message: "Enter Login Password",
                buttonText: ""
            })
            return false;
        }
        else if ($.trim($("#password").val()).length < 6) {
            $("#password").focus();
            toastAlert({
                type: "error",
                title: "",
                message: "Password length must be of 6-15 characters",
                buttonText: ""
            })
            return false;
        }
        
        return true;
    }
    
    function inputNumber(e, val, allowdecimal) {
    
        var key = (window.event) ? event.keyCode : e.charCode || 0;
    
        if (allowdecimal == true) {
            if (key == 0 || key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57)) {
                if (key == 46) {
                    if (val.indexOf(".") != -1) {
                        if (window.event) {
                            event.returnValue = false
                        }
                        else {
                            e.preventDefault()
                        }
                    }
                }
            }
            else {
                if (window.event) {
                    event.returnValue = false
                }
                else {
                    e.preventDefault()
                }
            }
        }
        else {
            if (key == 0 || key == 8 || key == 9 || (key >= 48 && key <= 57)) {
    
            }
            else {
                if (window.event) {
                    event.returnValue = false
                }
                else {
                    e.preventDefault()
                }
            }
        }
    }

});






// DELETE COURSE SCRIPT
// $( "#delete-stream" ).on( "click", function() { 

// } );

// GET DEPARTMENT NAME BY COURSE ID
// $("#course_id").change(function () {
//     $('#dvLoading').show();
//     var course_id = $("#course_id").val();
//     $.ajax({
//         type: "POST",
//         url: "getAllDepartmentByCourse.php",
//         dataType: "json",
//         data: 'course_id=' + course_id,
//         error: function (data) {
//         },
//         success: function (data) {
//             console.log(data);
//             $('#department_id').html("");
//             var html = '';
//             if (data.status == 1) {
//                 html += '<option value="">Select</option>';
//                 for (let i = 0; i < data.departmentRecord.length; i++) {
//                     html += '<option value="' + data.departmentRecord[i].department_id + '">' + data.departmentRecord[i].department_name + '</option>';
//                 }

//                 $('#department_id').html(html);
//             }
//             else {
//                 html += '<option value="">Select</option>';
//                 $('#department_id').html(html);

//             }
//         },
//         complete: function () {
//             $('#dvLoading').hide();
//         }

//     });
// });

//for checkuser time delay for call search ajax function
function delay(callback, ms) {
    var timer = 0;
    return function () {
        var context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}

// function for check username
$('document').ready(function () {
    var username_state = false;
    var email_state = false;
    $('#username').on('keyup', delay(function () {
        var username = $('#username').val();
        if (username == '') {
            username_state = false;
            return;
        }
        $.ajax({
            url: 'checkUserName.php',
            type: 'post',
            dataType: "json",
            data: {
                'username_check': 1,
                'username': username,
            },
            success: function (response) {
                console.log(response);
                if (response.msg == 'taken') {
                    //username_state = false;
                    // $('#username').parent().removeClass();
                    // $('#username').parent().addClass("form_error");
                    $('#username_err').css('color', 'red');
                    $('#username_err').html('<i class="fa-regular fa-circle-xmark"></i> Username already taken');
                } else if (response.msg == 'not_taken') {
                    //username_state = true;
                    // $('#username').parent().removeClass();
                    // $('#username').parent().addClass("form_success");
                    $('#username_err').css('color', 'green');
                    $('#username_err').html('<i class="fa-regular fa-circle-check"></i> Username available');
                }
            }
        });
    }, 500));

});




$('#teacher_name,#designation').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    /* $("#msgcontent").html(event.keyCode");
    $("#ValidationAlert").modal();  */
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});