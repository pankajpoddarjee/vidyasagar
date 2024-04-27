<?php
include("../sessionConfig.php");
include("../../connection_CCF.php");
include("../function.php");
include("../../configuration_CCF.php");
// echo "<pre>";
// print_r($_SESSION);

//print_r($semesters);
//$collegerollno = $_POST["txtrollno"]; 
$collegerollno = $_SESSION["studcollegeRollNo"];
$student_stream = isset($_SESSION["student_stream"])?$_SESSION["student_stream"]:'';
$student_subject = isset($_SESSION["student_subject"])?$_SESSION["student_subject"]:'';
$presentsemester = isset($_SESSION["presentsemester"])?$_SESSION["presentsemester"]:'';
$course_duration = isset($_SESSION["course_duration"])?$_SESSION["course_duration"]:'';

$current_sem = '';

switch ($presentsemester) {
    case "I":
        $current_sem = 1;
    break;
    case "II":
        $current_sem = 2;
    break;
    case "III":
        $current_sem = 3;
    break;
    case "IV":
        $current_sem = 4;
    break;
    case "V":
        $current_sem = 5;
    break;
    case "VI":
        $current_sem = 6;
    break;
    case "VII":
        $current_sem = 7;
    break;
    case "VIII":
        $current_sem = 8;
    break;
  default:
    echo "NOT FOUND CURRENT SEMESTER";
}

$studentSubSql = "select * from studentSemesterCourse  where collegeRollno = '".$collegerollno."'";
$studentSubQry = $dbConn->prepare($studentSubSql);
$studentSubQry->execute();
$studentSubRecord = $studentSubQry->fetchAll(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($studentSubRecord); die;
$student_stream_name = $studentSubRecord[0]['stream'];

$streamSql = "select stream_id from LMS_stream_master where stream_code = '".$student_stream_name."' and is_active=1";
$streamQry = $dbConn->prepare($streamSql);
$streamQry->execute();
$streamRecord = $streamQry->fetch(PDO::FETCH_ASSOC);
$student_stream = $streamRecord['stream_id'];

$student_subject_sem1 = [];
$student_subject_sem2 = [];
$student_subject_sem3 = [];
$student_subject_sem4 = [];
$student_subject_sem5 = [];
$student_subject_sem6 = [];
$student_subject_sem7 = [];
$student_subject_sem8 = [];
if($studentSubRecord){
    foreach ($studentSubRecord as $key => $value) {
        if( $value['semester'] == 'I'){
            if(!empty($value['CoreCourse1'])){
                $student_subject_sem1['CoreCourse1'] = $value['CoreCourse1'];
            }
            if(!empty($value['CoreCourse2'])){
                $student_subject_sem1['CoreCourse2'] = $value['CoreCourse2'];
            }
            if(!empty($value['CoreCourse3'])){
                $student_subject_sem1['CoreCourse3'] = $value['CoreCourse3'];
            }
            if(!empty($value['CoreCourse4'])){
                $student_subject_sem1['CoreCourse4'] = $value['CoreCourse4'];
            }
            if(!empty($value['minorCourse1'])){
                $student_subject_sem1['minorCourse1'] = $value['minorCourse1'];
            }
            if(!empty($value['minorCourse2'])){
                $student_subject_sem1['minorCourse2'] = $value['minorCourse2'];
            }
            if(!empty($value['IDC'])){
                $student_subject_sem1['IDC'] = $value['IDC'];
            }
            if(!empty($value['AECC'])){
                $student_subject_sem1['AEC'] = $value['AECC'];
            }
            if(!empty($value['SEC'])){
                $student_subject_sem1['SEC'] = $value['SEC'];
            }
            if(!empty($value['CVAC1'])){
                $student_subject_sem1['CVAC1'] = $value['CVAC1'];
            }
            if(!empty($value['CVAC2'])){
                $student_subject_sem1['CVAC2'] = $value['CVAC2'];
            }
            if(!empty($value['DSE1'])){
                $student_subject_sem1['DSE1'] = $value['DSE1'];
            }
            if(!empty($value['DSE2'])){
                $student_subject_sem1['DSE2'] = $value['DSE2'];
            }
            if(!empty($value['DSE3'])){
                $student_subject_sem1['DSE3'] = $value['DSE3'];
            }
            
        }
        if( $value['semester'] == 'II'){
            if(!empty($value['CoreCourse1'])){
                $student_subject_sem2['CoreCourse1'] = $value['CoreCourse1'];
            }
            if(!empty($value['CoreCourse2'])){
                $student_subject_sem2['CoreCourse2'] = $value['CoreCourse2'];
            }
            if(!empty($value['CoreCourse3'])){
                $student_subject_sem2['CoreCourse3'] = $value['CoreCourse3'];
            }
            if(!empty($value['CoreCourse4'])){
                $student_subject_sem2['CoreCourse4'] = $value['CoreCourse4'];
            }
            if(!empty($value['minorCourse1'])){
                $student_subject_sem2['minorCourse1'] = $value['minorCourse1'];
            }
            if(!empty($value['minorCourse2'])){
                $student_subject_sem2['minorCourse2'] = $value['minorCourse2'];
            }
            if(!empty($value['IDC'])){
                $student_subject_sem2['IDC'] = $value['IDC'];
            }
            if(!empty($value['AECC'])){
                $student_subject_sem2['AEC'] = $value['AECC'];
            }
            if(!empty($value['SEC'])){
                $student_subject_sem2['SEC'] = $value['SEC'];
            }
            if(!empty($value['CVAC1'])){
                $student_subject_sem2['CVAC1'] = $value['CVAC1'];
            }
            if(!empty($value['CVAC2'])){
                $student_subject_sem2['CVAC2'] = $value['CVAC2'];
            }
            if(!empty($value['DSE1'])){
                $student_subject_sem2['DSE1'] = $value['DSE1'];
            }
            if(!empty($value['DSE2'])){
                $student_subject_sem2['DSE2'] = $value['DSE2'];
            }
            if(!empty($value['DSE3'])){
                $student_subject_sem2['DSE3'] = $value['DSE3'];
            }
            
        }
        if( $value['semester'] == 'III'){
            if(!empty($value['CoreCourse1'])){
                $student_subject_sem3['CoreCourse1'] = $value['CoreCourse1'];
            }
            if(!empty($value['CoreCourse2'])){
                $student_subject_sem3['CoreCourse2'] = $value['CoreCourse2'];
            }
            if(!empty($value['CoreCourse3'])){
                $student_subject_sem3['CoreCourse3'] = $value['CoreCourse3'];
            }
            if(!empty($value['CoreCourse4'])){
                $student_subject_sem3['CoreCourse4'] = $value['CoreCourse4'];
            }
            if(!empty($value['minorCourse1'])){
                $student_subject_sem3['minorCourse1'] = $value['minorCourse1'];
            }
            if(!empty($value['minorCourse2'])){
                $student_subject_sem3['minorCourse2'] = $value['minorCourse2'];
            }
            if(!empty($value['IDC'])){
                $student_subject_sem3['IDC'] = $value['IDC'];
            }
            if(!empty($value['AECC'])){
                $student_subject_sem3['AEC'] = $value['AECC'];
            }
            if(!empty($value['SEC'])){
                $student_subject_sem3['SEC'] = $value['SEC'];
            }
            if(!empty($value['CVAC1'])){
                $student_subject_sem3['CVAC1'] = $value['CVAC1'];
            }
            if(!empty($value['CVAC2'])){
                $student_subject_sem3['CVAC2'] = $value['CVAC2'];
            }
            if(!empty($value['DSE1'])){
                $student_subject_sem3['DSE1'] = $value['DSE1'];
            }
            if(!empty($value['DSE2'])){
                $student_subject_sem3['DSE2'] = $value['DSE2'];
            }
            if(!empty($value['DSE3'])){
                $student_subject_sem3['DSE3'] = $value['DSE3'];
            }
            
        }
        if( $value['semester'] == 'IV'){
            if(!empty($value['CoreCourse1'])){
                $student_subject_sem4['CoreCourse1'] = $value['CoreCourse1'];
            }
            if(!empty($value['CoreCourse2'])){
                $student_subject_sem4['CoreCourse2'] = $value['CoreCourse2'];
            }
            if(!empty($value['CoreCourse3'])){
                $student_subject_sem4['CoreCourse3'] = $value['CoreCourse3'];
            }
            if(!empty($value['CoreCourse4'])){
                $student_subject_sem4['CoreCourse4'] = $value['CoreCourse4'];
            }
            if(!empty($value['minorCourse1'])){
                $student_subject_sem4['minorCourse1'] = $value['minorCourse1'];
            }
            if(!empty($value['minorCourse2'])){
                $student_subject_sem4['minorCourse2'] = $value['minorCourse2'];
            }
            if(!empty($value['IDC'])){
                $student_subject_sem4['IDC'] = $value['IDC'];
            }
            if(!empty($value['AECC'])){
                $student_subject_sem4['AEC'] = $value['AECC'];
            }
            if(!empty($value['SEC'])){
                $student_subject_sem4['SEC'] = $value['SEC'];
            }
            if(!empty($value['CVAC1'])){
                $student_subject_sem4['CVAC1'] = $value['CVAC1'];
            }
            if(!empty($value['CVAC2'])){
                $student_subject_sem4['CVAC2'] = $value['CVAC2'];
            }
            if(!empty($value['DSE1'])){
                $student_subject_sem4['DSE1'] = $value['DSE1'];
            }
            if(!empty($value['DSE2'])){
                $student_subject_sem4['DSE2'] = $value['DSE2'];
            }
            if(!empty($value['DSE3'])){
                $student_subject_sem4['DSE3'] = $value['DSE3'];
            }
            
        }
        if( $value['semester'] == 'V'){
            if(!empty($value['CoreCourse1'])){
                $student_subject_sem5['CoreCourse1'] = $value['CoreCourse1'];
            }
            if(!empty($value['CoreCourse2'])){
                $student_subject_sem5['CoreCourse2'] = $value['CoreCourse2'];
            }
            if(!empty($value['CoreCourse3'])){
                $student_subject_sem5['CoreCourse3'] = $value['CoreCourse3'];
            }
            if(!empty($value['CoreCourse4'])){
                $student_subject_sem5['CoreCourse4'] = $value['CoreCourse4'];
            }
            if(!empty($value['minorCourse1'])){
                $student_subject_sem5['minorCourse1'] = $value['minorCourse1'];
            }
            if(!empty($value['minorCourse2'])){
                $student_subject_sem5['minorCourse2'] = $value['minorCourse2'];
            }
            if(!empty($value['IDC'])){
                $student_subject_sem5['IDC'] = $value['IDC'];
            }
            if(!empty($value['AECC'])){
                $student_subject_sem5['AEC'] = $value['AECC'];
            }
            if(!empty($value['SEC'])){
                $student_subject_sem5['SEC'] = $value['SEC'];
            }
            if(!empty($value['CVAC1'])){
                $student_subject_sem5['CVAC1'] = $value['CVAC1'];
            }
            if(!empty($value['CVAC2'])){
                $student_subject_sem5['CVAC2'] = $value['CVAC2'];
            }
            if(!empty($value['DSE1'])){
                $student_subject_sem5['DSE1'] = $value['DSE1'];
            }
            if(!empty($value['DSE2'])){
                $student_subject_sem5['DSE2'] = $value['DSE2'];
            }
            if(!empty($value['DSE3'])){
                $student_subject_sem5['DSE3'] = $value['DSE3'];
            }
            
        }
        if( $value['semester'] == 'VI'){
            if(!empty($value['CoreCourse1'])){
                $student_subject_sem6['CoreCourse1'] = $value['CoreCourse1'];
            }
            if(!empty($value['CoreCourse2'])){
                $student_subject_sem6['CoreCourse2'] = $value['CoreCourse2'];
            }
            if(!empty($value['CoreCourse3'])){
                $student_subject_sem6['CoreCourse3'] = $value['CoreCourse3'];
            }
            if(!empty($value['CoreCourse4'])){
                $student_subject_sem6['CoreCourse4'] = $value['CoreCourse4'];
            }
            if(!empty($value['minorCourse1'])){
                $student_subject_sem6['minorCourse1'] = $value['minorCourse1'];
            }
            if(!empty($value['minorCourse2'])){
                $student_subject_sem6['minorCourse2'] = $value['minorCourse2'];
            }
            if(!empty($value['IDC'])){
                $student_subject_sem6['IDC'] = $value['IDC'];
            }
            if(!empty($value['AECC'])){
                $student_subject_sem6['AEC'] = $value['AECC'];
            }
            if(!empty($value['SEC'])){
                $student_subject_sem6['SEC'] = $value['SEC'];
            }
            if(!empty($value['CVAC1'])){
                $student_subject_sem6['CVAC1'] = $value['CVAC1'];
            }
            if(!empty($value['CVAC2'])){
                $student_subject_sem6['CVAC2'] = $value['CVAC2'];
            }
            if(!empty($value['DSE1'])){
                $student_subject_sem6['DSE1'] = $value['DSE1'];
            }
            if(!empty($value['DSE2'])){
                $student_subject_sem6['DSE2'] = $value['DSE2'];
            }
            if(!empty($value['DSE3'])){
                $student_subject_sem6['DSE3'] = $value['DSE3'];
            }
            
        }
        if( $value['semester'] == 'VII'){
            if(!empty($value['CoreCourse1'])){
                $student_subject_sem7['CoreCourse1'] = $value['CoreCourse1'];
            }
            if(!empty($value['CoreCourse2'])){
                $student_subject_sem7['CoreCourse2'] = $value['CoreCourse2'];
            }
            if(!empty($value['CoreCourse3'])){
                $student_subject_sem7['CoreCourse3'] = $value['CoreCourse3'];
            }
            if(!empty($value['CoreCourse4'])){
                $student_subject_sem7['CoreCourse4'] = $value['CoreCourse4'];
            }
            if(!empty($value['minorCourse1'])){
                $student_subject_sem7['minorCourse1'] = $value['minorCourse1'];
            }
            if(!empty($value['minorCourse2'])){
                $student_subject_sem7['minorCourse2'] = $value['minorCourse2'];
            }
            if(!empty($value['IDC'])){
                $student_subject_sem7['IDC'] = $value['IDC'];
            }
            if(!empty($value['AECC'])){
                $student_subject_sem7['AEC'] = $value['AECC'];
            }
            if(!empty($value['SEC'])){
                $student_subject_sem7['SEC'] = $value['SEC'];
            }
            if(!empty($value['CVAC1'])){
                $student_subject_sem7['CVAC1'] = $value['CVAC1'];
            }
            if(!empty($value['CVAC2'])){
                $student_subject_sem7['CVAC2'] = $value['CVAC2'];
            }
            if(!empty($value['DSE1'])){
                $student_subject_sem7['DSE1'] = $value['DSE1'];
            }
            if(!empty($value['DSE2'])){
                $student_subject_sem7['DSE2'] = $value['DSE2'];
            }
            if(!empty($value['DSE3'])){
                $student_subject_sem7['DSE3'] = $value['DSE3'];
            }
            
        }
        if( $value['semester'] == 'VIII'){
            if(!empty($value['CoreCourse1'])){
                $student_subject_sem8['CoreCourse1'] = $value['CoreCourse1'];
            }
            if(!empty($value['CoreCourse2'])){
                $student_subject_sem8['CoreCourse2'] = $value['CoreCourse2'];
            }
            if(!empty($value['CoreCourse3'])){
                $student_subject_sem8['CoreCourse3'] = $value['CoreCourse3'];
            }
            if(!empty($value['CoreCourse4'])){
                $student_subject_sem8['CoreCourse4'] = $value['CoreCourse4'];
            }
            if(!empty($value['minorCourse1'])){
                $student_subject_sem8['minorCourse1'] = $value['minorCourse1'];
            }
            if(!empty($value['minorCourse2'])){
                $student_subject_sem8['minorCourse2'] = $value['minorCourse2'];
            }
            if(!empty($value['IDC'])){
                $student_subject_sem8['IDC'] = $value['IDC'];
            }
            if(!empty($value['AECC'])){
                $student_subject_sem8['AEC'] = $value['AECC'];
            }
            if(!empty($value['SEC'])){
                $student_subject_sem8['SEC'] = $value['SEC'];
            }
            if(!empty($value['CVAC1'])){
                $student_subject_sem8['CVAC1'] = $value['CVAC1'];
            }
            if(!empty($value['CVAC2'])){
                $student_subject_sem8['CVAC2'] = $value['CVAC2'];
            }
            if(!empty($value['DSE1'])){
                $student_subject_sem8['DSE1'] = $value['DSE1'];
            }
            if(!empty($value['DSE2'])){
                $student_subject_sem8['DSE2'] = $value['DSE2'];
            }
            if(!empty($value['DSE3'])){
                $student_subject_sem8['DSE3'] = $value['DSE3'];
            }
            
        }
    }
}

// echo "<pre>";
// print_r($student_subject_sem1);
// print_r($student_subject_sem2);
// print_r($student_subject_sem3);
// print_r($student_subject_sem4);
// print_r($student_subject_sem5);
// print_r($student_subject_sem6);
// print_r($student_subject_sem7);
// print_r($student_subject_sem8); 
// die;



include("../Query_dashboard.php");

$qryresult = NULL;
$semester1 = [];$semester2 = [];$semester3 = [];$semester4 = [];$semester5 = [];$semester6 = [];
$semester7 = [];$semester8 = [];

//echo $student_stream;
$contentSql = "select sc.content_id,sc.title,sc.content_type,sc.video_link,sc.document_path,sc.is_active,sc.publish_date,tm.teacher_name,sc.created_at,cm.course_name,dm.department_name,mm.material_name,ptm.paper_type_name,ptm.subpaper_type,sm.semester_id,sm.subject_id,msc.SubjectName_SDMS,ptm.duration FROM LMS_study_content as sc left join LMS_study_material as sm on sm.study_id = sc.study_id left join LMS_course_master as cm on sm.course_id = cm.course_id 
left join LMS_department_master as dm on dm.department_id = sm.department_id
left join LMS_material_master as mm on mm.material_id = sm.material_id
left join LMS_paper_type_master as ptm on ptm.paper_type_id = sm.paper_type_id 
left join LMS_teacher_master as tm on tm.teacher_id = sc.created_by
left join CU_Master_Subject_Code_Type  as msc on msc.subject_id = sm.subject_id where sc.is_active=1 and CONCAT(',',sm.stream_id,',') LIKE CONCAT('%,','".$student_stream."',',%') ";

if(isset($_POST["filter_sem"])){
    $semester=$_POST["filter_sem"];
    $contentSql .= " and CONCAT(',',sm.semester_id,',') LIKE CONCAT('%,','".$semester."',',%')";
}
$contentSql .= " order by sc.content_id desc";

$contentQry = $dbConn->prepare($contentSql);
$contentQry->execute();
$contentRecord = $contentQry->fetchAll(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($contentRecord); die;
if($contentRecord){
    foreach ($contentRecord as $value) {

        
        if(in_array('I', explode(',',$value['semester_id']))){

            if($value['paper_type_name'] == 'MAJOR'){
                foreach ($student_subject_sem1 as $key => $sem_sub) {
                    if($key == 'CoreCourse1' || $key == 'CoreCourse2' || $key == 'CoreCourse3' || $key == 'CoreCourse4'){
                        if($value['SubjectName_SDMS'] ==  $sem_sub){
                            $semester1[] = $value;
                        }
                    }
                }
            }
            if($value['paper_type_name'] == 'MINOR'){
                foreach ($student_subject_sem1 as $key => $sem_sub) {
                    if($key == 'minorCourse1' || $key == 'minorCourse2'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
							if($course_duration == $value['duration']){
							$semester1[] = $value;	
							}
                            
                        }
                    }
                }
            }
            if($value['paper_type_name'] == 'MINOR' && $value['subpaper_type'] != 'CORE (3 YEAR)'){
                foreach ($student_subject_sem1 as $key => $sem_sub) {
                    if($key == 'minorCourse1' || $key == 'minorCourse2'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
							if($course_duration == $value['duration']){
							$semester1[] = $value;	
							}
                            
                        }
                    }
                }
            }
            if($value['paper_type_name'] == 'MINOR' && $value['subpaper_type'] == 'CORE (3 YEAR)'){
                foreach ($student_subject_sem1 as $key => $sem_sub) {
                    if($key == 'CoreCourse1' || $key == 'CoreCourse2' || $key == 'CoreCourse3' || $key == 'CoreCourse4'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
							if($course_duration == $value['duration']){
							$semester1[] = $value;	
							}
                            
                        }
                    }
                }
            }
            if($value['paper_type_name'] == 'CVAC'){
                foreach ($student_subject_sem1 as $key => $sem_sub) {
                    if($key == 'CVAC1' || $key == 'CVAC2'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester1[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'AEC'){
                foreach ($student_subject_sem1 as $key => $sem_sub) {
                    if($key == 'AEC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester1[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'IDC'){
                foreach ($student_subject_sem1 as $key => $sem_sub) {
                    if($key == 'IDC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester1[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'SEC'){
                foreach ($student_subject_sem1 as $key => $sem_sub) {
                    if($key == 'SEC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester1[] = $value;
                        }
                    }
                }
            }
            
            

        }
        if(in_array('II', explode(',',$value['semester_id']))){
            if($value['paper_type_name'] == 'MAJOR'){
                foreach ($student_subject_sem2 as $key => $sem_sub) {
                    if($key == 'CoreCourse1' || $key == 'CoreCourse2' || $key == 'CoreCourse3' || $key == 'CoreCourse4'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester2[] = $value;
                        }
                    }
                }
            }
            // if($value['paper_type_name'] == 'MINOR'){
            //     foreach ($student_subject_sem2 as $key => $sem_sub) {
            //         if($key == 'minorCourse1' || $key == 'minorCourse2'){
            //             if($value['SubjectName_SDMS'] == $sem_sub){
            //                 $semester2[] = $value;
            //             }
            //         }
            //     }
            // }

            if($value['paper_type_name'] == 'MINOR' && $value['subpaper_type'] != 'CORE (3 YEAR)'){
                foreach ($student_subject_sem2 as $key => $sem_sub) {
                    if($key == 'minorCourse1' || $key == 'minorCourse2'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
							if($course_duration == $value['duration']){
							$semester2[] = $value;	
							}
                            
                        }
                    }
                }
            }
            if($value['paper_type_name'] == 'MINOR' && $value['subpaper_type'] == 'CORE (3 YEAR)'){
                foreach ($student_subject_sem2 as $key => $sem_sub) {
                    if($key == 'CoreCourse1' || $key == 'CoreCourse2' || $key == 'CoreCourse3' || $key == 'CoreCourse4'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
							if($course_duration == $value['duration']){
							$semester2[] = $value;	
							}
                            
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'CVAC'){
                foreach ($student_subject_sem2 as $key => $sem_sub) {
                    if($key == 'CVAC1' || $key == 'CVAC2'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester2[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'AEC'){
                foreach ($student_subject_sem2 as $key => $sem_sub) {
                    if($key == 'AEC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester2[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'IDC'){
                foreach ($student_subject_sem2 as $key => $sem_sub) {
                    if($key == 'IDC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester2[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'SEC'){
                foreach ($student_subject_sem2 as $key => $sem_sub) {
                    if($key == 'SEC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester2[] = $value;
                        }
                    }
                }
            }
        }
        if(in_array('III', explode(',',$value['semester_id']))){
            if($value['paper_type_name'] == 'MAJOR'){
                foreach ($student_subject_sem3 as $key => $sem_sub) {
                    if($key == 'CoreCourse1' || $key == 'CoreCourse2' || $key == 'CoreCourse3' || $key == 'CoreCourse4'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester3[] = $value;
                        }
                    }
                }
            }
            // if($value['paper_type_name'] == 'MINOR'){
            //     foreach ($student_subject_sem3 as $key => $sem_sub) {
            //         if($key == 'minorCourse1' || $key == 'minorCourse2'){
            //             if($value['SubjectName_SDMS'] == $sem_sub){
            //                 $semester3[] = $value;
            //             }
            //         }
            //     }
            // }
            if($value['paper_type_name'] == 'MINOR' && $value['subpaper_type'] != 'CORE (3 YEAR)'){
                foreach ($student_subject_sem3 as $key => $sem_sub) {
                    if($key == 'minorCourse1' || $key == 'minorCourse2'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
							if($course_duration == $value['duration']){
							$semester3[] = $value;	
							}
                            
                        }
                    }
                }
            }
            if($value['paper_type_name'] == 'MINOR' && $value['subpaper_type'] == 'CORE (3 YEAR)'){
                foreach ($student_subject_sem3 as $key => $sem_sub) {
                    if($key == 'CoreCourse1' || $key == 'CoreCourse2' || $key == 'CoreCourse3' || $key == 'CoreCourse4'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
							if($course_duration == $value['duration']){
							$semester3[] = $value;	
							}
                            
                        }
                    }
                }
            }
            if($value['paper_type_name'] == 'CVAC'){
                foreach ($student_subject_sem3 as $key => $sem_sub) {
                    if($key == 'CVAC1' || $key == 'CVAC2'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester3[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'AEC'){
                foreach ($student_subject_sem3 as $key => $sem_sub) {
                    if($key == 'AEC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester3[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'IDC'){
                foreach ($student_subject_sem3 as $key => $sem_sub) {
                    if($key == 'IDC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester3[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'SEC'){
                foreach ($student_subject_sem3 as $key => $sem_sub) {
                    if($key == 'SEC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester3[] = $value;
                        }
                    }
                }
            }
        }
        if(in_array('IV', explode(',',$value['semester_id']))){
            if($value['paper_type_name'] == 'MAJOR'){
                foreach ($student_subject_sem4 as $key => $sem_sub) {
                    if($key == 'CoreCourse1' || $key == 'CoreCourse2' || $key == 'CoreCourse3' || $key == 'CoreCourse4'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester4[] = $value;
                        }
                    }
                }
            }
            // if($value['paper_type_name'] == 'MINOR'){
            //     foreach ($student_subject_sem4 as $key => $sem_sub) {
            //         if($key == 'minorCourse1' || $key == 'minorCourse2'){
            //             if($value['SubjectName_SDMS'] == $sem_sub){
            //                 $semester4[] = $value;
            //             }
            //         }
            //     }
            // }

            if($value['paper_type_name'] == 'MINOR' && $value['subpaper_type'] != 'CORE (3 YEAR)'){
                foreach ($student_subject_sem4 as $key => $sem_sub) {
                    if($key == 'minorCourse1' || $key == 'minorCourse2'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
							if($course_duration == $value['duration']){
							$semester4[] = $value;	
							}
                            
                        }
                    }
                }
            }
            if($value['paper_type_name'] == 'MINOR' && $value['subpaper_type'] == 'CORE (3 YEAR)'){
                foreach ($student_subject_sem4 as $key => $sem_sub) {
                    if($key == 'CoreCourse1' || $key == 'CoreCourse2' || $key == 'CoreCourse3' || $key == 'CoreCourse4'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
							if($course_duration == $value['duration']){
							$semester4[] = $value;	
							}
                            
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'CVAC'){
                foreach ($student_subject_sem4 as $key => $sem_sub) {
                    if($key == 'CVAC1' || $key == 'CVAC2'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester4[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'AEC'){
                foreach ($student_subject_sem4 as $key => $sem_sub) {
                    if($key == 'AEC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester4[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'IDC'){
                foreach ($student_subject_sem4 as $key => $sem_sub) {
                    if($key == 'IDC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester4[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'SEC'){
                foreach ($student_subject_sem4 as $key => $sem_sub) {
                    if($key == 'SEC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester4[] = $value;
                        }
                    }
                }
            }
        }
        if(in_array('V', explode(',',$value['semester_id']))){
            if($value['paper_type_name'] == 'MAJOR'){
                foreach ($student_subject_sem5 as $key => $sem_sub) {
                    if($key == 'CoreCourse1' || $key == 'CoreCourse2' || $key == 'CoreCourse3' || $key == 'CoreCourse4'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester5[] = $value;
                        }
                    }
                }
            }
            // if($value['paper_type_name'] == 'MINOR'){
            //     foreach ($student_subject_sem5 as $key => $sem_sub) {
            //         if($key == 'minorCourse1' || $key == 'minorCourse2'){
            //             if($value['SubjectName_SDMS'] == $sem_sub){
            //                 $semester5[] = $value;
            //             }
            //         }
            //     }
            // }
            if($value['paper_type_name'] == 'MINOR' && $value['subpaper_type'] != 'CORE (3 YEAR)'){
                foreach ($student_subject_sem5 as $key => $sem_sub) {
                    if($key == 'minorCourse1' || $key == 'minorCourse2'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
							if($course_duration == $value['duration']){
							$semester5[] = $value;	
							}
                            
                        }
                    }
                }
            }
            if($value['paper_type_name'] == 'MINOR' && $value['subpaper_type'] == 'CORE (3 YEAR)'){
                foreach ($student_subject_sem5 as $key => $sem_sub) {
                    if($key == 'CoreCourse1' || $key == 'CoreCourse2' || $key == 'CoreCourse3' || $key == 'CoreCourse4'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
							if($course_duration == $value['duration']){
							$semester5[] = $value;	
							}
                            
                        }
                    }
                }
            }
            if($value['paper_type_name'] == 'CVAC'){
                foreach ($student_subject_sem5 as $key => $sem_sub) {
                    if($key == 'CVAC1' || $key == 'CVAC2'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester5[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'AEC'){
                foreach ($student_subject_sem5 as $key => $sem_sub) {
                    if($key == 'AEC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester5[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'IDC'){
                foreach ($student_subject_sem5 as $key => $sem_sub) {
                    if($key == 'IDC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester5[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'SEC'){
                foreach ($student_subject_sem5 as $key => $sem_sub) {
                    if($key == 'SEC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester5[] = $value;
                        }
                    }
                }
            }
        }
        if(in_array('VI', explode(',',$value['semester_id']))){
            if($value['paper_type_name'] == 'MAJOR'){
                foreach ($student_subject_sem6 as $key => $sem_sub) {
                    if($key == 'CoreCourse1' || $key == 'CoreCourse2' || $key == 'CoreCourse3' || $key == 'CoreCourse4'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester6[] = $value;
                        }
                    }
                }
            }
            // if($value['paper_type_name'] == 'MINOR'){
            //     foreach ($student_subject_sem6 as $key => $sem_sub) {
            //         if($key == 'minorCourse1' || $key == 'minorCourse2'){
            //             if($value['SubjectName_SDMS'] == $sem_sub){
            //                 $semester6[] = $value;
            //             }
            //         }
            //     }
            // }
            if($value['paper_type_name'] == 'MINOR' && $value['subpaper_type'] != 'CORE (3 YEAR)'){
                foreach ($student_subject_sem6 as $key => $sem_sub) {
                    if($key == 'minorCourse1' || $key == 'minorCourse2'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
							if($course_duration == $value['duration']){
							$semester6[] = $value;	
							}
                            
                        }
                    }
                }
            }
            if($value['paper_type_name'] == 'MINOR' && $value['subpaper_type'] == 'CORE (3 YEAR)'){
                foreach ($student_subject_sem6 as $key => $sem_sub) {
                    if($key == 'CoreCourse1' || $key == 'CoreCourse2' || $key == 'CoreCourse3' || $key == 'CoreCourse4'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
							if($course_duration == $value['duration']){
							$semester6[] = $value;	
							}
                            
                        }
                    }
                }
            }
            if($value['paper_type_name'] == 'CVAC'){
                foreach ($student_subject_sem6 as $key => $sem_sub) {
                    if($key == 'CVAC1' || $key == 'CVAC2'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester6[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'AEC'){
                foreach ($student_subject_sem6 as $key => $sem_sub) {
                    if($key == 'AEC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester6[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'IDC'){
                foreach ($student_subject_sem6 as $key => $sem_sub) {
                    if($key == 'IDC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester6[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'SEC'){
                foreach ($student_subject_sem6 as $key => $sem_sub) {
                    if($key == 'SEC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester6[] = $value;
                        }
                    }
                }
            }
        }
        if(in_array('VII', explode(',',$value['semester_id']))){
            if($value['paper_type_name'] == 'MAJOR'){
                foreach ($student_subject_sem7 as $key => $sem_sub) {
                    if($key == 'CoreCourse1' || $key == 'CoreCourse2' || $key == 'CoreCourse3' || $key == 'CoreCourse4'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester7[] = $value;
                        }
                    }
                }
            }
            // if($value['paper_type_name'] == 'MINOR'){
            //     foreach ($student_subject_sem7 as $key => $sem_sub) {
            //         if($key == 'minorCourse1' || $key == 'minorCourse2'){
            //             if($value['SubjectName_SDMS'] == $sem_sub){
            //                 $semester7[] = $value;
            //             }
            //         }
            //     }
            // }
            if($value['paper_type_name'] == 'MINOR' && $value['subpaper_type'] != 'CORE (3 YEAR)'){
                foreach ($student_subject_sem7 as $key => $sem_sub) {
                    if($key == 'minorCourse1' || $key == 'minorCourse2'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
							if($course_duration == $value['duration']){
							$semester7[] = $value;	
							}
                            
                        }
                    }
                }
            }
            if($value['paper_type_name'] == 'MINOR' && $value['subpaper_type'] == 'CORE (3 YEAR)'){
                foreach ($student_subject_sem7 as $key => $sem_sub) {
                    if($key == 'CoreCourse1' || $key == 'CoreCourse2' || $key == 'CoreCourse3' || $key == 'CoreCourse4'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
							if($course_duration == $value['duration']){
							$semester7[] = $value;	
							}
                            
                        }
                    }
                }
            }
            if($value['paper_type_name'] == 'CVAC'){
                foreach ($student_subject_sem7 as $key => $sem_sub) {
                    if($key == 'CVAC1' || $key == 'CVAC2'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester7[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'AEC'){
                foreach ($student_subject_sem7 as $key => $sem_sub) {
                    if($key == 'AEC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester7[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'IDC'){
                foreach ($student_subject_sem7 as $key => $sem_sub) {
                    if($key == 'IDC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester7[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'SEC'){
                foreach ($student_subject_sem7 as $key => $sem_sub) {
                    if($key == 'SEC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester7[] = $value;
                        }
                    }
                }
            }
        }
        if(in_array('VIII', explode(',',$value['semester_id']))){
            if($value['paper_type_name'] == 'MAJOR'){
                foreach ($student_subject_sem8 as $key => $sem_sub) {
                    if($key == 'CoreCourse1' || $key == 'CoreCourse2' || $key == 'CoreCourse3' || $key == 'CoreCourse4'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester8[] = $value;
                        }
                    }
                }
            }
            // if($value['paper_type_name'] == 'MINOR'){
            //     foreach ($student_subject_sem8 as $key => $sem_sub) {
            //         if($key == 'minorCourse1' || $key == 'minorCourse2'){
            //             if($value['SubjectName_SDMS'] == $sem_sub){
            //                 $semester8[] = $value;
            //             }
            //         }
            //     }
            // }
            if($value['paper_type_name'] == 'MINOR' && $value['subpaper_type'] != 'CORE (3 YEAR)'){
                foreach ($student_subject_sem8 as $key => $sem_sub) {
                    if($key == 'minorCourse1' || $key == 'minorCourse2'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
							if($course_duration == $value['duration']){
							$semester8[] = $value;	
							}
                            
                        }
                    }
                }
            }
            if($value['paper_type_name'] == 'MINOR' && $value['subpaper_type'] == 'CORE (3 YEAR)'){
                foreach ($student_subject_sem8 as $key => $sem_sub) {
                    if($key == 'CoreCourse1' || $key == 'CoreCourse2' || $key == 'CoreCourse3' || $key == 'CoreCourse4'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
							if($course_duration == $value['duration']){
							$semester8[] = $value;	
							}
                            
                        }
                    }
                }
            }
            if($value['paper_type_name'] == 'CVAC'){
                foreach ($student_subject_sem8 as $key => $sem_sub) {
                    if($key == 'CVAC1' || $key == 'CVAC2'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester8[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'AEC'){
                foreach ($student_subject_sem8 as $key => $sem_sub) {
                    if($key == 'AEC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester8[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'IDC'){
                foreach ($student_subject_sem8 as $key => $sem_sub) {
                    if($key == 'IDC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester8[] = $value;
                        }
                    }
                }
            }

            if($value['paper_type_name'] == 'SEC'){
                foreach ($student_subject_sem8 as $key => $sem_sub) {
                    if($key == 'SEC'){
                        if($value['SubjectName_SDMS'] == $sem_sub){
                            $semester8[] = $value;
                        }
                    }
                }
            }
        }
    }
}
$dbConn = NULL;
if($semester1){
    $semester1 = array_map("unserialize", array_unique(array_map("serialize", $semester1)));
}
if($semester2){
    $semester2 = array_map("unserialize", array_unique(array_map("serialize", $semester2)));
}
if($semester3){
    $semester3 = array_map("unserialize", array_unique(array_map("serialize", $semester3)));
}
if($semester4){
    $semester4 = array_map("unserialize", array_unique(array_map("serialize", $semester4)));
}
if($semester5){
    $semester5 = array_map("unserialize", array_unique(array_map("serialize", $semester5)));
}
if($semester6){
    $semester6 = array_map("unserialize", array_unique(array_map("serialize", $semester6)));
}
if($semester7){
    $semester7 = array_map("unserialize", array_unique(array_map("serialize", $semester7)));
}
if($semester8){
    $semester8 = array_map("unserialize", array_unique(array_map("serialize", $semester8)));
}
$allSemester = $semester1 + $semester2 + $semester3 + $semester4 + $semester5 + $semester6 + $semester7 + $semester8;
// echo "<pre>";
// print_r($allSemester); die;
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title>Learning Materials - <?php echo COLLEGE_NAME; ?></title>
<?php include("../head_includes.php");?>
<script src="<?php echo BASE_URL_HOME;?>/bootstrap/table_filter/table_filter.js"></script>
<!-- <link rel="stylesheet" href="<?php echo BASE_URL_HOME;?>/bootstrap/table_filter/table_filter.css"> -->
</head>
<body>
    <?php include("lms_dashboard_menu.php");?>
    
    <div id="content">
    	<?php include("../header.php");?>
        <?php include("../candidate_dashboard_menu2.php");?>
        
        <div class="pl-3 pr-3 pt-0">        
            <?php include("../emergengy_notice_dashboard.php");?>
            
            <div class="row mb-2">
                <div class="col-md-4 mt-1 mb-1 text-center text-md-left">
                    <h3 class="m-0" style="font-family:Oswald">
                    	<i class="fa-solid fa-user-clock"></i> Session: <span class="text-danger"><?php echo $record["appliedsession"];?></span>
                    </h3>
                </div>
                <div class="col-md-4 mt-1 mb-1 text-center">
                    <h3 class="m-0" style="font-family:Oswald">
                    	<i class="fa-solid fa-user-graduate"></i> Semester: <span class="text-danger"><?php echo $record["presentsemester"];?></span>
                    </h3>
                </div>
                <div class="col-md-4 mt-1 mb-1 text-center text-md-right">
                    <h3 class="m-0" style="font-family:Oswald">
                    	<i class="fa-solid fa-clipboard-user"></i> Roll: <span class="text-danger"><?php echo $_SESSION["studcollegeRollNo"];?></span>
                    </h3>
                </div>
            </div>
            <hr>
            <form method="POST" action="">
            <div class="row mb-2 justify-content-center">            	
                <div class="col-md-3">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Select Semester <span class="text-danger">*</span></span>
                        </div>                        
                        <select id="filter_sem" name="filter_sem" class="custom-select" onchange="this.form.submit()">
                            <!-- <option value="" selected>Select</option> -->
                            <?php if($current_sem >=1 ) { ?>
                            <option value="I" <?php echo ($presentsemester=='I')?"selected":"" ?>>Semester - I</option>
                            <?php } ?>
                            <?php if($current_sem >=2 ) { ?>
                            <option value="II" <?php echo ($presentsemester=='II')?"selected":"" ?>>Semester - II</option>
                            <?php } ?>
                            <?php if($current_sem >=3 ) { ?>
                            <option value="III" <?php echo ($presentsemester=='III')?"selected":"" ?>>Semester - III</option>
                            <?php } ?>
                            <?php if($current_sem >=4 ) { ?>
                            <option value="IV" <?php echo ($presentsemester=='IV')?"selected":"" ?>>Semester - IV</option>
                            <?php } ?>
                            <?php if($current_sem >=5 ) { ?>
                            <option value="V" <?php echo ($presentsemester=='V')?"selected":"" ?>>Semester - V</option>
                            <?php } ?>
                            <?php if($current_sem >=6 ) { ?>
                            <option value="VI" <?php echo ($presentsemester=='VI')?"selected":"" ?>>Semester - VI</option>
                            <?php } ?>
                            <?php if($current_sem >=7 ) { ?>
                            <option value="VII" <?php echo ($presentsemester=='VII')?"selected":"" ?>>Semester - VII</option>
                            <?php } ?>
                            <?php if($current_sem >=8 ) { ?>
                            <option value="VIII" <?php echo ($presentsemester=='VIII')?"selected":"" ?>>Semester - VIII</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            </form>
            
            <nav class="mb-1">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="px-3 py-3 nav-item nav-link active" id="nav-table-tab" data-toggle="tab" href="#nav-table" role="tab" aria-controls="nav-table" aria-selected="true"><i class="fa-solid fa-table-cells"></i> Table View</a>
                    <a class="px-3 py-3 nav-item nav-link" id="nav-Semester-tab" data-toggle="tab" href="#nav-Semester" role="tab" aria-controls="nav-Semester" aria-selected="false"><i class="fa-regular fa-chart-bar"></i> Accordion View</a>
                </div>
            </nav>
            
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-table" role="tabpanel" aria-labelledby="nav-table-tab">
                	<div class="table-responsive">
                        <table class="table table-bordered text-nowrap" id="tablefilter">
                            <thead class="text-center bg-light">
                                <tr>
                                    <th>#</th>
                                    <th>Id</th>
                                    <th>Published Date</th>
                                    <th>Semester</th>
                                    <th>Department</th>
                                    <th>Material Title</th>
                                    <th>Material Type</th>
                                    <th>Paper Name</th>
                                    <th>Paper Type</th>
                                    <th>Teacher</th>
                                    <th>Link</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php 
                                if((isset($_POST["filter_sem"]) && $_POST["filter_sem"] == 'I') || ($presentsemester=='I' && !isset($_POST["filter_sem"]))){
                                if(count($semester1)>0){
                                    $i=1;
                                    foreach ($semester1 as $sem1) {
                                ?>                                            
                                <tr>
                                    <td class="align-middle text-center"><?php echo $i ?></td>
                                    <td class="align-middle text-center"><?php echo $sem1['content_id']; ?></td>
                                    <td class="align-middle text-center"><?php echo date('d F Y',strtotime($sem1['publish_date'])); ?></td>
                                    <td class="align-middle text-center"><?php echo  isset($sem1['semester_id'])?$sem1['semester_id']:''; ?></td>
                                    <td class="align-middle text-left"><?php echo $sem1['department_name']; ?></td>
                                    <td class="align-middle text-left"><?php echo $sem1['title']; ?></td>
                                    <td class="align-middle text-center"><?php echo $sem1['material_name']; ?></td>
                                    <td class="align-middle text-center"><?php echo $sem1['SubjectName_SDMS']; ?></td>
                                    <td class="align-middle text-center">
                                        <?php echo ($sem1['subpaper_type'] == 'CORE (3 YEAR)')?'CORE':$sem1['paper_type_name'];
                                        ?>
                                    </td>
                                    <td class="align-middle text-center"><?php echo $sem1['teacher_name']; ?></td>
                                    <?php if($sem1['content_type'] == 'video') { ?>
                                    <td class="align-middle text-center">
                                        <a class="btn btn-outline-danger" href="<?php echo $sem1['video_link']; ?>" data-toggle="tooltip" data-placement="top" title="Video" target="_blank">
                                            <i class="fa-solid fa-video"></i>
                                        </a>
                                    </td>   
                                    <?php } else { ?>
                                    <td class="align-middle text-center">
                                        <a download class="btn btn-outline-danger" href="<?php echo BASE_URL_HOME.'/CCF_Administrator/CCF_adminuser/LMS/'.$sem1['document_path']; ?>" data-toggle="tooltip" data-placement="top" title="Download Document" target="_blank">
                                            <i class="fa-solid fa-file-arrow-down"></i>
                                        </a>
                                    </td>   
                                    <?php } ?>
                                </tr>
                                <?php $i++; } }else{ ?>
                                <tr>
                                    <td class="align-middle text-center" colspan="11">No Record Found</td>
                                </tr>
                                <?php } } ?> 
                               
                               <?php 
                                if((isset($_POST["filter_sem"]) && $_POST["filter_sem"] == 'II') || ($presentsemester=='II' && !isset($_POST["filter_sem"]))){
                                if(count($semester2)>0){
                                    $i=1;
                                    foreach ($semester2 as $sem2) {
                                ?>                                            
                                <tr>
                                    <td class="align-middle text-center"><?php echo $i ?></td>
                                    <td class="align-middle text-center"><?php echo $sem2['content_id']; ?></td>
                                    <td class="align-middle text-center"><?php echo date('d F Y',strtotime($sem2['publish_date'])); ?></td>
                                    <td class="align-middle text-center"><?php echo  isset($sem2['semester_id'])?$sem2['semester_id']:''; ?></td>
                                    <td class="align-middle text-left"><?php echo $sem2['department_name']; ?></td>
                                    <td class="align-middle text-left"><?php echo $sem2['title']; ?></td>
                                    <td class="align-middle text-center"><?php echo $sem2['material_name']; ?></td>
                                    <td class="align-middle text-center"><?php echo $sem2['SubjectName_SDMS']; ?></td>
                                    <td class="align-middle text-center">
                                        <?php echo ($sem2['subpaper_type'] == 'CORE (3 YEAR)')?'CORE':$sem2['paper_type_name'];
                                        ?>
                                    </td>
                                    <td class="align-middle text-center"><?php echo $sem2['teacher_name']; ?></td>
                                    <?php if($sem2['content_type'] == 'video') { ?>
                                    <td class="align-middle text-center">
                                        <a class="btn btn-outline-danger" href="<?php echo $sem2['video_link']; ?>" data-toggle="tooltip" data-placement="top" title="Video" target="_blank">
                                            <i class="fa-solid fa-video"></i>
                                        </a>
                                    </td>   
                                    <?php } else { ?>
                                    <td class="align-middle text-center">
                                        <a download class="btn btn-outline-danger" href="<?php echo BASE_URL_HOME.'/CCF_Administrator/CCF_adminuser/LMS/'.$sem2['document_path']; ?>" data-toggle="tooltip" data-placement="top" title="Download Document" target="_blank">
                                            <i class="fa-solid fa-file-arrow-down"></i>
                                        </a>
                                    </td>   
                                    <?php } ?>
                                </tr>
                                <?php $i++; } } else{ ?>
                                <tr>
                                    <td class="align-middle text-center" colspan="11">No Record Found</td>
                                </tr>
                                <?php } } ?>
                                
                               <?php 
                                if((isset($_POST["filter_sem"]) && $_POST["filter_sem"] == 'III') || ($presentsemester=='III' && !isset($_POST["filter_sem"]))){
                                    if(count($semester3)>0){
                                    $i=1;
                                    foreach ($semester3 as $sem3) {
                                ?>                                            
                                <tr>
                                    <td class="align-middle text-center"><?php echo $i ?></td>
                                    <td class="align-middle text-center"><?php echo $sem3['content_id']; ?></td>
                                    <td class="align-middle text-center"><?php echo date('d F Y',strtotime($sem3['publish_date'])); ?></td>
                                    <td class="align-middle text-center"><?php echo  isset($sem3['semester_id'])?$sem3['semester_id']:''; ?></td>
                                    <td class="align-middle text-left"><?php echo $sem3['department_name']; ?></td>
                                    <td class="align-middle text-left"><?php echo $sem3['title']; ?></td>
                                    <td class="align-middle text-center"><?php echo $sem3['material_name']; ?></td>
                                    <td class="align-middle text-center"><?php echo $sem3['SubjectName_SDMS']; ?></td>
                                    <td class="align-middle text-center">
                                        <?php echo ($sem3['subpaper_type'] == 'CORE (3 YEAR)')?'CORE':$sem3['paper_type_name'];
                                        ?>
                                    </td>
                                    <td class="align-middle text-center"><?php echo $sem3['teacher_name']; ?></td>
                                    <?php if($sem3['content_type'] == 'video') { ?>
                                    <td class="align-middle text-center">
                                        <a class="btn btn-outline-danger" href="<?php echo $sem3['video_link']; ?>" data-toggle="tooltip" data-placement="top" title="Video" target="_blank">
                                            <i class="fa-solid fa-video"></i>
                                        </a>
                                    </td>   
                                    <?php } else { ?>
                                    <td class="align-middle text-center">
                                        <a download class="btn btn-outline-danger" href="<?php echo BASE_URL_HOME.'/CCF_Administrator/CCF_adminuser/LMS/'.$sem3['document_path']; ?>" data-toggle="tooltip" data-placement="top" title="Download Document" target="_blank">
                                            <i class="fa-solid fa-file-arrow-down"></i>
                                        </a>
                                    </td>   
                                    <?php } ?>
                                </tr>
                                <?php $i++; } } else{ ?>
                                <tr>
                                    <td class="align-middle text-center" colspan="11">No Record Found</td>
                                </tr>
                                <?php } } ?>
                                <?php 
                                if(isset($_POST["filter_sem"]) && $_POST["filter_sem"] == 'IV'){
                                    if(count($semester4)>0){
                                    $i=1;
                                    foreach ($semester4 as $sem4) {
                                ?>                                            
                                <tr>
                                    <td class="align-middle text-center"><?php echo $i ?></td>
                                    <td class="align-middle text-center"><?php echo $sem4['content_id']; ?></td>
                                    <td class="align-middle text-center"><?php echo date('d F Y',strtotime($sem4['publish_date'])); ?></td>
                                    <td class="align-middle text-center"><?php echo  isset($sem4['semester_id'])?$sem4['semester_id']:''; ?></td>
                                    <td class="align-middle text-left"><?php echo $sem4['department_name']; ?></td>
                                    <td class="align-middle text-left"><?php echo $sem4['title']; ?></td>
                                    <td class="align-middle text-center"><?php echo $sem4['material_name']; ?></td>
                                    <td class="align-middle text-center"><?php echo $sem4['SubjectName_SDMS']; ?></td>
                                    <td class="align-middle text-center">
                                        <?php echo ($sem4['subpaper_type'] == 'CORE (3 YEAR)')?'CORE':$sem4['paper_type_name'];
                                        ?>
                                    </td>
                                    <td class="align-middle text-center"><?php echo $sem4['teacher_name']; ?></td>
                                    <?php if($sem4['content_type'] == 'video') { ?>
                                    <td class="align-middle text-center">
                                        <a class="btn btn-outline-danger" href="<?php echo $sem4['video_link']; ?>" data-toggle="tooltip" data-placement="top" title="Video" target="_blank">
                                            <i class="fa-solid fa-video"></i>
                                        </a>
                                    </td>   
                                    <?php } else { ?>
                                    <td class="align-middle text-center">
                                        <a download class="btn btn-outline-danger" href="<?php echo BASE_URL_HOME.'/CCF_Administrator/CCF_adminuser/LMS/'.$sem4['document_path']; ?>" data-toggle="tooltip" data-placement="top" title="Download Document" target="_blank">
                                            <i class="fa-solid fa-file-arrow-down"></i>
                                        </a>
                                    </td>   
                                    <?php } ?>
                                </tr>
                                <?php $i++; } } else{ ?>
                                <tr>
                                    <td class="align-middle text-center" colspan="11">No Record Found</td>
                                </tr>
                                <?php } } ?>

                                <?php 
                                if(isset($_POST["filter_sem"]) && $_POST["filter_sem"] == 'V'){
                                    if(count($semester5)>0){
                                    $i=1;
                                    foreach ($semester5 as $sem5) {
                                ?>                                            
                                <tr>
                                    <td class="align-middle text-center"><?php echo $i ?></td>
                                    <td class="align-middle text-center"><?php echo $sem5['content_id']; ?></td>
                                    <td class="align-middle text-center"><?php echo date('d F Y',strtotime($sem5['publish_date'])); ?></td>
                                    <td class="align-middle text-center"><?php echo  isset($sem5['semester_id'])?$sem5['semester_id']:''; ?></td>
                                    <td class="align-middle text-left"><?php echo $sem5['department_name']; ?></td>
                                    <td class="align-middle text-left"><?php echo $sem5['title']; ?></td>
                                    <td class="align-middle text-center"><?php echo $sem5['material_name']; ?></td>
                                    <td class="align-middle text-center"><?php echo $sem5['SubjectName_SDMS']; ?></td>
                                    <td class="align-middle text-center">
                                        <?php echo ($sem5['subpaper_type'] == 'CORE (3 YEAR)')?'CORE':$sem5['paper_type_name'];
                                        ?>
                                    </td>
                                    <td class="align-middle text-center"><?php echo $sem5['teacher_name']; ?></td>
                                    <?php if($sem5['content_type'] == 'video') { ?>
                                    <td class="align-middle text-center">
                                        <a class="btn btn-outline-danger" href="<?php echo $sem5['video_link']; ?>" data-toggle="tooltip" data-placement="top" title="Video" target="_blank">
                                            <i class="fa-solid fa-video"></i>
                                        </a>
                                    </td>   
                                    <?php } else { ?>
                                    <td class="align-middle text-center">
                                        <a download class="btn btn-outline-danger" href="<?php echo BASE_URL_HOME.'/CCF_Administrator/CCF_adminuser/LMS/'.$sem5['document_path']; ?>" data-toggle="tooltip" data-placement="top" title="Download Document" target="_blank">
                                            <i class="fa-solid fa-file-arrow-down"></i>
                                        </a>
                                    </td>   
                                    <?php } ?>
                                </tr>
                                <?php $i++; } } else{ ?>
                                <tr>
                                    <td class="align-middle text-center" colspan="11">No Record Found</td>
                                </tr>
                                <?php } } ?>

                                <?php 
                                if(isset($_POST["filter_sem"]) && $_POST["filter_sem"] == 'VI'){
                                    if(count($semester6)>0){
                                    $i=1;
                                    foreach ($semester6 as $sem6) {
                                ?>                                            
                                <tr>
                                    <td class="align-middle text-center"><?php echo $i ?></td>
                                    <td class="align-middle text-center"><?php echo $sem6['content_id']; ?></td>
                                    <td class="align-middle text-center"><?php echo date('d F Y',strtotime($sem6['publish_date'])); ?></td>
                                    <td class="align-middle text-center"><?php echo  isset($sem6['semester_id'])?$sem6['semester_id']:''; ?></td>
                                    <td class="align-middle text-left"><?php echo $sem6['department_name']; ?></td>
                                    <td class="align-middle text-left"><?php echo $sem6['title']; ?></td>
                                    <td class="align-middle text-center"><?php echo $sem6['material_name']; ?></td>
                                    <td class="align-middle text-center"><?php echo $sem6['SubjectName_SDMS']; ?></td>
                                    <td class="align-middle text-center">
                                        <?php echo ($sem6['subpaper_type'] == 'CORE (3 YEAR)')?'CORE':$sem6['paper_type_name'];
                                        ?>
                                    </td>
                                    <td class="align-middle text-center"><?php echo $sem6['teacher_name']; ?></td>
                                    <?php if($sem6['content_type'] == 'video') { ?>
                                    <td class="align-middle text-center">
                                        <a class="btn btn-outline-danger" href="<?php echo $sem6['video_link']; ?>" data-toggle="tooltip" data-placement="top" title="Video" target="_blank">
                                            <i class="fa-solid fa-video"></i>
                                        </a>
                                    </td>   
                                    <?php } else { ?>
                                    <td class="align-middle text-center">
                                        <a download class="btn btn-outline-danger" href="<?php echo BASE_URL_HOME.'/CCF_Administrator/CCF_adminuser/LMS/'.$sem6['document_path']; ?>" data-toggle="tooltip" data-placement="top" title="Download Document" target="_blank">
                                            <i class="fa-solid fa-file-arrow-down"></i>
                                        </a>
                                    </td>   
                                    <?php } ?>
                                </tr>
                                <?php $i++; } } else{ ?>
                                <tr>
                                    <td class="align-middle text-center" colspan="11">No Record Found</td>
                                </tr>
                                <?php } } ?>

                                <?php 
                                if(isset($_POST["filter_sem"]) && $_POST["filter_sem"] == 'VII'){
                                    if(count($semester7)>0){
                                    $i=1;
                                    foreach ($semester7 as $sem7) {
                                ?>                                            
                                <tr>
                                    <td class="align-middle text-center"><?php echo $i ?></td>
                                    <td class="align-middle text-center"><?php echo $sem7['content_id']; ?></td>
                                    <td class="align-middle text-center"><?php echo date('d F Y',strtotime($sem7['publish_date'])); ?></td>
                                    <td class="align-middle text-center"><?php echo  isset($sem7['semester_id'])?$sem7['semester_id']:''; ?></td>
                                    <td class="align-middle text-left"><?php echo $sem7['department_name']; ?></td>
                                    <td class="align-middle text-left"><?php echo $sem7['title']; ?></td>
                                    <td class="align-middle text-center"><?php echo $sem7['material_name']; ?></td>
                                    <td class="align-middle text-center"><?php echo $sem7['SubjectName_SDMS']; ?></td>
                                    <td class="align-middle text-center">
                                        <?php echo ($sem7['subpaper_type'] == 'CORE (3 YEAR)')?'CORE':$sem7['paper_type_name'];
                                        ?>
                                    </td>
                                    <td class="align-middle text-center"><?php echo $sem7['teacher_name']; ?></td>
                                    <?php if($sem7['content_type'] == 'video') { ?>
                                    <td class="align-middle text-center">
                                        <a class="btn btn-outline-danger" href="<?php echo $sem7['video_link']; ?>" data-toggle="tooltip" data-placement="top" title="Video" target="_blank">
                                            <i class="fa-solid fa-video"></i>
                                        </a>
                                    </td>   
                                    <?php } else { ?>
                                    <td class="align-middle text-center">
                                        <a download class="btn btn-outline-danger" href="<?php echo BASE_URL_HOME.'/CCF_Administrator/CCF_adminuser/LMS/'.$sem7['document_path']; ?>" data-toggle="tooltip" data-placement="top" title="Download Document" target="_blank">
                                            <i class="fa-solid fa-file-arrow-down"></i>
                                        </a>
                                    </td>   
                                    <?php } ?>
                                </tr>
                                <?php $i++; } } else{ ?>
                                <tr>
                                    <td class="align-middle text-center" colspan="11">No Record Found</td>
                                </tr>
                                <?php } } ?>

                                <?php 
                                if(isset($_POST["filter_sem"]) && $_POST["filter_sem"] == 'VIII' ){
                                    if(count($semester8)>0){
                                    $i=1;
                                    foreach ($semester8 as $sem8) {
                                ?>                                            
                                <tr>
                                    <td class="align-middle text-center"><?php echo $i ?></td>
                                    <td class="align-middle text-center"><?php echo $sem8['content_id']; ?></td>
                                    <td class="align-middle text-center"><?php echo date('d F Y',strtotime($sem8['publish_date'])); ?></td>
                                    <td class="align-middle text-center"><?php echo  isset($sem8['semester_id'])?$sem8['semester_id']:''; ?></td>
                                    <td class="align-middle text-left"><?php echo $sem8['department_name']; ?></td>
                                    <td class="align-middle text-left"><?php echo $sem8['title']; ?></td>
                                    <td class="align-middle text-center"><?php echo $sem8['material_name']; ?></td>
                                    <td class="align-middle text-center"><?php echo $sem8['SubjectName_SDMS']; ?></td>
                                    <td class="align-middle text-center">
                                        <?php echo ($sem8['subpaper_type'] == 'CORE (3 YEAR)')?'CORE':$sem8['paper_type_name'];
                                        ?>
                                    </td>
                                    <td class="align-middle text-center"><?php echo $sem8['teacher_name']; ?></td>
                                    <?php if($sem8['content_type'] == 'video') { ?>
                                    <td class="align-middle text-center">
                                        <a class="btn btn-outline-danger" href="<?php echo $sem8['video_link']; ?>" data-toggle="tooltip" data-placement="top" title="Video" target="_blank">
                                            <i class="fa-solid fa-video"></i>
                                        </a>
                                    </td>   
                                    <?php } else { ?>
                                    <td class="align-middle text-center">
                                        <a download class="btn btn-outline-danger" href="<?php echo BASE_URL_HOME.'/CCF_Administrator/CCF_adminuser/LMS/'.$sem8['document_path']; ?>" data-toggle="tooltip" data-placement="top" title="Download Document" target="_blank">
                                            <i class="fa-solid fa-file-arrow-down"></i>
                                        </a>
                                    </td>   
                                    <?php } ?>
                                </tr>
                                <?php $i++; } } else{ ?>
                                <tr>
                                    <td class="align-middle text-center" colspan="11">No Record Found</td>
                                </tr>
                                <?php } } ?>
                               
                           </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="nav-Semester" role="tabpanel" aria-labelledby="nav-Semester-tab">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="accordion" id="SemesterAccordion">
                                
                            <?php if($current_sem >=1 ) { ?>
                                <div class="card mb-1 border-0" >
                                    <button type="button" class="btn btn-info pt-3 pb-3 text-left" data-toggle="collapse" data-target="#Sem1" aria-expanded="true" aria-controls="Sem1">
                                        <h4 class="m-0" style="font-family:Oswald">
                                            <i class="fa-solid fa-graduation-cap"></i> Semester I
                                            <?php if($presentsemester=='I'){ ?>
                                            <span class=pull-right><i class="fa-solid fa-user-graduate fa-beat-fade" data-toggle="tooltip" data-placement="top" title="Present Semester"></i></span>
                                            <?php } ?>
                                        </h4>
                                    </button>
                                    <div id="Sem1" class="collapse <?php echo ($presentsemester=='I')?' show':''; ?>" aria-labelledby="Sem1Heading" data-parent="#SemesterAccordion">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered text-nowrap">
                                                    <thead class="text-center bg-light">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Id</th>
                                                            <th>Published Date</th>
                                                            <th>Material Title</th>
                                                            <th>Material Type</th>
                                                            <th>Paper Name</th>
                                                            <th>Paper Type</th>
                                                            <th>Teacher</th>
                                                            <th>Link</th>
                                                        </tr>
                                                    </thead>
                                                    
                                                    <tbody>
                                                        <?php if(count($semester1)>0){
                                                            $i=1;
                                                            foreach ($semester1 as $sem1) {
                                                        ?>                                            
                                                        <tr>
                                                            <td class="align-middle text-center"><?php echo $i ?></td>
                                                            <td class="align-middle text-center"><?php echo $sem1['content_id']; ?></td>
                                                            <td class="align-middle text-center"><?php echo date('d F Y',strtotime($sem1['publish_date'])); ?></td>
                                                            <td class="align-middle text-left"><?php echo $sem1['title']; ?></td>
                                                            <td class="align-middle text-center"><?php echo $sem1['material_name']; ?></td>
                                                            <td class="align-middle text-center"><?php echo $sem1['SubjectName_SDMS']; ?></td>
                                                            <td class="align-middle text-center">
                                                                <?php echo ($sem1['subpaper_type'] == 'CORE (3 YEAR)')?'CORE':$sem1['paper_type_name'];
                                                                ?>
                                                            </td>
                                                            <td class="align-middle text-center"><?php echo $sem1['teacher_name']; ?></td>
                                                            <?php if($sem1['content_type'] == 'video') { ?>
                                                            <td class="align-middle text-center">
                                                                <a class="btn btn-outline-danger" href="<?php echo $sem1['video_link']; ?>" data-toggle="tooltip" data-placement="top" title="Video" target="_blank">
                                                                    <i class="fa-solid fa-video"></i>
                                                                </a>
                                                            </td>   
                                                            <?php } else { ?>
                                                            <td class="align-middle text-center">
                                                                <a download class="btn btn-outline-danger" href="<?php echo BASE_URL_HOME.'/CCF_Administrator/CCF_adminuser/LMS/'.$sem1['document_path']; ?>" data-toggle="tooltip" data-placement="top" title="Download Document" target="_blank">
                                                                    <i class="fa-solid fa-file-arrow-down"></i>
                                                                </a>
                                                            </td>   
                                                            <?php } ?>
                                                        </tr>
                                                        <?php $i++; } } else{ ?>
                                                        <tr>
                                                            <td class="align-middle text-center" colspan="9">No Record Found</td>
                                                        </tr>
                                                       <?php } ?>
                                                   </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if($current_sem >=2 ) { ?>
                                <div class="card mb-1 border-0">
                                    <button type="button" class="btn btn-info pt-3 pb-3 text-left" data-toggle="collapse" data-target="#Sem2" aria-expanded="false" aria-controls="Sem2">
                                        <h4 class="m-0" style="font-family:Oswald">
                                            <i class="fa-solid fa-graduation-cap"></i> Semester II
                                            <?php if($presentsemester=='II'){ ?>
                                            <span class=pull-right><i class="fa-solid fa-user-graduate fa-beat-fade" data-toggle="tooltip" data-placement="top" title="Present Semester"></i></span>
                                            <?php } ?>
                                        </h4>
                                    </button>
                                    <div id="Sem2" class="collapse <?php echo ($presentsemester=='II')?' show':''; ?>" aria-labelledby="Sem2Heading" data-parent="#SemesterAccordion">
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
                                                    
                                                    <tbody >
                                                        <?php if(count($semester2)>0){
                                                            $i=1;
                                                            foreach ($semester2 as $sem2) {
                                                        ?>                                            
                                                        <tr>
                                                            <td class="align-middle text-center"><?php echo $i ?></td>
                                                            <td class="align-middle text-center"><?php echo date('d F Y',strtotime($sem2['publish_date'])); ?></td>
                                                            <td class="align-middle text-left"><?php echo $sem2['title']; ?></td>
                                                            <td class="align-middle text-center"><?php echo $sem2['material_name']; ?></td>
                                                            <td class="align-middle text-center"><?php echo $sem2['paper_type_name']; ?></td>
                                                            <?php if($sem2['content_type'] == 'video') { ?>
                                                            <td class="align-middle text-center">
                                                                <a class="btn btn-outline-danger" href="<?php echo $sem2['video_link']; ?>" data-toggle="tooltip" data-placement="top" title="Video" target="_blank">
                                                                    <i class="fa-solid fa-video"></i>
                                                                </a>
                                                            </td>   
                                                            <?php } else { ?>
                                                            <td class="align-middle text-center">
                                                                <a download class="btn btn-outline-danger" href="<?php echo BASE_URL_HOME.'/CCF_Administrator/CCF_adminuser/LMS/'.$sem2['document_path']; ?>" data-toggle="tooltip" data-placement="top" title="Download Document" target="_blank">
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
                                <?php } ?>
                                <?php if($current_sem >=3 ) { ?>
                                <div class="card mb-1 border-0">
                                    <button type="button" class="btn btn-info pt-3 pb-3 text-left" data-toggle="collapse" data-target="#Sem3" aria-expanded="false" aria-controls="Sem3">
                                        <h4 class="m-0" style="font-family:Oswald">
                                            <i class="fa-solid fa-graduation-cap"></i> Semester III 
                                            <?php if($presentsemester=='III'){ ?>
                                            <span class=pull-right><i class="fa-solid fa-user-graduate fa-beat-fade" data-toggle="tooltip" data-placement="top" title="Present Semester"></i></span>
                                            <?php } ?>
                                        </h4>
                                    </button>
                                    <div id="Sem3" class="collapse <?php echo ($presentsemester=='III')?' show':''; ?>" aria-labelledby="Sem3Heading" data-parent="#SemesterAccordion">
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
                                                    
                                                    <tbody >
                                                        <?php if(count($semester3)>0){
                                                            $i=1;
                                                            foreach ($semester3 as $sem3) {
                                                        ?>                                            
                                                        <tr>
                                                            <td class="align-middle text-center"><?php echo $i ?></td>
                                                            <td class="align-middle text-center"><?php echo date('d F Y',strtotime($sem3['publish_date'])); ?></td>
                                                            <td class="align-middle text-left"><?php echo $sem3['title']; ?></td>
                                                            <td class="align-middle text-center"><?php echo $sem3['material_name']; ?></td>
                                                            <td class="align-middle text-center"><?php echo $sem3['paper_type_name']; ?></td>
                                                            <?php if($sem3['content_type'] == 'video') { ?>
                                                            <td class="align-middle text-center">
                                                                <a class="btn btn-outline-danger" href="<?php echo $sem3['video_link']; ?>" data-toggle="tooltip" data-placement="top" title="Video" target="_blank">
                                                                    <i class="fa-solid fa-video"></i>
                                                                </a>
                                                            </td>   
                                                            <?php } else { ?>
                                                            <td class="align-middle text-center">
                                                                <a download class="btn btn-outline-danger" href="<?php echo BASE_URL_HOME.'/CCF_Administrator/CCF_adminuser/LMS/'.$sem3['document_path']; ?>" data-toggle="tooltip" data-placement="top" title="Download Document" target="_blank">
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
                                <?php } ?>
                                <?php if($current_sem >=4 ) { ?>
                                <div class="card mb-1 border-0">
                                    <button type="button" class="btn btn-info pt-3 pb-3 text-left" data-toggle="collapse" data-target="#Sem4" aria-expanded="false" aria-controls="Sem4">
                                        <h4 class="m-0" style="font-family:Oswald">
                                            <i class="fa-solid fa-graduation-cap"></i> Semester IV
                                            <?php if($presentsemester=='IV'){ ?>
                                            <span class=pull-right><i class="fa-solid fa-user-graduate fa-beat-fade" data-toggle="tooltip" data-placement="top" title="Present Semester"></i></span>
                                            <?php } ?>
                                        </h4>
                                    </button>
                                    <div id="Sem4" class="collapse <?php echo ($presentsemester=='IV')?' show':''; ?>" aria-labelledby="Sem4Heading" data-parent="#SemesterAccordion">
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
                                                    
                                                    <tbody >
                                                        <?php if(count($semester4)>0){
                                                            $i=1;
                                                            foreach ($semester4 as $sem4) {
                                                        ?>                                            
                                                        <tr>
                                                            <td class="align-middle text-center"><?php echo $i ?></td>
                                                            <td class="align-middle text-center"><?php echo date('d F Y',strtotime($sem4['publish_date'])); ?></td>
                                                            <td class="align-middle text-left"><?php echo $sem4['title']; ?></td>
                                                            <td class="align-middle text-center"><?php echo $sem4['material_name']; ?></td>
                                                            <td class="align-middle text-center"><?php echo $sem4['paper_type_name']; ?></td>
                                                            <?php if($sem4['content_type'] == 'video') { ?>
                                                            <td class="align-middle text-center">
                                                                <a class="btn btn-outline-danger" href="<?php echo $sem4['video_link']; ?>" data-toggle="tooltip" data-placement="top" title="Video" target="_blank">
                                                                    <i class="fa-solid fa-video"></i>
                                                                </a>
                                                            </td>   
                                                            <?php } else { ?>
                                                            <td class="align-middle text-center">
                                                                <a download class="btn btn-outline-danger" href="<?php echo BASE_URL_HOME.'/CCF_Administrator/CCF_adminuser/LMS/'.$sem4['document_path']; ?>" data-toggle="tooltip" data-placement="top" title="Download Document" target="_blank">
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
                                <?php } ?>
                                <?php if($current_sem >=5 ) { ?>
                                <div class="card mb-1 border-0">
                                    <button type="button" class="btn btn-info pt-3 pb-3 text-left" data-toggle="collapse" data-target="#Sem5" aria-expanded="false" aria-controls="Sem5">
                                        <h4 class="m-0" style="font-family:Oswald">
                                            <i class="fa-solid fa-graduation-cap"></i> Semester V
                                            <?php if($presentsemester=='V'){ ?>
                                            <span class=pull-right><i class="fa-solid fa-user-graduate fa-beat-fade" data-toggle="tooltip" data-placement="top" title="Present Semester"></i></span>
                                            <?php } ?>
                                        </h4>
                                    </button>
                                    <div id="Sem5" class="collapse <?php echo ($presentsemester=='V')?' show':''; ?>" aria-labelledby="Sem5Heading" data-parent="#SemesterAccordion">
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
                                                    
                                                    <tbody >
                                                        <?php if(count($semester5)>0){
                                                            $i=1;
                                                            foreach ($semester5 as $sem5) {
                                                        ?>                                            
                                                        <tr>
                                                            <td class="align-middle text-center"><?php echo $i ?></td>
                                                            <td class="align-middle text-center"><?php echo date('d F Y',strtotime($sem5['publish_date'])); ?></td>
                                                            <td class="align-middle text-left"><?php echo $sem5['title']; ?></td>
                                                            <td class="align-middle text-center"><?php echo $sem5['material_name']; ?></td>
                                                            <td class="align-middle text-center"><?php echo $sem5['paper_type_name']; ?></td>
                                                            <?php if($sem5['content_type'] == 'video') { ?>
                                                            <td class="align-middle text-center">
                                                                <a class="btn btn-outline-danger" href="<?php echo $sem5['video_link']; ?>" data-toggle="tooltip" data-placement="top" title="Video" target="_blank">
                                                                    <i class="fa-solid fa-video"></i>
                                                                </a>
                                                            </td>   
                                                            <?php } else { ?>
                                                            <td class="align-middle text-center">
                                                                <a download class="btn btn-outline-danger" href="<?php echo BASE_URL_HOME.'/CCF_Administrator/CCF_adminuser/LMS/'.$sem5['document_path']; ?>" data-toggle="tooltip" data-placement="top" title="Download Document" target="_blank">
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
                                <?php } ?>
                                <?php if($current_sem >=6 ) { ?>
                                <div class="card mb-1 border-0">
                                    <button type="button" class="btn btn-info pt-3 pb-3 text-left" data-toggle="collapse" data-target="#Sem6" aria-expanded="false" aria-controls="Sem6">
                                        <h4 class="m-0" style="font-family:Oswald">
                                            <i class="fa-solid fa-graduation-cap"></i> Semester VI
                                            <?php if($presentsemester=='VI'){ ?>
                                            <span class=pull-right><i class="fa-solid fa-user-graduate fa-beat-fade" data-toggle="tooltip" data-placement="top" title="Present Semester"></i></span>
                                            <?php } ?>
                                        </h4>
                                    </button>
                                    <div id="Sem6" class="collapse <?php echo ($presentsemester=='VI')?' show':''; ?>" aria-labelledby="Sem6Heading" data-parent="#SemesterAccordion">
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
                                                    
                                                    <tbody >
                                                        <?php if(count($semester6)>0){
                                                            $i=1;
                                                            foreach ($semester6 as $sem6) {
                                                        ?>                                            
                                                        <tr>
                                                            <td class="align-middle text-center"><?php echo $i ?></td>
                                                            <td class="align-middle text-center"><?php echo date('d F Y',strtotime($sem6['publish_date'])); ?></td>
                                                            <td class="align-middle text-left"><?php echo $sem6['title']; ?></td>
                                                            <td class="align-middle text-center"><?php echo $sem6['material_name']; ?></td>
                                                            <td class="align-middle text-center"><?php echo $sem6['paper_type_name']; ?></td>
                                                            <?php if($sem6['content_type'] == 'video') { ?>
                                                            <td class="align-middle text-center">
                                                                <a class="btn btn-outline-danger" href="<?php echo $sem6['video_link']; ?>" data-toggle="tooltip" data-placement="top" title="Video" target="_blank">
                                                                    <i class="fa-solid fa-video"></i>
                                                                </a>
                                                            </td>   
                                                            <?php } else { ?>
                                                            <td class="align-middle text-center">
                                                                <a download class="btn btn-outline-danger" href="<?php echo BASE_URL_HOME.'/CCF_Administrator/CCF_adminuser/LMS/'.$sem6['document_path']; ?>" data-toggle="tooltip" data-placement="top" title="Download Document" target="_blank">
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
                                <?php } ?>
                                <?php if($current_sem >=7 ) { ?>
                                <div class="card mb-1 border-0">
                                    <button type="button" class="btn btn-info pt-3 pb-3 text-left" data-toggle="collapse" data-target="#Sem7" aria-expanded="false" aria-controls="Sem7">
                                        <h4 class="m-0" style="font-family:Oswald">
                                            <i class="fa-solid fa-graduation-cap"></i> Semester VII
                                            <?php if($presentsemester=='VII'){ ?>
                                            <span class=pull-right><i class="fa-solid fa-user-graduate fa-beat-fade" data-toggle="tooltip" data-placement="top" title="Present Semester"></i></span>
                                            <?php } ?>
                                        </h4>
                                    </button>
                                    <div id="Sem7" class="collapse <?php echo ($presentsemester=='VII')?' show':''; ?>" aria-labelledby="Sem7Heading" data-parent="#SemesterAccordion">
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
                                                    
                                                    <tbody >
                                                        <?php if(count($semester7)>0){
                                                            $i=1;
                                                            foreach ($semester7 as $sem7) {
                                                        ?>                                            
                                                        <tr>
                                                            <td class="align-middle text-center"><?php echo $i ?></td>
                                                            <td class="align-middle text-center"><?php echo date('d F Y',strtotime($sem7['publish_date'])); ?></td>
                                                            <td class="align-middle text-left"><?php echo $sem7['title']; ?></td>
                                                            <td class="align-middle text-center"><?php echo $sem7['material_name']; ?></td>
                                                            <td class="align-middle text-center"><?php echo $sem7['paper_type_name']; ?></td>
                                                            <?php if($sem7['content_type'] == 'video') { ?>
                                                            <td class="align-middle text-center">
                                                                <a class="btn btn-outline-danger" href="<?php echo $sem7['video_link']; ?>" data-toggle="tooltip" data-placement="top" title="Video" target="_blank">
                                                                    <i class="fa-solid fa-video"></i>
                                                                </a>
                                                            </td>   
                                                            <?php } else { ?>
                                                            <td class="align-middle text-center">
                                                                <a download class="btn btn-outline-danger" href="<?php echo BASE_URL_HOME.'/CCF_Administrator/CCF_adminuser/LMS/'.$sem7['document_path']; ?>" data-toggle="tooltip" data-placement="top" title="Download Document" target="_blank">
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
                                <?php } ?>
                                <?php if($current_sem >=8 ) { ?>
                                <div class="card mb-1 border-0">
                                    <button type="button" class="btn btn-info pt-3 pb-3 text-left" data-toggle="collapse" data-target="#Sem8" aria-expanded="false" aria-controls="Sem8">
                                        <h4 class="m-0" style="font-family:Oswald">
                                            <i class="fa-solid fa-graduation-cap"></i> Semester VIII
                                            <?php if($presentsemester=='VIII'){ ?>
                                            <span class=pull-right><i class="fa-solid fa-user-graduate fa-beat-fade" data-toggle="tooltip" data-placement="top" title="Present Semester"></i></span>
                                            <?php } ?>
                                        </h4>
                                    </button>
                                    <div id="Sem8" class="collapse <?php echo ($presentsemester=='VIII')?' show':''; ?>" aria-labelledby="Sem8Heading" data-parent="#SemesterAccordion">
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
                                                    
                                                    <tbody >
                                                        <?php if(count($semester8)>0){
                                                            $i=1;
                                                            foreach ($semester8 as $sem8) {
                                                        ?>                                            
                                                        <tr>
                                                            <td class="align-middle text-center"><?php echo $i ?></td>
                                                            <td class="align-middle text-center"><?php echo date('d F Y',strtotime($sem8['publish_date'])); ?></td>
                                                            <td class="align-middle text-left"><?php echo $sem8['title']; ?></td>
                                                            <td class="align-middle text-center"><?php echo $sem8['material_name']; ?></td>
                                                            <td class="align-middle text-center"><?php echo $sem8['paper_type_name']; ?></td>
                                                            <?php if($sem8['content_type'] == 'video') { ?>
                                                            <td class="align-middle text-center">
                                                                <a class="btn btn-outline-danger" href="<?php echo $sem8['video_link']; ?>" data-toggle="tooltip" data-placement="top" title="Video" target="_blank">
                                                                    <i class="fa-solid fa-video"></i>
                                                                </a>
                                                            </td>   
                                                            <?php } else { ?>
                                                            <td class="align-middle text-center">
                                                                <a download class="btn btn-outline-danger" href="<?php echo BASE_URL_HOME.'/CCF_Administrator/CCF_adminuser/LMS/'.$sem8['document_path']; ?>" data-toggle="tooltip" data-placement="top" title="Download Document" target="_blank">
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
                                <?php } ?>
                                
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
<script type="text/javascript">
  document.getElementById('filter_sem').value = "<?php echo $_POST['filter_sem'];?>";
  //Filter Table
  var tablefilter_Props = {
        col_0: "select",
        col_1: "select",
        col_2: "select",
        col_3: "select",
        col_4: "select",
        col_5: "select",
        col_6: "select",
        col_7: "select",
        col_8: "select",
        col_9: "select",
        col_10: "select",
        display_all_text: "Show all",
        sort_select: true
    };
    setFilterGrid("tablefilter", tablefilter_Props);
</script>