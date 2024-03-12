 <?php 
global $dbConn ;
    $dbHost='169.38.84.125'; 
    $dbName='CU_Registration_VMC_NEW';
    $dbUser='sa';      //by default root is user name.  
    $dbPassword='Sipl@2016';     //password is blank by default  
    try{  
        $dbConn= new PDO("sqlsrv:server=$dbHost;Database=$dbName",$dbUser,$dbPassword); 
		//$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//$dbConn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);		
      // Echo "Successfully connected with test database";  
    } catch(Exception $e){  
    Echo "Connection failed" . $e->getMessage();  
    }
	
	?>

 