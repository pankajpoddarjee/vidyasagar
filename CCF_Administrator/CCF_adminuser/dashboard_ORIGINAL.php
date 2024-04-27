<?php 
include("config.php"); 
include("../../connection_CCF.php");


 //$strsql="select presentsemester, count(stid) as totalstudent  from studentmaster WHERE isnull(passOutStatus,'')!='Y' GROUP BY presentsemester;";
 
 $strsql="select count(collegeRollNo) as totalstudent,semester from studentSession where session='".SESSIONYR."'  GROUP BY semester";
 
 $qryresult = $dbConn->query($strsql);

if($qryresult) {
	while($row=$qryresult->fetch(PDO::FETCH_ASSOC)) {
		$record[$row["semester"]] = $row["totalstudent"];
	}
}

$localitysql="select permntLocality, count(distinct ss.collegeRollNo) as totalstudent  from studentSession ss JOIN studentmaster st on st.collegeRollno=ss.collegeRollNo  WHERE isnull(passOutStatus,'')!='Y' and presentsession='".SESSIONYR."' GROUP BY permntLocality;";
 
 $localityresult = $dbConn->query($localitysql);

if($localityresult) {
	while($localityrow=$localityresult->fetch(PDO::FETCH_ASSOC)) {
		$localityrecord[$localityrow["permntLocality"]] = $localityrow["totalstudent"];
	}
}

$genderrecord =array();


  $gendersql="select sex, count(distinct ss.collegeRollNo) as totalstudent  from studentSession ss JOIN studentmaster st on st.collegeRollno=ss.collegeRollNo  WHERE isnull(passOutStatus,'')!='Y' and presentsession='".SESSIONYR."' and isnull(sex,'')<>'' GROUP BY sex;";
 
 $genderresult = $dbConn->query($gendersql);

if($genderresult) {
	while($genderrow=$genderresult->fetch(PDO::FETCH_ASSOC)) {
		$genderrecord[$genderrow["sex"]] = $genderrow["totalstudent"];
	}
}

$APLBPLrecord = array();

 $APLBPLsql="select APLBPL, count(distinct ss.collegeRollNo) as totalstudent  from studentSession ss JOIN studentmaster st on st.collegeRollno=ss.collegeRollNo  WHERE isnull(passOutStatus,'')!='Y' and presentsession='".SESSIONYR."' and isnull(APLBPL,'')<>'' GROUP BY APLBPL;";
 
 $APLBPLresult = $dbConn->query($APLBPLsql);

if($APLBPLresult) {
	while($APLBPLrow=$APLBPLresult->fetch(PDO::FETCH_ASSOC)) {
		$APLBPLrecord[$APLBPLrow["APLBPL"]] = $APLBPLrow["totalstudent"];
	}
} 

$minorityrecord = array();

 $minoritysql="select minoritygrp, count(distinct ss.collegeRollNo) as totalstudent  from studentSession ss JOIN studentmaster st on st.collegeRollno=ss.collegeRollNo  WHERE isnull(passOutStatus,'')!='Y' and presentsession='".SESSIONYR."' and isnull(minoritygrp,'')<>'' GROUP BY minoritygrp;";
 
 $minorityresult = $dbConn->query($minoritysql);

if($minorityresult) {
	while($minorityrow=$minorityresult->fetch(PDO::FETCH_ASSOC)) {
		$minorityrecord[$minorityrow["minoritygrp"]] = $minorityrow["totalstudent"];
	}
} 

$semarr =  array('I','II','III','IV','V','VI');

?>
 
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | <?php echo PROGRAMME_CODE; ?> | Dashboard</title>
<?php include("../head_includes.php");?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!--Pie Chart-->
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Urban',     <?php echo $localityrecord["URBAN"];?>],
          ['Semi-Urban',      <?php echo $localityrecord["SEMI-URBAN"];?>],
          ['Rural',    <?php echo $localityrecord["RURAL"];?>]
        ]);

        var options = {
          title: 'Locality Statistics',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
    
    <!--Donut Chart-->
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
         ['Male',     <?php echo (isset($genderrecord["Male"])?$genderrecord["Male"]:0);?>],
          ['Female',       <?php  echo (isset($genderrecord["Female"])?$genderrecord["Female"]:0);?>],
          ['Transgender',   <?php  echo (isset($genderrecord["Transgender"])?$genderrecord["Transgender"]:0);?>]
        ]);

        var options = {
          title: 'Gender Statistics [All Semester]',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
    
    <!--Pie Chart 2-->
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['APL',     <?php echo (isset($APLBPLrecord["NO"])?$APLBPLrecord["NO"]:0);?>],
          ['BPL',    <?php echo (isset($APLBPLrecord["YES"])?$APLBPLrecord["YES"]:0);?>]
        ]);

        var options = {
          title: 'APL / BPL',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d2'));
        chart.draw(data, options);
      }
    </script>
	
    <!--Pie Chart 2-->
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Yes',     <?php echo (isset($minorityrecord["Yes"])?$minorityrecord["Yes"]:0);?>],
          ['No',    <?php echo (isset($minorityrecord["No"])?$minorityrecord["No"]:0);?>]
        ]);

        var options = {
          title: 'Minority',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('minoritychart'));
        chart.draw(data, options);
      }
    </script>
    <!--Bar Chart-->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'General', 'SC', 'ST', 'OBC-A', 'OBC-B', 'PH'],
          ['2017', 398, 167, 58, 203, 132, 12],
          ['2018', 538, 298, 97, 164, 102, 17],
          ['2019', 592, 189, 55, 227, 98, 9],
          ['2020', 677, 302, 102, 239, 169, 27]
        ]);

        var options = {
          chart: {
            title: 'Student Category Report',
            subtitle: 'General, SC, ST, OBC-A, OBC-B & PH : 2017-2020',
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

</head>
<body>
    <?php include("headermenu_left.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("headermenu_top.php");?>
        
        <div class="pl-3 pr-3 pt-0">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" style="font-size:13px">
                            <thead>
                                <tr class="bg-light text-center">
                                    <td>&nbsp;</td>
									<?php foreach($semarr as $sem) {?>
                                    <td>Semester - <?php echo $sem;?></td>
                                    <?php }?>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr>
                                    <td align="left">Total Student</td>
                                    <?php foreach($semarr as $sem) {?>
                                    <td><?php echo (isset($record[$sem])?$record[$sem]:'');?></td>
                                    <?php }?>
                                </tr>						 
                            </tbody> 						
                        </table>
                    </div>
                </div>
                
                <!--<div class="col-md-12"> 
                	<div class="text-center mb-3"> 
                        <input class="form-control bg-light pt-4 pb-4" id="myInput" type="text" placeholder="Search table">
                    </div> 
                                          
                    <div class="table-responsive border">
                        <table class="table table-bordered table-hover table-striped" style="font-size:13px">
                            <thead>
                                <tr class="bg-light text-center">
                                <td>Subjects</td>
                                <td>Applied</td>
                                <td>Paid</td>
                                <td>Admitted</td>
                                <td>Cancelled</td>
                                </tr>
                            </thead>
                            <tbody class="text-center" id="myTable">
                                <tr>
                                    <td align="left">dd</td>
                                    <td>55</td>
                                    <td>77</td>
                                    <td>555</td>
                                    <td>33</td>
                                </tr>
                                <tr class="bg-light font-weight-bold">
                                    <td align="left">Total</td>
                                    <td>233</td>
                                    <td>22</td>
                                    <td>42</td>
                                    <td>98</td>
                                </tr>
                            </tbody> 						
                        </table>
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
                </div>-->
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                	<div id="piechart_3d" class="steps_follow_animation3" style="width:390px; height:300px"></div>
                </div>
                <div class="col-md-4 mb-3">
                	<div id="donutchart" class="steps_follow_animation3" style="width:390px; height:300px"></div>
                </div>
                <div class="col-md-4 mb-3">
                	<div id="piechart_3d2" class="steps_follow_animation3" style="width:390px; height:300px"></div>
                </div>
                <div class="col-md-12 mb-3 justify-content-center">
                <div id="minoritychart" class="steps_follow_animation3" style="width:390px; height:300px"></div>
                </div> 
            </div>
        </div>
        
        <div class="clearfix"></div>
        
        <?php include("../footer.php");?>
    </div>	
    <?php include("../footer_includes.php");?>    
</body>
</html>