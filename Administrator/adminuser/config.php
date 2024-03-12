<?php
 ob_start();
session_start();
if (!$_SESSION["loggedin"] ) {
header("location: ../login.php");
exit();
}
include("../../connection.php");
 include('../../configuration.php');  


$adminusername = $_SESSION['user'];
$adminuserid= $_SESSION["userid"];

$usertype = $_SESSION['usertype'];
  
  
 //echo $sqldb;

$qry = "SELECT permission  FROM role where ".$usertype."=1 ;";

//die($qry);
$record = array();
$phase = array();
$resultset = $dbConn->query($qry);
			while($row=$resultset->fetch(PDO::FETCH_ASSOC))
			{
				$record[]=$row["permission"];
			}
			
			$resultset = NULL;
			
 
 
function createURL($urlval){
	return strtolower(trim(BASE_URL.'/Administrator/adminuser/'.$urlval));
}



function url_origin( $s, $use_forwarded_host = false )
{
    $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
    $sp       = strtolower( $s['SERVER_PROTOCOL'] );
    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
    $port     = $s['SERVER_PORT'];
    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
    $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
    $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}

function full_url( $s, $use_forwarded_host = false )
{
	
	 return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
}
$permissionurlarr = array();
for($i=0; $i<count($record); $i++) {
$permissionurlarr[]= createURL($record[$i]);
}
 

$absolute_url =strtolower(full_url($_SERVER ));
/*  print_r($permissionurlarr);
   echo $absolute_url;
   exit; */ 
if(!in_array(trim($absolute_url),$permissionurlarr)){
	 
 header("location: permissionDenied.php ");
}
 

?>