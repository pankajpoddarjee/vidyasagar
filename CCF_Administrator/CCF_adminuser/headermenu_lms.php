<nav id="sidebar">
    <div class="sidebar-header p-2">
        <a class="text-light text-decoration-none" href="javascript:void(0)">
            <div class="row p-0 m-0">
                <div class="col-2 text-center p-0 ml-1">
                    <i class="fa fa-user ml-2 mr-2 text-secondary" style="font-size:34px"></i>
                </div>
                <div class="col-9 p-0 m-0">
                    <span class="ml-1"><?php   echo $adminusername;?> </span>
                    <small class=" align-text-top text-light ml-1 d-block"> <?php echo $usertype;?> Type</small>
                </div>
            </div>
        </a>
    </div>

    <ul class="list-unstyled components">
        <!--<p class="pt-0 pb-0"><i class="fa fa-spinner faa-spin animated mr-2"></i>Application Process</p>-->
        <li>
            <a href="dashboard.php"><i class="fa fa-tachometer mr-2"></i>Dashboard</a>
        </li> 
      
         <li>
            <a href="#printSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-print mr-2"></i>LMS</a>
            <ul class="collapse list-unstyled" id="printSubmenu">
                <li>
                    <a href="LMS/course_master.php"><i class="fa fa-print mr-2"></i>Course Master</a>
                </li>
                <li>
                    <a href="retreive_IDCARD.php"><i class="fa fa-print mr-2"></i>Stream Master</a>
                </li>
                <li>
                    <a href="retreive_IDCARD.php"><i class="fa fa-print mr-2"></i>Department Master</a>
                </li>
                <li>
                    <a href="retreive_IDCARD.php"><i class="fa fa-print mr-2"></i>LMS Master</a>
                </li>
            </ul>
        </li> 
    </ul>
</nav>
	