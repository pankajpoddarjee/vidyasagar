<?php 
include("config.php");
 
 $applysesssionqry =	"select distinct appliedsession FROM studentmaster order by appliedsession DESC;";
 
$applysesssionresult = $dbConn->query($applysesssionqry);

if($applysesssionresult) {
 	while($row=$applysesssionresult->fetch(PDO::FETCH_ASSOC))
	{
		$applysesssionrecord[] =  $row ;	 
	}
 } 


$presentsesssionqry =	"select distinct presentsession FROM studentmaster order by presentsession DESC;";
 
$presentsesssionresult = $dbConn->query($presentsesssionqry);

if($presentsesssionresult) {
 	while($presentrow=$presentsesssionresult->fetch(PDO::FETCH_ASSOC))
	{
		$presentsesssionrecord[] =  $presentrow ;	 
	}
 }      
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> |  Student Course Detail Report</title>
<link rel="stylesheet" type="text/css" href="../js_developer/jquery.datepick.css"> 
<?php include("../head_includes.php");?>
</head>
<body onload="fillstreamfordetail();">
    <?php include("headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("headermenu_top.php");?>
        
        <form id="frmreport" name="frmreport" action="" method="post">
        <div class="container">
        	<div class="row">
            	<div class="col-md-12">
                    <h5 class="text-danger border-bottom mb-3 pb-2">
                    	<i class="fa fa-bar-chart"></i> Student Course Detail Report
                    </h5>
                </div>
				  
                <div class="col-md-4">
                	<div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Applied Session</span>
                        </div>
                        <select id="choapplySession" name="choapplySession" class="custom-select" >
                                <option value="All" selected>All</option>
								<?php foreach($applysesssionrecord as $applysessionrec) {?>
								<option value="<?php echo $applysessionrec["appliedsession"];?>"><?php echo $applysessionrec["appliedsession"];?></option>
								<?php }?>
                        </select> 
                    </div>
                </div>
				
				<div class="col-md-4">
                	<div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Present Session</span>
                        </div>
                        <select id="chopresentSession" name="chopresentSession" class="custom-select" >
                                <option value="All" selected>All</option>
								<?php foreach($presentsesssionrecord as $presentsesssionrec) {?>
								<option value="<?php echo $presentsesssionrec["presentsession"];?>"><?php echo $presentsesssionrec["presentsession"];?></option>
								<?php }?>
                        </select> 
                    </div>
                </div>
				
				<div class="col-md-4">
                	<div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Present Semester</span>
                        </div>
                        <select id="chopresentSem" name="chopresentSem" class="custom-select" >
                                <option value="All" selected>All</option>
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
                            <span class="input-group-text">Stream</span>
                        </div>
                        <select id="chostream" name="chostream" class="custom-select"  onChange="fillsubject(this.value);">
                                <option value="" selected>Select</option>
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
                
                 
                 
            </div>            
            
            <div class="row justify-content-center">
                <div class="col-md-4 text-center">
                    <a type="button" id="btnsubmit" name="btnsubmit" onclick="getcourseDetail()" class="btn btn-primary text-white btn-sm"><i class="fa fa-check-circle mr-2"></i>Submit</a>
                    <a type="button" id="btnreset" name="btnreset" onclick="resetform()" class="btn btn-danger text-white btn-sm"><i class="fa fa-repeat mr-2"></i>Reset</a>
					<!--<span id="exportexcel" style="display:none"> <a id="showExport" onclick="export2excel(this)" style="background:#c00; color:#fff; font-weight:normal; padding:10px 7px; text-decoration:none; ">
                        Export Data
                    </a></span> -->
					
					 <span id="exportexcel" style="display:none"><a type="button" id="btnexport" name="btnexport" class="btn btn-secondary text-white btn-sm" onclick="javascript: export2excel(this);"><i class="fa fa-file-excel-o mr-2"></i>Export to Excel</a></span>  
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
 function export2excel(sipl) {
  var div = document.getElementById("recordset");
  var html = div.outerHTML;
  var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html div into url 
  sipl.setAttribute("href", url);
  sipl.setAttribute("download", "courseList.xls"); // Choose the file name
  return false;
}
</script>