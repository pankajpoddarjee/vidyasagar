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
            <a href="#searchSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-search mr-2"></i>Search</a>
            <ul class="collapse list-unstyled" id="searchSubmenu">
                <li>
                    <a href="search_candidate.php"><i class="fa fa-angle-right mr-2"></i>Student Search</a>
                </li>
            </ul>
        </li>
		 <!--<li>
            <a href="#editSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-search mr-2"></i>Update</a>
            <ul class="collapse list-unstyled" id="editSubmenu">
                <li>
                    <a href="searchforCourseEdit.php"><i class="fa fa-angle-right mr-2"></i>Course Detail</a>
                </li>
            </ul>
        </li>-->
        <li>
            <a href="#reportSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-bar-chart mr-2"></i>Reports</a>
            <ul class="collapse list-unstyled" id="reportSubmenu">
               <li>
                    <a href="report_applicantlist.php"><i class="fa fa-angle-right mr-2"></i>List of Student</a>
                </li>
				 <li>
                    <a href="report_applicantEligibleforPay.php"><i class="fa fa-angle-right mr-2"></i>Student Eligible for Payment</a>
                </li>
				 <li>
                    <a href="report_courseDetail.php"><i class="fa fa-angle-right mr-2"></i>Student Course Detail</a>
                </li>
				<li>
                    <a href="report_AdmissionPayment.php"><i class="fa fa-angle-right mr-2"></i>Admission Fee Payment Detail</a>
                </li>
				<li>
                    <a href="report_AdmPayWithcourse.php"><i class="fa fa-angle-right mr-2"></i>Admission Fee Payment with Course Detail</a>
                </li>
                <li>
                    <a href="report_OtherPayment.php"><i class="fa fa-angle-right mr-2"></i>Other Fee Payment Detail</a>
                </li>
				<li>
                    <a href="report_OtherPayWithcourse.php"><i class="fa fa-angle-right mr-2"></i>Other Fee Payment with Course Detail</a>
                </li>
            </ul>
        </li>
         <li>
            <a href="#printSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-print mr-2"></i>Print</a>
            <ul class="collapse list-unstyled" id="printSubmenu">
                <li>
                    <a href="retreive_IDCARD.php"><i class="fa fa-print mr-2"></i>Print ID Card</a>
                </li>
            </ul>
        </li> 
        <!--<li>
            <a href="#printSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-print mr-2"></i>Print</a>
            <ul class="collapse list-unstyled" id="printSubmenu">
                <li>
                    <a href="getPaymentReciept.php"><i class="fa fa-print mr-2"></i>Payment Reciept</a>
                </li>
            </ul>
        </li>-->
    </ul>
</nav>
	