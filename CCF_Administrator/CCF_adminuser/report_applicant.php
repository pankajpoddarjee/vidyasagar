<?php 
include("config.php");

$appdateqry = "SELECT convert(varchar,min(convert(date,appdate ,103)),105)  startappdate,convert(varchar,max(convert(date,appdate ,103)),105)  stopappdate  FROM appmaster WHERE ISNULL(appdate,'')<>'';";
 
$appdateresult = $dbConn->query($appdateqry);

if($appdateresult) {
	while ($appdaterow=$appdateresult->fetch(PDO::FETCH_ASSOC)) {
	$appdatearr[] =$appdaterow; 
	}
}

$appdateresult = NULL;

$paydateqry = "select convert(varchar,min(convert(date,paymentDate ,103)),105) startpaydate,convert(varchar,max(convert(date,paymentDate ,103)),105) stoppaydate  FROM appmaster  WHERE ISNULL(paymentDate,'')<>'';";
 
$paydateresult = $dbConn->query($paydateqry);

if($paydateresult) {
	while ($paydaterow=$paydateresult->fetch(PDO::FETCH_ASSOC)) {
	$paydatearr[] =$paydaterow; 
	}
}

$paydateresult = NULL;
$dbConn = NULL;
 $shiftarr = explode(",",SECTIONS);  
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> |  Application Report</title>
<link rel="stylesheet" type="text/css" href="../js_developer/jquery.datepick.css"> 
<?php include("../head_includes.php");?>
</head>
<body onload="fillstream();">
    <?php include("headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("headermenu_top.php");?>
        
        <form id="frmapplreport" name="frmapplreport" action="CSV_ApplicationList.php" method="post">
        <div class="container">
        	<div class="row">
            	<div class="col-md-12">
                    <h5 class="text-danger border-bottom mb-3 pb-2">
                    	<i class="fa fa-bar-chart"></i> Applicant Report
                    </h5>
                </div>
				  
                <div class="col-md-4">
                	<div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Stream</span>
                        </div>
                        <select id="chostream" name="chostream" class="custom-select"  onChange="fillsubject(this.value);">
                                <option value="All" selected>All</option>
                            </select> 
                    </div>
                </div>
            	<div class="col-md-4">
                	<div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Subject</span>
                        </div>
                        <select id="chosubject" name="chosubject" class="custom-select" >
                                <option value="All" selected>All</option>
                            </select>
                    </div>
                </div>
                
                <div class="col-md-4">
                	<div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Status</span>
                        </div>
                        <select id="chopaid" name="chopaid" class="custom-select">
                            <option value="All" selected>All</option>
                            <option value="Y">Paid</option>
                            <option value="">Unpaid</option>
                        </select>
                    </div>
                </div>
                 
            </div>            
            
            <div class="row justify-content-center">
                <div class="col-md-4 text-center">
                    <a type="button" id="btnsubmit" name="btnsubmit" onclick="getApplication()" class="btn btn-primary text-white btn-sm"><i class="fa fa-check-circle mr-2"></i>Submit</a>
                    <a type="button" id="btnreset" name="btnreset" onclick="resetform()" class="btn btn-danger text-white btn-sm"><i class="fa fa-repeat mr-2"></i>Reset</a>
					<span id="exportexcel" style="display:none"><a type="button" id="btnexport" name="btnexport" class="btn btn-secondary text-white btn-sm" onclick="javascript: $('#frmapplreport').submit();"><i class="fa fa-file-excel-o mr-2"></i>Export to Excel</a></span>
                </div>
            </div>
        </div>
        </form>
        
        <div class="container-fluid mt-4">
        	<div class="row justify-content-center">
            	<div class="col-md-12 text-center mb-3 font-weight-bold">
                    Total records: <span id="recordCount" style="display:none"></span>
                </div>
                <div class="col-md-12 text-center mb-3">
                    <a class="btn btn-success btn-sm" href="javascript: void(0)" onclick="javascript: $('#recordset').show();$('#exportexcel').show();$('#searchBar').show();"><i class="fa fa-list"></i> Show detail</a>
                </div>
                
                <div class="col-md-12 text-center mb-3" id="searchBar" style="display:none"> 
                    <input class="form-control bg-light pt-4 pb-4" id="myInput" type="text" placeholder="Search table">
                </div>

                <div class="col-md-12 text-center">                    
                    <div class="table-responsive" id="recordset" style="display:none; height:300px"></div>                    
					<script>
					$(document).ready(function(){
					  $("#myInput").on("keyup", function() {
						var value = $(this).val().toLowerCase();
						$("#myTable tr").filter(function() {
						  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
						});
					  });
					});
					</script>
                </div>
            </div>
        </div>
        <form id="frmDetail" name="frmDetail" action="search_candidate_details.php" method="post" target="_blank">
		<input type="hidden" id="txtapplicationnoforsearch" name="txtapplicationnoforsearch" /> 
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
<script type="text/javascript" src="../js_developer/date.js"></script>
<script type="text/javascript" src="../js_developer/jquery.plugin.js"></script> 
<script type="text/javascript" src="../js_developer/jquery.datepick.js"></script>
<script src="adminuser_js/report.js"></script>
<script>
var appmindate ='<?php echo $appdatearr[0]["startappdate"];?>';
var appmaxdate='<?php echo $appdatearr[0]["stopappdate"];?>';

$('#txtapplydateFrom,#txtapplydateTo').datepick({dateFormat: 'dd-mm-yyyy',minDate:appmindate,maxDate:appmaxdate});
var paymindate ='<?php echo $paydatearr[0]["startpaydate"];?>';
var paymaxdate='<?php echo $paydatearr[0]["stoppaydate"];?>';

$('#txtPaymentDateFrom,#txtPaymentDateTo').datepick({dateFormat: 'dd-mm-yyyy',minDate:paymindate,maxDate:paymaxdate});
</script>