<?php 
include("config.php");
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> | Candidate Details</title>
<?php include("../head_includes.php");?>
</head>
<body>
    <?php include("headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("headermenu_top.php");?>        
        
        <div class="container-fluid mt-4">
        	<div class="row m-auto">
            	<div class="col-md-12">
                    <h5 class="text-danger border-bottom mb-3 pb-2">
                    	<i class="fa fa-street-view"></i> Student Info
                  </h5>
                </div>
            	<div class="col-md-2 mb-3">
                    <table class="table table-borderless">                       
                        <tbody>
                            <tr>
                                <td class="text-center">
                                	<img src="http://oas.collegeadmission.in/Scottish/UG2021_TESTING/Apply2021/Upload_Images/Photograph/SCC2100031420_photograph.jpg" width="95" height="110" class="mb-2 border p-1">
                                    <br><img src="http://oas.collegeadmission.in/Scottish/UG2021_TESTING/Apply2021/Upload_Images/Signature/SCC2100031420_signature.jpg" width="120" height="40" class="mb-2 border p-1">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="col-md-5 mb-3">
                    <table class="table table-bordered table-hover shadow">
                        <thead>
                            <tr>
                                <th colspan="4" scope="col" class="bg-secondary text-left text-light font-weight-normal"><i class="fa fa-pencil-square-o"></i> Registration details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Roll No.</td>
                              <td colspan="3" class="text-uppercase">VMC-18-19/5987</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td colspan="3" class="text-success"><i class="fa fa-check-circle"></i> Active</td>
                            </tr>
                            <tr>
                                <td>Application No.</td>
                                <td colspan="3" class="text-uppercase">VMC1800031423 | 2018</td>
                            </tr>
                            <tr>
                                <td>Present Semester</td>
                              <td colspan="3" class="text-uppercase">Semester - VI</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="col-md-5 mb-3">
                    <table class="table table-bordered table-hover shadow">
                        <thead>
                            <tr>
                                <th colspan="4" scope="col" class="bg-secondary text-left text-light font-weight-normal"><i class="fa fa-user"></i> Student details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Name</td>
                              <td colspan="3">Ankit Das</td>
                            </tr>
                            <tr>
                                <td>Category</td>
                              <td colspan="3">General | West Bengal</td>
                            </tr>                             
                            <tr>
                                <td>Mobile No.</td>
                                <td colspan="3">8100299860 | 9903022607</td>
                            </tr>                            
                            <tr>
                                <td>Whatsapp No.</td>
                                <td colspan="3">8100299860</td>
                            </tr>
                            <tr>
                                <td>E-mail</td>
                                <td colspan="3">ankit.das031992@gmail.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="col-md-12 mb-3">
                    <table class="table table-bordered table-hover shadow">
                        <thead>
                            <tr>
                                <th colspan="12" class="bg-secondary text-left text-light font-weight-normal" scope="col"><i class="fa fa-book"></i> Course Details</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr class="bg-light">
                                <td>Year</td>
                                <td>Semester</td>
                                <td>Course</td>
                                <td>CC1</td>
                                <td>CC2</td>
                                <td>CC3</td>
                                <td>GE</td>
                                <td>LCC</td>
                                <td>DSE</td>
                                <td>AECC</td>
                                <td>SEC</td>
                                <td>Status</td>
                            </tr>
                            <tr>
                                <td>2018</td>
                                <td>I</td>
                                <td>BA General</td>
                                <td>--</td>
                                <td>--</td>
                                <td>--</td>
                                <td>History &amp; Philosophy</td>
                                <td>Bengali</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><i class="fa fa-check-circle-o text-success"></i></td>
                            </tr>
                            <tr>
                                <td>2018</td>
                                <td>II</td>
                                <td>BA General</td>
                                <td>--</td>
                                <td>--</td>
                                <td>--</td>
                                <td>History &amp; Philosophy</td>
                                <td>Bengali</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><i class="fa fa-check-circle-o text-success"></i></td>
                            </tr>
                            <tr>
                                <td>2019</td>
                                <td>III</td>
                                <td>BA General</td>
                                <td>Journalism</td>
                                <td>Film Studies</td>
                                <td>Sanskrit</td>
                                <td>History &amp; Philosophy</td>
                                <td>Bengali</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><i class="fa fa-check-circle-o text-success"></i></td>
                            </tr>
                            <tr>
                                <td>2019</td>
                                <td>IV</td>
                                <td>BA General</td>
                                <td>--</td>
                                <td>--</td>
                                <td>--</td>
                                <td>History &amp; Philosophy</td>
                                <td>Bengali</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><i class="fa fa-check-circle-o text-success"></i></td>
                            </tr>
                            <tr>
                                <td>2020</td>
                                <td>V</td>
                                <td>BA General</td>
                                <td>--</td>
                                <td>--</td>
                                <td>--</td>
                                <td>History &amp; Philosophy</td>
                                <td>Bengali</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><i class="fa fa-exclamation-triangle text-warning"></i></td>
                            </tr>
                            <tr>
                                <td>2020</td>
                                <td>VI</td>
                                <td>BA General</td>
                                <td>--</td>
                                <td>--</td>
                                <td>--</td>
                                <td>History &amp; Philosophy</td>
                                <td>Bengali</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><i class="fa fa-exclamation-triangle text-warning"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
              <div class="col-md-12 mb-3">
                    <table class="table table-bordered table-hover shadow text-center">
                        <thead>
                            <tr>
                                <th colspan="4" scope="col" class="bg-secondary text-left text-light font-weight-normal"><i class="fa fa-building-o"></i> Communication Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                	<span class="text-muted">Permanent Address:</span><br>
                                    38/B SGM Lane, P.O.: Bowbazar, P.S.: Muchipara, Kolkata, West Bengal, India, 700012
                              </td>
                            </tr>
                            <!--<tr>
                                <td>
                                	<span class="text-muted">Local Address:</span><br>
                                    38/B SGM Lane, P.O.: Bowbazar, P.S.: Muchipara, Kolkata, West Bengal, India, 700012
                              </td>
                            </tr>-->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
   
        <?php include("../footer.php");?>
    </div>	
    <?php include("../footer_includes.php");?>    
</body>
</html>