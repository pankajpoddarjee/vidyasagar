$(document).ready(function() {
    $('.multiple-select').select2();
});

$(document).ready(function() {
	//Initialize table
    var dataRecords = $('#study-material-table').DataTable({
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
            data:{action:'listRecordsUpload'},
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
    $("#open-add-material-modal").on("click", function () {
       
       // $('#material-form')[0].reset();
        $('#material-form').trigger("reset");
        $("#material-title").html("<i class='fa-solid fa-file-arrow-up text-danger'></i> Upload Material");
        $('#add-material-modal').modal('show');
        $("#edit-content").css('display','none');
        $("#material-table").css('display','block');
        $('#is_edit_mode').val("");
        $("#add-row-div").css('display','block');
        $("#content_id").val("");
        $("#study_id").val("");
        $('#stream_id').html('<option value="">Select </option>');
        $('#subject_id_div').css('display','none');
       // $('#department_id').html('<option value="">Select </option>');
    });

    // OPEN MODAL FOR edit study material 
    $('body').on('click', '.open-edit-material-modal', function () {
        $('#dvLoading').show();
        //$('#course_id').trigger('change');
        $("#is_edit_mode").val("edit");
        var content_id = $(this).attr("cid");
        $.ajax({
            type: "POST",
            url: "getStudyContent.php",
            dataType: "json",
            data: 'content_id=' + content_id,
            error: function (obj) {
            },
            success: function (obj) {

                if (obj.status == 1) {
                    // var department_html = '';
                    // for (let i = 0; i < obj.departmentRecord.length; i++) {
                    //     department_html += '<option value="' + obj.departmentRecord[i].department_id + '">' + obj.departmentRecord[i].department_name + '</option>';
                    // }
                    // $('#department_id').html(department_html);
                   // var semester_html = '';
                    var stream_html = '';
                    var stream_select = '';
                    //var semester_select = '';
                    for (let i = 0; i < obj.streamRecord.length; i++) {
                        // if(jQuery.inArray(obj.streamRecord[i].stream_id, obj.data.stream_id) != -1) {
                        //     stream_select = "selected";
                        // } else {
                        //     stream_select = "";
                        // } 
                        stream_html += '<option value="' + obj.streamRecord[i].stream_id + '" >' + obj.streamRecord[i].stream_name + '</option>';
                    }
                    //let semester_arr=["I","II","III","IV","V","VI","VII","VIII"];

                    // for (let i = 0; i < semester_arr.length; i++) {
                    //     console.log("array data",semester_arr[i]);
                    //     console.log("array data type",typeof(semester_arr[i]));
                    //     console.log("semester data",obj.data.semester_id);
                    //     console.log("array data type",typeof(obj.data.semester_id));
                    //     if(jQuery.inArray(semester_arr[i].toString(), obj.data.semester_id.toString()) != -1) {
                    //         //console.log("yes");
                    //         //console.log(semester_arr[i]);
                    //         semester_select = "selected";
                    //     } else {
                    //         //console.log("no");
                    //        // console.log(semester_arr[i]);
                    //         semester_select = "";
                    //     } 
                    //     semester_html += '<option value="' + semester_arr[i] + '" '+semester_select+'>' + semester_arr[i] + '</option>';
                    // }
                    //console.log(obj.data.semester_id);
                    //console.log(semester_html);

                    $('#stream_id').html(stream_html);
                    //$('#semester_id').html(semester_html);
                    $("#material-title").html("<i class='fa-solid fa-file-arrow-up text-danger'></i> Edit Content");
                    $("#teacher_name").val(obj.data.teacher_name);
                    $("#teacher_id").val(obj.data.teacher_id);
                    var str_stream =  obj.data.stream_id;
		            var stream_arr = str_stream.split(',');
		            //console.log("stream_arr",stream_arr);

                    var str_semester =  obj.data.semester_id;
		            var semester_arr = str_semester.split(',');
		            //console.log("semester_arr",semester_arr);
                    $("#stream_id").val(stream_arr);
                    $("#department_id").val(obj.data.department_id);
                    $("#course_id").val(obj.data.course_id);
                    $("#material_id").val(obj.data.material_id);
                    $("#paper_type_id").val(obj.data.paper_type_id);
                    $("#semester_id").val(semester_arr);
                    $("#content_id").val(obj.data.content_id);
                    $("#study_id").val(obj.data.study_id);
                    $("#pre_doc_val").val(obj.data.document_path);
                    $("#publish_date").val(obj.data.publish_date);
                    

                    
                    
                    $("#add-row-div").css('display','none');
                    $("#material-table").css('display','none');
                    $("#edit-content").css('display','block');
                    $("#edit_content_title").val(obj.data.title);
                    if(obj.data.content_type == 'video'){
                        $("#content_of_material_font").text("Video");
                        $("#edit_video_link").css('display','block');
                        $("#edit_document_path").css('display','none');
                        $("#edit_video_link").val(obj.data.video_link);
                        
                    }else{
                        $("#content_of_material_font").text("Document");
                        $("#edit_document_path").css('display','block');
                        $("#edit_video_link").css('display','none');
                        //$("#edit_document_path").val(obj.data.title);
                    }
                    $('#add-material-modal').modal('show');

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

    //Save Study Material
    $('body').on('click', '#save-study-material', function (event) {
        event.preventDefault();
       // alert(verifyInput());
        if (!verifyInput()) {
            return false;
        }
        $('#dvLoading').show();
        //var data = $("#material-form").serialize();
        //var formData = new FormData("form")[0];
        var formData = new FormData(document.getElementById("material-form"));
        formData.append("fileName",$('[name^="edit_document_path"]').files);
        $.ajax({
            type: "post",
            async: false,
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
            url: "saveContent.php",
            data: formData,
            dataType: "json",
    
            success: function (data) {
    
                if (data.status == 1) {
                    //console.log(data.studyMaterialRecord);
                    //console.log(data.studyMaterialRecord[0].course_name);
                    //var html = '';
                    // html += '<table class="table table-bordered " id="material-table"><tr><th>SL.</th> <th>Course Name</th> <th>Dept. Name</th> <th>Teacher Name</th> <th>Email</th> <th>Mobile</th> <th>Role</th> <th>Action</th></tr>';
                    // for (let i = 0; i < data.studyMaterialRecord.length; i++) {
                    //     var status = (data.studyMaterialRecord[i].is_active == 1) ? "<i class='fa-regular fa-circle-dot' style='color:#2ec900'></i> Active" : "<i class='fa-regular fa-circle-dot' style='color:#c90020'></i> Inactive";
                    //     var status_class = (data.studyMaterialRecord[i].is_active == 1) ? "success" : "danger";
                    //     html += '<tr><td class="align-middle">' + (i + 1) + '</td><td class="align-middle">' + data.studyMaterialRecord[i].course_name + '</td><td class="align-middle">' + data.studyMaterialRecord[i].stream_name + '</td><td class="align-middle">' + data.studyMaterialRecord[i].department_name + '</td><td class="align-middle">' + data.studyMaterialRecord[i].material_name + '</td><td class="align-middle">' + data.studyMaterialRecord[i].paper_type_name + '</td><td class="align-middle">' + data.studyMaterialRecord[i].semester_id + '</td><td class="align-middle">' + data.studyMaterialRecord[i].title + '</td>';
                    //     if(data.studyMaterialRecord[i].content_type == 'video'){
                    //     html += '<td class="align-middle"><a class="btn btn-outline-danger" href="' + data.studyMaterialRecord[i].video_link + '" data-toggle="tooltip" data-placement="top" title="Video" target="_blank"><i class="fa-solid fa-video"></i></a></td>';
                    //     }else{
                    //     html += '<td class="align-middle"><a download class="btn btn-outline-danger" href="' + data.studyMaterialRecord[i].document_path + '" data-toggle="tooltip" data-placement="top" title="Document" target="_blank"><i class="fa-solid fa-file"></i></a></td>';
                    //     }
                    //     html += '<td class="align-middle"><button class="btn btn-info open-edit-material-modal" cid="' + data.studyMaterialRecord[i].content_id + '" data-toggle="tooltip" data-placement="top" title="Edit Material"><i class="fa-solid fa-pen-to-square"></i></button> <button class="open-delete-material-modal btn btn-' + status_class + '" status="' + data.studyMaterialRecord[i].is_active + '" cid="' + data.studyMaterialRecord[i].content_id + '" data-toggle="tooltip" data-placement="top" title="Change Status"><i class="fa-solid fa-arrows-rotate"></i></button></td></tr>';
                    // }
                    //console.log(html);
                    var content_html ='';
                    content_html ='<tr id="row0"><td id="td-material_type0"><select name="material_type[]" mid="0"  id="material_type0" class="form-control upload-type" onchange="changeInput(this,0)"><option value="">Select</option><option value="doc">Document</option><option value="video">Video</option></select></td></tr>';
                    //$('#material-table-body').html(html);
                    dataRecords.ajax.reload();
                    $('#myTable').html(content_html);
                    $('#material_type0').val("");
                    $('#material-form')[0].reset();
                    $('#stream_id').html('<option value="">Select </option>');
                    //$('#department_id').html('<option value="">Select </option>');
                    $('#add-material-modal').modal('hide');
    
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
    });
    
    // Check Validation
    function verifyInput() {
        if (!$.trim($("#department_id").val()).length) { // zero-length string AFTER a trim
            $("#department_id").focus();
            toastAlert({
                type: "error",
                title: "",
                message: "Please select department",
                buttonText: ""
            })
            return false;
        }
        if (!$.trim($("#material_id").val()).length) { // zero-length string AFTER a trim
            $("#material_id").focus();
            toastAlert({
                type: "error",
                title: "",
                message: "Please select material type",
                buttonText: ""
            })
            return false;
        }
        if (!$.trim($("#paper_type_id").val()).length) { // zero-length string AFTER a trim
            $("#paper_type_id").focus();
            toastAlert({
                type: "error",
                title: "",
                message: "Please select paper type",
                buttonText: ""
            })
            return false;
        }
        if (!$.trim($("#subject_id").val()).length) { // zero-length string AFTER a trim
            $("#subject_id").focus();
            toastAlert({
                type: "error",
                title: "",
                message: "Please select subject",
                buttonText: ""
            })
            return false;
        }
        if (!$.trim($("#course_id").val()).length) { // zero-length string AFTER a trim
            $("#course_id").focus();
            toastAlert({
                type: "error",
                title: "",
                message: "Please select course",
                buttonText: ""
            })
            return false;
        }
        if (!$.trim($("#stream_id").val()).length) { // zero-length string AFTER a trim
            $("#stream_id").focus();
            toastAlert({
                type: "error",
                title: "",
                message: "Please select Stream",
                buttonText: ""
            })
            return false;
        }
        if (!$.trim($("#semester_id").val()).length) { // zero-length string AFTER a trim
            $("#semester_id").focus();
            toastAlert({
                type: "error",
                title: "",
                message: "Please select Semester",
                buttonText: ""
            })
            return false;
        }
    
        if (!$.trim($("#publish_date").val()).length) { // zero-length string AFTER a trim
            $("#publish_date").focus();
            toastAlert({
                type: "error",
                title: "",
                message: "Please select publish date",
                buttonText: ""
            })
            return false;
        }
            //alert($("#is_edit_mode").val());
            if ($.trim($("#is_edit_mode").val()) == "" ) {
                if (!$.trim($("#material_type0").val()).length) { // zero-length string AFTER a trim
                    $("#material_type0").focus();
                    toastAlert({
                        type: "error",
                        title: "",
                        message: "Please select content type",
                        buttonText: ""
                    })
                    return false;
                }
           
            
                var is_err = false;
                $('[name^="material_type"]').each(function(){  
                // alert($.trim(this.value));
                    var ctype =  $("#content"+id).attr("type");
                    if(ctype=="text"){
                        var msg = "Please enter video link";
                    }else{
                        var msg = "Please upload content";
                    }
                    var id = $(this).attr("mid");
                    if($.trim(this.value) == ""){ //alert("blank");
                        is_err = true;
                        toastAlert({
                            type: "error",
                            title: "",
                            message: "Please select Content type",
                            buttonText: ""
                        })
                        return false;
                    }
                    if($("#content_title"+id).val() == ""){
                        is_err = true;
                        toastAlert({
                            type: "error",
                            title: "",
                            message: "Please enter Content Title",
                            buttonText: ""
                        })
                        return false;
                    }
                    if($("#content"+id).val() == ""){
                        is_err = true;
                        toastAlert({
                            type: "error",
                            title: "",
                            message: msg,
                            buttonText: ""
                        })
                        return false;
                    }
                    
                });
    
                if(is_err){
                    return false;
                }
            }
       
       
            return true;
    }
    
    // delete Study material
    $('body').on('click', '.open-delete-material-modal', function () {
        var content_id = $(this).attr("cid");
        var status = $(this).attr("status");
        var custom_status = status;
        if (status == '1') {
            custom_status = "Inactive";
        } else {
            custom_status = "Active";
        }
        $('#delete_content_id').val(content_id);
        $('#active-inactive').text(custom_status);
        $('#new_satus').val(custom_status);
        //$('#delete-teacher-modal').modal('show');
        toastAlert({
            type: "question",
            title: "Confirm Title",
            message: "Are you sure want to <strong>" + custom_status + "</strong> this study material ?",
            confirmText: "Yes",
            cancelText: "No"
        }).then((e) => {
            if (e == ("Thanks")) {
            } else {
                var data = $("#delete-study-material-form").serialize();
                $('#dvLoading').show();
                $.ajax({
                    type: "post",
                    async: false,
                    url: "deleteStudyMaterial.php",
                    data: data,
                    dataType: "json",
    
                    success: function (data) {
    
                        if (data.status == 1) {
                            //var html = '';
                            //html += '<table class="table table-bordered " id="material-table"><tr><th>SL.</th> <th>Course Name</th> <th>Dept. Name</th> <th>Teacher Name</th> <th>Email</th> <th>Mobile</th> <th>Role</th> <th>Action</th></tr>';
                            
                            // for (let i = 0; i < data.studyMaterialRecord.length; i++) {
                            //     var status = (data.studyMaterialRecord[i].is_content_active == 1) ? "Active" : "Inactive";
                            //     var status_class = (data.studyMaterialRecord[i].is_content_active == 1) ? "success" : "danger";
                            //     html += '<tr><td class="align-middle">' + (i + 1) + '</td><td class="align-middle">' + data.studyMaterialRecord[i].course_name + '</td><td class="align-middle">' + data.studyMaterialRecord[i].stream_name + '</td><td class="align-middle">' + data.studyMaterialRecord[i].department_name + '</td><td class="align-middle">' + data.studyMaterialRecord[i].material_name + '</td><td class="align-middle">' + data.studyMaterialRecord[i].paper_type_name + '</td><td class="align-middle">' + data.studyMaterialRecord[i].semester_id + '</td><td class="align-middle">' + data.studyMaterialRecord[i].title + '</td>';
                            //     if(data.studyMaterialRecord[i].content_type == 'video'){
                            //     html += '<td class="align-middle"><a class="btn btn-outline-danger" href="' + data.studyMaterialRecord[i].video_link + '" data-toggle="tooltip" data-placement="top" title="Video" target="_blank"><i class="fa-solid fa-video"></i></a></td>';
                            //     }else{
                            //     html += '<td class="align-middle"><a download class="btn btn-outline-danger" href="' + data.studyMaterialRecord[i].document_path + '" data-toggle="tooltip" data-placement="top" title="Document" target="_blank"><i class="fa-solid fa-file"></i></a></td>';
                            //     }
                            //     html += '<td class="align-middle"><button class="btn btn-info open-edit-material-modal" cid="' + data.studyMaterialRecord[i].content_id + '" data-toggle="tooltip" data-placement="top" title="Edit Material"><i class="fa-solid fa-pen-to-square"></i></button> <button class="open-delete-material-modal btn btn-' + status_class + '" status="' + data.studyMaterialRecord[i].is_active + '" cid="' + data.studyMaterialRecord[i].content_id + '" data-toggle="tooltip" data-placement="top" title="Change Status"><i class="fa-solid fa-arrows-rotate"></i></button></td></tr>';
                            // }
    
                            //html += '</table>';
                            dataRecords.ajax.reload();
                            //$('#material-table-body').html(html);
                            $('#delete-material-modal').modal('hide');
                            $("#material-title").text("Add Teacher");
                            $('#material-form')[0].reset();
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

});


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
//                 html += '<option value="">Select Department</option>';
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

//GET DROPDOWN VALUE FOR STREAM

$("#course_id").change(function () {
    $('#dvLoading').show();
    var course_id = $("#course_id").val();
    $.ajax({
        type: "POST",
        url: "getAllSteamByCourse.php",
        dataType: "json",
        data: 'course_id=' + course_id,
        error: function (data) {
        },
        success: function (data) {
            console.log(data);
            $('#stream_id').html("");
            var html = '';
            if (data.status == 1) {
                html += '<option value="">Select Stream</option>';
                for (let i = 0; i < data.streamRecord.length; i++) {
                    html += '<option value="' + data.streamRecord[i].stream_id + '">' + data.streamRecord[i].stream_name + '</option>';
                }

                $('#stream_id').html(html);
            }
            else {
                html += '<option value="">Select Stream</option>';
                $('#stream_id').html(html);

            }
        },
        complete: function () {
            $('#dvLoading').hide();
        }

    });
});


$(document).ready(function(){
    var i = 1;

    $("#addRow").click(function(){ 
        $("#myTable").append('<tr id="row'+i+'"><td class="align-middle text-nowrap" id="td-material_type'+i+'"><select mid="'+i+'" name="material_type[]" id="material_type'+i+'" class="form-control upload-type" onchange="changeInput(this,'+i+')"><option value="">Select</option><option value="doc">Document</option><option value="video">Video</option></select></td><td class="align-middle text-nowrap"></td><td class="align-middle text-nowrap"></td><td class="align-middle text-center"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-sm text-center btn_remove"><i class="fa-solid fa-trash-can" data-toggle="tooltip" data-placement="top" title="Delete Row"></i></button></td></tr>');
        i++;
      });

    $(document).on('click', '.btn_remove', function(){
      var button_id = $(this).attr("id");
      $('#row'+button_id+'').remove();
    });
});


function changeInput(type,id){
    
    $('#row'+id).html("")
    var html = '';
    if(type.value=='doc'){
        
        html +='<td class="align-middle" id="td-material_type'+id+'"><select  mid="'+id+'" name="material_type[]"  id="material_type'+id+'" class="form-control upload-type" onchange="changeInput(this,'+id+')"><option value="">Select</option><option value="doc" selected>Document</option><option value="video">Video</option></select></td><td class="align-middle" id="td-content_title'+id+'"><input type="text" name="content_title[]" tid="'+id+'" id="content_title'+id+'" placeholder="Enter Title" class="form-control" autocomplete="off"/></td><td class="align-middle" id="td-content'+id+'"><input type="file" name="content[]"  cid="'+id+'" multiple id="content'+id+'" class="form-control-file"/></td>';
        if(id != 0){
            html +='<td class="align-middle text-center"><button type="button" name="remove" id="'+id+'" class="btn btn-danger btn-sm text-center btn_remove"><i class="fa-solid fa-trash-can" data-toggle="tooltip" data-placement="top" title="Delete Row"></i></button></td>';
        }
        html +='</tr>';
        
    }else if(type.value=='video'){
        
        html +='<td class="align-middle" id="td-material_type'+id+'"><select  mid="'+id+'" name="material_type[]"  id="material_type'+id+'" class="form-control upload-type" onchange="changeInput(this,'+id+')"><option value="">Select</option><option value="doc" >Document</option><option value="video" selected>Video</option></select></td><td class="align-middle" id="td-content_title'+id+'"><input type="text" name="content_title[]" tid="'+id+'" id="content_title'+id+'" placeholder="Enter Title" class="form-control" autocomplete="off"/></td><td class="align-middle" id="td-content'+id+'"><input type="text" name="content[]" cid="'+id+'"  id="content'+id+'" placeholder="Enter Video Link" class="form-control" autocomplete="off"/></td>';
        if(id !=0 ){
            html +='<td class="align-middle text-center"><button type="button" name="remove" id="'+id+'" class="btn btn-danger text-center btn_remove"><i class="fa-solid fa-trash-can" data-toggle="tooltip" data-placement="top" title="Delete Row"></i></button></td>';
        }
        html +='</tr>';
    }else{
        html +='<td class="align-middle" id="td-material_type'+id+'"><select  mid="'+id+'" name="material_type[]"  id="material_type'+id+'" class="form-control upload-type" onchange="changeInput(this,'+id+')"><option value="" selected>Select</option><option value="doc" >Document</option><option value="video">Video</option></select></td>';
        if(id != 0){
        html +='<td></td><td></td><td class="align-middle text-center"><button type="button" name="remove" id="'+id+'" class="btn btn-danger text-center btn_remove"><i class="fa-solid fa-trash-can" data-toggle="tooltip" data-placement="top" title="Delete Row"></i></button></td>';
        }
        html +='</tr>';
    }
    
    $('#row'+id).html(html)

}

function getSubject(){
    var department_id = $('#department_id').val();
    var paper_type_id = $('#paper_type_id').val();

    console.log(department_id);
    console.log(paper_type_id);
    if(typeof(department_id) != "undefined" && department_id !== null && department_id !=="" && typeof(paper_type_id) != "undefined" && paper_type_id !== null && paper_type_id !== "") {
    $('#dvLoading').show();

       
        var data = {action:'getSubjectForUploadStudyMaterial',department_id:department_id,paper_type_id:paper_type_id};
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
                    html = '';
                    
                    for (let i = 0; i < data.subjectRecord.length; i++) {
                        //console.log(data.subjectRecord[i].department_id);
                        
                        var department_name = '';
                        var subject_type = '';
                        if(data.subjectRecord[i].department_name){
                            department_name = ' ('+data.subjectRecord[i].department_name+')';
                        }
                        if(data.subjectRecord[i].SubjectType){
                            subject_type = '<span class="text-danger"> ('+data.subjectRecord[i].SubjectType+')</span>';
                        }
                        html += '<option value="' + data.subjectRecord[i].subject_id + '">' + data.subjectRecord[i].SubjectName_SDMS + subject_type + '</option>';
                    }

                    $('#subject_id').html(html);
                    $('#subject_id_div').css('display','block');
                    // $("#subject_id").multiselect('reload');
                    // $('#subject_id').multiselect({
                    //     reload : true,
                    //     columns: 1,
                    //     texts: {
                    //         placeholder: 'Select Subject',
                    //         search     : 'Search Subject'
                    //     },
                    //     search: true,
                    //     selectAll: true
                    // });
                }
                else
                {
                    $('#subject_id_div').css('display','none');
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


    }
}



