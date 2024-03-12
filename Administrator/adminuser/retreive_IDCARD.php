<?php 
// ob_start();
//session_start();
include("config.php"); 
//include("../../../connection.php");
// include('../../../configuration.php');
 //$usertype = $_SESSION['usertype'];
 //$adminusername = $_SESSION['user'];
 $sessionarr=array();
 $sessionquery = "select distinct session from studentSession ORDER BY session DESC;";
	
	$sessionresult = $dbConn->query($sessionquery);
	
	if($sessionresult) {
		while($sessionrow= $sessionresult->fetch(PDO::FETCH_ASSOC)){
		 $sessionarr[]=$sessionrow["session"];
		 }
	} 
	
	array_push($sessionarr,SESSIONYR);
	
	 $finalsessions = array_values(array_unique($sessionarr)) ;
  
$query = "select distinct appstream,appsubject,appsubjectcode from studentmaster order by appstream asc ,appsubject asc;";
	
	$qryresult = $dbConn->query($query);
	
	if($qryresult) {
		while($row= $qryresult->fetch(PDO::FETCH_ASSOC)){
		 $recordarr[]=$row;
		 }
	} 	

?>
 
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> | Generate Student ID Card</title>
<?php include("../head_includes.php");?>
<style type="text/css">	
.footer{background:#039; padding:0; margin:0; width:100%}
@media only screen and (min-width: 1050px) {.footer{position:fixed; bottom:0; padding:0}}
</style>
</head>
<body>
    <?php include("headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("headermenu_top.php");?>
        
        <div class="pl-3 pr-3 pt-0">
            
            <FORM name="frmIDCard" id="frmIDCard" action="SDMS_ID_CARD/idCard.php" method="post" target="_blank">
			<input type="hidden" id="hdnprintoption" name="hdnprintoption">
            
            <div class="row">
            	<div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Session <span class="text-danger">*</span></span>
                        </div>
                        <select class="custom-select" id="chosession" name="chosession" >
                            <option value="">Select</option>
                            <?php foreach($finalsessions as $session){ ?>
                            <option value="<?php echo $session;?>"><?php echo $session;?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                
            	<div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Semester <span class="text-danger">*</span></span>
                        </div>
                        <select class="custom-select" id="chosemester" name="chosemester" >
                            <option value="">Select</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            <option value="V">V</option>
                            <option value="VI">VI</option>										
                        </select>
                    </div>
                </div>
                
            	<div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Print By <span class="text-danger">*</span></span>
                        </div>
                        <select class="custom-select" id="choprintcategory" name="choprintcategory" onchange="showForm(this.value)" >
                            <option value="">Select</option>
                            <option value="Individual">Generate Individual ID Card</option>
                            <option value="BySubject">Generate Subject-Wise ID Card</option>														
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row justify-content-center m-auto" id="div_frmIndividual" style="display:none">
                <div class="col-md-12 mb-2">
                    <hr>
                </div>
                
                <div class="col-md-4 mb-3">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">College Roll No. <span class="text-danger">*</span></span>
                        </div>
                        <input type="text" id="txtCollegeRollNo" name="txtCollegeRollNo" class="form-control text-uppercase" maxlength="20" onfocus="javascript: $('#txtstudentId').val('');$('#txtapplicationNo').val('');" placeholder="Enter College Roll No.">
                    </div>
                </div>
                
                <div class="col-md-12 text-center">
                    <button class="btn btn-success" type="button" name="retrieve" onClick="printBy('Individual')">
                    	<i class="fa fa-refresh"></i> Generate ID Card
                    </button>
                    
                    <button class="btn btn-danger" type="reset" name="btnreset" id="btnreset">
                    	<i class="fa fa-repeat"></i> Reset Data
                    </button>
                </div>
                
                
                <div class="col-md-12 mt-5 mb-2">
                    <!--<hr>-->
                </div>
                
                <div class="col-md-3 mb-3 text-center">
                    <i class="fa fa-print text-secondary" style="font-size:160px"></i>
                </div>
                
                <div class="col-md-9 mb-3">
                    <ul class="list-group">
                        <li class="list-group-item">
                        	<i class="fa fa-check-square-o"></i> Browser: <span class="text-danger">Google Chrome</span>
                        </li>
                        <li class="list-group-item">
                        	<i class="fa fa-check-square-o"></i> Destination: <span class="text-danger">Set to "Save as PDF"</span>
                        </li>
                        <li class="list-group-item">
                        	<i class="fa fa-check-square-o"></i> Margins: <span class="text-danger">Set to "None"</span>
                        </li>
                        <li class="list-group-item">
                        	<i class="fa fa-check-square-o"></i> Options: <span class="text-danger">Tick "Background graphics"</span>
                        </li>
                    </ul>
                </div>                
            </div>
            
            <div class="row justify-content-center m-auto" id="div_frmSubject" style="display:none">
                <div class="col-md-12 mb-2">
                    <hr>
                </div>
                
                <div class="col-md-4 mb-2">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Choose Subject <span class="text-danger">*</span></span>
                        </div>
                        <select class="custom-select" id="chosubject" name="chosubject" onchange="displayIDCardCount(this.value)">
                            <option value="">Select</option>
                            <option value="All">All</option>
                            <?php foreach($recordarr as $rec){?>
                            <option value="<?php echo $rec["appsubjectcode"]?>"><?php echo $rec["appsubject"]?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-12 mb-4 text-center">
                    <span id="span_totalrecord" class="font-weight-bold text-primary">sadsa</span>
                </div>
                
                <div class="col-md-12 text-center">
                    <button class="btn btn-success" type="button" name="btnsubmit" onClick="printBy('Subject')">
                    	<i class="fa fa-refresh"></i> Generate ID Card
                    </button>
                    
                    <button type="reset" class="btn btn-danger" id="btnreset2" name="btnreset2">
                    	<i class="fa fa-repeat"></i> Reset Data
                    </button>
                </div>
                
                <div class="col-md-12 mt-5 mb-2">
                    <!--<hr>-->
                </div>
                
                <div class="col-md-3 mb-3 text-center">
                    <i class="fa fa-print text-secondary" style="font-size:160px"></i>
                </div>
                
                <div class="col-md-9 mb-3">
                    <ul class="list-group">
                        <li class="list-group-item">
                        	<i class="fa fa-check-square-o"></i> Browser: <span class="text-danger">Google Chrome</span>
                        </li>
                        <li class="list-group-item">
                        	<i class="fa fa-check-square-o"></i> Destination: <span class="text-danger">Set to "Save as PDF"</span>
                        </li>
                        <li class="list-group-item">
                        	<i class="fa fa-check-square-o"></i> Margins: <span class="text-danger">Set to "None"</span>
                        </li>
                        <li class="list-group-item">
                        	<i class="fa fa-check-square-o"></i> Options: <span class="text-danger">Tick "Background graphics"</span>
                        </li>
                    </ul>
                </div>
                
            </div>            
            </FORM>
            
        </div>
        
        <?php include("../footer.php");?>
    </div>	
    <?php include("../footer_includes.php");?>    
</body>
</html>
<script type="text/javascript" src="SDMS_ID_CARD/js/Id_card.js"></script>