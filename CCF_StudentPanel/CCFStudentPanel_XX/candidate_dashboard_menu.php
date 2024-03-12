<style type="text/css">
/*a,
a:hover,
a:focus {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s;
}*/
.navbar {
    padding: 15px 10px;
    background: #222;
    border: none;
    border-radius: 0;
    margin-bottom: 40px;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
}

.navbar-btn {
    box-shadow: none;
    outline: none !important;
    border: none;
}

.line {
    width: 100%;
    height: 1px;
    border-bottom: 1px dashed #ddd;
    margin: 40px 0;
}

/* ---------------------------------------------------
    SIDEBAR STYLE
----------------------------------------------------- */

.wrapper {
    display: flex;
    width: 100%;
}

#sidebar {
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    z-index: 999;
    background: #222;
    color: #fff;
    transition: all 0.3s;
}

#sidebar.active {
    margin-left: -250px;
}

#sidebar .sidebar-header {
    background: #333;
}

#sidebar ul.components {
    padding: 10px 0 3px 0;
    /*border-bottom: 1px solid #444;*/
}

.components a{color: inherit;}
.components a:hover{text-decoration:none;transition: all 0.3s;}
.components ul a{font-size: 0.9em !important;padding-left: 30px !important;background: #333;}

#sidebar ul p {
    color: #fff;
    padding: 10px;
}

#sidebar ul li a {
    padding: 10px;
    font-size: 13px;
    display: block;
}

#sidebar ul li a:hover {
    color: #fff;
    background: #555;
}

#sidebar ul li.active>a,
a[aria-expanded="true"] {
    color: #fff;
    background: #444;
}

a[data-toggle="collapse"] {
    position: relative;
}

.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
}

/*ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
    background: #333;
}

ul.CTAs {
    padding: 20px;
}

ul.CTAs a {
    text-align: center;
    font-size: 0.9em !important;
    display: block;
    border-radius: 5px;
    margin-bottom: 5px;
}*/

/*a.download {
    background: #fff;
    color: #7386D5;
}

a.article,
a.article:hover {
    background: #6d7fcc !important;
    color: #fff !important;
}*/

/* ---------------------------------------------------
    CONTENT STYLE
----------------------------------------------------- */

#content {
    width: calc(100% - 250px);
    padding: 0;
    /*min-height: 100vh;*/
    transition: all 0.3s;
    position: absolute;
    top: 0;
    right: 0;
}

#content.active {
    width: 100%;
}

/* ---------------------------------------------------
    MEDIAQUERIES
----------------------------------------------------- */

@media (max-width: 768px) {
    #sidebar {
        margin-left: -250px;
    }
    #sidebar.active {
        margin-left: 0;
    }
    #content {
        width: 100%;
    }
    #content.active {
        width: calc(100% - 250px);
    }
    #sidebarCollapse span {
        display: none;
    }
}
</style>
<link rel="stylesheet" href="<?php echo BASE_URL_HOME;?>/bootstrap/css/menuScrollbar.min.css">
<div class="wrapper d-print-none">
    <!-- Sidebar  -->
    <nav id="sidebar">        
        <div class="sidebar-header p-2">
        	<!--<a class="text-light text-decoration-none" href="javascript: void(0)" onclick="gotoComplete('<?php echo BASE_URL;?>/candidate_profile.php')"> -->
			 
                <div class="row p-0 m-0">
                	<div class="col-2 text-center p-0 ml-1">
						<?php 
                        if($record["photo"]!='') {
                        $photobasepath = BASE_URL."/Upload_Images/".$record["appliedsession"]."/Photograph/".$record["photo"];
                        ?>                
                        <img src="<?php echo $photobasepath; ?>" class="img-fluid" style="height:47px">
                        <?php 
                        }
                        else {
                        ?>
                        <img src="<?php echo BASE_URL_HOME;?>/images/noimage.png" alt="noimage" class="img-fluid" style="height:47px">
                        <?php }?>
                    </div>
                    <div class="col-9 p-0 m-0">
                        <span class="ml-1"><?php echo $_SESSION["studentname"];?></span>
                        <small class=" align-text-top text-light text-uppercase ml-1 d-block">ID: <?php echo $_SESSION["studcollegeRollNo"];?></small>
						<small class=" align-text-top text-light text-uppercase ml-1 d-block">Sem: <?php echo $record["presentsemester"].' ('.ACADEMIC_SESSION.')';?></small>
                    </div>
                </div>
           <!-- </a> -->
        </div>

        <ul class="list-unstyled components">
            <!--<p class="pt-0 pb-0"><i class="fa fa-spinner faa-spin animated mr-2"></i>Application Process</p>-->
            <li>
            <form id="frmdashboard" name="frmdashboard" action="<?php echo BASE_URL_CCF_STUDENT;?>/dashboard.php" method="post">
            	<input type="hidden" id="txtrollno" name="txtrollno" value="<?php echo $_SESSION["studcollegeRollNo"];?>" />
            </form>
			 <a href="javascript: void(0)" onclick="javascript: $('#frmdashboard').submit()"><i class="fa fa-tachometer mr-2"></i>Dashboard</a>
			
            </li> 
			<form id="frmnext" name="frmnext" action="" method="post" >
					<input type="hidden" id="txtcollegerollno" name="txtcollegerollno"  value="<?php echo $collegerollno;?>"/>
				</form>
			 
			<li>
			 <a href="javascript: void(0)" onclick="gonextfor('studentInfo','<?php echo BASE_URL_CCF_STUDENT;?>')"><i class="fa fa-user mr-2"></i>Student Information </a>
            </li>
			<li>
			 <a href="javascript: void(0)"  onclick="gonextfor('courseDetail','<?php echo BASE_URL_CCF_STUDENT;?>')"><i class="fa fa-book mr-2"></i>Course Detail</a>
            </li>
			<li>
			 <a href="javascript: void(0)"  onclick="gonextfor('paymentDetail','<?php echo BASE_URL_CCF_STUDENT;?>')"><i class="fa fa-inr mr-2"></i>Pay Online</a>
            </li> 			
            <li>
                <a href="#printSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-print mr-2"></i>Print</a>
                <ul class="collapse list-unstyled" id="printSubmenu">
                   <li>
						<a href="javascript: void(0)"  onclick="gonextfor('paymentreciept','<?php echo BASE_URL_CCF_STUDENT;?>')"><i class="fa fa-print mr-2"></i>Print Payment Reciept</a>
					</li> 
                </ul>
            </li>
			
            
        </ul>
    </nav>
</div>