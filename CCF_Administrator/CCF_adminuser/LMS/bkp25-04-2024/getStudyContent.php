<?php
 include("../../../connection_CCF.php");
 //include("../function.php");
 include("../../../configuration_CCF.php");
 session_start();

$cnt = 0;
  
$arr = array();

$content_id = $_POST["content_id"];
$study_id = $_POST["study_id"];

// echo "<pre>";
// print_r($_POST);
   
 if(isset($_POST["content_id"])){
	
    
	$contentQry = $dbConn->prepare("select sc.content_id,sc.title,sc.content_type,sc.video_link,sc.document_path,sc.is_active,sc.created_by,sc.created_by_user,sc.publish_date,sc.teacher_id,sm.course_id,sm.study_id,sm.created_by as m_created_by,sm.created_at as m_created_at,sm.created_device as m_created_device,sm.updated_by as m_updated_by,sm.updated_at as m_updated_at,sm.updated_device as m_updated_device,sm.stream_id,sm.subject_id,sm.department_id,sm.material_id,sm.paper_type_id,sm.semester_id,sm.study_id,cm.course_name,dm.department_name,mm.material_name,ptm.paper_type_name,ptm.duration FROM LMS_study_content as sc left join LMS_study_material as sm on sm.study_id = sc.study_id left join LMS_course_master as cm on sm.course_id = cm.course_id  left join LMS_department_master as dm on dm.department_id = sm.department_id
    left join LMS_material_master as mm on mm.material_id = sm.material_id
    left join LMS_paper_type_master as ptm on ptm.paper_type_id = sm.paper_type_id where sc.is_active=1 and sc.content_id= $content_id");
    $contentQry->execute();
    $contentRecord = $contentQry->fetch(PDO::FETCH_ASSOC);

	$getAllContentQry = $dbConn->prepare("select * FROM LMS_study_content  where is_active =1 and study_id= $study_id");
    $getAllContentQry->execute();
    $getAllContentRecord = $getAllContentQry->fetchAll(PDO::FETCH_ASSOC);

	$course_id = $contentRecord["course_id"];
    $stream_id = $contentRecord["stream_id"];
    $department_id = $contentRecord["department_id"];
	$paper_duration = $contentRecord["duration"];
	//echo "select * FROM LMS_stream_master where course_id = $course_id and duration IN (".$paper_duration.") and is_active=1";
    $streamQry = $dbConn->prepare("select * FROM LMS_stream_master where course_id = $course_id and duration IN (".$paper_duration.") ");
	$streamQry->execute();
	$streamRecord = $streamQry->fetchAll(PDO::FETCH_ASSOC);

	$is_hod = isset($_SESSION['is_hod'])?$_SESSION['is_hod']:"";
	$session_department_id = isset($_SESSION['department_id'])?$_SESSION['department_id']:"";
	$departmentSql = "";	
	$departmentSql .= "select * FROM LMS_department_master where course_id = $course_id";
	if($is_hod == 1  || (($_SESSION['usertype'] == 'teacher' && $_SESSION['is_hod'] == 0))){ 
		$departmentSql .= " and department_id = $department_id";
	}
	// $departmentQry = $dbConn->prepare($departmentSql);
	// $departmentQry->execute();
	// $departmentRecord = $departmentQry->fetchAll(PDO::FETCH_ASSOC);

	if($contentRecord) {
       
		$arr["status"]=1;
		$arr["data"]=$contentRecord;	 
		$arr["streamRecord"]=$streamRecord;	 
        $arr["getAllContentRecord"]=$getAllContentRecord;	 

	}
	else {
        $arr["status"]=0;
        $arr["msg"]="Data Not Found";  
    }
		
 }

echo json_encode($arr);

?>