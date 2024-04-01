<?php
 include("../../../connection_CCF.php");
 include("../../function.php");
 include("../../../configuration_CCF.php");
 include("lmsfunction.php");


if(!empty($_POST['action']) && $_POST['action'] == 'listRecordsCourse') {
    if(!empty($_POST["search"]["value"])){
        $courseRecord = getCourseAllData($_POST["search"]["value"]);
    }else{
        $courseRecord = getCourseAllData();
    }
	
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
			"iTotalRecords"	=> 	count($courseRecord),
			"iTotalDisplayRecords"	=>  count($courseRecord),
			"data"	=> 	$records
		);
		
		echo json_encode($output);
    // $arr["status"]=1;
    // $arr["msg"]="data fetched successfully";	
    // $arr["courseRecord"]=$courseRecord;
}



//echo json_encode($arr);

?>