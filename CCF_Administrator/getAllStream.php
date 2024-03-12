<?php
include("../connection_CCF.php");
include("../configuration_CCF.php");
include("function.php");
 
$streamrecord =array();
 
//$section = $_POST["section"];
 //$streamqry = "select distinct stream from College_CourseMaster WHERE section='".$section."' and isnull(IsActive,0)=1 order by stream asc;";
 
 
 $streamqry = "select distinct stream from College_CourseMaster WHERE  isnull(IsActive,0)=1 order by stream asc;";

$streamresult = $dbConn->query($streamqry);

if($streamresult) {
	while ($streamrow=$streamresult->fetch(PDO::FETCH_ASSOC)){

					$streamrecord[] = $streamrow;
			}
}

$streamresult = NULL;
 
if(isset($_POST["index0"])) {
	if($_POST["index0"]=='All')
$str = '<option value="All">All</option>';
}
else {	
$str = '<option value="">Select</option>';
}
if(count($streamrecord)>0) {
	for($i=0; $i<count($streamrecord); $i++) {
		$str .= '<option value="'.$streamrecord[$i]["stream"].'">'.displayStreamName($streamrecord[$i]["stream"]).'</option>';
	}
}
$dbConn = NULL;
echo $str;
?>
