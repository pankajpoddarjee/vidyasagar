<?php

function getCourseDetailByID($course_id)
{
    //include("../../../connection_CCF.php");
    global $dbConn;
	$checkCourseQry = $dbConn->prepare("select * FROM LMS_course_master where course_id=$course_id");
    $checkCourseQry->execute();
    $checkCourseRecord = $checkCourseQry->fetch(PDO::FETCH_ASSOC);

    if($checkCourseRecord){
        return $checkCourseRecord;
    }else{
        return false;
    }

}	

// function getDepartmentAllData()
// {
//     //include("../../../connection_CCF.php");
//     global $dbConn;
// 	$departmentQry = $dbConn->prepare("select dept.department_id,dept.department_name,dept.is_active,course.course_name FROM LMS_department_master as dept join LMS_course_master as course on course.course_id = dept.course_id order by course.course_name desc, dept.department_name ASC");
//     $departmentQry->execute();
//     $departmentRecord = $departmentQry->fetchAll(PDO::FETCH_ASSOC);

//     if($departmentRecord){
//         return $departmentRecord;
//     }else{
//         return false;
//     }

// }	

// function getStreamAllData()
// {
//     //include("../../../connection_CCF.php");
//     global $dbConn;
// 	$streamQry = $dbConn->prepare("select stream.stream_id,stream.stream_name,stream.stream_code,stream.is_active,course.course_name FROM LMS_stream_master as stream join LMS_course_master as course on course.course_id = stream.course_id order by stream.stream_name ASC");
//     $streamQry->execute();
//     $streamRecord = $streamQry->fetchAll(PDO::FETCH_ASSOC);

//     if($streamRecord){
//         return $streamRecord;
//     }else{
//         return false;
//     }

// }	

function getCourseAllData()
{
    //include("../../../connection_CCF.php");
    global $dbConn;
    $courseRecord = [];
    $qry = "";
    $qry .= "select * FROM LMS_course_master ";
    // if(isset($keyword) && !empty($keyword)){
    //     $qry .= " where course_name LIKE '%".$keyword."%'" ;
    // }
    $qry .= " order by is_active desc, course_name desc";
	$courseQry = $dbConn->prepare($qry);
    $courseQry->execute();
    $courseRecord = $courseQry->fetchAll(PDO::FETCH_ASSOC);
    return $courseRecord;
    

}

function getDepartmentAllData()
{
    //include("../../../connection_CCF.php");
    global $dbConn;
    //session_start();
    $departmentRecord = [];
    $is_hod = isset($_SESSION['is_hod'])?$_SESSION['is_hod']:"";
    $department_id = isset($_SESSION['department_id'])?$_SESSION['department_id']:"";
    $departmentSql = "";
    $departmentSql .= "select * FROM LMS_department_master where is_active=1";
    if($is_hod == 1 || (($_SESSION['usertype'] == 'teacher' && $_SESSION['is_hod'] == 0))){ 
        $departmentSql .= " and department_id = $department_id";
    }
    $departmentQry = $dbConn->prepare($departmentSql);
    $departmentQry->execute();
    $departmentRecord = $departmentQry->fetchAll(PDO::FETCH_ASSOC);
    return $departmentRecord;
}

// function getTeacherAllData()
// {
//     //include("../../../connection_CCF.php");
//     global $dbConn;
//     $is_hod = isset($_SESSION['is_hod'])?$_SESSION['is_hod']:"";
//     $department_id = isset($_SESSION['department_id'])?$_SESSION['department_id']:"";
//     $teacherSql = "";

//     $teacherSql .= "select teacher.teacher_id,teacher.teacher_name,teacher.email,teacher.mobile,teacher.designation,teacher.is_hod,teacher.is_active,course.course_name,dept.department_name FROM LMS_teacher_master as teacher LEFT JOIN LMS_course_master as course on course.course_id = teacher.course_id LEFT JOIN LMS_department_master as dept ON teacher.department_id = dept.department_id";

//     if($is_hod == 1){
//         $teacherSql .= " where teacher.department_id = $department_id";
//     }

//     $teacherSql .= " order by course.course_name desc, dept.department_name ASC";


// 	$teacherQry = $dbConn->prepare($teacherSql);
//     $teacherQry->execute();
//     $teacherRecord = $teacherQry->fetchAll(PDO::FETCH_ASSOC);

//     if($teacherRecord){
//         return $teacherRecord;
//     }else{
//         return false;
//     }

// }	

function getMaterialAllData()
{
    //include("../../../connection_CCF.php");
    global $dbConn;
	$materialQry = $dbConn->prepare("select * FROM LMS_material_master order by is_active desc, material_name desc");
    $materialQry->execute();
    $materialRecord = $materialQry->fetchAll(PDO::FETCH_ASSOC);

    if($materialRecord){
        return $materialRecord;
    }else{
        return false;
    }

}

function getPaperTypeAllData()
{
    //include("../../../connection_CCF.php");
    global $dbConn;
	$paperTypeQry = $dbConn->prepare("select * FROM LMS_paper_type_master order by is_active desc, paper_type_name desc");
    $paperTypeQry->execute();
    $paperTypeRecord = $paperTypeQry->fetchAll(PDO::FETCH_ASSOC);

    if($paperTypeRecord){
        return $paperTypeRecord;
    }else{
        return false;
    }

}

function geAllSemester()
{
    $semesters = array("I","II","III","IV","V","VI","VII","VIII");
    return $semesters;
}

function getStudyMaterialAllData()
{
    //include("../../../connection_CCF.php");
    global $dbConn;
	$studyMaterialQry = $dbConn->prepare("select sc.content_id,sc.title,sc.content_type,sc.video_link,sc.document_path,sc.is_active as is_content_active,sc.publish_date,cm.course_name,dm.department_name,mm.material_name,ptm.paper_type_name,sm.semester_id,sm.is_active  FROM LMS_study_content as sc left join LMS_study_material as sm on sm.study_id = sc.study_id left join LMS_course_master as cm on sm.course_id = cm.course_id 
    left join LMS_department_master as dm on dm.department_id = sm.department_id
    left join LMS_material_master as mm on mm.material_id = sm.material_id
    left join LMS_paper_type_master as ptm on ptm.paper_type_id = sm.paper_type_id
    order by sc.content_id desc");
    $studyMaterialQry->execute();
    $studyMaterialRecord = $studyMaterialQry->fetchAll(PDO::FETCH_ASSOC);

    if($studyMaterialRecord){
        return $studyMaterialRecord;
    }else{
        return false;
    }

}

function getStreamName($stream_ids)
{
    //include("../../../connection_CCF.php");
    //echo $stream_ids;
    global $dbConn;
	$streamNameQry = $dbConn->prepare("select stream_name FROM LMS_stream_master where stream_id IN (".$stream_ids.")");
    $streamNameQry->execute();
    $streamNameRecord = $streamNameQry->fetchAll(PDO::FETCH_ASSOC);
    $stream_name_arr = []; 
    if($streamNameRecord){
        foreach ($streamNameRecord as $value) {
            $stream_name_arr[] = $value['stream_name'];
        }
        return implode(',',$stream_name_arr);
    }else{
        return false;
    }

}

function getMaterialNameById($material_id)
{
    //include("../../../connection_CCF.php");
    //echo $stream_ids;
    global $dbConn;
    $material_name = '';
	$materialNameQry = $dbConn->prepare("select material_name FROM LMS_material_master where material_id = $material_id");
    $materialNameQry->execute();
    $materialNameRecord = $materialNameQry->fetch(PDO::FETCH_ASSOC);
    if($materialNameRecord){
        return $materialNameRecord['material_name'];
    }

}

function getSubjectAllData()
{
    //include("../../../connection_CCF.php");
    global $dbConn;
    $subjectRecord = [];
	$subjectQry = $dbConn->prepare("select * FROM CU_Master_Subject_Code_Type where IsActive = 1 order by SubjectName_SDMS ASC");
    $subjectQry->execute();
    $subjectRecord = $subjectQry->fetchAll(PDO::FETCH_ASSOC);
    return $subjectRecord;
}


?>