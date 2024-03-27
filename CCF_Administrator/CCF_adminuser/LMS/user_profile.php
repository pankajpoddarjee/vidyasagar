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
                    <img class="img-fluid rounded border p-1 shadow-sm" src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHx8MA%3D%3D" alt="">
                    <a class="btn btn-info btn-sm mt-2" href="javascript:void(0)">
                    	<i class="fa-regular fa-pen-to-square"></i> Edit Photo
                    </a>
                </div>
                
                <div class="col-md-6 mb-3 border-right">
                    <h3 class="name">
                    	Soumyadipta Bhattacharya 
                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Edit Profile">
                        	<i class="fa-regular fa-pen-to-square text-danger"></i>
                        </a>
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
        <?php include("../../footer.php");?>
    </div>	
    <?php include("../../footer_includes.php");?>
</body>
</html>
