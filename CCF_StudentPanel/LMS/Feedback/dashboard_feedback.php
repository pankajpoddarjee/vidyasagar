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
  background: linear-gradient(40deg, #3e61df, #27d9d7) !important;
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
                        <h1 style="font-family:Courgette">~ Student's Feedback ~</h1>
                    </div>
                </div>
            </div>
            
            <div class="container">
                <div class="row" style="font-family:Montserrat">
                	<div class="col-md-3 animatehov">
                    	<section class="mx-auto shadow steps_follow_animation" style="max-width: 23rem;">
                            <div class="card testimonial-card mb-3">
                                <div class="card-up aqua-gradient"></div>
                                <div class="avatar mx-auto white">
                                    <img src="../../../images/Teacher_Evaluation_Icon.jpg" class="img-fluid rounded-circle" alt="">
                                </div>
                                <div class="card-body text-center">
                                    <h6 class="card-title">Feedback on</h6>
                                    <h5 class="card-title text-uppercase">Teacher Evaluation</h5>
                                    <hr>
                                    <a class="btn btn-danger steps_follow_animation2" href="feedback_teacher_evaluation.php">
                                        Learn more
                                    </a>
                                </div>
                            </div>
                        </section>
                    </div>
                    
                    <div class="col-md-3 animatehov">
                    	<section class="mx-auto shadow steps_follow_animation" style="max-width: 23rem;">
                            <div class="card testimonial-card mb-3">
                                <div class="card-up aqua-gradient"></div>
                                <div class="avatar mx-auto white">
                                    <img src="../../../images/Institution_Icon.jpg" class="img-fluid rounded-circle" alt="">
                                </div>
                                <div class="card-body text-center">
                                    <h6 class="card-title">Feedback on</h6>
                                    <h5 class="card-title text-uppercase">College / Institution</h5>
                                    <hr>
                                    <a class="btn btn-danger steps_follow_animation2" href="feedback_institution.php">
                                        Learn more
                                    </a>
                                </div>
                            </div>
                        </section>
                    </div>
                    
                    <div class="col-md-3 animatehov">
                    	<section class="mx-auto shadow steps_follow_animation" style="max-width: 23rem;">
                            <div class="card testimonial-card mb-3">
                                <div class="card-up aqua-gradient"></div>
                                <div class="avatar mx-auto white">
                                    <img src="../../../images/Library_Icon.jpg" class="img-fluid rounded-circle" alt="">
                                </div>
                                <div class="card-body text-center">
                                    <h6 class="card-title">Feedback on</h6>
                                    <h5 class="card-title text-uppercase">Library</h5>
                                    <hr>
                                    <a class="btn btn-danger steps_follow_animation2" href="feedback_library.php">
                                        Learn more
                                    </a>
                                </div>
                            </div>
                        </section>
                    </div>
                    
                    <div class="col-md-3 animatehov">
                    	<section class="mx-auto shadow steps_follow_animation" style="max-width: 23rem;">
                            <div class="card testimonial-card mb-3">
                                <div class="card-up aqua-gradient"></div>
                                <div class="avatar mx-auto white">
                                    <img src="../../../images/Subjects_Introduced_Icon.jpg" class="img-fluid rounded-circle" alt="">
                                </div>
                                <div class="card-body text-center">
                                    <h6 class="card-title">Feedback on</h6>
                                    <h5 class="card-title text-uppercase">New Subjects</h5>
                                    <hr>
                                    <a class="btn btn-danger steps_follow_animation2" href="feedback_subjects.php">
                                        Learn more
                                    </a>
                                </div>
                            </div>
                        </section>
                    </div>
                    
                </div>
                
                
            </div>
            
            
            
            
            <!--<div class="container-fluid">
            	<div class="row mt-4">
                    <div class="col-4 mb-1">
                        <h4 class="text-uppercase">Soumyadipta Biswas</h4>
                        <p>Bengali Department</p>                        
                    </div>
                    
                    <div class="col-4 mb-1">
                        <h4 class="text-uppercase">Semester IV</h4>
                        <p>Present Session: 202</p>                        
                    </div>
                </div>
                
                <hr>
                
                <div class="row">
                    <div class="col-12 mt-3 mb-1">
                        
                    </div>
                </div>
            </div>-->
            
            
<!--<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/fonts/simple-line-icons/style.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/colors.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap-extended.min.css">-->

            <!--<div class="grey-bg container-fluid">
              <section id="minimal-statistics">
                <div class="row">
                  <div class="col-12 mt-3 mb-1">
                    <h4 class="text-uppercase">Student Detail (Overall)</h4>
                    <p>Statistics on minimal cards.</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xl-3 col-sm-6 col-12"> 
                    <div class="card">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="align-self-center">
                              <i class="icon-pencil primary font-large-2 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                              <h3>278</h3>
                              <span>New Posts</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="align-self-center">
                              <i class="icon-speech warning font-large-2 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                              <h3>156</h3>
                              <span>New Comments</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="align-self-center">
                              <i class="icon-graph success font-large-2 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                              <h3>64.89 %</h3>
                              <span>Bounce Rate</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="align-self-center">
                              <i class="icon-pointer danger font-large-2 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                              <h3>423</h3>
                              <span>Total Visits</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              
                <div class="row">
                  <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                              <h3 class="danger">278</h3>
                              <span>New Projects</span>
                            </div>
                            <div class="align-self-center">
                              <i class="icon-rocket danger font-large-2 float-right"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                              <h3 class="success">156</h3>
                              <span>New Clients</span>
                            </div>
                            <div class="align-self-center">
                              <i class="icon-user success font-large-2 float-right"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              
                  <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                              <h3 class="warning">64.89 %</h3>
                              <span>Conversion Rate</span>
                            </div>
                            <div class="align-self-center">
                              <i class="icon-pie-chart warning font-large-2 float-right"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                              <h3 class="primary">423</h3>
                              <span>Support Tickets</span>
                            </div>
                            <div class="align-self-center">
                              <i class="icon-support primary font-large-2 float-right"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              
                <div class="row">
                  <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                              <h3 class="primary">278</h3>
                              <span>New Posts</span>
                            </div>
                            <div class="align-self-center">
                              <i class="icon-book-open primary font-large-2 float-right"></i>
                            </div>
                          </div>
                          <div class="progress mt-1 mb-0" style="height: 7px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                              <h3 class="warning">156</h3>
                              <span>New Comments</span>
                            </div>
                            <div class="align-self-center">
                              <i class="icon-bubbles warning font-large-2 float-right"></i>
                            </div>
                          </div>
                          <div class="progress mt-1 mb-0" style="height: 7px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              
                  <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                              <h3 class="success">64.89 %</h3>
                              <span>Bounce Rate</span>
                            </div>
                            <div class="align-self-center">
                              <i class="icon-cup success font-large-2 float-right"></i>
                            </div>
                          </div>
                          <div class="progress mt-1 mb-0" style="height: 7px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                              <h3 class="danger">423</h3>
                              <span>Total Visits</span>
                            </div>
                            <div class="align-self-center">
                              <i class="icon-direction danger font-large-2 float-right"></i>
            
                            </div>
                          </div>
                          <div class="progress mt-1 mb-0" style="height: 7px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              
              <section id="stats-subtitle">
              <div class="row">
                <div class="col-12 mt-3 mb-1">
                  <h4 class="text-uppercase">Statistics With Subtitle</h4>
                  <p>Statistics on minimal cards with Title &amp; Sub Title.</p>
                </div>
              </div>
            
              <div class="row">
                <div class="col-xl-6 col-md-12">
                  <div class="card overflow-hidden">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="align-self-center">
                            <i class="icon-pencil primary font-large-2 mr-2"></i>
                          </div>
                          <div class="media-body">
                            <h4>Total Posts</h4>
                            <span>Monthly blog posts</span>
                          </div>
                          <div class="align-self-center">
                            <h1>18,000</h1>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            
                <div class="col-xl-6 col-md-12">
                  <div class="card">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="align-self-center">
                            <i class="icon-speech warning font-large-2 mr-2"></i>
                          </div>
                          <div class="media-body">
                            <h4>Total Comments</h4>
                            <span>Monthly blog comments</span>
                          </div>
                          <div class="align-self-center"> 
                            <h1>84,695</h1>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            
              <div class="row">
                <div class="col-xl-6 col-md-12">
                  <div class="card">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="align-self-center">
                            <h1 class="mr-2">$76,456.00</h1>
                          </div>
                          <div class="media-body">
                            <h4>Total Sales</h4>
                            <span>Monthly Sales Amount</span>
                          </div>
                          <div class="align-self-center">
                            <i class="icon-heart danger font-large-2"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            
                <div class="col-xl-6 col-md-12">
                  <div class="card">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="align-self-center">
                            <h1 class="mr-2">$36,000.00</h1>
                          </div>
                          <div class="media-body">
                            <h4>Total Cost</h4>
                            <span>Monthly Cost</span>
                          </div>
                          <div class="align-self-center">
                            <i class="icon-wallet success font-large-2"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            </div>-->    
            
                    
        </div>
        <?php include("../../footer.php");?>
    </div>	
    <?php include("../../footer_includes.php");?>    
</body>
</html>