<?php include('../configuration_CCF.php');?>
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
        <section class="text-white shadow">
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
                        <h6 class="text-center">CCF Administrator Login Panel</h6>                        
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
        .footer{background:#039; padding:10px 0; margin:0; width:100%}
        @media only screen and (min-width: 1050px) {.footer{position:fixed; bottom:0; padding:0}}
        </style>
        
		<style type="text/css">
        .bg{background:url(bg.jpg) no-repeat fixed; background-size:cover}
        </style>
        
        <section class="mt-5"><!--vh-100-->
          <div class="container py-2">
            <div class="row d-flex justify-content-center align-items-center h-100">
              <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                  <div class="card-body p-5 text-center">
        
                    <form id="frmlogin" name="frmlogin" action="" method="post">
                    <div class="mb-md-5 mt-md-4 pb-5">
        
                      <h2 class="fw-bold mb-2 text-uppercase"><i class="fa fa-lock"></i> Login</h2>
                      <p class="text-white-50 mb-5">Please enter your username and password!</p>
					  
					   <div class="form-outline form-white mb-4">
					   Course Type
                        <select id="txtcourseType" name="txtusername" class="form-control form-control-lg">
						<option value="">Select</option>
						<!--<option value="CBCS">CBCS</option>-->
						<option value="CCF">CCF</option>
            <option value="teacher">TEACHER</option>
						</select>
                       
						</div>
        
                      <div class="form-outline form-white mb-4">
                        <input type="text" id="txtusername" name="txtusername" class="form-control form-control-lg" placeholder="Username">
                        <!--<label class="form-label" for="txtusername">Username</label>-->
                      </div>
        
                      <div class="form-outline form-white mb-4">
                        <input type="password" id="txtpassword" name="txtpassword" class="form-control form-control-lg" placeholder="Password">
                        <!--<label class="form-label" for="txtpassword">Password</label>-->
                      </div>
        
                      <!--<p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>-->
        
                      <a class="btn btn-danger btn-lg px-5" type="submit" onclick="verifyLogin()">Login <i class="fa fa-sign-in"></i></a>
                      
                      <!--<a class="btn btn-sm btn-primary" href="javascript: void(0)" onclick="verifyLogin()"><i class="fa fa-sign-in"></i> LOG-IN</a>-->
                      
                    </div>
                    </form>
        
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
		
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
<script src="CCF_js/adminlogin.js"></script>