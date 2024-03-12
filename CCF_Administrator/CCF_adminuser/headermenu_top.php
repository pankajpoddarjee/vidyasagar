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
            	<li class="nav-item active">
                    <a class="nav-link" href="javascript:void(0)"><i class="fa fa-user mr-2"></i>Welcome <?php echo $adminusername;?></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo BASE_URL_HOME;?>/CCF_Administrator/CCF_adminuser/logoutuser.php"><i class="fa fa-power-off mr-2 text-danger"></i>Logout</a>
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
<script src="adminuser_js/admin_dashboard.js"></script>