<?php
 
function _generateRandom($length=8)
{
	$_rand_src = array(
		array(48,57) //digits
		, array(65,90) //uppercase chars
	);
	srand ((double) microtime() * 1000000);
	$random_string = "";
	for($i=0;$i<$length;$i++){
		$i1=rand(0,sizeof($_rand_src)-1);
		$random_string .= chr(rand($_rand_src[$i1][0],$_rand_src[$i1][1]));
	}
	return $random_string;
}

for($i=0; $i<=200 ; $i++){
	echo _generateRandom()."<br>";
	
}


 ?>