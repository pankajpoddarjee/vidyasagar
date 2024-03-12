<?php 
 ob_start();
session_start();
//include("../config.php"); 
include("../../../connection_CCF.php");
 include('../../../configuration_CCF.php');
 $usertype = $_SESSION['usertype'];
 $adminusername = $_SESSION['user'];
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
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> |Generate ID Card</title>
<?php include("../../head_includes.php");?>
 
</head>
<body>
    <?php include("../headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../../header.php");?>
        <?php include("../headermenu_top.php");?>
        
        <div class="pl-3 pr-3 pt-0">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="table-responsive">
					 <FORM name="frmIDCard" id="frmIDCard" action="idCard.php" method="post"  target="_blank">
					   <input type="hidden" id="hdnprintoption" name="hdnprintoption"   />
                        <table class="table table-bordered table-hover" style="font-size:13px">
                            
                                <tr>
                                    <td>Session</td>
                                    <td>
									<select id="chosession" name="chosession" >
										<option value="">Select</option>
										<?php foreach($finalsessions as $session){ ?>
										<option value="<?php echo $session;?>"><?php echo $session;?></option>
										<?php }?>
									</select>
									</td>
                                </tr>
                             
                                <tr>
                                    <td align="left">Semester</td>
                                    <td><select id="chosemester" name="chosemester" >
										<option value="">Select</option>
										<option value="I">I</option>
										<option value="II">II</option>
										<option value="III">III</option>
										<option value="IV">IV</option>
										<option value="V">V</option>
										<option value="VI">VI</option>										
									</select> </td>
                                    
                                </tr>						 
                            	<tr>
                                    <td align="left">Print By</td>
                                    <td><select id="choprintcategory" name="choprintcategory" onchange="showForm(this.value)" >
										<option value="">Select</option>
										<option value="Individual">Generate Individual ID Card</option>
										<option value="BySubject">Generate Subject-Wise ID Card</option>
														
									</select> </td>
                                    
                                </tr>		
								<tr>
                                    <td colspan="2">
									<div id="div_frmIndividual" style="display:none">
                                   
                                  
                                <table width="80%" border="0" bordercolor="#eaeaea" cellspacing="0" cellpadding="5" align="center" style="font-weight:bold">
                                
                                
                                <tr>
                                <td width="45%">Enter College Roll No<font style="color:#FF0000">*</font></td>
                                <td width="2%">:</td>
                                <td><input size="24" type="text" name="txtCollegeRollNo" maxlength="20" id="txtCollegeRollNo" style="padding:5px"  onfocus="javascript: $('#txtstudentId').val('');$('#txtapplicationNo').val('');"/></td>
                                </tr>
                                
                                <tr><td colspan="3"></td></tr>
                                <tr>
                                <td></td>
                                <td></td>
                                <td>
                                <div style="width:100px; float:left">
                                    <input id="btnreset" type="reset" title="Click Here to Reset Data" value="Reset" name="btnreset" style="padding:8px 10px" class="button">
                                </div>
                                <div style="width:100px; float:left">
                                    <input name="retrieve" type="Button" title="Click Here to Generate ID Card" value="Submit" onClick="printBy('Individual')" style="padding:8px 10px" class="button"/>
                                </div>
                                </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <p style="font-weight:bold">Print Settings</p>
                                        <ul>
                                        	<li style="margin-bottom:7px">
                                            	Browser: <strong style="color:#900">Google Chrome</strong>
                                            </li>
                                        	<li style="margin-bottom:7px">
                                            	Destination: Set to "<strong style="color:#900">Save as PDF</strong>"
                                            </li>
                                        	<li style="margin-bottom:7px">
                                            	Margins: Set to "<strong style="color:#900">None</strong>"
                                            </li>
                                        	<li style="margin-bottom:7px">
                                            	Options: <strong>Tick</strong> "<strong style="color:#900">Background graphics</strong>"
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                </table>
                                  
                                    </div> </td>
                                    
                                </tr>
								<tr><td colspan="2">
								<div id="div_frmSubject" style="display:none">
                                    
                                  
                                
                                <table width="60%" border="0" bordercolor="#eaeaea" cellspacing="0" cellpadding="5" align="center" style="font-weight:bold">
                                
                                <tr>
                                <td width="32%">Choose Subject <font style="color:#FF0000">*</font></td>
                                <td width="2%">:</td>
                                <td><Select id="chosubject" name="chosubject" onchange="displayIDCardCount(this.value)" >
                                <option value="">Select</option>
                                 <option value="All">All</option>
                                <?php foreach($recordarr as $rec){?>
                                <option value="<?php echo $rec["appsubjectcode"]?>"><?php echo $rec["appsubject"]?></option>
                                <?php }?>
                                </Select>
                                
                                </td>
                                </tr>
                                <tr><td colspan="3"><span id='span_totalrecord'></span></td></tr>
                                
                                <tr><td colspan="3"></td></tr>
                                <tr>
                                <td></td>
                                <td></td>
                                <td>
                                <div style="width:100px; float:left">
                                    <input id="btnreset2" type="reset" title="Click Here to Reset Data" value="Reset" name="btnreset2" style="padding:8px 10px" class="button">
                                </div>
                                <div style="width:100px; float:left">
                                    <input name="btnsubmit" type="button" title="Click Here to Generate ID Card" value="Submit" onClick="printBy('Subject')" style="padding:8px 10px" class="button"/>
                                </div>
                                </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <p style="font-weight:bold">Print Settings</p>
                                        <ul>
                                        	<li style="margin-bottom:7px">
                                            	Browser: <strong style="color:#900">Google Chrome</strong>
                                            </li>
                                        	<li style="margin-bottom:7px">
                                            	Destination: Set to "<strong style="color:#900">Save as PDF</strong>"
                                            </li>
                                        	<li style="margin-bottom:7px">
                                            	Margins: Set to "<strong style="color:#900">None</strong>"
                                            </li>
                                        	<li style="margin-bottom:7px">
                                            	Options: <strong>Tick</strong> "<strong style="color:#900">Background graphics</strong>"
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                </table>
                                   
                                    </div>
								</td></tr>
								
                        </table> 
						</FORM>
                    </div>
                </div>
                
                
            </div>

            
        </div>
        
        <div class="clearfix"></div>
        
        <?php include("../../footer.php");?>
    </div>	
    <?php include("../../footer_includes.php");?>    
</body>
</html>
<script type="text/javascript" src="js/Id_card.js"></script>