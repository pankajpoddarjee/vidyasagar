<?php
include("../sessionConfig.php");
include("../../connection_CCF.php");
include("../function.php");
include("../../configuration_CCF.php");

//print_r($semesters);
//$collegerollno = $_POST["txtrollno"]; 
$collegerollno = $_SESSION["studcollegeRollNo"];
$student_stream = isset($_SESSION["student_stream"])?$_SESSION["student_stream"]:'';
$student_subject = isset($_SESSION["student_subject"])?$_SESSION["student_subject"]:'';

include("../Query_dashboard.php");

$qryresult = NULL;



$contentQry = $dbConn->prepare("select sc.content_id,sc.title,sc.content_type,sc.video_link,sc.document_path,sc.is_active,cm.course_name,stream.stream_name,dm.department_name,mm.material_name,ptm.paper_type_name,sm.semester_id FROM LMS_study_content as sc left join LMS_study_material as sm on sm.study_id = sc.study_id left join LMS_course_master as cm on sm.course_id = cm.course_id left join LMS_stream_master as stream on stream.stream_id = sm.stream_id
left join LMS_department_master as dm on dm.department_id = sm.department_id
left join LMS_material_master as mm on mm.material_id = sm.material_id
left join LMS_paper_type_master as ptm on ptm.paper_type_id = sm.paper_type_id where stream.stream_code= '".$student_stream."' and  dm.department_name= '".$student_subject."' order by sc.content_id desc");
$contentQry->execute();
$contentRecord = $contentQry->fetchAll(PDO::FETCH_ASSOC);
$dbConn = NULL;

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title>Candidate Dashboard - <?php echo COLLEGE_NAME; ?></title>
<?php include("../head_includes.php");?>
</head>
<body>
<?php //if($record["coursesAplliedDetail"]!='Y') {?>
<style type="text/css">	
.footer{background:#039; padding:0; margin:0; width:100%}
@media only screen and (min-width: 1050px) {.footer{position:fixed; bottom:0; padding:0}}
</style>
<?php //}?>
    <?php include("lms_dashboard_menu.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("../candidate_dashboard_menu2.php");?>
        
        <div class="pl-3 pr-3 pt-0">        
            <?php include("../emergengy_notice_dashboard.php");?>
            
            <div class="row">
            	<div class="col-md-12 mb-3">
                
                    <div class="accordion" id="SemesterAccordion">
                        <div class="card mb-1">
                            <button type="button" class="btn btn-info pt-3 pb-3 text-left" data-toggle="collapse" data-target="#Sem1" aria-expanded="true" aria-controls="Sem1">
                            	<h4 class="m-0" style="font-family:Oswald">
                                	<i class="fa-solid fa-graduation-cap"></i> Semester I
                                </h4>
                            </button>
                            <div id="Sem1" class="collapse" aria-labelledby="Sem1Heading" data-parent="#SemesterAccordion">
                                <div class="card-body">
                                    <div class="table-responsive">
                                    	Semester 1
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-1">
                            <button type="button" class="btn btn-info pt-3 pb-3 text-left" data-toggle="collapse" data-target="#Sem2" aria-expanded="false" aria-controls="Sem2">
                            	<h4 class="m-0" style="font-family:Oswald">
                                	<i class="fa-solid fa-graduation-cap"></i> Semester II
                                </h4>
                            </button>
                            <div id="Sem2" class="collapse" aria-labelledby="Sem2Heading" data-parent="#SemesterAccordion">
                                <div class="card-body">
                                    <div class="table-responsive">
                                    	Semester 2
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-1">
                            <button type="button" class="btn btn-info pt-3 pb-3 text-left" data-toggle="collapse" data-target="#Sem3" aria-expanded="false" aria-controls="Sem3">
                            	<h4 class="m-0" style="font-family:Oswald">
                                	<i class="fa-solid fa-graduation-cap"></i> Semester III <span class=pull-right><i class="fa-solid fa-user-graduate fa-beat-fade" data-toggle="tooltip" data-placement="top" title="Present Semester"></i></span>
                                </h4>
                            </button>
                            <div id="Sem3" class="collapse show" aria-labelledby="Sem3Heading" data-parent="#SemesterAccordion">
                                <div class="card-body">
                                    <div class="table-responsive">
                                    	<table class="table table-bordered text-nowrap">
                                            <thead class="text-center bg-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <th>Title</th>
                                                    <th>Type</th>
                                                    <th>Paper</th>
                                                    <th>Link</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody id="material-table-body">
                                                <?php if($contentRecord){
                                                    $i=1;
                                                    foreach ($contentRecord as $value) {
                                                ?>                                            
                                                <tr>
                                                    <td class="align-middle text-center"><?php echo $i ?></td>
                                                    <td class="align-middle text-center">12 Mar 2024</td>
                                                    <td class="align-middle text-left"><?php echo $value['title']; ?></td>
                                                    <td class="align-middle text-center"><?php echo $value['material_name']; ?></td>
                                                    <td class="align-middle text-center"><?php echo $value['paper_type_name']; ?></td>
                                                    <?php if($value['content_type'] == 'video') { ?>
                                                    <td class="align-middle text-center">
                                                        <a class="btn btn-outline-danger" href="<?php echo $value['video_link']; ?>" data-toggle="tooltip" data-placement="top" title="Video" target="_blank">
                                                            <i class="fa-solid fa-video"></i>
                                                        </a>
                                                    </td>   
                                                    <?php } else { ?>
                                                    <td class="align-middle text-center">
                                                        <a class="btn btn-outline-danger" href="<?php echo BASE_URL_HOME.'/CCF_Administrator/CCF_adminuser/LMS/'.$value['document_path']; ?>" data-toggle="tooltip" data-placement="top" title="Download Document" target="_blank">
                                                            <i class="fa-solid fa-file-arrow-down"></i>
                                                        </a>
                                                    </td>   
                                                    <?php } ?>
                                                </tr>
                                                <?php $i++; } } else{ ?>
                                                <tr>
                                                    <td class="align-middle text-center" colspan="10">No Record Found</td>
                                                </tr>
                                               <?php } ?>
                                           </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-1">
                            <button type="button" class="btn btn-info pt-3 pb-3 text-left" data-toggle="collapse" data-target="#Sem4" aria-expanded="false" aria-controls="Sem4">
                            	<h4 class="m-0" style="font-family:Oswald">
                                	<i class="fa-solid fa-graduation-cap"></i> Semester IV
                                </h4>
                            </button>
                            <div id="Sem4" class="collapse" aria-labelledby="Sem4Heading" data-parent="#SemesterAccordion">
                                <div class="card-body">
                                    <div class="table-responsive">
                                    	Semester 4
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-1">
                            <button type="button" class="btn btn-info pt-3 pb-3 text-left" data-toggle="collapse" data-target="#Sem5" aria-expanded="false" aria-controls="Sem5">
                            	<h4 class="m-0" style="font-family:Oswald">
                                	<i class="fa-solid fa-graduation-cap"></i> Semester V
                                </h4>
                            </button>
                            <div id="Sem5" class="collapse" aria-labelledby="Sem5Heading" data-parent="#SemesterAccordion">
                                <div class="card-body">
                                    <div class="table-responsive">
                                    	Semester 5
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card">
                            <button type="button" class="btn btn-info pt-3 pb-3 text-left" data-toggle="collapse" data-target="#Sem6" aria-expanded="false" aria-controls="Sem6">
                            	<h4 class="m-0" style="font-family:Oswald">
                                	<i class="fa-solid fa-graduation-cap"></i> Semester VI
                                </h4>
                            </button>
                            <div id="Sem6" class="collapse" aria-labelledby="Sem6Heading" data-parent="#SemesterAccordion">
                                <div class="card-body">
                                    <div class="table-responsive">
                                    	Semester 6
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>            
        </div>
        <?php include("../footer.php");?>
    </div>	
    <?php include("../footer_includes.php");?>    
</body>
</html> 
<script src="js/dashboard_lms.js"></script> 