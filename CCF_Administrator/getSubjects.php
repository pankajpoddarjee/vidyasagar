<?php
include("../connection_CCF.php");
include("../configuration_CCF.php");
include("function.php");
 
$streamrecord =array();

$section = $_POST["section"];
$stream = $_POST["stream"];

  $subjqry = "select subjectcode,subjectName from College_CourseMaster WHERE stream='".$stream."' and isnull(IsActive,0)=1 order by subjectName asc;";

$subjresult = $dbConn->query($subjqry);

if($subjresult) {
	while ($subjrow=$subjresult->fetch(PDO::FETCH_ASSOC)){

					$subjectrecord[] = $subjrow;
			}
}
$subjresult = NULL;
if(isset($_POST["index0"])) {
	if($_POST["index0"]=='All')
$str = '<option value="All">All</option>';
}
else {	
$str = '<option value="">Select</option>';
}
if(count($subjectrecord)>0) {
	for($i=0; $i<count($subjectrecord); $i++) {
		$str .= '<option value="'.$subjectrecord[$i]["subjectcode"].'">'.$subjectrecord[$i]["subjectName"].'</option>';
	}
}
$dbConn = NULL;
echo $str;
?>
