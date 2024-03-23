<?php
 include("../../../connection_CCF.php");
 //include("../function.php");
 include("../../../configuration_CCF.php");

$cnt = 0;
  
$arr = array();

$content_id = $_POST["content_id"];

// echo "<pre>";
// print_r($_POST);
   
 if(isset($_POST["content_id"])){
	
    
	$contentQry = $dbConn->prepare("select sc.content_id,sc.title,sc.content_type,sc.video_link,sc.document_path,sc.is_active,sm.course_id,sm.stream_id,sm.department_id,sm.material_id,sm.paper_type_id,sm.semester_id,sm.study_id,cm.course_name,stream.stream_name,dm.department_name,mm.material_name,ptm.paper_type_name FROM LMS_study_content as sc left join LMS_study_material as sm on sm.study_id = sc.study_id left join LMS_course_master as cm on sm.course_id = cm.course_id left join LMS_stream_master as stream on stream.stream_id = sm.stream_id left join LMS_department_master as dm on dm.department_id = sm.department_id
    left join LMS_material_master as mm on mm.material_id = sm.material_id
    left join LMS_paper_type_master as ptm on ptm.paper_type_id = sm.paper_type_id where sc.content_id= $content_id");
    $contentQry->execute();
    $contentRecord = $contentQry->fetch(PDO::FETCH_ASSOC);

	$course_id = $contentRecord["course_id"];
    $stream_id = $contentRecord["stream_id"];
    $department_id = $contentRecord["department_id"];

    $streamQry = $dbConn->prepare("select * FROM LMS_stream_master where course_id = $course_id");
	$streamQry->execute();
	$streamRecord = $streamQry->fetchAll(PDO::FETCH_ASSOC);

	$departmentQry = $dbConn->prepare("select * FROM LMS_department_master where course_id = $course_id");
	$departmentQry->execute();
	$departmentRecord = $departmentQry->fetchAll(PDO::FETCH_ASSOC);

	if($contentRecord) {
       
		$arr["status"]=1;
		$arr["data"]=$contentRecord;	 
		$arr["streamRecord"]=$streamRecord;	 
        $arr["departmentRecord"]=$departmentRecord;	 

	}
	else {
        $arr["status"]=0;
        $arr["msg"]="Data Not Found";  
    }
		
 }

echo json_encode($arr);

?>