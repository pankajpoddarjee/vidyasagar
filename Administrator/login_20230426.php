<?php include('../configuration.php');?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> | Administrator Login Panel</title>
<?php include("head_includes.php");?>
</head>
<body class="bg">    
    <div id="content">
    	<?php /*?><?php include("header.php");?><?php */?>
        <section class="text-dark shadow">
            <div class="container-fluid">
                <div class="row" style="padding:8px 0">
                    <div class="col-md-2">
                        <div class="text-center">
                            <img class="rounded shadow mb-2" width="65" src="<?php echo BASE_URL_HOME;?>/<?php echo COLLEGE_LOGO; ?>" alt="logo">
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <h2 class="text-center font-weight-bold text-uppercase" style="font-family:Poppins"><?php echo COLLEGE_NAME; ?></h2>
                        <h6 class="text-center"><?php echo COLLEGE_TAG;?></h6>
                        <h6 class="text-center">Administrator Login Panel</h6>                        
                    </div>
                    
                    <div class="col-md-2 d-none d-lg-block">
                        <div class="text-center">
                            <!--<img src="images/ashok_stambh_logo.png" alt="ashok stambh logo">-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
		<style type="text/css">
        .bg{background: rgb(88,183,1);
        background: -moz-linear-gradient(90deg, rgba(88,183,1,0.5508578431372548) 0%, rgba(225,237,69,0.500437675070028) 24%, rgba(177,213,0,0.5844712885154062) 62%, rgba(207,232,167,0.80015756302521) 91%, rgba(88,183,1,0.45281862745098034) 100%);
        background: -webkit-linear-gradient(90deg, rgba(88,183,1,0.5508578431372548) 0%, rgba(225,237,69,0.500437675070028) 24%, rgba(177,213,0,0.5844712885154062) 62%, rgba(207,232,167,0.80015756302521) 91%, rgba(88,183,1,0.45281862745098034) 100%);
        background: linear-gradient(90deg, rgba(88,183,1,0.5508578431372548) 0%, rgba(225,237,69,0.500437675070028) 24%, rgba(177,213,0,0.5844712885154062) 62%, rgba(207,232,167,0.80015756302521) 91%, rgba(88,183,1,0.45281862745098034) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#58b701",endColorstr="#58b701",GradientType=1);}
        .footer{background:#039; padding:10px 0; margin:0; width:100%}
        @media only screen and (min-width: 1050px) {.footer{position:fixed; bottom:0; padding:0}}
        </style>
        
        <div class="container">
            <div class="row justify-content-center mt-5">
            	<div class="col-md-5 steps_follow_animation mt-5">
                	<div class="shadow">
                        <div class="shadow p-3 font-weight-bold"><i class="fa fa-sign-in"></i> Authentication Required</div>
                        <div style="margin:5px 0" class="overflow-hidden p-5">
                        	<span class="pt-0 mt-0"><i class="fa fa-key"></i> Enter Credentials</span>
                            <form id="frmlogin" name="frmlogin" action="" method="post">
							 
                                <div class="input-group mb-3 mt-2">
                                    <!--<div class="input-group-prepend">
                                        <span class="input-group-text">Student Id <span class="text-danger">*</span></span>
                                    </div>-->
                                    <input type="text" id="txtusername" name="txtusername" class="form-control" placeholder="Username">
                                </div>
                                
                                <div class="input-group mb-3">
                                    <input type="password" id="txtpassword" name="txtpassword" class="form-control" placeholder="Password">
                                </div>
                                
                                <p class="text-center" style="margin:15px 0 10px 0">
                                    <a  class="btn btn-sm btn-primary" href="javascript: void(0)" onclick="verifyLogin()"><i class="fa fa-sign-in"></i> LOG-IN</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
        <!--MODAL START-->
        <div class="modal fade" id="ValidationAlert" tabindex="-1" role="dialog" aria-labelledby="ValidationAlertTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="ShowValidationAlert"><?php echo MODAL_VALIDATION_TEXT;?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-left" id="msgcontent">
                    	
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--MODAL END-->
          
        <?php include("footer.php");?>
    </div>	
    <?php include("footer_includes.php");?>    
</body>
</html>
<script src="js_developer/adminlogin.js"></script>