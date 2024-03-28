<nav class="navbar sticky-top navbar-expand-lg navbar-dark p-2 mb-3 d-print-none">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn btn-secondary">
            <i class="fa fa-bars"></i>
            <span>Show / Hide</span>
        </button>
        <button class="btn btn-secondary d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-user"></i>
        </button>
        		 
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
            	<!--<li class="nav-item active">
                    <a class="nav-link" href="javascript:void(0)"><i class="fa fa-user mr-2"></i><?php echo $adminusername;?></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo BASE_URL_HOME;?>/CCF_Administrator/CCF_adminuser/logoutuser.php"><i class="fa fa-power-off mr-2 text-danger"></i>Logout</a>
                </li>-->
                
                
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle no-BG" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-none d-lg-inline text-warning text-uppercase">
						<?php if ($_SESSION["loggedin"]) {?><?php echo $_SESSION['user'];?><?php }?>
                        </span>                        
                        <span class="d-none d-lg-inline text-white"><i class="fa fa-user border border-dark p-1 rounded" style="font-size:16px; color:rgba(255,255,255,0.6)"></i></span>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="user_profile.php">
                            <i class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                            <i class="fa fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                            Change Password
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                            <i class="fa fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#logoutModal">
                            <i class="fa fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i>
                            <span class="text-danger">Logout</span>
                        </a>
                    </div>
                </li>
                
            </ul>
        </div>
    </div>
</nav>
<script src="<?php echo BASE_URL_HOME;?>/bootstrap/js/menuScrollbar.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#sidebar").mCustomScrollbar({
			theme: "minimal"
		});

		$('#sidebarCollapse').on('click', function () {
			$('#sidebar, #content').toggleClass('active');
			$('.collapse.in').toggleClass('in');
			$('a[aria-expanded=true]').attr('aria-expanded', 'false');
		});
	});
</script>
<script src="<?php echo BASE_URL;?>/CCF_Administrator/CCF_adminuser/adminuser_js/admin_dashboard.js"></script>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalModalLongTitle">Ready to Leave ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <p class="p-0 m-0" style="font-family:'Rubik'">
            <h5>Are you sure you want to Logout?</h5>
            <h6>This will end your current session.</h6>
        </p>
      </div>
      
      <div class="modal-footer">
        <a type="button" class="btn btn-danger btn-sm" href="<?php echo BASE_URL_HOME;?>/CCF_Administrator/CCF_adminuser/logoutuser.php"><i class="fa fa-sign-out fa-sm fa-fw"></i> Logout</a>
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>