 <?php 
global $dbConn ;
   

	$dbHost='169.38.84.125'; 
    $dbName='VMC_SDMS_CCF';
    $dbUser='VMCSDMSCCF';      //by default root is user name.  
    $dbPassword='Surya@2016';     //password is blank by default  

    try{  
        $dbConn= new PDO("sqlsrv:server=$dbHost;Database=$dbName",$dbUser,$dbPassword); 
    } catch(Exception $e){  
    Echo "Connection failed" . $e->getMessage();  
    }
	
	?>