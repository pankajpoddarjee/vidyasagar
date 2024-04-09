<?php
 include("../../../connection_CCF.php");
 include("../../function.php");
 include("../../../configuration_CCF.php");
 include("lmsfunction.php");
 session_start();

 if(isset($_POST['action']) && $_POST['action'] == 'getAllSubject'){
   $subjectRecord = [];
   $subjectQry = $dbConn->prepare("select sm.*,dm.department_name FROM CU_Master_Subject_Code_Type as sm left join LMS_department_master as dm on sm.department_id = dm.department_id where sm.IsActive = 1 order by sm.SubjectName_SDMS ASC");
   $subjectQry->execute();
   $subjectRecord = $subjectQry->fetchAll(PDO::FETCH_ASSOC);
  
   if($subjectRecord){
      $arr["status"]=1;
      $arr["msg"]="data fetch successfully";	
      $arr["subjectRecord"]=$subjectRecord;
   }else{
      $arr["status"]=0;
      $arr["msg"]="No subject found";	
   }
   echo json_encode($arr);
 }
 if(isset($_POST['action']) && $_POST['action'] == 'updateDepartment'){

   // echo "<pre>";
   // print_r($_POST);
   $success = false;
   $department_id = isset($_POST['department_id_for_subject'])?$_POST['department_id_for_subject']:'';
   $subjects = $_POST['subject_id'];
   if(isset($subjects)) {
       foreach ($subjects as $subject) {
        $subject_id = $subject;

         $qryUpdate = $dbConn->prepare('UPDATE CU_Master_Subject_Code_Type SET department_id = :department_id WHERE subject_id = :subject_id');
        
            $qryUpdate->execute([
                'department_id' => $department_id,
                'subject_id' => $subject_id
            ]);
            if($qryUpdate){
               $success = true;
            }
       }

      if($success){
         $arr["status"]=1;
         $arr["msg"]="Successfully Updated";	
        // $arr["departmentRecord"]=$departmentRecord;
     }else{
         $arr["status"]=0;
         $arr["msg"]="Something Went Wrong";   
     }
   }
  
   echo json_encode($arr);
 }

 if(isset($_POST['action']) && $_POST['action'] == 'getSubjectForUploadStudyMaterial'){

   $department_id = $_POST['department_id'];
   $paper_type_id = $_POST['paper_type_id'];

   $paperQry = $dbConn->prepare("select paper_type_name FROM LMS_paper_type_master where paper_type_id = $paper_type_id");
   $paperQry->execute();
   $paperRecord = $paperQry->fetch(PDO::FETCH_ASSOC);
   if($paperRecord){
      $paper_type = $paperRecord['paper_type_name'];
   }
   

   $subjectRecord = [];
   $subjectQry = $dbConn->prepare("select sm.*,dm.department_name FROM CU_Master_Subject_Code_Type as sm left join LMS_department_master as dm on sm.department_id = dm.department_id where sm.IsActive = 1 and sm.department_id = $department_id and SubjectType = '".$paper_type."' order by sm.SubjectName_SDMS ASC");
   $subjectQry->execute();
   $subjectRecord = $subjectQry->fetchAll(PDO::FETCH_ASSOC);
  
   if($subjectRecord){
      $arr["status"]=1;
      $arr["msg"]="data fetch successfully";	
      $arr["subjectRecord"]=$subjectRecord;
   }else{
      $arr["status"]=0;
      $arr["msg"]="No subject found";	
   }
   echo json_encode($arr);
 }
 

 ?>