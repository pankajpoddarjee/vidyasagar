<?php
include("../../connection_CCF.php");
  
$semrecord =array();

$sessionyr = $_POST["sessionyr"];
 $feetype = $_POST["feetype"];

  $semqry = "select distinct semester from College_FeeStructureMaster where sesssionYear='".$sessionyr."' and feedetail='".$feetype."'";

$semresult = $dbConn->query($semqry);

if($semresult) {
	while ($semrow=$semresult->fetch(PDO::FETCH_ASSOC)){

					$semrecord[] = $semrow;
			}
}

$semresult = NULL;
if(isset($_POST["index0"])) {
	if($_POST["index0"]=='All')
$str = '<option value="All">All</option>';
}
else {	
$str = '<option value="">Select</option>';
}
if(count($semrecord)>0) {
	for($i=0; $i<count($semrecord); $i++) {
		$str .= '<option value="'.$semrecord[$i]["semester"].'">'.$semrecord[$i]["semester"].'</option>';
	}
}
$dbConn = NULL;
echo $str;
?>
