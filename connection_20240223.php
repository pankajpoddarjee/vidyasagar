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
	
	
	$dbHost2='169.38.84.125'; 
    $dbName2='VMC_SDMS_CCF';
    $dbUser2='VMCSDMSCCF';      //by default root is user name.  
    $dbPassword2='Surya@2016';     //password is blank by default  

    try{  
        $dbConn2= new PDO("sqlsrv:server=$dbHost2;Database=$dbName2",$dbUser2,$dbPassword2); 
    } catch(Exception $e){  
    Echo "Connection failed" . $e->getMessage();  
    }
	
	?>