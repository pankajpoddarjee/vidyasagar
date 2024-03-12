<nav class="navbar sticky-top navbar-expand-lg navbar-dark p-2 mb-4 d-print-none">
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
                    <a class="nav-link" href="javascript:void(0)" data-toggle="modal" style="color:#FFEDA6">Academic Session : <?php echo ACADEMIC_SESSION;?></a>
                </li>
				<li class="nav-item active">
                    <a class="nav-link" href="javascript:void(0)" data-toggle="modal" data-target="#helpline"><i class="fa fa-phone faa faa-tada animated mr-2"></i>Helpline</a>
                </li>
                <!--<li class="nav-item active">
                 <form id="frmProfile" name="frmProfile" action="candidate_profile.php" method="post">
                	<input type="hidden" id="txtappnoforprofile" name="txtappnoforprofile" value="<?php echo $applicationno?>" />
                </form>
                    <a class="nav-link"  href="javascript: void(0)" onclick="gotoComplete('<?php echo BASE_URL;?>/candidate_profile.php')"><i class="fa fa-user mr-2"></i>Profile</a>
                </li>
                 <li class="nav-item active">
                    <a class="nav-link" href="javascript: void(0)" onclick="gotoComplete('<?php echo BASE_URL;?>/change_password.php')"><i class="fa fa-key mr-2"></i>Change Password</a>
                </li>--> 
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo BASE_URL_STUDENT;?>/candidateLogout.php"><i class="fa fa-power-off mr-2 text-danger"></i>Logout</a>
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