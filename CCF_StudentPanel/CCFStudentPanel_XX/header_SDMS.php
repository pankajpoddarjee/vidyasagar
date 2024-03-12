<section class="text-white" style="background:#0066cc">
    <div class="container-fluid">
        <div class="row" style="padding:13px 0"><!-- style="border-top:4px solid #039; padding:15px 0"-->
            <div class="col-md-2">
                <div class="text-center">
                    <img src="<?php echo BASE_URL; ?>/<?php echo COLLEGE_LOGO; ?>" alt="college logo" width="70">
                </div>
            </div>
            
            <div class="col-md-8">
                <h2 class="text-center font-weight-bold"><?php echo COLLEGE_NAME; ?></h2>
                <?php if(COLLEGE_TAG!='') {?>
                	<h6 class="text-center"><?php echo COLLEGE_TAG; ?></h6>
				<?php } ?>
            </div>
            
            <div class="col-md-2 d-none d-lg-block">
                <div class="text-center">
                    <!--<img src="images/ashok_stambh_logo.png" alt="ashok stambh logo">-->
                </div>
            </div>
        </div>
    </div>
</section>