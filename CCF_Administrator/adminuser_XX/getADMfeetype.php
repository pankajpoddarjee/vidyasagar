<?php
include("../../connection.php");
  
$feetyperecord =array();

$section = $_POST["section"];
 

  $feetypeqry = "select distinct feedetail from College_FeeStructureMaster where sesssionYear='".$_POST["sessionyr"]."' and feeCode='ADMFEE'";

$feetyperesult = $dbConn->query($feetypeqry);

if($feetyperesult) {
	while ($feetyperow=$feetyperesult->fetch(PDO::FETCH_ASSOC)){

					$feetyperecord[] = $feetyperow;
			}
}

$feetyperesult = NULL;
if(isset($_POST["index0"])) {
	if($_POST["index0"]=='All')
$str = '<option value="All">All</option>';
}
else {	
$str = '<option value="">Select</option>';
}
if(count($feetyperecord)>0) {
	for($i=0; $i<count($feetyperecord); $i++) {
		$str .= '<option value="'.$feetyperecord[$i]["feedetail"].'">'.$feetyperecord[$i]["feedetail"].'</option>';
	}
}
$dbConn = NULL;
echo $str;
?>
