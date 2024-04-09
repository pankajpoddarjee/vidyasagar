<?php 
include("config.php");
include("lmsfunction.php");
//session_start();
$name = "";
$user_id = isset($_SESSION['userid'])?$_SESSION['userid']:"";
$user_type = ($_SESSION['usertype'] == "teacher")?'teacher':'other';
if($_SESSION['usertype'] == "teacher"){
    $table = 'LMS_teacher_master';
    $where = "teacher_id = $user_id";
}else{
    $table = 'useradmin';
    $where = "id = $user_id";
}
$userQry = $dbConn->prepare("select * FROM ".$table." where ".$where);
$userQry->execute();
$userRecord = $userQry->fetch(PDO::FETCH_ASSOC);
if($userRecord){
    $user_img_path =  (isset($userRecord['profile_image']) && $userRecord['profile_image']!="")?$userRecord['profile_image']:"uploads/profile-image/default.png";

    if($_SESSION['usertype'] == "teacher"){
        $name = $userRecord['teacher_name'];
    }else{
        $name = $userRecord['name'];
    }
    
}


?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">

<link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
<!-- <script src="https://unpkg.com/dropzone"></script> -->
<script src="https://unpkg.com/cropperjs"></script>
<title><?php echo COLLEGE_CODE; ?> | LMS | User Profile</title>
<?php include("../../head_includes.php");?>
</head>
<body >
    <?php include("headermenu_lms.php");?>
    
    <div id="content">
    	<?php include("../../header.php");?>
        <?php include("../headermenu_top.php");?>

<style type="text/css">
.name{font-family:Inter !important; color:#3C3D57}
.designation{font-family:Inter !important; color:#3C3D57}
.department{font-family:Inter !important; color:#3C3D57}
.headings{color:#3C3D57; background-color:rgba(102,102,102,0.2); padding:8px; border-radius:3px; font-family:Oswald}
.details{list-style-type:none; padding:0 0 0 5px; margin:0; font-family:Inter; font-size:14px; color:#5A727E}
.details li {margin-bottom:4px}

.completeness {
    text-align: center;
    vertical-align: middle;
}
.completeness_circle {
    background-color:#adcfd6;
    border-radius: 200px;
    color: #000;
    height: 160px;
    font-weight: bold;
    width: 160px;
    display: table;
    margin: 0 auto;
	border:6px solid rgba(43,123,177,0.4);
}
.completeness_circle p {
    vertical-align: middle;
    display: table-cell; font-size:36px; font-family:Oswald
}

.social {
padding: 14px 18px;
font-size: 16px;
text-align: center;
text-decoration: none;
margin: 5px 2px; border-radius:5px
}

.social:hover {
opacity: 0.8;
}

.facebook {
background: #3B5998;
color: white;
}

.facebook:hover {
color: white;
}

.twitter {
background: #000000;
color: white;
}

.twitter:hover {
color: white;
}

.linkedin {
background: #007bb5;
color: white;
}

.linkedin:hover {
color: white;
}

.youtube {
background: #bb0000;
color: white;
}

.youtube:hover {
color: white;
}


.instagram {
background: #125688;
color: white;
}

.instagram:hover {
color: white;
}
</style>
        
        <div class="container mt-4">
        	<div class="row p-0 m-0">
                <div class="col-md-12 border-bottom mb-3 text-left p-0">
                	<h5 class="sub_head">
                        <i class="fa-solid fa-user-graduate"></i> User <span class="text-danger">Profile</span>
                    </h5>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-2 mb-3 text-center">
                    <img class="img-fluid rounded border p-1 shadow-sm" src="<?php echo $user_img_path?>" alt="profile-pic" id="uploaded_image">
                    <!-- <a class="btn btn-info btn-sm mt-2" href="javascript:void(0)">
                    	<i class="fa-regular fa-pen-to-square"></i> Edit Photo
                    </a> -->
                    <input type="file" name="image" class="image" id="upload_image" style="display:none;"/>
                    <label for="upload_image" class="btn btn-info btn-sm mt-2"><i class="fa-regular fa-pen-to-square"></i> Edit Photo</label>
                </div>
                
                <div class="col-md-6 mb-3 border-right">
                    <h3 class="name">
                    	<?php echo strtoupper($name); ?>
                        <?php if($user_type=='teacher'){ ?>
                        <a href="javascript:void(0)"  title="Edit Profile" class="open-edit-user-modal"  data-toggle="modal" data-target="#edit-profile-modal">
                        	<i class="fa-regular fa-pen-to-square text-danger"></i>
                        </a>
                        <?php } ?>
                    </h3>
                    <h6 class="designation">Assistant Professor</h6>
                    <hr>
                    <ul class="details">
                    	<li><i class="fa-solid fa-person"></i> Male</li>
                    	<li><i class="fa-solid fa-cake-candles"></i> March 11, 1992</li>
                    	<li><i class="fa-solid fa-location-dot"></i> Kolkata, West Bengal</li>
                    </ul>
                </div>
                
                <div class="col-md-4 completeness mb-3">
                    <div class="completeness_circle">
                        <p>60%</p>
                    </div>                    
                    <p class="p-0 mt-2">Profile Completeness</p>
                </div>
            </div>
            
            <hr>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5 class="headings"><i class="fa-solid fa-user-tie"></i> Basic Information</h5>
                    <ul class="details">
                    	<li><i class="fa-solid fa-genderless"></i> Gender: Male</li>
                    	<li><i class="fa-solid fa-person"></i> Marital Status: Married</li>
                    	<li><i class="fa-solid fa-cake-candles"></i> Date of Birth: March 11, 1992</li>
                    	<li><i class="fa-solid fa-cake-candles"></i> Anniversary Date: January 27, 2019</li>
                    </ul>
                </div>
                
                <div class="col-md-4 mb-3">
                    <h5 class="headings"><i class="fa-solid fa-briefcase"></i> Work Details</h5>
                    <ul class="details">
                    	<li><i class="fa-solid fa-calendar-days"></i> Date of Joining: April 20, 2022</li>
                    	<li><i class="fa-solid fa-user-tie"></i> Designation: Assistant Professor</li>
                    	<li><i class="fa-solid fa-book"></i> Department: Physics</li>
                    </ul>
                </div>
                
                <div class="col-md-4 mb-3">
                    <h5 class="headings"><i class="fa-solid fa-earth-asia"></i> Contact Details</h5>
                    <ul class="details">
                    	<li>
                            <i class="fa-solid fa-map-location-dot"></i> 38/1B, S.G.M. Lane, Kolkata, West Bengal, India
                        </li>
                    	<li><i class="fa-solid fa-mobile-screen-button"></i> +91 8100299860</li>
                    	<li><i class="fa-brands fa-whatsapp"></i> +91 8100299860</li>
                    	<li><i class="fa-solid fa-at"></i> bharracharya.soumyadipta@gmail.com</li>
                    	<li><i class="fa-solid fa-earth-asia"></i> www.soumyacons.com</li>
                        <hr>
                        <i class="fa-solid fa-link"></i> Connect via
                        <li class="mt-4">
                            <a href="#" class="social facebook text-decoration-none"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#" class="social twitter text-decoration-none"><i class="fa-brands fa-x-twitter"></i></a>
                            <a href="#" class="social linkedin text-decoration-none"><i class="fa-brands fa-linkedin-in"></i></a>
                            <a href="#" class="social youtube text-decoration-none"><i class="fa-brands fa-youtube"></i></a>
                            <a href="#" class="social instagram text-decoration-none"><i class="fa-brands fa-instagram"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>
        <!-- //open crop image modal -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Crop Image Before Upload</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-8">
                                    <img src="" id="sample_image" />
                                </div>
                                <div class="col-md-4">
                                    <div class="preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="crop" class="btn btn-primary">Crop</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>	
        <!-- //close crop image modal -->
        <!-- //open edit profile modal -->
        <div class="modal fade" id="edit-profile-modal" tabindex="-1" role="dialog" aria-labelledby="ValidationAlertTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" id="profile-form">
                    <div class="modal-header">
                        <h4 class="modal-title" style="font-family:Oswald">Edit Profile</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label for="teacher_name">Name</label>
                                    <input type="text" class="form-control" id="teacher_name" name="teacher_name" maxlength="100" data-trigger="focus" placeholder="Enter Name" autocomplete="off" value="<?php echo $userRecord['teacher_name']; ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="email">Email Id.</label>
                                    <input type="text" class="form-control" id="email" name="email" maxlength="100" data-trigger="focus" placeholder="Enter Teacher Email" autocomplete="off" value="<?php echo $userRecord['email']; ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="mobile">Mobile No.</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" maxlength="10" data-trigger="focus" onKeyPress="inputNumber(event,this.value,false);" inputmode="numeric" placeholder="Enter Teacher Mobile No." autocomplete="off" value="<?php echo $userRecord['mobile']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="teacher_name">Address</label>
                                    <textarea name="address" id="address" cols="30" rows="3" class="form-control"  placeholder="Enter Address"><?php echo $userRecord['address']; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="teacher_name">Gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="">Select</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="dob">Date Of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob" data-trigger="focus"  autocomplete="off" value="<?php echo $userRecord['dob']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="doj">Date Of Joining</label>
                                    <input type="date" class="form-control" id="doj" name="doj" data-trigger="focus"  autocomplete="off" value="<?php echo $userRecord['doj']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="teacher_name">Is Married</label>
                                    <select name="is_married" id="is_married" class="form-control">
                                        <option value="">Select</option>
                                        <option value="1" <?php echo ($userRecord['is_married'] == 1)?"selected":""; ?> >Yes</option>
                                        <option value="0" <?php echo ($userRecord['is_married'] == 0)?"selected":""; ?> >No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2" id="doa-div" style="display:<?php echo ($userRecord['is_married'] == 1)?'block':'none'; ?> ">
                                <div class="form-group">
                                    <label for="doj">Date Of Anniversary</label>
                                    <input type="date" class="form-control" id="doa" name="doa" data-trigger="focus"  autocomplete="off" value="<?php echo $userRecord['doa']; ?>">
                                </div>
                            </div>
                            <input type="hidden" id="teacher_id" name="teacher_id" class="form-control" value="<?php echo $userRecord['teacher_id']; ?>">                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="update-profile" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <!-- //close edit profile modal -->
        <?php include("../../footer.php");?>
    </div>	
    <?php include("../../footer_includes.php");?>

    <script>

    $(document).ready(function(){

        var $modal = $('#modal');

        var image = document.getElementById('sample_image');

        var cropper;

        $('#upload_image').change(function(event){
            var files = event.target.files;

            var done = function(url){
                image.src = url;
                $modal.modal('show');
            };

            if(files && files.length > 0)
            {
                reader = new FileReader();
                reader.onload = function(event)
                {
                    done(reader.result);
                };
                reader.readAsDataURL(files[0]);
            }
        });

        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview:'.preview'
            });
        }).on('hidden.bs.modal', function(){
            cropper.destroy();
            cropper = null;
        });

        $('#crop').click(function(){
            canvas = cropper.getCroppedCanvas({
                width:400,
                height:400
            });

            canvas.toBlob(function(blob){
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function(){
                    var base64data = reader.result;
                    $.ajax({
                        url:'upload_profile_image.php',
                        method:'POST',
                        data:{image:base64data},
                        success:function(data)
                        {
                            $modal.modal('hide');
                            $('#uploaded_image').attr('src', data);
                        }
                    });
                };
            });
        });
        
    });

    // OPEN MODAL FOR EDIT USER 
    $('body').on('click', '#update-profile', function () {
        if (!verifyInput()) {
            return false;
        }

        $('#dvLoading').show();
        var data = $("#profile-form").serialize();
        $.ajax({
            type: "post",
            async: false,
            url: "edit_user_profile.php",
            data: data,
            dataType: "json",

            success: function (data) {

                if (data.status == 1) {
                    $('#edit-profile-modal').modal('hide');
                    

                    toastAlert({
                        type: "success",
                        title: "",
                        message: data.msg,
                        buttonText: ""
                    })
                    location.reload();
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

    function verifyInput() {
       
        
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
        return true;
    }

    $("#is_married").change(function () {
        var is_married = $("#is_married").val();
        if(is_married == 1){
            $('#doa-div').show();
        }else{
            $('#doa-div').hide();
        }
    });
    </script>
</body>
</html>
