<?php include('../configuration_CCF.php');?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> | Administrator Login Panel</title>
<?php include("head_includes.php");?>

<style type="text/css">
body {
	background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab, #d5a123);
	background-size: 400% 400%;
	animation: gradient 15s ease infinite;
	height: 100vh;
}

@keyframes gradient {
	0% {
		background-position: 0% 50%;
	}
	50% {
		background-position: 100% 50%;
	}
	100% {
		background-position: 0% 50%;
	}
}

.wrap {
overflow: hidden;
background:rgba(0,0,0,0.7);
border-radius: 10px;
-webkit-box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 1);
-moz-box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 1);
box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 1); color:#fff;
}

body::-webkit-scrollbar {
  width: 3px;
}

body::-webkit-scrollbar-thumb {
  background-color: #333;
  /*outline: 1px solid slategrey;*/
}
</style>
</head>
<body>

	<section style="margin-top:15vh">
		<div class="container">
            <div class="row justify-content-center">
				<div class="col-md-5">
                    <div class="wrap p-4">
                        <div class="d-flex">
                            <div class="w-100 text-center">
                                <img class="rounded shadow mb-2" width="60" src="<?php echo BASE_URL_HOME;?>/<?php echo COLLEGE_LOGO; ?>" alt="logo"><br>
                                <span style="font-family:Rubik; font-size:20px"><?php echo COLLEGE_NAME;?></span><br>
                                <span style="font-family:AR One Sans">Administrator Login Panel</span>
                                <hr class="bg-secondary">
                            </div>
                        </div>
                        
                        <form id="frmlogin" name="frmlogin" action="" method="post">
                            <div class="form-group mb-3">
                                <label class="label" for="txtcourseType"><i class="fa-solid fa-user-gear"></i> User Type</label>
                                <select name="txtcourseType" id="txtcourseType" class="form-control">
                                    <option value="">Select</option>
                                    <option value="CCF">CCF</option>
                                    <option value="teacher">TEACHER</option>
                                </select>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label class="label" for="txtusername"><i class="fa-regular fa-circle-user"></i> Username</label>
                                <input type="text" class="form-control" name="txtusername" id="txtusername" placeholder="Username" autocomplete="off">
                            </div>
                            
                            <div class="form-group mb-3">
                                <label class="label" for="txtpassword"><i class="fa-solid fa-lock"></i> Password</label>
                                <input type="password" class="form-control" name="txtpassword" id="txtpassword" placeholder="Password" autocomplete="off">
                            </div>
                            
                            <div class="form-group text-center mt-4">
                                <a class="form-control btn btn-danger rounded submit px-3 col-4" type="submit" onclick="verifyLogin()" href="javascript:void(0)">Login <i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                            </div>
                            
                            <!--<div class="form-group d-md-flex">
                                <div class="w-50 text-left">
                                <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                    <input type="checkbox" checked>
                                    <span class="checkmark"></span>
                                </label>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="#">Forgot Password</a>
                                </div>
                            </div>-->
                        </form>
                      	<!--<p class="text-center">Not a member? <a data-toggle="tab" href="#signup">Sign Up</a></p>-->
                      	
                        <div class="text-center mt-4">
                        	<hr class="bg-dark">
                        	<!--Powered by:<br>-->
                            <a class="text-warning text-decoration-none text-center" href="https://www.suryashaktiinfotech.com" target="_blank">
                                <img src="<?php echo BASE_URL_HOME;?>/images/sipl_logo_small.png" width="25" style="vertical-align:top"> 
                                Suryashakti Infotech Pvt. Ltd.
                            </a>
                        </div>
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
    
    <?php include("footer_includes.php");?>    
</body>
</html>
<script src="CCF_js/adminlogin.js"></script>