<?php 
include("config.php");
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> | Search Candidate</title>
<?php include("../head_includes.php");?>
<style type="text/css">	
.footer{background:#039; padding:0; margin:0; width:inherit}
/*@media only screen and (min-width: 1050px) {*/.footer{position:fixed; bottom:0; padding:0}/*}*/
</style>
</head>
<body>
    <?php include("headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("headermenu_top.php");?>
        <form id="frmsearch" name="frmsearch" action="viewCourse_edit.php" method="post" >
        <div class="container">
        	<div class="row">
            	<div class="col-md-12">
                    <h5 class="text-danger border-bottom mb-3 pb-2">
                    	<i class="fa fa-search"></i>  Update Course
                    </h5>
                </div>
            	<div class="col-md-12" style="margin-top:30px">
                	<div class="row justify-content-center m-auto">
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Collage Roll No.  <span class="text-danger">*</span></span>
                                </div>
                                <input type="text" id="txtRollnoforsearch" name="txtRollnoforsearch" class="form-control text-uppercase" maxlength="20">
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
            
            <div class="row justify-content-center">
                <div class="col-md-4 text-center">
                    <a type="button" id="btngo" name="btngo" onclick="goforCourseEdit()" class="btn btn-primary text-white btn-sm"><i class="fa fa-check-circle mr-2"></i>Submit</a>
                    <a type="button" id="btnreset" name="btnreset" onclick="javascript: $('#txtRegNoforsearch').val('')" class="btn btn-danger text-white btn-sm"><i class="fa fa-repeat mr-2"></i>Reset</a>
                </div>
            </div>
        </div>
		</form>
        
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
        <?php include("../footer.php");?>
    </div>	
    <?php include("../footer_includes.php");?>    
</body>
</html>
<script src="adminuser_js/admin_search.js"></script>