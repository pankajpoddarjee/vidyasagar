<?php include('../settings.php');?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> | Permission denied</title>
<?php include("../head_includes.php");?>
</head>
<body class="bg">    
    <div id="content">
		<style type="text/css">
        .bg{background: rgb(88,183,1);
        background: -moz-linear-gradient(90deg, rgba(88,183,1,0.5508578431372548) 0%, rgba(225,237,69,0.500437675070028) 24%, rgba(177,213,0,0.5844712885154062) 62%, rgba(207,232,167,0.80015756302521) 91%, rgba(88,183,1,0.45281862745098034) 100%);
        background: -webkit-linear-gradient(90deg, rgba(88,183,1,0.5508578431372548) 0%, rgba(225,237,69,0.500437675070028) 24%, rgba(177,213,0,0.5844712885154062) 62%, rgba(207,232,167,0.80015756302521) 91%, rgba(88,183,1,0.45281862745098034) 100%);
        background: linear-gradient(90deg, rgba(88,183,1,0.5508578431372548) 0%, rgba(225,237,69,0.500437675070028) 24%, rgba(177,213,0,0.5844712885154062) 62%, rgba(207,232,167,0.80015756302521) 91%, rgba(88,183,1,0.45281862745098034) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#58b701",endColorstr="#58b701",GradientType=1);}
        .footer{background:#039; padding:10px 0; margin:0; width:100%}
        .footer{position:fixed; bottom:0; padding:0}
        </style>
        
        <div class="container">
            <div class="row justify-content-center mt-5">
            	<div class="col-md-5 steps_follow_animation mt-5">
                	<div class="shadow">
                        <div style="margin:5px 0; line-height:22px" class="overflow-hidden p-5 text-center font-weight-bold">
							<?php session_start(); echo 
							"<i class='fa fa-times-circle faa-flash animated text-danger' style='font-size:36px'></i><br>
							You don't have permission to access this page55555."
							;?>
                            <br><br>
                            <a class="btn btn-info btn-sm" href="logoutuser.php"><i class="fa fa-sign-in mr-2"></i>Click here to Log-in</a>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
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
          
        <?php include("../../footer.php");?>
    </div>	
    <?php include("../../footer_includes.php");?>    
</body>
</html>