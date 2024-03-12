<?php
include("sessionConfig.php");
include("../connection_CCF.php");
include("function.php");
include("../configuration_CCF.php");

$collegerollno = $_POST["txtcollegerollno"];
 
 include("Query_dashboard.php"); 
 
 
 $courserecord = array();
 
 
    $courseqry	=	"select  collegeRollno,semester,appliedsession,stream,	subject,subjectcode,	isnull(CoreCourse1,'') as CoreCourse1,	isnull(CoreCourse2,'') CoreCourse2,	isnull(CoreCourse3,'') as CoreCourse3,isnull(CoreCourse4,'') as CoreCourse4,	isnull(minorCourse1,'') as minorCourse1,isnull(minorCourse2,'') as minorCourse2,isnull(IDC,'') as IDC,isnull(AECC,'') as AECC,isnull(SEC,'') as SEC,isnull(CVAC1,'') as CVAC1, isnull(CVAC2,'') as CVAC2,isnull(Internship,'') as Internship, isnull(Dissertation,'') as Dissertation, isnull(ResearchWork,'') as ResearchWork from studentSemesterCourse where  collegeRollNo='".$collegerollno."'";
 
 
$courseqryresult = $dbConn->query($courseqry);

if($courseqryresult) {
 	while($courserow=$courseqryresult->fetch(PDO::FETCH_ASSOC))
	{
		$courserecord[] = $courserow;
	}
 }
   
 $headerarr =  array( 'semester'=>'Semester','subject'=>'Subject','CoreCourse1'=>'Core Course 1','CoreCourse2'=>'Core Course 2','CoreCourse3'=>'Core Course 3','CoreCourse4'=>'Core Course 4','minorCourse1'=>'Minor Course 1','minorCourse2'=>'Minor Course 2','IDC'=>'IDC','AECC'=>'AECC','SEC'=>'SEC','CVAC1'=>'CVAC 1','CVAC2'=>'CVAC 2','Internship'=>'Internship');
 	
 $courseqryresult = NULL;

$dbConn = NULL;


?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title>Course Details - <?php echo COLLEGE_NAME; ?></title>
<?php include("head_includes.php");?>
</head>
<body>
 
<style type="text/css">	
.footer{background:#039; padding:0; margin:0; width:100%}
@media only screen and (min-width: 1050px) {.footer{position:fixed; bottom:0; padding:0}}
</style>
 
    <?php include("candidate_dashboard_menu.php");?>
    
    <div id="content">
    	<?php include("header.php");?>
        <?php include("candidate_dashboard_menu2.php");?>
        
        <div class="pl-3 pr-3 pt-0">        
            <?php include("emergengy_notice_dashboard.php");?>            
                	 
            <div id="printdivcontent">
                <div class="table-responsive">
                    <table width="100%" align="center" border="1" bordercolor="#d5d5d5" cellpadding="" class="table table-bordered table-hover font-weight-normal text-center" style="border-collapse:collapse; text-align:center; font-family:Poppins, Arial, Helvetica, sans-serif; font-size:12px"> 				 
                        <tr class="bg-light font-weight-bold text-nowrap align-middle">
                        <td>Serial No.</td>
                        <?php foreach($headerarr as $headkey=>$headlabel) { ?>
                        <td><?php echo $headlabel; ?></td>
                        <?php } ?>  
                        </tr>
                    
                    <?php
                        $i=0;
                        foreach($courserecord as $coursedetail) {
                        $i=$i+1;
                    ?>
                        <tr>
                        <td><?php echo $i;?> </td>
                        <?php foreach($headerarr as $headkey=>$headlabel) { ?>
                        <td><?php echo $coursedetail[$headkey];?></td>
                        <?php } ?>  
                        
                        </tr>
                    
                    <?php  } ?>
                    </table>
                </div>
            </div>
            
            <p class="text-center">
            	<button type="button" class="btn btn-info" onclick="PrintDiv();"><i class="fa fa-print"></i> Print</button>
            </p>
            
            <script type="text/javascript">  
				function PrintDiv() {  
					var divContents = document.getElementById("printdivcontent").innerHTML;  
					var printWindow = window.open('', '', 'height=auto,width=auto');  
					printWindow.document.write(divContents);  
					printWindow.document.close();  
					printWindow.print();  
				}  
			</script>
            
            <!--<form id="nextfrm" name="nextfrm" action="infoforpayment.php" method="post">
            <input type="hidden" name="hdnsemester" id="hdnsemester" value="<?php //echo $record[0]["presentsemester"];?>" />
            <input type="hidden" id="hdnrollno" name="hdnrollno"  value="<?php //echo $collegerollno?>"/>
            </form>-->
            
        </div>
        <?php include("footer.php");?>
    </div>	
    <?php include("footer_includes.php");?>    
</body>
</html> 
<script src="js/dashboard.js"></script> 
