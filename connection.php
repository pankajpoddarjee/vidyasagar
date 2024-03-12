 <?php 
global $dbConn ;
   

    $dbHost='169.38.84.125'; 
    $dbName='VMC_SDMS';
    $dbUser='VMCSDMS';      //by default root is user name.  
    $dbPassword='Sipl@2016';     //password is blank by default  

    try{  
        $dbConn= new PDO("sqlsrv:server=$dbHost;Database=$dbName",$dbUser,$dbPassword); 
    } catch(Exception $e){  
    Echo "Connection failed" . $e->getMessage();  
    }
	
	?>