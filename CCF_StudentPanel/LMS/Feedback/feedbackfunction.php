<?php

include("../../../connection_CCF.php");

function getDepartmentAllData()
{
    //include("../../../connection_CCF.php");
    global $dbConn;
    //session_start();
    $departmentRecord = [];
    $departmentSql = "";
    $departmentSql .= "select * FROM LMS_department_master where is_active=1";
  
    $departmentQry = $dbConn->prepare($departmentSql);
    $departmentQry->execute();
    $departmentRecord = $departmentQry->fetchAll(PDO::FETCH_ASSOC);
    return $departmentRecord;
}
function getFeedbackQuestions($table='')
{
    //include("../../../connection_CCF.php");
    global $dbConn;
    //session_start();
    $questionsRecord = [];
    $questionsSql = "";
    $questionsSql .= "select * FROM ".$table." where is_active=1";
  
    $questionsQry = $dbConn->prepare($questionsSql);
    $questionsQry->execute();
    $questionsRecord = $questionsQry->fetchAll(PDO::FETCH_ASSOC);
    return $questionsRecord;
}

function getFeedbackSubjectCOP($type)
{
    //include("../../../connection_CCF.php");
    global $dbConn;
    //session_start();
    $subjectCOPRecord = [];
    $subjectCOPSql = "";
    $subjectCOPSql .= "select * FROM LMS_feedback_subject_cop where is_active=1 and type= '".$type."'";
  
    $subjectCOPQry = $dbConn->prepare($subjectCOPSql);
    $subjectCOPQry->execute();
    $subjectCOPRecord = $subjectCOPQry->fetchAll(PDO::FETCH_ASSOC);
    return $subjectCOPRecord;
}
?>