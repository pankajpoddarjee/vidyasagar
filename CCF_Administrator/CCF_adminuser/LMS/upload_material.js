//GET DROPDOWN VALUE FOR DEPARTMENT

// OPEN MODAL FOR INSERT COURSE           
$("#open-add-material-modal").on("click", function () {
    $('#material-form').trigger("reset");
    $('#add-material-modal').modal('show');
    $("#edit-content").css('display','none');
    $("#material-table").css('display','block');

});

$("#course_id").change(function () {
    $('#dvLoading').show();
    var course_id = $("#course_id").val();
    $.ajax({
        type: "POST",
        url: "getAllDepartmentByCourse.php",
        dataType: "json",
        data: 'course_id=' + course_id,
        error: function (data) {
        },
        success: function (data) {
            console.log(data);
            $('#department_id').html("");
            var html = '';
            if (data.status == 1) {
                html += '<option value="">Select Department</option>';
                for (let i = 0; i < data.departmentRecord.length; i++) {
                    html += '<option value="' + data.departmentRecord[i].department_id + '">' + data.departmentRecord[i].department_name + '</option>';
                }

                $('#department_id').html(html);
            }
            else {
                html += '<option value="">Select</option>';
                $('#department_id').html(html);

            }
        },
        complete: function () {
            $('#dvLoading').hide();
        }

    });
});

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
                html += '<option value=""> Select Stream</option>';
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
        $("#myTable").append('<tr id="row'+i+'"><td id="td-material_type'+i+'"><select mid="'+i+'" name="material_type[]" id="material_type'+i+'" class="form-control upload-type" onchange="changeInput(this,'+i+')"><option value="">Select</option><option value="doc">Document</option><option value="video">Video</option></select></td><td></td><td></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
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
        
        html +='<td class="align-middle" id="td-material_type'+id+'"><select  mid="'+id+'" name="material_type[]"  id="material_type'+id+'" class="form-control upload-type" onchange="changeInput(this,'+id+')"><option value="">Select</option><option value="doc" selected>Document</option><option value="video">Video</option></select></td><td class="align-middle" id="td-content_title'+id+'"><input type="text" name="content_title[]" tid="'+id+'" id="content_title'+id+'" placeholder="Enter Title"  class="form-control"/></td><td class="align-middle" id="td-content'+id+'"><input type="file" name="content[]"  cid="'+id+'" multiple id="content'+id+'"  class="form-control-file"/></td>';
        if(id != 0){
            html +='<td class="align-middle"><button type="button" name="remove" id="'+id+'" class="btn btn-danger btn_remove">X</button></td>';
        }
        html +='</tr>';
        
    }else if(type.value=='video'){
        
        html +='<td class="align-middle" id="td-material_type'+id+'"><select  mid="'+id+'" name="material_type[]"  id="material_type'+id+'" class="form-control upload-type" onchange="changeInput(this,'+id+')"><option value="">Select</option><option value="doc" >Document</option><option value="video" selected>Video</option></select></td><td class="align-middle" id="td-content_title'+id+'"><input type="text" name="content_title[]" tid="'+id+'" id="content_title'+id+'" placeholder="Enter Title" class="form-control"/></td><td class="align-middle" id="td-content'+id+'"><input type="text" name="content[]" cid="'+id+'"  id="content'+id+'" placeholder="Enter Video URL" class="form-control"/></td>';
        if(id !=0 ){
            html +='<td class="align-middle"><button type="button" name="remove" id="'+id+'" class="btn btn-danger btn_remove">X</button></td>';
        }
        html +='</tr>';
    }else{
        html +='<td class="align-middle" id="td-material_type'+id+'"><select  mid="'+id+'" name="material_type[]"  id="material_type'+id+'" class="form-control upload-type" onchange="changeInput(this,'+id+')"><option value="" selected>Select</option><option value="doc" >Document</option><option value="video">Video</option></select></td>';
        if(id != 0){
        html +='<td></td><td></td><td><button type="button" name="remove" id="'+id+'" class="btn btn-danger btn_remove">X</button></td>';
        }
        html +='</tr>';
    }
    
    $('#row'+id).html(html)

}
//Save Study Material

// OPEN MODAL FOR edit study material 
$('body').on('click', '.open-edit-material-modal', function () {
    $('#dvLoading').show();
    //$('#course_id').trigger('change');
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
                var department_html = '';
                for (let i = 0; i < obj.departmentRecord.length; i++) {
                    department_html += '<option value="' + obj.departmentRecord[i].department_id + '">' + obj.departmentRecord[i].department_name + '</option>';
                }
                $('#department_id').html(department_html);

                var stream_html = '';
                for (let i = 0; i < obj.streamRecord.length; i++) {
                    stream_html += '<option value="' + obj.streamRecord[i].stream_id + '">' + obj.streamRecord[i].stream_name + '</option>';
                }
                $('#stream_id').html(stream_html);

                $("#material-title").html("<i class='fa-solid fa-user-graduate text-danger'></i> Edit Content");
                $("#teacher_name").val(obj.data.teacher_name);
                $("#teacher_id").val(obj.data.teacher_id);
                $("#stream_id").val(obj.data.stream_id);
                $("#department_id").val(obj.data.department_id);
                $("#course_id").val(obj.data.course_id);
                $("#material_id").val(obj.data.material_id);
                $("#paper_type_id").val(obj.data.paper_type_id);
                $("#semester_id").val(obj.data.semester_id);
                $("#content_id").val(obj.data.content_id);
                $("#study_id").val(obj.data.study_id);

                
                
                //$("#addRow").css('display','none');
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

$(document).ready(function(){
$('body').on('click', '#save-study-material', function (event) {
    event.preventDefault();
    //alert(verifyInput());
    if (!verifyInput()) {
        return false;
    }

    
    
    $('#dvLoading').show();
    var data = $("#material-form").serialize();
    //var formData = new FormData("form")[0];
    var formData = new FormData(document.getElementById("material-form"));
    formData.append("fileName",$('[name^="material_type"]').files);
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
                console.log(data.studyMaterialRecord);
                console.log(data.studyMaterialRecord[0].course_name);
                var html = '';
                // html += '<table class="table table-bordered " id="teacher-table"><tr><th>SL.</th> <th>Course Name</th> <th>Dept. Name</th> <th>Teacher Name</th> <th>Email</th> <th>Mobile</th> <th>Role</th> <th>Action</th></tr>';
                for (let i = 0; i < data.studyMaterialRecord.length; i++) {
                    var status = (data.studyMaterialRecord[i].is_active == 1) ? "Active" : "Inactive";
                    var status_class = (data.studyMaterialRecord[i].is_active == 1) ? "success" : "danger";
                    html += '<tr><td>' + (i + 1) + '</td><td>' + data.studyMaterialRecord[i].course_name + '</td><td>' + data.studyMaterialRecord[i].stream_name + '</td><td>' + data.studyMaterialRecord[i].department_name + '</td><td>' + data.studyMaterialRecord[i].material_name + '</td><td>' + data.studyMaterialRecord[i].paper_type_name + '</td><td>' + data.studyMaterialRecord[i].semester_id + '</td><td>' + data.studyMaterialRecord[i].title + '</td><td>' + data.studyMaterialRecord[i].content_type + '</td>';
                    if(data.studyMaterialRecord[i].content_type == 'video'){
                    html += '<td><a href="' + data.studyMaterialRecord[i].video_link + '" target="_blank">' + data.studyMaterialRecord[i].video_link + '</a></td>';
                    }else{
                    html += '<td><a href="' + data.studyMaterialRecord[i].document_path + '" target="_blank">' + data.studyMaterialRecord[i].document_path + '</a></td>';
                    }
                    html += '<td><button class="open-edit-material-modal" cid="' + data.studyMaterialRecord[i].content_id + '">Edit</button>&nbsp;<button class="open-delete-material-modal btn btn-' + status_class + '" status="' + data.studyMaterialRecord[i].is_active + '" cid="' + data.studyMaterialRecord[i].content_id + '" >' + status + '</button></td></tr>';
                }
                console.log(html);
                var content_html ='';
                content_html ='<tr id="row0"><td id="td-material_type0"><select name="material_type[]" mid="0"  id="material_type0" class="form-control upload-type" onchange="changeInput(this,0)"><option value="">Select</option><option value="doc">Document</option><option value="video">Video</option></select></td></tr>';
                $('#material-table-body').html(html);
                $('#myTable').html(content_html);
                $('#material_type0').val("");
                $('#material-form')[0].reset();
                $('#stream_id').html('<option value="">Select Stream</option>');
                $('#department_id').html('<option value="">Select Department</option>');
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
    if (!$.trim($("#course_id").val()).length) { // zero-length string AFTER a trim
        $("#course_id").focus();
        toastAlert({
            type: "error",
            title: "",
            message: "Please enter course name",
            buttonText: ""
        })
        return false;
    }
    if (!$.trim($("#stream_id").val()).length) { // zero-length string AFTER a trim
        $("#stream_id").focus();
        toastAlert({
            type: "error",
            title: "",
            message: "Please select stream",
            buttonText: ""
        })
        return false;
    }
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

    if (!$.trim($("#semester_id").val()).length) { // zero-length string AFTER a trim
        $("#semester_id").focus();
        toastAlert({
            type: "error",
            title: "",
            message: "Please select semester",
            buttonText: ""
        })
        return false;
    }
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
        
        // $('[name^="material_type"]').each(function(){  
        //     //alert($.trim(this.value));
        //     var id = $(this).attr("mid");
        //     if($.trim(this.value) == ""){ alert("blank");
        //         $("#material_type"+id).focus();
        //         toastAlert({
        //             type: "error",
        //             title: "",
        //             message: "Please select content type",
        //             buttonText: ""
        //         })
        //         return false;
        //     }else{
        //         if($("#content_title"+id).val() == ""){
        //             toastAlert({
        //                 type: "error",
        //                 title: "",
        //                 message: "Please enter content title",
        //                 buttonText: ""
        //             })
        //             return false;
        //         }
        //         var ctype =  $("#content"+id).attr("type");
        //         if(ctype=="text"){
        //             var msg = "Please enter video link";
        //         }else{
        //             var msg = "Please upload content";
        //         }
        //         if($("#content"+id).val() == ""){
        //             toastAlert({
        //                 type: "error",
        //                 title: "",
        //                 message: msg,
        //                 buttonText: ""
        //             })
        //             return false;
        //         }
        //     }
        // });
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
                    message: "Please select content type",
                    buttonText: ""
                })
                return false;
            }
            if($("#content_title"+id).val() == ""){
                is_err = true;
                toastAlert({
                    type: "error",
                    title: "",
                    message: "Please enter content title",
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
   
   
	    return true;
    }
});