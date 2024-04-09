<?php
include("../../../connection_CCF.php");
    // echo $_POST['dob'];
    // echo (isset($_POST['dob'] ) && $_POST['dob'] =='')?$_POST['dob']:"jjjj";
    // echo isset($_POST['doj'])?$_POST['doj']:"hhhhhhhh"; die;

    if (empty(str_replace(array("0", "-", ":", " "), "", $_POST['dob'])))
    {
        $dob = NULL;
    }
    else
    {
       $dob = $_POST['dob']; 
    }
    if (empty(str_replace(array("0", "-", ":", " "), "", $_POST['doj'])))
    {
        $doj = NULL;
    }
    else
    {
       $doj = $_POST['doj']; 
    }
    if (empty(str_replace(array("0", "-", ":", " "), "", $_POST['doa'])))
    {
        $doa = NULL;
    }
    else
    {
       $doa = $_POST['doa']; 
    }
    $qryUpdate = $dbConn->prepare('UPDATE LMS_teacher_master SET teacher_name = :teacher_name,email = :email,mobile = :mobile,address = :address,gender = :gender,dob = :dob,doj = :doj,is_married = :is_married,doa = :doa WHERE teacher_id = :teacher_id');
    //echo $qryUpdate; die;
    $qryUpdate->execute([
        'teacher_id' => $_POST['teacher_id'],
        'teacher_name' => $_POST['teacher_name'],
        'email' => $_POST['email'],
        'mobile' => $_POST['mobile'],
        'address' => $_POST['address'],
        'gender' => isset($_POST['gender'])?$_POST['gender']:NULL,
        'dob' => $dob,
        'doj' =>$doj,
        'is_married' => isset($_POST['is_married'])?$_POST['is_married']:NULL,
        'doa' => $doa,
    ]);
    //var_dump( $qryUpdate->queryString, $qryUpdate->_debugQuery() );
    if($qryUpdate){
        $arr["status"]=1;
        $arr["msg"]="Successfully Updated";	
        //$arr["teacherRecord"]=$teacherRecord;
    }else{
        $arr["status"]=0;
        $arr["msg"]="Something Went Wrong";   
    }

    echo json_encode($arr);


?>