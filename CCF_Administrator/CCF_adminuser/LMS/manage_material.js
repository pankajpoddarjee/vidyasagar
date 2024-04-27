// $(document).ready(function() {
//     $('.multiple-select').select2();
// });

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
            data:{action:'listRecordsMaterial'},
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
        $("#teacher_id").val("");
        $("#semester_id").val("");
        $("#stream_id").val("");
        $("#created_by_user").val("");
        $("#m_created_by").val("");
        $("#m_created_at").val("");
        $("#m_created_device").val("");
        $("#m_updated_by").val("");
        $("#m_updated_at").val("");
        $("#m_updated_device").val("");
        $("#delete-all").css('display','none');
        $("#delete-all-with-parent").css('display','none');
        //$("#form_id").val("");
        $('#stream_id').html('<option value="">Select </option>');
        $('#subject_id_div').css('display','none');
       // $('#department_id').html('<option value="">Select </option>');

        $("#stream_id").multiselect('reload');
        $('#stream_id').multiselect({
            reload : true,
            columns: 1,
            texts: {
                placeholder: 'Select Stream',
                search     : 'Type here to search'
            },
            search: true,
            selectAll: true
        });
        $("#semester_id").multiselect('reload');
        $('#semester_id').multiselect({
            reload : true,
            columns: 1,
            texts: {
                placeholder: 'Select Semester',
                search     : 'Type here to search'
            },
            search: true,
            selectAll: true
        });


        var content_html = '';
        content_html +='<table class="table table-bordered text-nowrap" id="content-table"><thead><tr style="background:#f8fafd; color:#758289"><th class="align-middle">Content Type</th><th class="align-middle">Content Title</th><th class="align-middle">File/Link</th><th class="align-middle">Publish Date</th><th class="align-middle">Action</th></tr></thead><tbody id="myTable"><tr id="row0"><td class="align-middle text-nowrap" id="td-material_type0"><select name="material_type[]" mid="0"  id="material_type0" class="form-control upload-type" onchange="changeInput(this,0)"><option value="">Select</option><option value="doc">Document</option><option value="video">Video</option></select></td></tr></tbody></table>';
        $('#material-table').html(content_html);
    });

    // OPEN MODAL FOR edit study material 
    $('body').on('click', '.open-edit-material-modal', function () {
        $('#dvLoading').show();
        //$('#course_id').trigger('change');
        $("#is_edit_mode").val("edit");
        var content_id = $(this).attr("cid");
        var study_id = $(this).attr("sid");
        var data = {content_id:content_id,study_id:study_id};
        $.ajax({
            type: "POST",
            url: "getStudyContent.php",
            dataType: "json",
            data: data,
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
                    $("#material-title").html("<i class='fa-solid fa-file-arrow-up text-danger'></i> Edit Content - "+obj.data.study_id);
                    $("#teacher_name").val(obj.data.teacher_name);
                    $("#teacher_id").val(obj.data.teacher_id);
                    var str_stream =  obj.data.stream_id;
		            var stream_arr = str_stream.split(',');
		            //console.log("stream_arr",stream_arr);

                    var str_semester =  obj.data.semester_id;
		            var semester_arr = str_semester.split(',');
		            //console.log("semester_arr",semester_arr);
                    $("#teacher_id").val(obj.data.teacher_id);
                    $("#teacher_id").val(obj.data.teacher_id);
                    $("#stream_id").val(stream_arr);
                    $("#stream_id").multiselect('reload');
                    $('#stream_id').multiselect({
                        reload : true,
                        columns: 1,
                        texts: {
                            placeholder: 'Select Stream',
                            search     : 'Type here to search'
                        },
                        search: true,
                        selectAll: true
                    });
                    
                    $("#department_id").val(obj.data.department_id);
                    $("#course_id").val(obj.data.course_id);
                    $("#material_id").val(obj.data.material_id);
                    $("#paper_type_id").val(obj.data.paper_type_id);
                    $("#semester_id").val(semester_arr);
                    $("#semester_id").multiselect('reload');
                    $('#semester_id').multiselect({
                        reload : true,
                        columns: 1,
                        texts: {
                            placeholder: 'Select Semester',
                            search     : 'Type here to search'
                        },
                        search: true,
                        selectAll: true
                    });
                    $("#content_id").val(obj.data.content_id);
                    $("#study_id").val(obj.data.study_id);
                    $("#teacher_id").val(obj.data.teacher_id);
                    $("#created_by_user").val(obj.data.created_by_user);
                    $("#pre_doc_val").val(obj.data.document_path);
                    $("#publish_date").val(obj.data.publish_date);
                    $('#subject_id_div').css('display','block');
                    $("#m_created_by").val(obj.data.m_created_by);
                    $("#m_created_at").val(obj.data.m_created_at);
                    $("#m_created_device").val(obj.data.m_created_device);
                    $("#m_updated_by").val(obj.data.m_updated_by);
                    $("#m_updated_at").val(obj.data.m_updated_at);
                    $("#m_updated_device").val(obj.data.m_updated_device);
                    $("#delete-all").css('display','block');
                    $("#delete-all-with-parent").css('display','block');
                    $(".remove-all").attr("study_id", obj.data.study_id);

                    getSubject(obj.data.subject_id);

                    $("#subject_id").val(obj.data.subject_id);

                    
                    
                    // $("#add-row-div").css('display','none');
                    $("#material-table").css('display','block');
                    $("#edit-content").css('display','block');
                    $("#edit_content_title").val(obj.data.title);
                    var content_html = '<table class="table table-bordered text-nowrap" id="content-table"><thead><tr style="background:#f8fafd; color:#758289"><th class="align-middle">Select</th><th class="align-middle">Content Type</th><th class="align-middle">Content Title</th><th class="align-middle">File/Link</th><th class="align-middle">Publish Date</th><th class="align-middle">Action</th></tr></thead><tbody id="myTable">';
                    
                    for (let i = 0; i < obj.getAllContentRecord.length; i++) {
                        if(obj.getAllContentRecord[i].content_type=='doc'){
                            if(content_id == obj.getAllContentRecord[i].content_id){
                                var row_select_class = "alert-danger";
                                var checked = 'checked';
                                var disabled = '';
                            }else{
                                var row_select_class = "";
                                var checked = '';
                                var disabled = 'disabled';
                            }
                            content_html +='<tr id="row'+i+'" class="'+row_select_class+'">';
                            content_html += '<td class="align-middle" id="td-check'+i+'"><input type="checkbox" name="check[]" onclick="isSelected(this,'+obj.getAllContentRecord[i].content_id+')" tid="'+i+'" id="check'+i+'"  class="form-control" autocomplete="off" '+checked+' value="'+obj.getAllContentRecord[i].content_id+'" /></td>';
                            content_html +='<td class="align-middle" id="td-material_type'+i+'">'+obj.getAllContentRecord[i].content_id+'<select '+disabled+'  mid="'+i+'" name="material_type[]"  id="material_type'+i+'" class="form-control upload-type" onchange="changeInput(this,'+i+','+obj.getAllContentRecord[i].content_id+')"><option value="">Select</option><option selected value="doc" selected>Document</option><option value="video">Video</option></select></td><td class="align-middle" id="td-content_title'+i+'"><input '+disabled+' type="text" name="content_title[]" tid="'+i+'" id="content_title'+i+'" placeholder="Enter Title" class="form-control" autocomplete="off" value="'+obj.getAllContentRecord[i].title+'"/></td><td class="align-middle" id="td-content'+i+'"><input '+disabled+' type="file" name="content[]"  cid="'+i+'" multiple id="content'+i+'" class="form-control-file"/><input type="hidden" id="content_doc'+i+'" name="content_doc'+i+'" value="'+obj.getAllContentRecord[i].document_path+'"></td><td class="align-middle" id="td-content_publish_date'+i+'"><input '+disabled+' type="date" name="content_publish_date[]" tid="'+i+'" id="content_publish_date'+i+'"  class="form-control" value="'+obj.getAllContentRecord[i].publish_date+'"/></td>';
                            if(checked!=''){
                                content_html +='<td class="align-middle text-center" id="td-delete-content'+i+'"><button type="button" name="remove" id="'+i+'" cid="'+obj.getAllContentRecord[i].content_id+'" class="btn btn-danger text-center btn_remove"><i class="fa-solid fa-trash-can" data-toggle="tooltip" data-placement="top" title="Delete Row"></i></button></td>';
                            }

                            content_html +='</tr>';
                            
                        }else if(obj.getAllContentRecord[i].content_type=='video'){
                            if(content_id == obj.getAllContentRecord[i].content_id){
                                var row_select_class = "alert-danger";
                                var checked = 'checked';
                                var disabled = '';
                            }else{
                                var row_select_class = "";
                                var checked = '';
                                var disabled = 'disabled';
                            }
                            content_html +='<tr id="row'+i+'" class="'+row_select_class+'">';
                            content_html += '<td class="align-middle" id="td-check'+i+'"><input type="checkbox" name="check[]" onclick="isSelected(this,'+obj.getAllContentRecord[i].content_id+')" tid="'+i+'" id="check'+i+'"  class="form-control" autocomplete="off" '+checked+' value="'+obj.getAllContentRecord[i].content_id+'" /></td>';
                            content_html +='<td class="align-middle" id="td-material_type'+i+'">'+obj.getAllContentRecord[i].content_id+'<select '+disabled+'  mid="'+i+'"  name="material_type[]"  id="material_type'+i+'" class="form-control upload-type" onchange="changeInput(this,'+i+','+obj.getAllContentRecord[i].content_id+')"><option value="">Select</option><option value="doc" >Document</option><option selected value="video" selected>Video</option></select></td><td class="align-middle" id="td-content_title'+i+'"><input '+disabled+' type="text" name="content_title[]" tid="'+i+'" id="content_title'+i+'" placeholder="Enter Title" class="form-control" autocomplete="off" value="'+obj.getAllContentRecord[i].title+'" /></td><td class="align-middle" id="td-content'+i+'"><input '+disabled+' type="text" name="content[]" cid="'+i+'"  id="content'+i+'" placeholder="Enter Video Link" class="form-control" autocomplete="off" value="'+obj.getAllContentRecord[i].video_link+'"/></td><td class="align-middle" id="td-content_publish_date'+i+'"><input '+disabled+' type="date" name="content_publish_date[]" tid="'+i+'" id="content_publish_date'+i+'"  class="form-control" value="'+obj.getAllContentRecord[i].publish_date+'"/></td>';
                            if(checked!=''){
                                content_html +='<td class="align-middle text-center" id="td-delete-content'+i+'"><button type="button" name="remove" id="'+i+'" cid="'+obj.getAllContentRecord[i].content_id+'" class="btn btn-danger text-center btn_remove"><i class="fa-solid fa-trash-can" data-toggle="tooltip" data-placement="top" title="Delete Row"></i></button></td>';
                            }
                            content_html +='</tr>';
                        }
                    }
                    content_html += '</tbody></table>';
                    $("#material-table").html(content_html);
                
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
    
        // if (!$.trim($("#publish_date").val()).length) { // zero-length string AFTER a trim
        //     $("#publish_date").focus();
        //     toastAlert({
        //         type: "error",
        //         title: "",
        //         message: "Please select publish date",
        //         buttonText: ""
        //     })
        //     return false;
        // }
            //alert($("#is_edit_mode").val());
            if ($.trim($("#is_edit_mode").val()) == "" ) { // check validation Add New Upload
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
                    var id = $(this).attr("mid");
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
            }else{  // check validation Edit Upload
                //var length = $('[name^="check"]').length;
                var length = $('input[name^="check"]:checked').length;
                if(length == 0){
                    toastAlert({
                        type: "error",
                        title: "",
                        message: "No record found for update. Please select record.",
                        buttonText: ""
                    })
                    return false;
                }
                var is_err = false;
                $('[name^="material_type"]').each(function(){  
                // alert($.trim(this.value));
                    var id = $(this).attr("mid");
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

                    if(ctype=="text"){
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
                    }else{

                        //console.log($("#content_doc"+id).val());
                        if($("#content_doc"+id).val() != "" && $("#content_doc"+id).val() != "undefined" && $("#content_doc"+id).val() != null)
                        { //alert("yes");
                            is_err = false;
                        }else{ //alert("no");
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
                        }
                        
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
            //message: "Are you sure want to <strong>" + custom_status + "</strong> this study material ?",
			message: "Are you sure want to<strong class='text-danger'> Delete </strong> this study material ?",
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

    $('body').on('click', '.remove-all', function (){
        //function deleteAll(param){
            var study_id =  $(this).attr("study_id");
            var all_child_with_parent =  $(this).attr("all_child_with_parent");
            if(all_child_with_parent == '1'){
                var tmsg = "Are you sure want to<strong class='text-danger'> Delete All </strong> this study material with Parent Information?";
            }else{
                var tmsg = "Are you sure want to<strong class='text-danger'> Delete All </strong> this study material ?";
            }
            toastAlert({
                type: "question",
                title: "Confirm Title",
                //message: "Are you sure want to <strong>" + custom_status + "</strong> this study material ?",
                message: tmsg,
                confirmText: "Yes",
                cancelText: "No"
            }).then((e) => {
                if (e == ("Thanks")) {
                } else {
                    var data = {delete_study_id:study_id,all_child_with_parent:all_child_with_parent,action:'deleteAll'};
                    $('#dvLoading').show();
                    $.ajax({
                        type: "post",
                        async: false,
                        url: "deleteStudyMaterial.php",
                        data: data,
                        dataType: "json",
        
                        success: function (data) {
        
                            if (data.status == 1) {
                                //dataRecords.ajax.reload();
                                toastAlert({
                                    type: "success",
                                    title: "",
                                    message: data.msg,
                                    buttonText: ""
                                })
                                dataRecords.ajax.reload();
                                $('#add-material-modal').modal('hide');
                                
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
        //}
    });


    //Start content table 
    var i = 2000;

    $("#addRow").click(function(){ 

        if ($.trim($("#is_edit_mode").val()) == "" ) { 
            var edit_html = '';
        }else{
            var edit_html = '<td class="align-middle" id="td-check'+i+'"><input type="checkbox" name="check[]" tid="'+i+'" id="check'+i+'"  class="form-control" autocomplete="off" checked onclick="return false;"/></td>';
        }

        $("#myTable").append('<tr id="row'+i+'">'+edit_html+'<td class="align-middle text-nowrap" id="td-material_type'+i+'"><select mid="'+i+'" name="material_type[]" id="material_type'+i+'" class="form-control upload-type" onchange="changeInput(this,'+i+')"><option value="">Select</option><option value="doc">Document</option><option value="video">Video</option></select></td><td class="align-middle text-nowrap"></td><td class="align-middle text-nowrap"></td><td class="align-middle text-nowrap"></td><td class="align-middle text-center"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-sm text-center btn_remove"><i class="fa-solid fa-trash-can" data-toggle="tooltip" data-placement="top" title="Delete Row"></i></button></td></tr>');
        i++;
      });

    $(document).on('click', '.btn_remove', function(){
      var button_id = $(this).attr("id");
      var content_id = $(this).attr("cid");
      if(content_id!='' && content_id!='undefined' && content_id!=null){
        // alert(content_id);
        // alert("i m ready for delete record");

        toastAlert({
            type: "question",
            title: "Confirm Title",
            //message: "Are you sure want to <strong>" + custom_status + "</strong> this study material ?",
			message: "Are you sure want to<strong class='text-danger'> Delete </strong> this study material ?",
            confirmText: "Yes",
            cancelText: "No"
        }).then((e) => {
            if (e == ("Thanks")) { return false;
            } else {
                var data = {delete_content_id:content_id};
                $('#dvLoading').show();
                $.ajax({
                    type: "post",
                    async: false,
                    url: "deleteStudyMaterial.php",
                    data: data,
                    dataType: "json",
    
                    success: function (data) {
    
                        if (data.status == 1) {
                            //dataRecords.ajax.reload();
                            toastAlert({
                                type: "success",
                                title: "",
                                message: data.msg,
                                buttonText: ""
                            })
                            dataRecords.ajax.reload();
                            $('#row'+button_id+'').remove();
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
      }else{
        $('#row'+button_id+'').remove();
      }
      
      
    });
    //End Content table
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

//$("#course_id").change(function () {
    function getStream(){
    $('#dvLoading').show();
    var course_id = $("#course_id").val();
    var paper_type_id = $("#paper_type_id").val();
    var data = {course_id:course_id,paper_type_id:paper_type_id};
    $.ajax({
        type: "POST",
        url: "getAllSteamByCourse.php",
        dataType: "json",
        data: data,
        error: function (data) {
        },
        success: function (data) {
            console.log(data);
            $('#stream_id').html("");
            var html = '';
            if (data.status == 1) {
                // html += '<option value="">Select Stream</option>';
                for (let i = 0; i < data.streamRecord.length; i++) {
                    html += '<option value="' + data.streamRecord[i].stream_id + '">' + data.streamRecord[i].stream_name + '</option>';
                }

                $('#stream_id').html(html);
            }
            else {
                html += '<option value="">Select Stream</option>';
                $('#stream_id').html(html);

            }
            $("#stream_id").multiselect('reload');
            $('#stream_id').multiselect({
                reload : true,
                columns: 1,
                texts: {
                    placeholder: 'Select Stream',
                    search     : 'Type here to search'
                },
                search: true,
                selectAll: true
            });
        },
        complete: function () {
            $('#dvLoading').hide();
        }

    });
}
//});


// $(document).ready(function(){
//     var i = 2000;

//     $("#addRow").click(function(){ 

//         if ($.trim($("#is_edit_mode").val()) == "" ) { 
//             var edit_html = '';
//         }else{
//             var edit_html = '<td class="align-middle" id="td-check'+i+'"><input type="checkbox" name="check[]" tid="'+i+'" id="check'+i+'"  class="form-control" autocomplete="off" checked onclick="return false;"/></td>';
//         }

//         $("#myTable").append('<tr id="row'+i+'">'+edit_html+'<td class="align-middle text-nowrap" id="td-material_type'+i+'"><select mid="'+i+'" name="material_type[]" id="material_type'+i+'" class="form-control upload-type" onchange="changeInput(this,'+i+')"><option value="">Select</option><option value="doc">Document</option><option value="video">Video</option></select></td><td class="align-middle text-nowrap"></td><td class="align-middle text-nowrap"></td><td class="align-middle text-nowrap"></td><td class="align-middle text-center"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-sm text-center btn_remove"><i class="fa-solid fa-trash-can" data-toggle="tooltip" data-placement="top" title="Delete Row"></i></button></td></tr>');
//         i++;
//       });

//     $(document).on('click', '.btn_remove', function(){
//       var button_id = $(this).attr("id");
//       var content_id = $(this).attr("cid");
//       if(content_id!='' && content_id!='undefined' && content_id!=null){
//         // alert(content_id);
//         // alert("i m ready for delete record");

//         toastAlert({
//             type: "question",
//             title: "Confirm Title",
//             //message: "Are you sure want to <strong>" + custom_status + "</strong> this study material ?",
// 			message: "Are you sure want to<strong class='text-danger'> Delete </strong> this study material ?",
//             confirmText: "Yes",
//             cancelText: "No"
//         }).then((e) => {
//             if (e == ("Thanks")) { return false;
//             } else {
//                 var data = {delete_content_id:content_id};
//                 $('#dvLoading').show();
//                 $.ajax({
//                     type: "post",
//                     async: false,
//                     url: "deleteStudyMaterial.php",
//                     data: data,
//                     dataType: "json",
    
//                     success: function (data) {
    
//                         if (data.status == 1) {
//                             //dataRecords.ajax.reload();
//                             toastAlert({
//                                 type: "success",
//                                 title: "",
//                                 message: data.msg,
//                                 buttonText: ""
//                             })
//                             $('#row'+button_id+'').remove();
//                         }
//                         else {
//                             toastAlert({
//                             type: "error",
//                             title: "",
//                             message: data.msg,
//                             buttonText: ""
//                             })
//                             return false;
//                         }
    
//                     },
//                     complete: function () {
//                         $('#dvLoading').hide();
//                     }
//                 });
//             }
//         })
//       }else{
//         $('#row'+button_id+'').remove();
//       }
      
      
//     });
// });


function changeInput(type,id,content_id=''){
    var cd = (new Date()).toISOString().split('T')[0];

    if ($.trim($("#is_edit_mode").val()) == "" ) { 
        var edit_html = '';
    }else{
        var edit_html = '<td class="align-middle" id="td-check'+id+'"><input type="checkbox" name="check[]" tid="'+id+'" id="check'+id+'"  class="form-control" autocomplete="off" checked value="'+content_id+'" onclick="isSelected(this,'+content_id+')" /></td>';
    }
    
    $('#row'+id).html("");
    var html = '';
    if(type.value=='doc'){
        
        html +=edit_html+'<td class="align-middle" id="td-material_type'+id+'"><select  mid="'+id+'" name="material_type[]"  id="material_type'+id+'" class="form-control upload-type" onchange="changeInput(this,'+id+','+content_id+')"><option value="">Select</option><option value="doc" selected>Document</option><option value="video">Video</option></select></td><td class="align-middle" id="td-content_title'+id+'"><input type="text" name="content_title[]" tid="'+id+'" id="content_title'+id+'" placeholder="Enter Title" class="form-control" autocomplete="off"/></td><td class="align-middle" id="td-content'+id+'"><input type="file" name="content[]"  cid="'+id+'" multiple id="content'+id+'" class="form-control-file"/></td><td class="align-middle" id="td-content_publish_date'+id+'"><input type="date" name="content_publish_date[]" tid="'+id+'" id="content_publish_date'+id+'"  class="form-control" value="'+cd+'"/></td>';
        if(id != 0 || content_id !=''){
            html +='<td class="align-middle text-center" id="td-delete-content'+id+'"><button type="button" name="remove" id="'+id+'" cid="'+content_id+'"  class="btn btn-danger btn-sm text-center btn_remove"><i class="fa-solid fa-trash-can" data-toggle="tooltip" data-placement="top" title="Delete Row"></i></button></td>';
        }
        html +='</tr>';
        
    }else if(type.value=='video'){
        
        html +=edit_html+'<td class="align-middle" id="td-material_type'+id+'"><select  mid="'+id+'" name="material_type[]"  id="material_type'+id+'" class="form-control upload-type" onchange="changeInput(this,'+id+','+content_id+')"><option value="">Select</option><option value="doc" >Document</option><option value="video" selected>Video</option></select></td><td class="align-middle" id="td-content_title'+id+'"><input type="text" name="content_title[]" tid="'+id+'" id="content_title'+id+'" placeholder="Enter Title" class="form-control" autocomplete="off"/></td><td class="align-middle" id="td-content'+id+'"><input type="text" name="content[]" cid="'+id+'"  id="content'+id+'" placeholder="Enter Video Link" class="form-control" autocomplete="off"/></td><td class="align-middle" id="td-content_publish_date'+id+'"><input type="date" name="content_publish_date[]" tid="'+id+'" id="content_publish_date'+id+'"  class="form-control" value="'+cd+'"/></td>';
        if(id !=0 || content_id !=''){
            html +='<td class="align-middle text-center" id="td-delete-content'+id+'"><button type="button" name="remove" id="'+id+'" cid="'+content_id+'"  class="btn btn-danger text-center btn_remove"><i class="fa-solid fa-trash-can" data-toggle="tooltip" data-placement="top" title="Delete Row"></i></button></td>';
        }
        html +='</tr>';
    }else{
        html +='<td class="align-middle" id="td-material_type'+id+'"><select  mid="'+id+'" name="material_type[]"  id="material_type'+id+'" class="form-control upload-type" onchange="changeInput(this,'+id+')"><option value="" selected>Select</option><option value="doc" >Document</option><option value="video">Video</option></select></td>';
        if(id != 0 ){
        html +='<td></td><td></td><td class="align-middle text-center"><button type="button" name="remove" id="'+id+'" class="btn btn-danger text-center btn_remove"><i class="fa-solid fa-trash-can" data-toggle="tooltip" data-placement="top" title="Delete Row"></i></button></td>';
        }
        html +='</tr>';
    }
    
    $('#row'+id).html(html)

}

function getSubject(sid=''){
    var department_id = $('#department_id').val();
    var paper_type_id = $('#paper_type_id').val();
    var option_text  = $( "#paper_type_id option:selected" ).text();

    //console.log(department_id);
    //console.log(paper_type_id);
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
                        var selected = '';
                        if(sid){
                            if(data.subjectRecord[i].subject_id == sid){
                                selected = 'selected';
                            }
                        }
                        var department_name = '';
                        var subject_type = '';
                        if(data.subjectRecord[i].department_name){
                            department_name = ' ('+data.subjectRecord[i].department_name+')';
                        }
                        if(option_text != 'CORE (3 YEAR)'){
                            if(data.subjectRecord[i].SubjectType){
                                subject_type = '<span class="text-danger"> ('+data.subjectRecord[i].SubjectType+')</span>';
                            }
                        }else{
                            subject_type = '<span class="text-danger"> (Core)</span>';
                        }
                        
                        html += '<option '+selected+' value="' + data.subjectRecord[i].subject_id + '">' + data.subjectRecord[i].SubjectName_SDMS + subject_type + '</option>';
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

$("#semester_id").multiselect('reload');
$('#semester_id').multiselect({
    reload : true,
    columns: 1,
    texts: {
        placeholder: 'Select Semester',
        search     : 'Type here to search'
    },
    search: true,
    selectAll: true
});

$("#stream_id").multiselect('reload');
$('#stream_id').multiselect({
    reload : true,
    columns: 1,
    texts: {
        placeholder: 'Select Stream',
        search     : 'Type here to search'
    },
    search: true,
    selectAll: true
});

// validation file upload
$(document).on('change', '.form-control-file', function (e) {
    e.preventDefault();
    const thisValue = $(this).val().split('.').pop().toLowerCase();
    const userFile = [thisValue];
    // Allowing file type
    const validFile = ['csv', 'xlsx','jpg', 'jpeg', 'png','pdf', 'doc','docx', 'pptx', 'zip'];
    // const intersection = validFile.filter(element => userFile.includes(element));
    // if(intersection == ''){
    //     $(this).val('');
    //     alert('Please Select ' + validFile + ' file');
    //     return false;
    // }
    if(this.files[0].size > 2000000) {
        toastAlert({
            type: "error",
            title: "",
            message: 'Please upload file less than 2MB. Thanks!!',
            buttonText: ""
            })
        $(this).val('');
        return false;
    }

   // Allowing file type
    const allowedExtensions =  /(\.csv|\.xlsx|\.jpg|\.jpeg|\.png|\.pdf|\.doc|\.docx|\.pptx|\.zip)$/i;
    if (!allowedExtensions.exec($(this).val())) {
        $(this).val('');

        toastAlert({
            type: "error",
            title: "",
            // message: 'Please Select ' + validFile + ' file',
            message: '<ul style="list-style-type:decimal; text-align:left; padding:0"><li>csv</li><li>xlsx</li><li>jpg</li><li>png</li><li>pdf</li><li>doc</li><li>docx</li><li>pptx</li></ul>',
            buttonText: ""
            })
        //alert('Please Select ' + validFile + ' file');
        return false;
    } 
});
// $('input[name="check"]').click(function () {
//     if (this.checked) {
//         alert("Thanks for checking me");
//     }
// });
function isSelected(param,content_id=''){
        var element_id = $(param).attr("tid");
        //console.log(element_id);
        if ($(param).is(':checked')){
            //alert("Checked");
            $('#material_type'+element_id).prop('disabled', false);
            $('#content_title'+element_id).prop('disabled', false);
            $('#content'+element_id).prop('disabled', false);
            $('#content_publish_date'+element_id).prop('disabled', false);
            delete_html ='<td class="align-middle text-center" id="td-delete-content'+element_id+'"><button type="button" name="remove" id="'+element_id+'" cid="'+content_id+'" class="btn btn-danger text-center btn_remove"><i class="fa-solid fa-trash-can" data-toggle="tooltip" data-placement="top" title="Delete Row"></i></button></td>';

            $('#content-table').find('#td-content_publish_date'+element_id).after(delete_html);
            //$('#td-content_publish_date'+id).append(delete_html);
           // $('#content-table tr').find('#td-content_publish_date'+id).append(delete_html);

            // $('#content-table #td-content_publish_date0').find('td:last').after('<td>'+delete_html+'</td>');

        }else{
            $('#material_type'+element_id).prop('disabled', true);
            $('#content_title'+element_id).prop('disabled', true);
            $('#content'+element_id).prop('disabled', true);
            $('#content_publish_date'+element_id).prop('disabled', true);
            $('#content-table').find('#td-delete-content'+element_id).remove();
        }
    
}



