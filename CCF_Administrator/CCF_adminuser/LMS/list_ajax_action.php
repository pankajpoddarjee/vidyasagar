<?php
//include("config.php");
include("../../../connection_CCF.php");
include("../../function.php");
include("../../../configuration_CCF.php");
include("lmsfunction.php");

/*COURSE LIST*/
if(!empty($_POST['action']) && $_POST['action'] == 'listRecordsCourse') {

    $courseRecord = [];
    $qry = "";
    $qry .= "select * FROM LMS_course_master ";
    if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"])){
        $keyword = $_POST["search"]["value"];
        $qry .= " where course_name LIKE '%".$keyword."%'" ;
    }
    if(!empty($_POST["order"])){
        $qry .= "ORDER BY ".$_POST['order']['0']['column']." ".$_POST['order']['0']['dir']." ";
    } else {
        $qry .= 'ORDER BY course_id DESC ';
    }
    
    if($_POST["length"] != -1){
        $qry .= " OFFSET " . $_POST['start'] . " ROWS FETCH FIRST " . $_POST['length'] . " ROWS ONLY";
    }
	$courseQry = $dbConn->prepare($qry);
    $courseQry->execute();
    $courseRecord = $courseQry->fetchAll(PDO::FETCH_ASSOC);

    $stmtTotal = $dbConn->prepare("SELECT * FROM LMS_course_master");
    $stmtTotal->execute();
    $allResult = $stmtTotal->fetchAll(PDO::FETCH_ASSOC);
    $allRecords = count($allResult);
    $displayRecords = count($courseRecord);

    $records = array();		
		
    $i=1;
    foreach ($courseRecord as $record) {
        $rows = array();			
        $rows[] = $i;
        $rows[] = $record['course_name'];
        $status = ($record['is_active']==1)?'Active':'Inactive';	
        $status_class = ($record['is_active']==1)?'success':'danger';	
        $rows[] = ($record['is_active']==1)?"<i class='fa-regular fa-circle-dot' style='color:#2ec900'></i> Active":"<i class='fa-regular fa-circle-dot' style='color:#c90020'></i> Inactive";	
                            
        $rows[] = '<button class="btn btn-info open-edit-course-modal" cid="'.$record['course_id'].'" data-toggle="tooltip" data-placement="top" title="Edit Course">
        <i class="fa-solid fa-pen-to-square"></i>
        </button> <button class="open-delete-course-modal btn btn-'.$status_class.'" status="'.$record['is_active'].'" cid="'.$record['course_id'].'" data-toggle="tooltip" data-placement="top" title="Change Status">
        <i class="fa-solid fa-arrows-rotate"></i>
        </button>';
        
        $records[] = $rows;
        $i++;
    }
    
    $output = array(
        "draw"	=>	intval($_POST["draw"]),			
        "iTotalRecords"	=> 	$displayRecords,
        "iTotalDisplayRecords"	=>  $allRecords,
        "data"	=> 	$records
    );
    
    echo json_encode($output);
}

/*STREAM LIST*/
if(!empty($_POST['action']) && $_POST['action'] == 'listRecordsStream') {

    $streamRecord = [];
    $qry = "";
   
    $qry .= "select stream.stream_id,stream.stream_name,stream.stream_code,stream.is_active,course.course_name FROM LMS_stream_master as stream join LMS_course_master as course on course.course_id = stream.course_id ";

    if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"])){
        $keyword = $_POST["search"]["value"];
        //$qry .= " where(stream.stream_name LIKE '"%.$keyword.%"' ";
        $qry .= " where (stream.stream_name LIKE '%".$keyword."%'" ;
        $qry .= " OR stream.stream_code LIKE '%".$keyword."%'" ;
		$qry .= " OR course.course_name LIKE '%".$keyword."%')";		
    }
    if(!empty($_POST["order"])){
        $qry .= " ORDER BY ".$_POST['order']['0']['column']." ".$_POST['order']['0']['dir']." ";
    } else {
        $qry .= " ORDER BY stream.stream_id DESC ";
    }
    if($_POST["length"] != -1){
        $qry .= " OFFSET " . $_POST['start'] . " ROWS FETCH FIRST " . $_POST['length'] . " ROWS ONLY";
    }
	$streamQry = $dbConn->prepare($qry);
    $streamQry->execute();
    $streamRecord = $streamQry->fetchAll(PDO::FETCH_ASSOC);

    $stmtTotal = $dbConn->prepare("select stream.stream_id,stream.stream_name,stream.stream_code,stream.is_active,course.course_name FROM LMS_stream_master as stream join LMS_course_master as course on course.course_id = stream.course_id");
    $stmtTotal->execute();
    $allResult = $stmtTotal->fetchAll(PDO::FETCH_ASSOC);
    $allRecords = count($allResult);
    $displayRecords = count($streamRecord);

    $records = array();		
		
    $i=1;
    foreach ($streamRecord as $record) {
        $rows = array();			
        $rows[] = $i;
        $rows[] = $record['course_name'];
        $rows[] = $record['stream_name'];
        $rows[] = $record['stream_code'];
        $status = ($record['is_active']==1)?'Active':'Inactive';	
        $status_class = ($record['is_active']==1)?'success':'danger';	
        $rows[] = ($record['is_active']==1)?"<i class='fa-regular fa-circle-dot' style='color:#2ec900'></i> Active":"<i class='fa-regular fa-circle-dot' style='color:#c90020'></i> Inactive";	
                            
        $rows[] = '<button class="btn btn-info open-edit-stream-modal" cid="'.$record['stream_id'].'" data-toggle="tooltip" data-placement="top" title="Edit Stream">
        <i class="fa-solid fa-pen-to-square"></i>
        </button> <button class="open-delete-stream-modal btn btn-'.$status_class.'" status="'.$record['is_active'].'" cid="'.$record['stream_id'].'" data-toggle="tooltip" data-placement="top" title="Change Status">
        <i class="fa-solid fa-arrows-rotate"></i>
        </button>';
        
        $records[] = $rows;
        $i++;
    }
    
    $output = array(
        "draw"	=>	intval($_POST["draw"]),			
        "iTotalRecords"	=> 	$displayRecords,
        "iTotalDisplayRecords"	=>  $allRecords,
        "data"	=> 	$records
    );
    
    echo json_encode($output);
}

/*DEPARTMENT LIST*/
if(!empty($_POST['action']) && $_POST['action'] == 'listRecordsDepartment') {
    ob_start();
    session_start();
    $is_hod = isset($_SESSION['is_hod'])?$_SESSION['is_hod']:"";
    $department_id = isset($_SESSION['department_id'])?$_SESSION['department_id']:"";

    $departmentRecord = [];
    $qry = "";
   
    // $qry .= "select dept.department_id,dept.department_name,dept.is_active,course.course_name FROM LMS_department_master as dept join LMS_course_master as course on course.course_id = dept.course_id  ";
    $qry .= "select * FROM LMS_department_master  ";
    if(!empty($department_id)){
        $qry .= " where department_id = $department_id ";
    }
    if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"])){
        $keyword = $_POST["search"]["value"];
        $qry .= " where (department_name LIKE '%".$keyword."%')" ;
		//$qry .= " OR course.course_name LIKE '%".$keyword."%')";		
    }
    
    if(!empty($_POST["order"])){
        $qry .= " ORDER BY ".$_POST['order']['0']['column']." ".$_POST['order']['0']['dir']." ";
    } else {
        $qry .= " ORDER BY department_id DESC ";
    }
    if($_POST["length"] != -1){
        $qry .= " OFFSET " . $_POST['start'] . " ROWS FETCH FIRST " . $_POST['length'] . " ROWS ONLY";
    }
    //echo $qry;
	$departmentQry = $dbConn->prepare($qry);
    $departmentQry->execute();
    $departmentRecord = $departmentQry->fetchAll(PDO::FETCH_ASSOC);

    $stmtTotal = $dbConn->prepare("SELECT * FROM LMS_department_master");
    $stmtTotal->execute();
    $allResult = $stmtTotal->fetchAll(PDO::FETCH_ASSOC);
    $allRecords = count($allResult);
    $displayRecords = count($departmentRecord);

    $records = array();		
    
	
    $i=1;
    foreach ($departmentRecord as $record) {
        $assign_subject_html = '';
        if(($_SESSION['usertype']=='teacher' && $_SESSION['is_hod'] ==1) || ($_SESSION['usertype']!='teacher' && $_SESSION['is_hod'] == 0)){
            $assign_subject_html .= ' <button class="btn btn-warning open-assign-subject-modal" cid="'.$record['department_id'].'" udid="'.$department_id.'" utype="'.$_SESSION['usertype'].'" dname="'.$record['department_name'].'" data-toggle="tooltip" data-placement="top" title="Assign Subject">
            <i class="fa-solid fa-clipboard-check"></i>
            </button>';
        }
        $rows = array();			
        $rows[] = $i;
        $rows[] = $record['department_name'];
        $status = ($record['is_active']==1)?'Active':'Inactive';	
        $status_class = ($record['is_active']==1)?'success':'danger';	
        $rows[] = ($record['is_active']==1)?"<i class='fa-regular fa-circle-dot' style='color:#2ec900'></i> Active":"<i class='fa-regular fa-circle-dot' style='color:#c90020'></i> Inactive";	
                            
        $rows[] = '<button class="btn btn-info open-edit-department-modal" cid="'.$record['department_id'].'" data-toggle="tooltip" data-placement="top" title="Edit Department">
        <i class="fa-solid fa-pen-to-square"></i>
        </button>  <button class="open-delete-department-modal btn btn-'.$status_class.'" status="'.$record['is_active'].'" cid="'.$record['department_id'].'" data-toggle="tooltip" data-placement="top" title="Change Status"><i class="fa-solid fa-arrows-rotate"></i></button>'.$assign_subject_html;
        
        $records[] = $rows;
        $i++;
    }
    
    $output = array(
        "draw"	=>	intval($_POST["draw"]),			
        "iTotalRecords"	=> $displayRecords,
        "iTotalDisplayRecords"	=>  $allRecords,
        "data"	=> 	$records
    );
    
    echo json_encode($output);
}

/*TEACHER LIST*/
if(!empty($_POST['action']) && $_POST['action'] == 'listRecordsTeacher') {
    ob_start();
    session_start();
    $is_hod = isset($_SESSION['is_hod'])?$_SESSION['is_hod']:"";
    $department_id = isset($_SESSION['department_id'])?$_SESSION['department_id']:"";

    $teacherRecord = [];
    $qry = "";
   
    $qry .= "select teacher.teacher_id,teacher.teacher_name,teacher.profile_image,teacher.email,teacher.mobile,teacher.designation,teacher.is_hod,teacher.is_active,course.course_name,dept.department_name FROM LMS_teacher_master as teacher LEFT JOIN LMS_course_master as course on course.course_id = teacher.course_id LEFT JOIN LMS_department_master as dept ON teacher.department_id = dept.department_id ";

    if($is_hod == 1){
        $qry .= " where teacher.department_id = $department_id ";
    }

    if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"])){
        $keyword = $_POST["search"]["value"];
        //$qry .= " where(stream.stream_name LIKE '"%.$keyword.%"' ";
        $qry .= " where (teacher.teacher_name LIKE '%".$keyword."%'" ;
        $qry .= " OR dept.department_name LIKE '%".$keyword."%'" ;
        $qry .= " OR course.course_name LIKE '%".$keyword."%'" ;
        $qry .= " OR teacher.email LIKE '%".$keyword."%'" ;
		$qry .= " OR teacher.mobile LIKE '%".$keyword."%')";		
    }
    if(!empty($_POST["order"])){
        $qry .= " ORDER BY ".$_POST['order']['0']['column']." ".$_POST['order']['0']['dir']." ";
    } else {
        $qry .= " ORDER BY teacher.teacher_id DESC ";
    }
    if($_POST["length"] != -1){
        $qry .= " OFFSET " . $_POST['start'] . " ROWS FETCH FIRST " . $_POST['length'] . " ROWS ONLY";
    }
	$teacherQry = $dbConn->prepare($qry);
    $teacherQry->execute();
    $teacherRecord = $teacherQry->fetchAll(PDO::FETCH_ASSOC);

    $stmtTotal = $dbConn->prepare("select teacher.teacher_id,teacher.teacher_name,teacher.profile_image, teacher.email,teacher.mobile,teacher.designation,teacher.is_hod,teacher.is_active,course.course_name,dept.department_name FROM LMS_teacher_master as teacher LEFT JOIN LMS_course_master as course on course.course_id = teacher.course_id LEFT JOIN LMS_department_master as dept ON teacher.department_id = dept.department_id");
    $stmtTotal->execute();
    $allResult = $stmtTotal->fetchAll(PDO::FETCH_ASSOC);
    $allRecords = count($allResult);
    $displayRecords = count($teacherRecord);

    $records = array();		
		
    $i=1;
    foreach ($teacherRecord as $record) {
        if($record['is_hod']=='1'){
            $hod_tag = ' <sup><i class="fa-solid fa-user-graduate" data-toggle="tooltip" data-placement="top" title="(HOD)"></i></sup>';
        }else{
            $hod_tag = '';
        }
		
		if(!empty($record['profile_image']) && isset($record['profile_image'])){
            $t_name = '<div class="avatar"><img class="img-fluid rounded-circle" src="'.$record['profile_image'].'" alt=""></div>';
        }else{
            $t_name = '<div class="flex-shrink-0"><div class="avatar avatar-initials avatar-circle"><span class="text-uppercase">'.mb_substr($record['teacher_name'],0,1).'</span></div>';
            
        }
        $rows = array();			
        $rows[] = $i;
        $rows[] = '<a class="d-flex align-items-center avatar_link" href="javascript:void(0)">
        '.$t_name.'</div><div class="flex-grow-1 ml-2 text-left"><span class="mb-0">'.$record['teacher_name'].$hod_tag.' </span></div></a>';
        $rows[] = $record['department_name'];
        $rows[] = $record['course_name'];
        $rows[] = $record['email'];
        $rows[] = $record['mobile'];
        $status = ($record['is_active']==1)?'Active':'Inactive';	
        $status_class = ($record['is_active']==1)?'success':'danger';	
        $rows[] = ($record['is_active']==1)?"<i class='fa-regular fa-circle-dot' style='color:#2ec900'></i> Active":"<i class='fa-regular fa-circle-dot' style='color:#c90020'></i> Inactive";	
                            
        $rows[] = '<button class="btn btn-info open-edit-teacher-modal" cid="'.$record['teacher_id'].'" data-toggle="tooltip" data-placement="top" title="Edit Teacher">
        <i class="fa-solid fa-pen-to-square"></i>
        </button>  <button class="open-delete-teacher-modal btn btn-'.$status_class.'" status="'.$record['is_active'].'" cid="'.$record['teacher_id'].'" data-toggle="tooltip" data-placement="top" title="Change Status"><i class="fa-solid fa-arrows-rotate"></i></button>';
        
        $records[] = $rows;
        $i++;
    }
    
    $output = array(
        "draw"	=>	intval($_POST["draw"]),			
        "iTotalRecords"	=> 	$displayRecords,
        "iTotalDisplayRecords"	=>  $allRecords,
        "data"	=> 	$records
    );
    
    echo json_encode($output);
}

/*UPLOAD MATERIAL LIST*/
if(!empty($_POST['action']) && $_POST['action'] == 'listRecordsUpload') {
    ob_start();
    session_start();
    $is_hod = isset($_SESSION['is_hod'])?$_SESSION['is_hod']:"";
    $department_id = isset($_SESSION['department_id'])?$_SESSION['department_id']:"";
    $usertype = isset($_SESSION['usertype'])?$_SESSION['usertype']:"";
    $userid = isset($_SESSION['userid'])?$_SESSION['userid']:"";

    $contentRecord = [];
    $qry = "";
   
    

    if(($_SESSION['usertype']=='teacher' && $_SESSION['is_hod'] ==1)){
        $qry .= "select sc.content_id,sc.title,sc.content_type,sc.video_link,sc.document_path,sc.is_active,cm.course_name,sm.stream_id,dm.department_name,mm.material_name,ptm.paper_type_name,ptm.subpaper_type,sm.semester_id,sm.study_id,tm.teacher_name FROM LMS_study_content as sc left join LMS_study_material as sm on sm.study_id = sc.study_id left join LMS_course_master as cm on sm.course_id = cm.course_id 
        left join LMS_department_master as dm on dm.department_id = sm.department_id
        left join LMS_material_master as mm on mm.material_id = sm.material_id		
		left join LMS_teacher_master as tm on tm.teacher_id = sc.teacher_id		
        left join LMS_paper_type_master as ptm on ptm.paper_type_id = sm.paper_type_id  where sc.is_active=1 and sc.created_by_user ='teacher' and sm.department_id = $department_id ";
    }
    if(($_SESSION['usertype']=='teacher' && $_SESSION['is_hod'] ==0)){
        $qry .= "select sc.content_id,sc.title,sc.content_type,sc.video_link,sc.document_path,sc.is_active,cm.course_name,sm.study_id,sm.stream_id,dm.department_name,mm.material_name,ptm.paper_type_name,ptm.subpaper_type,sm.semester_id,sm.study_id,tm.teacher_name FROM LMS_study_content as sc left join LMS_study_material as sm on sm.study_id = sc.study_id left join LMS_course_master as cm on sm.course_id = cm.course_id 
        left join LMS_department_master as dm on dm.department_id = sm.department_id
        left join LMS_material_master as mm on mm.material_id = sm.material_id
		left join LMS_teacher_master as tm on tm.teacher_id = sc.teacher_id
        left join LMS_paper_type_master as ptm on ptm.paper_type_id = sm.paper_type_id  where sc.is_active=1 and sc.created_by_user ='teacher' and sc.created_by = $userid ";
    }
    if(($_SESSION['usertype']!='teacher' && $_SESSION['is_hod'] ==0)){
        $qry .= "select sc.content_id,sc.title,sc.content_type,sc.video_link,sc.document_path,sc.is_active,cm.course_name,sm.study_id,sm.stream_id,dm.department_name,mm.material_name,ptm.paper_type_name,ptm.subpaper_type,sm.semester_id,sm.study_id,tm.teacher_name FROM LMS_study_content as sc left join LMS_study_material as sm on sm.study_id = sc.study_id left join LMS_course_master as cm on sm.course_id = cm.course_id 
        left join LMS_department_master as dm on dm.department_id = sm.department_id
        left join LMS_material_master as mm on mm.material_id = sm.material_id
		left join LMS_teacher_master as tm on tm.teacher_id = sc.teacher_id
        left join LMS_paper_type_master as ptm on ptm.paper_type_id = sm.paper_type_id where sc.is_active=1 ";
    }

    if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"])){
        $keyword = $_POST["search"]["value"];
        //$qry .= " where(stream.stream_name LIKE '"%.$keyword.%"' ";
        $qry .= " AND (cm.course_name LIKE '%".$keyword."%'" ;
        //$qry .= " OR stream.stream_name LIKE '%".$keyword."%'" ;
        $qry .= " OR tm.teacher_name LIKE '%".$keyword."%'" ;
		$qry .= " OR dm.department_name LIKE '%".$keyword."%'" ;
        $qry .= " OR mm.material_name LIKE '%".$keyword."%'" ;
        $qry .= " OR ptm.paper_type_name LIKE '%".$keyword."%'" ;
        $qry .= " OR sm.semester_id LIKE '%".$keyword."%'" ;
		$qry .= " OR sc.title LIKE '%".$keyword."%')";		
    }
    if(!empty($_POST["order"])){
        $qry .= " ORDER BY ".$_POST['order']['0']['column']." ".$_POST['order']['0']['dir']." ";
    } else {
        $qry .= " ORDER BY sc.content_id DESC ";
    }
    if($_POST["length"] != -1){
        $qry .= " OFFSET " . $_POST['start'] . " ROWS FETCH FIRST " . $_POST['length'] . " ROWS ONLY";
    }
	$contentQry = $dbConn->prepare($qry);
    $contentQry->execute();
    $contentRecord = $contentQry->fetchAll(PDO::FETCH_ASSOC);

    if(($_SESSION['usertype']=='teacher' && $_SESSION['is_hod'] ==1)){
        $qryTotal = "select sc.content_id,sc.title,sc.content_type,sc.video_link,sc.document_path,sc.is_active,cm.course_name,sm.study_id,sm.stream_id,dm.department_name,mm.material_name,ptm.paper_type_name,sm.semester_id,sm.study_id FROM LMS_study_content as sc left join LMS_study_material as sm on sm.study_id = sc.study_id left join LMS_course_master as cm on sm.course_id = cm.course_id 
        left join LMS_department_master as dm on dm.department_id = sm.department_id
        left join LMS_material_master as mm on mm.material_id = sm.material_id
        left join LMS_paper_type_master as ptm on ptm.paper_type_id = sm.paper_type_id  where sc.is_active=1 and sc.created_by_user ='teacher' and sm.department_id = $department_id ";
    }
    if(($_SESSION['usertype']=='teacher' && $_SESSION['is_hod'] ==0)){
        $qryTotal = "select sc.content_id,sc.title,sc.content_type,sc.video_link,sc.document_path,sc.is_active,cm.course_name,sm.study_id,sm.stream_id,dm.department_name,mm.material_name,ptm.paper_type_name,sm.semester_id,sm.study_id FROM LMS_study_content as sc left join LMS_study_material as sm on sm.study_id = sc.study_id left join LMS_course_master as cm on sm.course_id = cm.course_id 
        left join LMS_department_master as dm on dm.department_id = sm.department_id
        left join LMS_material_master as mm on mm.material_id = sm.material_id
        left join LMS_paper_type_master as ptm on ptm.paper_type_id = sm.paper_type_id  where sc.is_active=1 and sc.created_by_user ='teacher' and sc.created_by = $userid ";
    }
    if(($_SESSION['usertype']!='teacher' && $_SESSION['is_hod'] ==0)){
        $qryTotal = "select sc.content_id,sc.title,sc.content_type,sc.video_link,sc.document_path,sc.is_active,cm.course_name,sm.study_id,sm.stream_id,dm.department_name,mm.material_name,ptm.paper_type_name,sm.semester_id,sm.study_id FROM LMS_study_content as sc left join LMS_study_material as sm on sm.study_id = sc.study_id left join LMS_course_master as cm on sm.course_id = cm.course_id 
        left join LMS_department_master as dm on dm.department_id = sm.department_id
        left join LMS_material_master as mm on mm.material_id = sm.material_id
        left join LMS_paper_type_master as ptm on ptm.paper_type_id = sm.paper_type_id where sc.is_active=1 ";
    }

    $stmtTotal = $dbConn->prepare($qryTotal);
    $stmtTotal->execute();
    $allResult = $stmtTotal->fetchAll(PDO::FETCH_ASSOC);
    $allRecords = count($allResult);
    $displayRecords = count($contentRecord);

    $records = array();		
		
    $i=1;
    foreach ($contentRecord as $record) {

        $link = "";
        if($record['content_type'] == 'video'){
            $link .= '<a class="btn btn-outline-danger" href="'.$record['video_link'].'" data-toggle="tooltip" data-placement="top" title="Video" target="_blank">
            <i class="fa-solid fa-video"></i>
        </a>';
        }else{
            $link .= '<a download class="btn btn-outline-danger" href="'.$record['document_path'].'" data-toggle="tooltip" data-placement="top" title="Document" target="_blank">
            <i class="fa-solid fa-file"></i>
        </a>';
        }
        $rows = array();			
        $rows[] = $i;
        $rows[] = $record['content_id'];
        $rows[] = $record['teacher_name'];
        $rows[] = $record['course_name'];
        $rows[] = getStreamName($record['stream_id']);
        $rows[] = $record['department_name'];
        $rows[] = $record['material_name'];
        $rows[] = ($record['subpaper_type'] == 'CORE (3 YEAR)')?'CORE':$record['paper_type_name']; 
        $rows[] = $record['semester_id'];
        $rows[] = $record['title'];
        $rows[] = $link;
        $status = ($record['is_active']==1)?'Active':'Inactive';	
        $status_class = ($record['is_active']==1)?'success':'danger';	
        //$rows[] = ($record['is_active']==1)?"<i class='fa-regular fa-circle-dot' style='color:#2ec900'></i> Active":"<i class='fa-regular fa-circle-dot' style='color:#c90020'></i> Inactive";	
                            
        $rows[] = '<button class="btn btn-info open-edit-material-modal" cid="'.$record['content_id'].'" sid="'.$record['study_id'].'" data-toggle="tooltip" data-placement="top" title="Edit Material">
        <i class="fa-solid fa-pen-to-square"></i>
        </button>
        <button class="open-delete-material-modal btn btn-'.$status_class.'" status="'.$record['is_active'].'" cid="'.$record['content_id'].'" sid="'.$record['study_id'].'" data-toggle="tooltip" data-placement="top" title="Change Status"><i class="fa-solid fa fa-trash"></i></button>';
        
        $records[] = $rows;
        $i++;
    }
    
    $output = array(
        "draw"	=>	intval($_POST["draw"]),			
        "iTotalRecords"	=> 	$displayRecords,
        "iTotalDisplayRecords"	=>  $allRecords,
        "data"	=> 	$records
    );
    
    echo json_encode($output);
}

/*MANAGE MATERIAL LIST*/
if(!empty($_POST['action']) && $_POST['action'] == 'listRecordsMaterial') {
    ob_start();
    session_start();
    $is_hod = isset($_SESSION['is_hod'])?$_SESSION['is_hod']:"";
    $department_id = isset($_SESSION['department_id'])?$_SESSION['department_id']:"";
    $usertype = isset($_SESSION['usertype'])?$_SESSION['usertype']:"";
    $userid = isset($_SESSION['userid'])?$_SESSION['userid']:"";

    $contentRecord = [];
    $qry = "";
   
    

    if(($_SESSION['usertype']=='teacher' && $_SESSION['is_hod'] ==1)){
        $qry .= "select sc.content_id,sc.title,sc.content_type,sc.video_link,sc.document_path,sc.is_active,cm.course_name,sm.stream_id,dm.department_name,mm.material_name,ptm.paper_type_name,ptm.subpaper_type,sm.semester_id,sm.study_id,tm.teacher_name FROM LMS_study_content as sc left join LMS_study_material as sm on sm.study_id = sc.study_id left join LMS_course_master as cm on sm.course_id = cm.course_id 
        left join LMS_department_master as dm on dm.department_id = sm.department_id
        left join LMS_material_master as mm on mm.material_id = sm.material_id		
		left join LMS_teacher_master as tm on tm.teacher_id = sc.teacher_id		
        left join LMS_paper_type_master as ptm on ptm.paper_type_id = sm.paper_type_id  where sm.deleted_by is NULL and sc.created_by_user ='teacher' and sm.department_id = $department_id ";
    }
    if(($_SESSION['usertype']=='teacher' && $_SESSION['is_hod'] ==0)){
        $qry .= "select sc.content_id,sc.title,sc.content_type,sc.video_link,sc.document_path,sc.is_active,cm.course_name,sm.study_id,sm.stream_id,dm.department_name,mm.material_name,ptm.paper_type_name,ptm.subpaper_type,sm.semester_id,sm.study_id,tm.teacher_name FROM LMS_study_content as sc left join LMS_study_material as sm on sm.study_id = sc.study_id left join LMS_course_master as cm on sm.course_id = cm.course_id 
        left join LMS_department_master as dm on dm.department_id = sm.department_id
        left join LMS_material_master as mm on mm.material_id = sm.material_id
		left join LMS_teacher_master as tm on tm.teacher_id = sc.teacher_id
        left join LMS_paper_type_master as ptm on ptm.paper_type_id = sm.paper_type_id  where sm.deleted_by is NULL and sc.created_by_user ='teacher' and sc.created_by = $userid ";
    }
    if(($_SESSION['usertype']!='teacher' && $_SESSION['is_hod'] ==0)){
        $qry .= "select sc.content_id,sc.title,sc.content_type,sc.video_link,sc.document_path,sc.is_active,cm.course_name,sm.study_id,sm.stream_id,dm.department_name,mm.material_name,ptm.paper_type_name,ptm.subpaper_type,sm.semester_id,sm.study_id,tm.teacher_name FROM LMS_study_content as sc left join LMS_study_material as sm on sm.study_id = sc.study_id left join LMS_course_master as cm on sm.course_id = cm.course_id 
        left join LMS_department_master as dm on dm.department_id = sm.department_id
        left join LMS_material_master as mm on mm.material_id = sm.material_id
		left join LMS_teacher_master as tm on tm.teacher_id = sc.teacher_id
        left join LMS_paper_type_master as ptm on ptm.paper_type_id = sm.paper_type_id where sm.deleted_by is NULL";
    }

    if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"])){
        $keyword = $_POST["search"]["value"];
        //$qry .= " where(stream.stream_name LIKE '"%.$keyword.%"' ";
        $qry .= " AND (cm.course_name LIKE '%".$keyword."%'" ;
        //$qry .= " OR stream.stream_name LIKE '%".$keyword."%'" ;
        $qry .= " OR tm.teacher_name LIKE '%".$keyword."%'" ;
		$qry .= " OR dm.department_name LIKE '%".$keyword."%'" ;
        $qry .= " OR mm.material_name LIKE '%".$keyword."%'" ;
        $qry .= " OR ptm.paper_type_name LIKE '%".$keyword."%'" ;
        $qry .= " OR sm.semester_id LIKE '%".$keyword."%'" ;
		$qry .= " OR sc.title LIKE '%".$keyword."%')";		
    }
    if(!empty($_POST["order"])){
        $qry .= " ORDER BY ".$_POST['order']['0']['column']." ".$_POST['order']['0']['dir']." ";
    } else {
        $qry .= " ORDER BY sc.content_id DESC ";
    }
    if($_POST["length"] != -1){
        $qry .= " OFFSET " . $_POST['start'] . " ROWS FETCH FIRST " . $_POST['length'] . " ROWS ONLY";
    }
	$contentQry = $dbConn->prepare($qry);
    $contentQry->execute();
    $contentRecord = $contentQry->fetchAll(PDO::FETCH_ASSOC);

    if(($_SESSION['usertype']=='teacher' && $_SESSION['is_hod'] ==1)){
        $qryTotal = "select sc.content_id,sc.title,sc.content_type,sc.video_link,sc.document_path,sc.is_active,cm.course_name,sm.study_id,sm.stream_id,dm.department_name,mm.material_name,ptm.paper_type_name,sm.semester_id,sm.study_id FROM LMS_study_content as sc left join LMS_study_material as sm on sm.study_id = sc.study_id left join LMS_course_master as cm on sm.course_id = cm.course_id 
        left join LMS_department_master as dm on dm.department_id = sm.department_id
        left join LMS_material_master as mm on mm.material_id = sm.material_id
        left join LMS_paper_type_master as ptm on ptm.paper_type_id = sm.paper_type_id  where sm.deleted_by is NULL and sc.created_by_user ='teacher' and sm.department_id = $department_id ";
    }
    if(($_SESSION['usertype']=='teacher' && $_SESSION['is_hod'] ==0)){
        $qryTotal = "select sc.content_id,sc.title,sc.content_type,sc.video_link,sc.document_path,sc.is_active,cm.course_name,sm.study_id,sm.stream_id,dm.department_name,mm.material_name,ptm.paper_type_name,sm.semester_id,sm.study_id FROM LMS_study_content as sc left join LMS_study_material as sm on sm.study_id = sc.study_id left join LMS_course_master as cm on sm.course_id = cm.course_id 
        left join LMS_department_master as dm on dm.department_id = sm.department_id
        left join LMS_material_master as mm on mm.material_id = sm.material_id
        left join LMS_paper_type_master as ptm on ptm.paper_type_id = sm.paper_type_id  where sm.deleted_by is NULL and sc.created_by_user ='teacher' and sc.created_by = $userid ";
    }
    if(($_SESSION['usertype']!='teacher' && $_SESSION['is_hod'] ==0)){
        $qryTotal = "select sc.content_id,sc.title,sc.content_type,sc.video_link,sc.document_path,sc.is_active,cm.course_name,sm.study_id,sm.stream_id,dm.department_name,mm.material_name,ptm.paper_type_name,sm.semester_id,sm.study_id FROM LMS_study_content as sc left join LMS_study_material as sm on sm.study_id = sc.study_id left join LMS_course_master as cm on sm.course_id = cm.course_id 
        left join LMS_department_master as dm on dm.department_id = sm.department_id
        left join LMS_material_master as mm on mm.material_id = sm.material_id
        left join LMS_paper_type_master as ptm on ptm.paper_type_id = sm.paper_type_id where sm.deleted_by is NULL ";
    }

    $stmtTotal = $dbConn->prepare($qryTotal);
    $stmtTotal->execute();
    $allResult = $stmtTotal->fetchAll(PDO::FETCH_ASSOC);
    $allRecords = count($allResult);
    $displayRecords = count($contentRecord);

    $records = array();		
		
    $i=1;
    // Add new code 
    function remove_duplicateKeys($key,$contentRecord){
        $_data = array();
        foreach ($contentRecord as $v) {
        if (isset($_data[$v[$key]])) {
            // found duplicate
            continue;
        }
        // remember unique item
        $_data[$v[$key]] = $v;
        }
        // if you need a zero-based array
        // otherwise work with $_data
        $contentRecord = array_values($_data);
        return $contentRecord;
    }

    $contentRecord = remove_duplicateKeys("study_id",$contentRecord);
    // Add new code 
    foreach ($contentRecord as $record) {

        $link = "";
        if($record['content_type'] == 'video'){
            $link .= '<a class="btn btn-outline-danger" href="'.$record['video_link'].'" data-toggle="tooltip" data-placement="top" title="Video" target="_blank">
            <i class="fa-solid fa-video"></i>
        </a>';
        }else{
            $link .= '<a download class="btn btn-outline-danger" href="'.$record['document_path'].'" data-toggle="tooltip" data-placement="top" title="Document" target="_blank">
            <i class="fa-solid fa-file"></i>
        </a>';
        }
        $rows = array();			
        $rows[] = $i;
        $rows[] = $record['content_id'];
        $rows[] = $record['teacher_name'];
        $rows[] = $record['course_name'];
        $rows[] = getStreamName($record['stream_id']);
        $rows[] = $record['department_name'];
        $rows[] = $record['material_name'];
        $rows[] = ($record['subpaper_type'] == 'CORE (3 YEAR)')?'CORE':$record['paper_type_name']; 
        $rows[] = $record['semester_id'];
        $rows[] = grtNumberOfContentByStudyId($record['study_id']);
        //$rows[] = $link;
        $status = ($record['is_active']==1)?'Active':'Inactive';	
        $status_class = ($record['is_active']==1)?'success':'danger';	
        //$rows[] = ($record['is_active']==1)?"<i class='fa-regular fa-circle-dot' style='color:#2ec900'></i> Active":"<i class='fa-regular fa-circle-dot' style='color:#c90020'></i> Inactive";	
                            
        $rows[] = '<button class="btn btn-info open-edit-material-modal" cid="'.$record['content_id'].'" sid="'.$record['study_id'].'" data-toggle="tooltip" data-placement="top" title="Edit Material">
        <i class="fa-solid fa-pen-to-square"></i>
        </button>';
        
        $records[] = $rows;
        $i++;
    }
    
    $output = array(
        "draw"	=>	intval($_POST["draw"]),			
        "iTotalRecords"	=> 	$displayRecords,
        "iTotalDisplayRecords"	=>  $allRecords,
        "data"	=> 	$records
    );
    
    echo json_encode($output);
}

/*SUBJECT LIST*/
if(!empty($_POST['action']) && $_POST['action'] == 'listRecordsSubject') {

    $department_id = !empty($_POST['department_id'])?$_POST['department_id']:'';
    $paper_type = !empty($_POST['paper_type'])?$_POST['paper_type']:'';
    $subject = !empty($_POST['subject'])?$_POST['subject']:'';
    $is_assigned = !empty($_POST['is_assigned'])?$_POST['is_assigned']:'';

    $subjectRecord = [];
    $qry = "";
   
    $qry .= "select subject.subject_id,subject.SubjectName_SDMS,subject.SubjectCode,subject.SubjectType,dept.department_name FROM CU_Master_Subject_Code_Type as subject left join LMS_department_master as dept on dept.department_id = subject.department_id where subject.IsActive=1 ";
    // $qry .= "select subject.subject_id,subject.SubjectName_SDMS,subject.SubjectCode,subject.SubjectType,subject.department_id FROM CU_Master_Subject_Code_Type as subject  where subject.IsActive=1 ";

    if(!empty($department_id) && isset($department_id)){
        $qry .= " AND subject.department_id = $department_id ";
    }
    if(!empty($paper_type) && isset($paper_type)){
        $qry .= " AND subject.SubjectType = '".$paper_type."' ";
    }
    if(!empty($subject) && isset($subject)){
        $qry .= " AND subject.SubjectName_SDMS = '".$subject."' ";
    }
    if(!empty($is_assigned) && isset($is_assigned)){
        if($is_assigned == 'assigned'){
            $qry .= " AND subject.department_id is NOT NULL ";
        }
        if($is_assigned == 'not'){
            $qry .= " AND subject.department_id is NULL ";
        }
        
    }

    if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"])){
        $keyword = $_POST["search"]["value"];
        //$qry .= " where(stream.stream_name LIKE '"%.$keyword.%"' ";
        $qry .= " and (subject.SubjectName_SDMS LIKE '%".$keyword."%'" ;
        $qry .= " OR subject.SubjectCode LIKE '%".$keyword."%'" ;
        $qry .= " OR subject.SubjectType LIKE '%".$keyword."%'" ;
		$qry .= " OR dept.department_name LIKE '%".$keyword."%')";		
    }
    if(!empty($_POST["order"])){
        $qry .= " ORDER BY ".$_POST['order']['0']['column']." ".$_POST['order']['0']['dir']." ";
    } else {
        $qry .= " ORDER BY subject.SubjectName_SDMS ASC,subject.SubjectType ASC  ";
    }
    if($_POST["length"] != -1){
        $qry .= " OFFSET " . $_POST['start'] . " ROWS FETCH FIRST " . $_POST['length'] . " ROWS ONLY";
    }
    //echo $qry;
	$subjectQry = $dbConn->prepare($qry);
    $subjectQry->execute();
    $subjectRecord = $subjectQry->fetchAll(PDO::FETCH_ASSOC);
    $qryPage = "";
    $qryPage .= "select subject.subject_id,subject.SubjectName_SDMS,subject.SubjectCode,subject.SubjectType,dept.department_name FROM CU_Master_Subject_Code_Type as subject left join LMS_department_master as dept on dept.department_id = subject.department_id where subject.IsActive=1 ";
    if(!empty($department_id) && isset($department_id)){
        $qryPage .= " AND subject.department_id = $department_id ";
    }
    if(!empty($paper_type) && isset($paper_type)){
        $qryPage .= " AND subject.SubjectType = '".$paper_type."' ";
    }
    if(!empty($subject) && isset($subject)){
        $qryPage .= " AND subject.SubjectName_SDMS = '".$subject."' ";
    }
    if(!empty($is_assigned) && isset($is_assigned)){
        if($is_assigned == 'assigned'){
            $qryPage .= " AND subject.department_id is NOT NULL ";
        }
        if($is_assigned == 'not'){
            $qryPage .= " AND subject.department_id is NULL ";
        }
        
    }
    $stmtTotal = $dbConn->prepare($qryPage);
    $stmtTotal->execute();
    $allResult = $stmtTotal->fetchAll(PDO::FETCH_ASSOC);
    $allRecords = count($allResult);
    $displayRecords = count($subjectRecord);

    $records = array();		
		
    $i=1;
    foreach ($subjectRecord as $record) {
        $rows = array();			
        $rows[] = $i;
        $rows[] = $record['SubjectName_SDMS'];
        $rows[] = $record['SubjectCode'];
        $rows[] = $record['SubjectType'];	
        //$rows[] = 'department_name';   
        $rows[] = $record['department_name'];               
        
        
        $records[] = $rows;
        $i++;
    }
    
    $output = array(
        "draw"	=>	intval($_POST["draw"]),			
        "iTotalRecords"	=> 	$displayRecords,
        "iTotalDisplayRecords"	=>  $allRecords,
        "data"	=> 	$records
    );
    
    echo json_encode($output);
}



?>