<?php
include("../../sessionConfig.php");
include("../../../connection_CCF.php");
include("../../function.php");
include("../../../configuration_CCF.php");
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title>LMS - Dashboard - <?php echo COLLEGE_NAME; ?></title>
<?php include("../../head_includes.php");?>
</head>
<body>
<style type="text/css">	
/*.footer{background:#039; padding:0; margin:0; width:100%}
@media only screen and (min-width: 1050px) {.footer{position:fixed; bottom:0; padding:0}}*/
.grey-bg {  
    background-color: #F5F7FA;
}
.testimonial-card .card-up {
  height: 120px;
  overflow: hidden;
  border-top-left-radius: .25rem;
  border-top-right-radius: .25rem;
}

.aqua-gradient {
  background: linear-gradient(40deg, #3e5cdf, #28c4d8) !important;
}

.testimonial-card .avatar {
  width: 120px;
  height:120px; background:#fff;
  margin-top: -60px;
  overflow: hidden;
  border: 5px solid #fff;
  border-radius: 50%;
}
.animatehov{padding-top:20px; transition:ease-in-out 250ms}
.animatehov:hover{padding-top:10px;}
</style>

    <?php //include("lms_dashboard_menu.php");?>
    
    <div id="content" class="grey-bg">
    	<?php include("../../header.php");?>
        <?php //include("../../candidate_dashboard_menu2.php");?>
        
        <div class="">  <!--pl-3 pr-3 pt-0-->      
            <?php include("../../emergengy_notice_dashboard.php");?>
            
            <div class="container-fluid alert-secondary py-2 mb-2">
            	<div class="row mb-2">
                    <div class="col-md-4 mt-1 mb-1 text-center text-md-left">
                        <h3 class="m-0 p-0" style="font-family:Oswald">
                            <i class="fa-solid fa-user-clock"></i> Session: <span class="text-danger">2024-25</span>
                        </h3>
                    </div>
                    <div class="col-md-4 mt-1 mb-1 text-center">
                        <h3 class="m-0 p-0" style="font-family:Oswald">
                            <i class="fa-solid fa-user-graduate"></i> Semester: <span class="text-danger">III</span>
                        </h3>
                    </div>
                    <div class="col-md-4 mt-1 mb-1 text-center text-md-right">
                        <h3 class="m-0 p-0" style="font-family:Oswald">
                            <i class="fa-solid fa-clipboard-user"></i> Roll: <span class="text-danger">24-BA-BNGA-0001</span>
                        </h3>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid mt-3">
            	<div class="row mb-2">
                    <div class="col-md-12 text-center">                        
                        <a class="btn btn-outline-primary pull-left" href="../dashboard_lms.php">
                        	<i class="fa-solid fa-arrow-left-long"></i> Go Back
                        </a>
                    </div>
                    
                    <div class="col-md-12 text-center">                        
                        <h1 style="font-family:Courgette">~ Student's Grievance ~</h1>
                    </div>
                </div>
            </div>
            
            <div class="container">
                <div class="row" style="font-family:Montserrat">
                	<div class="col-md-4 animatehov">
                    	<section class="mx-auto shadow steps_follow_animation" style="max-width: 23rem;">
                            <div class="card testimonial-card mb-3">
                                <div class="card-up aqua-gradient"></div>
                                <div class="avatar mx-auto white">
                                    <img src="../../../images/Complaint_Icon.jpg" class="img-fluid rounded-circle" alt="">
                                </div>
                                <div class="card-body text-center">
                                    <h6 class="card-title">Grievance</h6>
                                    <h5 class="card-title text-uppercase">Complaint Box</h5>
                                    <hr>
                                    <a class="btn btn-danger steps_follow_animation2" href="javascript:void(0)">
                                        Learn more
                                    </a>
                                </div>
                            </div>
                        </section>
                    </div>
                    
                    <div class="col-md-4 animatehov">
                    	<section class="mx-auto shadow steps_follow_animation" style="max-width: 23rem;">
                            <div class="card testimonial-card mb-3">
                                <div class="card-up aqua-gradient"></div>
                                <div class="avatar mx-auto white">
                                    <img src="../../../images/Suggestion_Icon.jpg" class="img-fluid rounded-circle" alt="">
                                </div>
                                <div class="card-body text-center">
                                    <h6 class="card-title">Grievance</h6>
                                    <h5 class="card-title text-uppercase">Suggestion Box</h5>
                                    <hr>
                                    <a class="btn btn-danger steps_follow_animation2" href="javascript:void(0)">
                                        Learn more
                                    </a>
                                </div>
                            </div>
                        </section>
                    </div>
                    
                    <div class="col-md-4 animatehov">
                    	<section class="mx-auto shadow steps_follow_animation" style="max-width: 23rem;">
                            <div class="card testimonial-card mb-3">
                                <div class="card-up aqua-gradient"></div>
                                <div class="avatar mx-auto white">
                                    <img src="../../../images/Sexual_Icon.jpg" class="img-fluid rounded-circle" alt="">
                                </div>
                                <div class="card-body text-center">
                                    <h6 class="card-title">Grievance</h6>
                                    <h5 class="card-title text-uppercase">Sexual Harassment</h5>
                                    <hr>
                                    <a class="btn btn-danger steps_follow_animation2" href="javascript:void(0)">
                                        Learn more
                                    </a>
                                </div>
                            </div>
                        </section>
                    </div>
                    
                </div>
                
            </div>
                    
        </div>
        <?php include("../../footer.php");?>
    </div>	
    <?php include("../../footer_includes.php");?>    
</body>
</html>