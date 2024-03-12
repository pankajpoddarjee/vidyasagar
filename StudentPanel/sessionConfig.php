<?php
session_start();
if(!$_SESSION["candidateloggedin"]){
	header("location : candidateLogin.php");
}
 
	
	
?>
