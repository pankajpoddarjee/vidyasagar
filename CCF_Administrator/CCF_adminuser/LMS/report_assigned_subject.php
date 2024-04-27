<?php 
include("config.php");
include("lmsfunction.php");
$departmentRecord = getAllDepartmentForReport();
$subjectRecord = getAllSubjectForReport();
$paperTypeRecord = getAllPaperTypeForReport();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="<?php echo VIEWPORT;?>">
<meta name="description" content="">
<title><?php echo COLLEGE_CODE; ?> | LMS | Report - Assigned Subject</title>
<?php include("../../head_includes.php");?>

</head>
<body >
    <?php include("headermenu_lms.php");?>
    
    <div id="content">
    	<?php include("../../header.php");?>
        <?php include("../headermenu_top.php");?>
        
        <div class="container-fluid mt-4">        
        	<div class="row p-0 m-0">
                <div class="col-md-8 border-bottom mb-3 text-left p-0">
                	<h5 class="sub_head">
                        <i class="fa-solid fa-file-lines"></i> Report <span class="text-danger">Assigned Subject</span>
                    </h5>
                </div>
                
                <div class="col-md-4 border-bottom hide_border_bottom_mobile mb-3 text-right p-0">
                	<!--<button class="btn btn-outline-danger btn-sm" id="open-add-department-modal"><i class="fa-solid fa-users"></i> Add Department</button>-->
                </div>
            </div>
            <form action="" method="post" id="filter-form">
                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Department <span class="text-danger">*</span></span>
                            </div>
                            <select id="department_id" name="department_id" class="custom-select">
                                <option value="" selected>Select</option>
                                <?php 
                                if($departmentRecord){
                                    foreach ($departmentRecord as $dept) { ?>
                                        <option value="<?php echo $dept['department_id']; ?>" ><?php echo $dept['department_name']; ?></option>
                                <?php    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Paper Type <span class="text-danger">*</span></span>
                            </div>
                            <select id="paper_type" name="paper_type" class="custom-select">
                                <option value="" selected>Select</option>
                                <?php 
                                if($paperTypeRecord){
                                    foreach ($paperTypeRecord as $paper) { ?>
                                        <option value="<?php echo $paper['SubjectType']; ?>" ><?php echo $paper['SubjectType']; ?></option>
                                <?php    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Subject <span class="text-danger">*</span></span>
                            </div>
                            <select id="subject" name="subject" class="custom-select">
                                <option value="" selected>Select</option>
                                <?php 
                                if($subjectRecord){
                                    foreach ($subjectRecord as $subject) { ?>
                                        <option value="<?php echo $subject['SubjectName_SDMS']; ?>" ><?php echo $subject['SubjectName_SDMS']; ?></option>
                                <?php    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Is Assigned? <span class="text-danger">*</span></span>
                            </div>
                            <select id="is_assigned" name="is_assigned" class="custom-select">
                                <option value="" selected>Select</option>
                                <option value="all">All</option>
                                <option value="assigned">Assigned</option>
                                <option value="not">Not Assigned</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-12 text-center mt-3 mb-3">
                        <a class="btn btn-danger btn-sm" id="reset" href="javascript:void(0)">
                            <i class="fa-regular fa-circle-xmark"></i> Reset
                        </a>
                        
                        <a class="btn btn-success btn-sm" href="javascript:void(0)" id="searchData" >
                            <i class="fa-regular fa-circle-check"></i> Submit
                        </a>
                    </div>
                    
                    <div class="col-md-12">
                        <hr>
                    </div>
                    
                    
                </div>
            </form>
            <div class="row">
                <div class="col-md-12 text-center">                    
                    <div class="table-responsive">
                    <table class="table table-bordered nowrap" id="subject-report-table">
                        <thead>
                        <tr style="background:#f8fafd; color:#758289">
                            <th>Srl.</th>
                            <th>Subject Name</th>
                            <th>Subject Code</th>
                            <th>Paper Type</th>
                            <th>Department</th>
                        </tr>
                        </thead>
                    </table>
                
                    </div>                    
					
                </div>
            </div>
        </div>
        <?php include("../../footer.php");?>
    </div>	
    <?php include("../../footer_includes.php");?>   
    
	<script> 
    
    $(document).ready(function() {
        //Initialize table
       
        var dataRecords = $('#subject-report-table').DataTable({
            //"lengthChange": false,
            "processing":true,
            "serverSide":true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',			
            "order":[],
            "ajax":{
                url:"list_ajax_action.php",
                type:"POST",
                data:{action:'listRecordsSubject'},
                dataType:"json"
            },
            "columnDefs":[
                {
                    "targets":[0],
                    "orderable":false,
                },
            ],
            "pageLength": 10,
            "paging": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
            
        });	

        $('body').on('click', '#searchData', function (event) {
        event.preventDefault();
        var department_id = $('#department_id').val();
        var paper_type = $('#paper_type').val();
        var subject = $('#subject').val();
        var is_assigned = $('#is_assigned').val();
       
        var data = {action:'listRecordsSubject',department_id:department_id,paper_type:paper_type,subject:subject,is_assigned:is_assigned};
        //dataRecords.destroy();
            $('#subject-report-table').DataTable().clear().destroy();
            var dataRecords = $('#subject-report-table').DataTable({
                //"lengthChange": false,
                "processing":true,
                "serverSide":true,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',			
                "order":[],
                "ajax":{
                    url:"list_ajax_action.php",
                    type:"POST",
                    data:data,
                    dataType:"json"
                },
                "columnDefs":[
                    {
                        "targets":[0],
                        "orderable":false,
                    },
                ],
                "pageLength": 10,
                "paging": true,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
                
            });
        });
        
        $('body').on('click', '#reset', function (event) {
        event.preventDefault();
            $('#filter-form')[0].reset();

            $("#searchData").trigger("click");
        });

    });
    
    </script>
</body>
</html>
