
function getTeacher(){ 
    $('#dvLoading').show();
    var department_id = $('#department_id').val();
    //alert(department_id);
    var data = {action:'get_teacher',department_id:department_id};
    $.ajax({
        type: "POST",
        url: "feedback_ajax.php",
        dataType: "json",
        data: data,
        error: function (data) {
        },
        success: function (data) {
            console.log(data);
            $('#teacher_id').html("");
            var html = '';
            if (data.status == 1) {
                for (let i = 0; i < data.teacherRecord.length; i++) {
                    html += '<option value="' + data.teacherRecord[i].teacher_id + '">' + data.teacherRecord[i].teacher_name + '</option>';
                }

                $('#teacher_id').html(html);
            }
            else {
                html += '<option value="">Select</option>';
                $('#teacher_id').html(html);

            }
        },
        complete: function () {
            $('#dvLoading').hide();
        }

    });
}

// Submit Teacher Feedback
$('body').on('click', '#teacher-feedback-submit', function (event) {
    if (!verifyInputTeacherFeedback()) {
        return false;
    }

    var formData = new FormData(document.getElementById("teacher-feedback-form"));
        formData.append("action",'submit_teacher_feedback');
        formData.append("teacher_id",$('#teacher_id').val());
        $.ajax({
            type: "post",
            async: false,
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
            url: "feedback_ajax.php",
            data: formData,
            dataType: "json",
    
            success: function (data) {
    
            if (data.status == 1) {
                
                $('#teacher-feedback-form')[0].reset();
                $('#department_id').val('');
                html = '<option value="">Select</option>';
                $('#teacher_id').html(html);
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

// Check Validation Teacher Feedback
function verifyInputTeacherFeedback() {
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
    if (!$.trim($("#teacher_id").val()).length) { // zero-length string AFTER a trim
        $("#teacher_id").focus();
        toastAlert({
            type: "error",
            title: "",
            message: "Please select teacher",
            buttonText: ""
        })
        return false;
    }
    
    var is_err = false;
    $('[name^="teacher_question_id"]').each(function(){  
        var qid = $(this).attr("qid");
        var qtext = $(this).attr("qtext");
        if (!$.trim($("#que"+qid).val()).length) { 
            $("#que"+qid).focus();
            is_err = true;
            toastAlert({
                type: "error",
                title: "",
                message: "<b>Select feedback of </b> "+qtext,
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

// Submit College Feedback
$('body').on('click', '#college-feedback-submit', function (event) {
    if (!verifyInputCollegeFeedback()) {
        return false;
    }

    var formData = new FormData(document.getElementById("college-feedback-form"));
        formData.append("action",'submit_college_feedback');
        $.ajax({
            type: "post",
            async: false,
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
            url: "feedback_ajax.php",
            data: formData,
            dataType: "json",
    
            success: function (data) {
    
            if (data.status == 1) {
                
                $('#college-feedback-form')[0].reset();
                
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

// Check Validation College Feedback
function verifyInputCollegeFeedback() {
    var is_err = false;
    $('[name^="college_question_id"]').each(function(){  
        var qid = $(this).attr("qid");
        var qtext = $(this).attr("qtext");
        if (!$.trim($("#que"+qid).val()).length) { 
            $("#que"+qid).focus();
            is_err = true;
            toastAlert({
                type: "error",
                title: "",
                message: "<b>Select feedback of </b> "+qtext,
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

// Submit Library Feedback
$('body').on('click', '#library-feedback-submit', function (event) {
    if (!verifyInputLibraryFeedback()) {
        return false;
    }

    var formData = new FormData(document.getElementById("library-feedback-form"));
        formData.append("action",'submit_library_feedback');
        $.ajax({
            type: "post",
            async: false,
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
            url: "feedback_ajax.php",
            data: formData,
            dataType: "json",
    
            success: function (data) {
    
            if (data.status == 1) {
                
                $('#library-feedback-form')[0].reset();
                
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

// Check Validation Library Feedback
function verifyInputLibraryFeedback() { 
 
    var is_err = false;
    $('[name^="library_question_id"]').each(function(){  
        var qid = $(this).attr("qid");
        var qtext = $(this).attr("qtext");
        if (!$.trim($("#que"+qid).val()).length) { 
            $("#que"+qid).focus();
            is_err = true;
            toastAlert({
                type: "error",
                title: "",
                message: "<b>Select feedback of </b> "+qtext,
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

// Submit Subject Feedback
$('body').on('click', '#subject-feedback-submit', function (event) {
    if (!verifyInputSubjectFeedback()) {
        return false;
    }

    var formData = new FormData(document.getElementById("subject-feedback-form"));
        formData.append("action",'submit_subject_feedback');
        $.ajax({
            type: "post",
            async: false,
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
            url: "feedback_ajax.php",
            data: formData,
            dataType: "json",
    
            success: function (data) {
    
            if (data.status == 1) {
                
                $('#subject-feedback-form')[0].reset();
                
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
// Check Validation Subject Feedback
function verifyInputSubjectFeedback() { 
    
    if (!$.trim($("#introduce_new_suject").val()).length) { // zero-length string AFTER a trim
        $("#introduce_new_suject").focus();
        toastAlert({
            type: "error",
            title: "",
            message: "<b>Select feedback of </b>The college should introduce more new subjects (offered by the university)?",
            buttonText: ""
        })
        return false;
    }
    if($("#introduce_new_suject").val() == 'Yes' && ($("#subject_id").val() == '' || $("#subject_id").val() == undefined)){
        toastAlert({
            type: "error",
            title: "",
            message: "<b>Select feedback of </b>Which new subject from university curriculum the college should introduce?",
            buttonText: ""
        })
        return false;
    }
    if (!$.trim($("#introduce_new_cop").val()).length) { // zero-length string AFTER a trim
        $("#introduce_new_cop").focus();
        toastAlert({
            type: "error",
            title: "",
            message: "<b>Select feedback of </b>The college should introduce more career oriented programmes?",
            buttonText: ""
        })
        return false;
    }
    if($("#introduce_new_cop").val() == 'Yes' && ($("#cop_id").val() == '' || $("#cop_id").val() == undefined)){
        toastAlert({
            type: "error",
            title: "",
            message: "<b>Select feedback of </b>Which career oriented programmes do you think that the college should introduce?",
            buttonText: ""
        })
        return false;
    }
    
    return true;
}
$('body').on('change', '#introduce_new_suject', function (event) {
    var is_introduce_subject = $(this).val();
    if(is_introduce_subject=='Yes'){
        $("#tr-subject_id").show();
    }else{
        $("#subject_id").val("")
        $("#tr-subject_id").hide();
    }
});
$('body').on('change', '#introduce_new_cop', function (event) {
    var is_introduce_cop = $(this).val();
    if(is_introduce_cop=='Yes'){
        $("#tr-cop_id").show();
    }else{
        $("#cop_id").val("")
        $("#tr-cop_id").hide();

    }
});
// function getsubject(){
//     //var is_introduce_subject = $(this).val();
//     alert('is_introduce_subject');
// }
