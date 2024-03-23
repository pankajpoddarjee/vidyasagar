<?php 
include("config.php");
include("lmsfunction.php");
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
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
                    <img class="img-fluid rounded border p-1" src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHx8MA%3D%3D" alt="">
                    <a class="btn btn-info btn-sm mt-2" href="javascript:void(0)">
                    	<i class="fa-regular fa-pen-to-square"></i> Edit Photo
                    </a>
                </div>
                
                <div class="col-md-10 mb-3">
                    <h3 class="name">Soumyadipta Bhattacharya</h3>
                    <h6 class="designation">Assistant Professor</h6>
                </div>
            </div>
            
            <hr>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5 class="headings">Basic Information</h5>
                    <i class="fa-solid fa-cake-candles"></i> March 11, 1992
                </div>
                
                <div class="col-md-4 mb-3">
                    <h5 class="headings">Work Details</h5>
                </div>
                
                <div class="col-md-4 mb-3">
                    <h5 class="headings">Contact Details</h5>
                </div>
            </div>
            
        </div>
        <?php include("../../footer.php");?>
    </div>	
    <?php include("../../footer_includes.php");?>
</body>
</html>
