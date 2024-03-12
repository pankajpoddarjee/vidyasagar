<?php
 
/*$dbname = 'Scottish_Fee_Collection_2018';
$server = 'office-3';
$username = 'sa';
$password = 'Amitkh150377';*/


$dbname = 'VEC_UG_Fee_Collection';
$server = '119.81.103.78';
$username = 'sa';
$password = 'Amitkh150377';
 
 $type= MSSQL_ASSOC;
 
 	$sqlconnect=mssql_connect($server,$username,$password);
	
	
	if (!$sqlconnect) {
		echo'Could not connect';
		 trigger_error('Could not connect', E_USER_WARNING);
		die('Could not connect: ' . mssql_error());
	}


 ?>