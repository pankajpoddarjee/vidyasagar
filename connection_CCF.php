 <?php 
global $dbConn ;
   

	$dbHost='169.38.84.125'; 
    $dbName='pankaj_SDMS_CCF';
    $dbUser='pankaj';      //by default root is user name.  
    $dbPassword='pankaj@123#';     //password is blank by default  

    

    try{  
        $dbConn= new PDO("sqlsrv:server=$dbHost;Database=$dbName",$dbUser,$dbPassword); 
    } catch(Exception $e){  
    Echo "Connection failed" . $e->getMessage();  
    }
	
	?>